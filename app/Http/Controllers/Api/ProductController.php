<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $category = Category::find(1);
        $products = $category->products;
        return response()->json($products);
    }

    public function productInfo()
{
    $category = Category::find(2);


    $products = $category->products()->select( 'product_name', 'brand',
    'description', 'quantity', 'product_price', 'color')->get();

    return response()->json($products);
}

//store
    public function store(ProductRequest $request){
        try{
            $validated = $request->validated();
            return "done";

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

}
