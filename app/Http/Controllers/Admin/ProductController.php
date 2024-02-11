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

    //edit
    public function edit($id){
        $product = Product::find($id);
        if($product){
            return view('admin.products.edit',compact('product'));
        }else{
            return redirect()->back()->with('error','Product not found');
        }
    }

    //update
    public function update(ProductRequest $request, $id){
        try{
            DB::beginTransaction();
            $product = Product::find($id);
            if($product){
                $data = $request->only(['product_name','product_price','description','brand','color','quantity']);
                $product->update($data);
                DB::commit();
                return redirect()->route('admin.products')->with('success','Product updated successfully');
            }else{
                return redirect()->back()->with('error','Product not found');
            }
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    //delete
    public function delete($id){
        try{
            DB::beginTransaction();
            $product = Product::find($id);
            if($product){
                $product->delete();
                DB::commit();
                return redirect()->route('admin.products')->with('success','Product deleted successfully');
            }else{
                return redirect()->back()->with('error','Product not found');
            }
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
