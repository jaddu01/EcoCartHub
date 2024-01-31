<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    //register
    public function register(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->whereNull('deleted_at')],
                'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users', 'email')->whereNull('deleted_at')],
                'password' => 'required|string|min:8|max:50',
                'country_code' => 'required|string|max:5',
                'phone_number' => ['required', 'string', 'max:15', Rule::unique('users', 'phone_number')->whereNull('deleted_at')],
            ]);

            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(), $this->validationStatus);
            }
            DB::beginTransaction();

            $input = $request->only(['first_name','last_name','username','email','country_code','phone_number']);
            $input['password'] = Hash::make($request->password);

            $user = User::create($input);

            //log-in user
            $token = $user->createToken('EcoCartHub')->accessToken;
            $this->response->token = $token;
            $this->response->user = new UserResource($user);
            DB::commit();


            return ResponseBuilder::success($this->response, "User created successfully.", $this->successStatus);

        }catch(\Exception $e){
            // return $e;
            DB::rollBack();
            return ResponseBuilder::error("Oops! Something went wrong.", $this->errorStatus);
        }
    }

    //login
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:8|max:50',
            ]);

            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(), $this->validationStatus);
            }

            $credentials = request(['email', 'password']);
            if(!Auth::attempt($credentials)){
                return ResponseBuilder::error("Invalid credentials.", $this->unAuthStatus);
            }

            $user = $request->user();
            $token = $user->createToken('EcoCartHub')->accessToken;
            $this->response->token = $token;
            $this->response->user = new UserResource($user);

            return ResponseBuilder::success($this->response, "User logged in successfully.", $this->successStatus);
        }catch(\Exception $e){
            return ResponseBuilder::error("Oops! Something went wrong.", $this->errorStatus);
        }

    }

    //logout
    public function logout(Request $request){
        try{
            $request->user()->token()->revoke();
            return ResponseBuilder::success(null, "User logged out successfully.", $this->successStatus);
        }catch(\Exception $e){
            return ResponseBuilder::error("Oops! Something went wrong.", $this->errorStatus);
        }
    }
}
