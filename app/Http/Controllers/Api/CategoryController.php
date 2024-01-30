<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
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



    public function details($id)
    {
        try {
            //Lazy Loading :- task read about it.
            $category = Category::find($id);
            if (!$category) {
                //return response()->json(['error' => 'Category not found'], 404);
                return ResponseBuilder::error('Category not found', $this->errorStatus);
            }
            $this->response->products = new CategoryResource($category);
            //$category = new CategoryResource($category); //single record
            // $products = ProductResource::collection($product); //for collection/array
            //return response()->json(['category' => $category]);
            return ResponseBuilder::success( $this->response, 'Category fetched successfully', $this->successStatus);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    public function store(Request $request)
    {

        try {
            $validate = validator::make($request->all(), [
                'category_name' => 'required|min:3|max:50',
                'description' => 'required|min:15|max:150',
                'image' => 'required|min:10|max:500',

            ]);

            if ($validate->fails()) {
                return ResponseBuilder::error($validate->errors()->first(), $this->validationStatus);
                //return response()->json($validate->errors()->first(), 400);
            }

            $input = $request->only(['category_name', 'description']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->store('category/image');
                $input['image'] = 'category/image/' . $image->hashName();
            }
            $category = Category::create($input);



            return ResponseBuilder::success($category , 'Category created successfully' , $this->successStatus);
            //return response()->json(['message' => 'Category created successfully'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            //return response()->json(['error' => 'Something went wrong'], 500);
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }


    public function update(Request $request, $id)
    {

        try {
            $validator = validator::make($request->all(), [
                'category_name' => 'required|min:3|max:50',
                'description' => 'required|min:15|max:150',
                'image' => 'required|min:10|max:100',

            ]);

            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), $this->errorStatus);
            }

            $category = Category::find($id);
            if (!$category) {
                return ResponseBuilder::error('Category not found', $this->errorStatus);
            }

            $category->category_name = $request->category_name;
            $category->description = $request->description;
            $category->image = $request->image;
            $category->save();

            return ResponseBuilder::success($category , 'Category updated successfully' , $this->successStatus);

        } catch (Exception $e) {
            log::error($e->getMessage());
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }

    public function delete($id)
    {

        try {
            $category = Category::find($id);
            if (!$category) {
                return ResponseBuilder::error('category not found', $this->errorStatus);
            }

            $category->products()->detach();

            $category->products()->delete();

            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 202);
        } catch (Exception $e) {

            log::error($e->getMessage());
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }


    public function showDeletedCategories()
    {
        try {
            $category = Category::onlyTrashed()->get();
            //$category = Category::withTrashed()->get();
            return ResponseBuilder::success($category , $this->successStatus);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseBuilder::error('Something went wrong', $this->errorStatus);
        }
    }
}
