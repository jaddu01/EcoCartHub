<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories= Category::get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }
    public function store(CategoryRequest $request){
        try{
            DB::beginTransaction();
            $data = $request->only(['category_name','description']);

            //upload image to storage
            if($request->hasFile('category_image')){
                $image = $request->file('category_image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image->store('categories/images');
                $data['image'] = 'categories/images/'.$image->hashName();
                // $data['image_type'] = $image->getClientOriginalExtension();
            }
            // dd($data);
            Category::create($data);
            DB::commit();
            return redirect()->route('admin.categories')->with('success','category added successfully');
        }catch(\Exception $e){
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('error',$e->getMessage())->withInput();
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
public function update(CategoryRequest $request, $id){
    try{
        // dd($request->all());
        DB::beginTransaction();
        $category = Category::find($id);
        if($category){
            $data = $request->only(['category_name','description']);
            if($request->hasFile('category_image')){
                $image = $request->file('category_image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                // dd($image_name);
                $image->store('categories/images');
                $data['image'] = 'categories/images/'.$image->hashName();
            }
            // dd($data);
            $category->update($data);
            DB::commit();
            return redirect()->route('admin.categories')->with('success','Category updated successfully');
        }else{
            return redirect()->back()->with('error','Category not found');
        }
    }catch(\Exception $e){
        DB::rollBack();
        dd($e->getMessage());
        return redirect()->back()->with('error',$e->getMessage());
    }
}

//delete
public function delete($id){
    try{
        DB::beginTransaction();
        $category = Category::find($id);
        if($category){
            $category->products()->delete();
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

    public function getCategories(Request $request){
        $categories = Category::latest()->get();

        return DataTables::of($categories)
            ->addColumn('category_name', function($category){
                return $category->category_name;
            })
            ->addColumn('image', function($category){
                return '<img src="{{ Storage::url($category->image) }}" height="100" width="100" />';
            })
            ->addColumn('action', function($category){
                return '<a href="'.route('admin.categories.edit',$category->id).'" class="btn btn-primary btn-sm">Edit</a>
                <a href="'.route('admin.categories.delete',$category->id).'" class="btn btn-danger btn-sm">Delete</a>';

            })
            ->rawColumns(['action','image'])
            ->make(true);

    }
    }

