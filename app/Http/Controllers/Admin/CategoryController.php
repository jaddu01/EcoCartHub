<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories= Category::get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $data = $request->only(['category_name','description','image','image_type']);

            Category::create($data);
            DB::commit();
            return redirect()->route('admin.categories')->with('success','category added successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
}
public function edit($id){
    $category = Category::find($id);
    if($category){
        return view('admin.categories.edit',compact('category'));
    }else{
        return redirect()->back()->with('error','Product not found');
    }
}

//update
public function update(Request $request, $id){
    try{
        DB::beginTransaction();
        $category = Category::find($id);
        if($category){
            $data = $request->only(['category_name','description','image','image_type']);
            $category->update($data);
            DB::commit();
            return redirect()->route('admin.categories')->with('success','Category updated successfully');
        }else{
            return redirect()->back()->with('error','Category not found');
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
        $category = Category::find($id);
        if($category){
            $category->products->delete();
            $category->delete();
            DB::commit();
            return redirect()->route('admin.categories')->with('success','Category deleted successfully');
        }else{
            return redirect()->back()->with('error','Category not found');
        }
    }catch(\Exception $e){
        DB::rollBack();
        return redirect()->back()->with('error',$e->getMessage());
    }
}
}
