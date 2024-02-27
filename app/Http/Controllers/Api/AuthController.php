<?php

namespace App\Http\Controllers\Api;

use App\Events\RegisterConfirmed;
use App\Helpers\CustomHelper;
use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Jobs\SenEmails;
use App\Mail\SendOrderConfirmation;
use App\Mail\SendRegisterConfirmation;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Number;

class AuthController extends Controller
{
    //register
    public function register(Request $request)
    {
        try {
            $lang = $request->header('lang');
            app()->setLocale($lang);

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->whereNull('deleted_at')],
                'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users', 'email')->whereNull('deleted_at')],
                'password' => 'required|string|min:8|max:50',
                'country_code' => 'required|string|max:5',
                'phone_number' => ['required', 'string', 'max:15', Rule::unique('users', 'phone_number')->whereNull('deleted_at')],
            ]);

            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), $this->validationStatus);
            }
            DB::beginTransaction();

            $input = $request->only(['first_name', 'last_name', 'username', 'email', 'country_code', 'phone_number']);
            $input['password'] = Hash::make($request->password);

            $user = User::create($input);

            $addresses = $request->get('addresses', []);
            foreach ($addresses as $address) {
                $user->addresses()->create($address);
            }

            //log-in user
            $token = $user->createToken('EcoCartHub')->accessToken;
            $this->response->token = $token;
            $this->response->user = new UserResource($user);
            DB::commit();

            event(new RegisterConfirmed($user));

            return ResponseBuilder::success($this->response, "User created successfully.", $this->successStatus);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseBuilder::error("Oops! Something went wrong.", $this->errorStatus);
        }
    }

    //login
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|max:50',
                'password' => 'required|string|min:8|max:50',


            ]);

            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), $this->validationStatus);
            }


            //$credentials = request(['email', 'password']);
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $credentials = ['email' => $request->email, 'password' => $request->password];
            } else {
                $credentials = ['username' => $request->email, 'password' => $request->password];
            }

            if (!Auth::attempt($credentials)) {
                return ResponseBuilder::error("Invalid credentials.", $this->unAuthStatus);
            }

            $user = $request->user();
            $token = $user->createToken('EcoCartHub')->accessToken;
            //$this->response->token = $token;
            $this->response->user = new UserResource($user);

            return ResponseBuilder::successWithToken($token, $this->response, "User logged in successfully.", $this->successStatus);

            //return ResponseBuilder::success($this->response, "User logged in successfully.", $this->successStatus);
        } catch (\Exception $e) {
            return ResponseBuilder::error("Oops! Something went wrong.", $this->errorStatus);
        }
    }

    //logout
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return ResponseBuilder::success(null, "User logged out successfully.", $this->successStatus);
        } catch (\Exception $e) {
            return ResponseBuilder::error("Oops! Something went wrong.", $this->errorStatus);
        }
    }




    protected function generateOTP($user)
    {
        // Generate a random 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store the OTP in the cache for the user
        Cache::put("otp:{$user->id}", $otp, 5); // Adjust the expiration time as needed

        // You may also want to send the OTP to the user through a notification or another method

        return $otp;
    }




    public function loginOTP(Request $request)
    {
        // Validate the phone number and country code
        $request->validate([
            'country_code' => 'required|string|max:5',
            'phone_number' => 'required|string',
        ]);

        $user = User::where('country_code', $request->country_code)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (!$user) {
            // User not found
            return ResponseBuilder::error('User not found', $this->errorStatus);
        }

        // Generate and save OTP
        $otp = $this->generateOTP($user);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(config('auth.otp_ttl')),
        ]);

        // Send OTP (you may implement this part)

        return ResponseBuilder::success($otp, 'OTP sent successfully', $this->successStatus);
    }

    public function verifyOTP(Request $request)
    {

        $request->validate([
            'country_code' => 'required|string',
            'phone_number' => 'required|string',
            'otp' => 'required|string',
        ]);

        // Find the user by phone number and country code
        $user = User::where('country_code', $request->country_code)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (!$user) {
            // User not found
            return ResponseBuilder::error('User not found', $this->errorStatus);
        }


        if ($request->otp === $user->otp) {
            // Clear OTP fields in the user record
            $user->otp = null;
            $user->save();


            $token = $user->createToken('OTPtoken')->accessToken;

            return ResponseBuilder::success($token, 'OTP verified successfully', $this->successStatus);
        } else {
            return ResponseBuilder::error('Invalid OTP', $this->errorStatus);
        }
    }

    public function sendEmailJob(){
        try {
            $sum = CustomHelper::getSum(5, 10);
            dd($sum);
            $users = User::limit(5)->get();
            // dd($users);
            foreach ($users as $user) {
                //send email
                SenEmails::dispatch($user); //dispatches the job to the queue
                // SenEmails::dispatchSync($user); //dispatches the job to the queue and runs it immediately
            }

            // SenEmails::dispatchSync(); //dispatches the job to the queue and runs it immediately
            // SenEmails::dispatchAfterResponse(); //dispatches the job to the queue and runs it after the response is sent
            // SenEmails::dispatchIf(true, $users); //dispatches the job to the queue if the condition is true
            // SenEmails::dispatchUnless(false, $users); //dispatches the job to the queue if the condition is false
            return ResponseBuilder::success(null, "Email sent successfully.", $this->successStatus);
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::error("Oops! Something went wrong.", $this->errorStatus);
        }
    }
}
