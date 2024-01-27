<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(){
        $category = Category::find(1);
        $products = $category->products;
        return response()->json($products);
    }

    public function details($id){
        try{
            //Lazy Loading :- task read about it.
            $product = Product::with(['images', 'categories'])->find($id);
            if(!$product){
                return response()->json(['error' => 'Product not found'], 404);
            }

            $product = new ProductResource($product); //single record
            // $products = ProductResource::collection($product); //for collection/array
            return response()->json(['product' => $product]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

//store
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'product_name' => ['required', 'max:30', 'min:3', Rule::unique('products', 'product_name')->whereNull('deleted_at')],
                'brand' => 'required|min:3|max:30',
                'description' => 'nullable|min:20|max:200',
                'quantity' => 'required|integer',
                'product_price' => 'required|numeric',
                'color' => 'nullable',
                'category_id' => 'required|integer|exists:categories,id'
            ],[
                'category_id.required' => 'The category field is required',
                'category_id.exists' => 'The selected category does not exist'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->first(), 400);
            }

            // dd($request->all());
            $input = $request->only(['product_name', 'brand', 'description', 'quantity', 'product_price', 'color']);
            $product = Product::create($input);

            //store images
            if($request->hasFile('images')){
                $images = $request->file('images');
                foreach($images as $image){
                    $image->store('products/images');
                    $product->images()->create(['image' => 'products/images/'.$image->hashName(), 'image_type' => $image->extension()]);
                }
            }

            //save into pivot table
            $product->categories()->attach($request->category_id);

            return response()->json(['message' => 'Product created successfully'], 200);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    //update
    public function update(Request $request, $id){
        try{
            // dd(request('product_id'));
            //task:- you have to use unique validation rule to check if the product name is unique
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|min:3|max:50|unique:products,products_name,NULL,id,category_id,' . $request->input('category_id'),
                'brand' => 'required|min:3|max:30',
                'description' => 'nullable|min:20|max:200',
                'quantity' => 'required|integer',
                'product_price' => 'required|numeric',
                'color' => 'nullable',
                'category_id' => 'required|integer|exists:categories,id'
            ],[
                'category_id.required' => 'The category field is required',
                'category_id.exists' => 'The selected category does not exist',
                'product_name.unique' => 'The product name must be unique within the selected category.'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors()->first(), 400);
            }

            $product = Product::find($id);
            if(!$product){
                return response()->json(['error' => 'Product not found'], 404);
            }
            $product->product_name = $request->product_name;
            $product->brand = $request->brand;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->product_price = $request->product_price;
            $product->color = $request->color;
            $product->save();

            //update pivot table
            //Task:- read the definition and diff between sync, attach and syncWithoutDetaching
            $product->categories()->sync($request->category_id);

            return response()->json(['message' => 'Product updated successfully'], 200);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    //delete
    public function delete($id){
        try{
            $product = Product::find($id);
            if(!$product){
                return response()->json(['error' => 'Product not found'], 404);
            }
            //remove images
            $product->images()->delete();

            //detach pivot table
            $product->categories()->detach();

            //delete product
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 200);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    //show deleted products
    public function showDeletedProducts(){
        try{
            //onlyTrashed() is a method of softDeletes
            //withTrashed() is a method of softDeletes
            $products = Product::onlyTrashed()->get();
            return response()->json($products);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

}
