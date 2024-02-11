<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request){
        $products= Product::latest()->get();
        return view('admin.products.index',compact('products'));
    }

    //create
    public function create(){
        return view('admin.products.create');
    }

    //store
    public function store(Request $request){
        try{
            $request->validator([
                'product_name'=>'required',
                'product_price'=>'required',
                'description'=>'required',
                'brand'=>'required',
                'color' => 'required',
            ]);
            dd($request->all());
            DB::beginTransaction();
            $data = $request->only(['product_name','product_price','description','brand','color']);

            Product::create($data);
            DB::commit();
            return redirect()->route('admin.products')->with('success','Product added successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
