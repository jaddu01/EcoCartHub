<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(Request $request){
        try{
            $users = User::count();
            $products = Product::count();

            $admin = Auth::guard('admin')->user();
        $adminName = $admin->first_name . ' ' . $admin->last_name;

        $product = Product::first();
        $productName = $product->product_name;
        $quantity = $product->quantity;

        return view('admin.dashboard', compact('users', 'products', 'adminName','productName','quantity'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

//
}
