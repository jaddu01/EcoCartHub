<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrdersController extends Controller
{
    //view orders
    public function index(Request $request){
        try{
            $user = $request->user('api');

            $orders = $user->orders()->with('items')->paginate(1);
            $this->response->orders = OrderResource::collection($orders);

            return ResponseBuilder::successWithPagination($orders, $this->response, 'Orders list', $this->successStatus);

        }catch(Exception $e){
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }


    //place order
    public function placeOrder(Request $request){
        try{
            $user = $request->user('api');

            DB::beginTransaction();
            //cart
            $cart = $user->cart;
            if(!$cart){
                return ResponseBuilder::error('Cart not found', $this->notFoundStatus);
            }

            //save order
            $order = $user->orders()->create([
                'order_number' => 'ORD-'.strtoupper(uniqid()),
                'total_price' => $cart->total_price,
                'discount' => 0,
                'grand_total' => $cart->grand_total,
                'status' => 'pending'
            ]);

            //save order items
            foreach($cart->items as $item){
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'product_price' => $item->product_price,
                    'color' => $item->color,
                    'image' => $item->product->image->image ?? ''
                ]);
            }

            //clear cart
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return ResponseBuilder::success('Order placed successfully', $this->successStatus);

        }catch(Exception $e){
            DB::rollBack();
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }


    //order info
    public function view(Request $request){
        try{
            $user = $request->user('api');
            $orderId = request('order_id');

            $order = $user->orders()->with('items')->find($orderId);
            if(!$order){
                return ResponseBuilder::error('Order not found', $this->notFoundStatus);
            }

            $this->response->order = new OrderResource($order);

            return ResponseBuilder::success($this->response, 'Order info', $this->successStatus);

        }catch(Exception $e){
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }

    //1. create a new api to update the order status
    //2. create a new api to cancel the order
}
