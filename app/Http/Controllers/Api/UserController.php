<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function usersWithAddresses($userId){
        $user = User::find($userId);
        $addresses = $user->addresses;
        return response()->json($addresses);
    }

}
