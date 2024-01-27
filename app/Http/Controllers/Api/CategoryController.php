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

    public function index()
    {

        $categories = Category::all();
        return response()->json($categories);
    }


    public function store(Request $request)
    {

        try {
            $validate = validator::make($request->all(), [
                'category_name' => 'required|min:3|max:50',
                'description' => 'required|min:15|max:150',
                'image' => 'required|min:10|max:100',

            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors()->first(), 400);
            }

            Category::create($request->all());


            return response()->json(['message' => 'Category created successfully'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    public function update(Request $request, $id){

        try{
            $validator = validator::make($request->all(),[
                'category_name' => 'required|min:3|max:50',
                'description' => 'required|min:15|max:150',
                'image' => 'required|min:10|max:100',

            ]);

            if($validator->fails()){
                return response()->json($validator->errors()->first(),401);
            }

            $category= Category::find($id);
            if(!$category){
                return response()->json(['error'=>'Category not found'],403);
            }

            $category->category_name = $request->category_name;
            $category->description = $request->description;
            $category->image = $request->image;
            $category->save();

            return response()->json(['message' => 'Category updated successfully'], 200);

        }catch(Exception $e){
         log::error($e->getMessage());
         return response()->json(['error' => 'Something went wrong'],500);
        }

    }

    public function delete($id){

        try{
            $category=Category::find($id);
            if(!$category){
                return response()->json(['error'=>'category not found'],405);
            }

            $category->products()->detach();

            $category->products()->delete();

            $category->delete();

            return response()->json(['message'=>'Category deleted successfully'],202);

        }catch(Exception $e){

            log::error($e->getMessage());
            return response()->json(['error'=>'Something went wrong'],406);

        }

    }


    public function showDeletedCategories(){
        try{
            $category = Category::onlyTrashed()->get();
            //$category = Category::withTrashed()->get();
            return response()->json($category);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }





}
