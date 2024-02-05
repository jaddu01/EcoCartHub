<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //login
    public function index(){
        $title = "Login | EcocartHub";
        return view('admin.login', compact('title'));
    }

    //login
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:3'
            ]);

            if($validator->fails()){
                Session::flash('error', $validator->errors()->first());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            //admin guard
            if(!auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                Session::flash('error', 'Invalid login details');
                return redirect()->back()->with('error', 'Invalid login details');
            }

            return redirect()->route('admin.dashboard');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
