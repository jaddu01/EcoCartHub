<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //index
    public function index(){
        return "Welcome to admin panel";
    }

    //login
    public function login(){
        return "Login";
    }
}
