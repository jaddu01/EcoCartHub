<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Jobs\SendOffersJob;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use app\Mail\SendOffers;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(){

        $users= User::all();
        return response()->json($users);

    }

    public function getUserById($userId)
    {

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function profile(Request $request){
        try{
            $user = $request->user('api');
            $this->response->user = new UserResource($user);

            return ResponseBuilder::success($this->response, "User profile retrieved successfully.", $this->successStatus);
        }catch(\Exception $e){
            return ResponseBuilder::error("Oops! Something went wrong.", 500);
        }
    }

    public function sendOffersJob(Request $request)
    {
        try {

            SendOffersJob::dispatch();


            return response()->json(['message' => 'Offers sent to users successfully'], 200);
            }catch (\Exception $e) {

            Log::error($e->getMessage());


            // return response()->json(['error' => 'Failed to send offers to users'], 500);
        }
    }
}



