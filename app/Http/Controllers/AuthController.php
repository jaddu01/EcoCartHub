<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //index
    public function index(){
        app()->setLocale('en');
        return __('api.welcome_text');
    }

}
