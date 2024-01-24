<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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

}
