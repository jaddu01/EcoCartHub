<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

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
}
