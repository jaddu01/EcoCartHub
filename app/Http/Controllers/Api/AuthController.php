<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //index
    public function index(){
        return "Welcome to API";
    }

    //register
    public function register(){
        return "Register";
    }

    //login
    public function login(){
        return "Login";
    }
}
