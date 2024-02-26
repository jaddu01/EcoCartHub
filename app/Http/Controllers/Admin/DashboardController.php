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
    public function index(Request $request)
    {
        try {
            app()->setLocale('ar');
            $users = User::count();

            $products = $this->product();

            $totalProducts = Product::count();
            return view('admin.dashboard', compact('users', 'totalProducts', 'products'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function product()
    {
        $AllProducts = collect(Product::get());
        $products = $AllProducts->take(10);

        return $products;
    }

    //
}
