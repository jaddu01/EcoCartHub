<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


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
            $product = Product::create($data);

            //upload images to storage
            if($request->hasFile('product_images')){
                $images = $request->file('product_images');
                foreach($images as $image){
                    $image->store('products/images');
                    $product->images()->create(['image' => 'products/images/'.$image->hashName()], ['image_type' => $image->getClientOriginalExtension()]);
                }
            }
            DB::commit();
            return redirect()->route('admin.products')->with('success','Product added successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    //edit
    public function edit($id){
        $product = Product::with('images')->find($id);
        // dd($product);
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


    public function getProducts(Request $request){
        $products = Product::latest()->get();

        return DataTables::of($products)
            ->addColumn('product_name', function($product){
                return $product->product_name;
            })
            ->addColumn('brand', function($product){
                return $product->brand;

            })

            ->addColumn('description', function($product){
                return $product->description;
            })
            ->addColumn('product_price', function($product){
                return $product->product_price;
            })
            ->addColumn('color', function($product){
                return $product->color;
            })
            ->addColumn('productImage', function($product){
                return '<img src="'.Storage::url($product->images()->first()->image).'" height="70" width="70" />';;
            })
            ->addColumn('action', function($product){
                return '<a href="'.route('admin.products.edit',$product->id).'" class="btn btn-primary btn-sm">Edit</a>
                <a href="'.route('admin.products.delete',$product->id).'" class="btn btn-danger btn-sm">Delete</a>
                ';
            })
            ->rawColumns(['action','productImage'])
            ->make(true);

    }
}
