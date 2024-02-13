<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(Request $request){
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }

    public function create(){

        return view('admin.users.create');
    }

    public function store(UserRequest $request){

        try{
            DB::beginTransaction();
            $data = $request->only('first_name','last_name','username','email','password','country_code','phone_number');
            $user = User::create($data);

            $dataAddress= $request->only('address_line_1','address_line_2','city','state','country','postal_code');
            $address= $user->addresses()->create($dataAddress);

            DB::commit();

            return redirect()->route('admin.users')->with('Success','User added successfully');


        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function edit($id){
        $user= User::with('addresses')->find($id);
        if($user){
            return view('admin.users.edit',compact('user'));

    }else{
        return redirect()->back()->with('error','User not found');
    }

    }

    public function update(UserRequest $request, $id){
        try{
            DB::beginTransaction();
            $user= User::find($id);
            $userWithAddresses= $user->addresses();
            if($user){
            $data = $request->only('first_name','last_name','username','email','password','country_code','phone_number');
            $user->update($data);
            $dataAddress= $request->only('address_line_1','address_line_2','city','state','country','postal_code');
            $address= $user->addresses()->update($dataAddress);

            }

            else{
                return redirect()->back()->with('error','User not found');
            }

            DB::commit();

            return redirect()->route('admin.users')->with('Success','User updated successfully');


        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function delete($id){
        try{
        DB::beginTransaction();
        $user= User::find($id);
        if($user){
            $user->addresses()->delete();
            $user->delete();
            DB::commit();
            return redirect()->route('admin.users')->with('success','User deleted successfully');
        }
        else{
            return redirect()->back()->with('error','User not found');
        }
    }catch(\Exception $e){
        DB::rollBack();

        return redirect()->back()->with('error',$e->getMessage());

    }
    }


    public function profile($id){
        $user = User::with('addresses')->find($id);
        return view('admin.users.profile', compact('users'));
    }
}





