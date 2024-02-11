<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    public function store(ProductRequest $request){
        try{
            DB::beginTransaction();
            $data = $request->only(['product_name','product_price','description','brand','color','quantity']);

            Product::create($data);
            DB::commit();
            return redirect()->route('admin.products')->with('success','Product added successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
