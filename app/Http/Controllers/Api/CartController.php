<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CartItem;
use App\Http\Resources\CartResource;
use App\Models\Product;
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

    public function addItem(Request $request, $productId){
        try{
            $user= $request->user('api');
            $cart = $user->cart;
            // dd($cart);
            if(!$cart){
                $cart = Cart::create(['user_id'=>$user->id,'status'=>'active']);
            }



            $product= Product::find($productId);

            if(!$product){
                return ResponseBuilder::error('Product not found', $this->errorStatus);
            }
            $price= $product->product_price;

            $existingItem = $cart->items()->where('product_id', $productId)->first();

            if($existingItem){
                $existingItem->increment('quantity');
                $existingItem->update(['price'=> $price * $existingItem->quantity]);
            }else{
                $items = [
                    'product_id' => $productId,
                    'quantity' => 1,
                    'price' => $price
                ];

                $cart->items()->create($items);
            }
            $this->response->cart = new CartResource($cart);
            return ResponseBuilder::success($this->response, 'Item added to the cart successfully',$this->successStatus);

        }catch(Exception $e){

            log::error($e->getMessage());
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }


    public function removeItem(Request $request, $itemId) {
        try {
            $user = $request->user('api');
            $cart = $user->cart;

            $item = $cart->items()->findOrFail($itemId);

            if ($item->quantity > 1) {
                $item->decrement('quantity');

                $product = $item->product;

            $newPrice = $product->price * $item->quantity;
            $item->update(['price' => $newPrice]);

            } else {

                $item->delete();
                return ResponseBuilder::success(null, 'Item removed from the cart successfully', $this->successStatus);
            }

            return ResponseBuilder::success(null, 'Item quantity reduced successfully', $this->successStatus);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }


}



