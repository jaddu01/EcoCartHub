<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        try{
            $users = User::count();
            $products = Product::count();
            // $orders = Order::get();
            return view('admin.dashboard', compact('users', 'products'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
