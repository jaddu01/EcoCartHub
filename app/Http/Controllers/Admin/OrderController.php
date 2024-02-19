<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{

    public function index(Request $request){
        return view('admin.orders.index');
    }

    public function getOrders(Request $request){
        $orders = Order::latest()->get();

        return DataTables::of($orders)
            ->addColumn('order_number', function($order){
                return $order->order_number;
            })
            ->addColumn('total_price', function($order){
                return $order->total_price;

            })
            ->addColumn('discount', function($order){
                return $order->discount;

            })
            ->addColumn('grand_total', function($order){
                return $order->total_price;

            })
            ->addColumn('status', function($order){
                return $order->status;

            })
            ->addColumn('user_id', function($order){
                return $order->user_id;

            })


            ->make(true);

    }
}
