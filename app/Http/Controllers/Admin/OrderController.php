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
                return "SAR ".$order->total_price;

            })
            ->addColumn('discount', function($order){
                return "SAR ".$order->discount;

            })
            ->addColumn('grand_total', function($order){
                return "SAR ".$order->total_price;

            })
            ->addColumn('status', function($order){
                switch($order->status){
                    case 'pending':
                        return '<span class="btn btn-block btn-outline-warning">Pending</span>';
                        break;
                    case 'processing':
                        return '<span class="btn btn-block btn-outline-primary">Processing</span>';
                        break;
                    case 'completed':
                        return '<span class="btn btn-block btn-outline-success">Completed</span>';
                        break;
                    case 'declined':
                        return '<span class="btn btn-block btn-outline-danger">Declined</span>';
                        break;
                    case 'canceled':
                        return '<span class="btn btn-block btn-outline-danger">Declined</span>';
                        break;
                    default:
                        return '<span class="btn btn-block btn-outline-warning">Pending</span>';
                        break;
                }

            })
            ->addColumn('user_name', function($order){
                return $order->user->full_name;
            })
            ->addColumn('actions', function($order){
                return '<a href="'.route('admin.orders.show', $order->id).'" class="btn btn-outline-primary btn-sm">View</a>';
            })
            ->rawColumns(['status','actions'])
            ->make(true);

    }

    //show order details
    public function show($order_id){
        $order = Order::find($order_id);
        return view('admin.orders.show', compact('order'));
    }
}
