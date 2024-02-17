<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartItemResource;
use App\Models\Product;
use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('cart_item.products')->get();
        $this->response->carts = CartResource::collection($carts);
        return ResponseBuilder::success($this->response);
    }


    public function cartInfo(Request $request)
{
    try {
        $user= $request->user('api');

        $cart = $user->cart;
        if(!$cart){
            return ResponseBuilder::error('Cart not found', $this->notFoundStatus);
        }

        $this->response->cart = new CartResource($cart);

        return ResponseBuilder::success($this->response, 'Cart details is successfully returned', $this->successStatus);

    } catch (Exception $e) {
        // Log::error($e->getMessage());
        dd($e->getMessage());
        return ResponseBuilder::error( 'Something went wrong', $this->errorStatus);
    }


    }

    public function addItem(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'product_id' => ['required', Rule::exists('products', 'id')->whereNull('deleted_at')],
                'color' => 'nullable|string|max:255'
            ]);

            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(), $this->validationStatus);
            }

            DB::beginTransaction();
            $user = $request->user('api');
            $productId = $request->product_id;
            $product= Product::find($productId);
            if(!$product){
                return ResponseBuilder::error('Product not found', $this->notFoundStatus);
            }
            $price= $product->product_price;
            $quantity= $request->quantity ?? 1;

            $totalPrice = $price * $quantity;

            $cart = $user->cart;
            if(!$cart){
                $cart = Cart::create(['user_id'=>$user->id, 'total_price' => $totalPrice, 'grand_total' => $totalPrice]);
            }else{
                $cart->update(['total_price' => $cart->total_price + $totalPrice, 'grand_total' => $cart->grand_total + $totalPrice]);
            }
            $existingItem = $cart->items()->where('product_id', $productId)->first();

            if($existingItem){
                $existingItem->increment('quantity');
                $existingItem->update(['product_price'=> $price, 'price' => $existingItem->quantity * $price, 'color' => $request->color ?? $existingItem->color]);

            }else{
                $items = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'product_price' => $price,
                    'price' => $totalPrice,
                    'color' => $request->color ?? null,
                ];

                $cart->items()->create($items);
            }
            DB::commit();
            $this->response->cart = new CartResource($cart);
            return ResponseBuilder::success($this->response, 'Item added to the cart successfully',$this->successStatus);

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }


    // public function deleteItem(Request $request,$itemId) {
    //     try {
    //         $user = $request->user('api');
    //         $cart = $user->cart();
    //         //dd($user);
    //         $item = $cart->items()->find($itemId);

    //         if ($item->quantity > 1) {
    //             $item->decrement('quantity');

    //             $product = $item->product;

    //         $newPrice = $product->price * $item->quantity;
    //         $item->update(['price' => $newPrice]);

    //         } else {

    //             $item->delete();
    //             return ResponseBuilder::success(null, 'Item removed from the cart successfully', $this->successStatus);
    //         }

    //         return ResponseBuilder::success(null, 'Item quantity reduced successfully', $this->successStatus);
    //     } catch (Exception $e) {
    //         Log::error($e->getMessage());
    //         return ResponseBuilder::error('Something went wrong', $this->errorStatus);
    //     }
    // }

    //remove only item from cart item table and update cart table total price and grand total
    public function deleteItem(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'product_id' => ['required', Rule::exists('products', 'id')->whereNull('deleted_at')],
            ]);

            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(), $this->validationStatus);
            }

            DB::beginTransaction();
            $user = $request->user('api');
            $productId = $request->product_id;

            $cart = $user->cart;
            if(!$cart){
                return ResponseBuilder::error('Cart not found', $this->notFoundStatus);
            }

            $existingItem = $cart->items()->where('product_id', $productId)->first();

            if($existingItem){

                $existingItem->decrement('quantity');

                $price = $existingItem->product_price;
                $existingItem->price = $price * $existingItem->quantity;
                $existingItem->save();

                $cart->update(['total_price' => $cart->total_price - $price, 'grand_total' => $cart->grand_total - $price]);


                if ($existingItem->quantity === 0) {
                    $existingItem->delete();
                }
            } else {
                return ResponseBuilder::error('Item not found in the cart', $this->notFoundStatus);
            }

            DB::commit();
            $this->response->cart = new CartResource($cart);
            return ResponseBuilder::success($this->response, 'Item removed from the cart successfully', $this->successStatus);
        } catch(Exception $e){
            DB::rollBack();
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }

    //create a new function to update the cart

    //clear the cart
    public function clearCart(Request $request){
        try{
            $user = $request->user('api');

            $cart = $user->cart;
            if(!$cart){
                return ResponseBuilder::error('Cart not found', $this->notFoundStatus);
            }

            $cart->items()->delete();
            $cart->delete();

            return ResponseBuilder::success(null, 'Cart cleared successfully', $this->successStatus);

        }catch(Exception $e){
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }



}



