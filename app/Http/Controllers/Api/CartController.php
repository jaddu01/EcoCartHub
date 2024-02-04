<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
class CartController extends Controller
{
    public function index()
    {

        $carts = Cart::with('user_cart', 'cart_item.products')->get();

        return response()->json($carts);
    }
}
