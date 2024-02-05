<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CartItem;
use App\Http\Resources\CartResource;


use App\Models\Cart;
use Exception;



use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function index()
    {

        $carts = Cart::with('cart_item.products')->get();

        return ResponseBuilder::success($carts);
    }


    public function cartInfo(Request $request)
{
    try {
        $user= $request->user('api');

        $cart = $user->cart()->with(['user','items'])->first();

        if (!$cart) {
            return ResponseBuilder::error( 'Cart not found', $this->errorStatus);
        }

        $this->response->cart = new CartResource($cart);

        return ResponseBuilder::success($this->response, 'Cart details is successfully returned', $this->successStatus);

    } catch (Exception $e) {
        Log::error($e->getMessage());
        return ResponseBuilder::error( 'Something went wrong', $this->errorStatus);
    }


    }


}



