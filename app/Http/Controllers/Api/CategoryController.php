<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class CategoryController extends Controller
{

public function index(){

    $categories= Category::all();
    return response()->json($categories);

}


public function store(CategoryRequest $request){

    try{
        $validated = $request->validated();
        return response()->json(['message' => 'Category created successfully'], 200);


    }catch(Exception $e){
        Log::error($e->getMessage());
        return response()->json(['error' => 'Something went wrong'], 500);
    }

}



}
