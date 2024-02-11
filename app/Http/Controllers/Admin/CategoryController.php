<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories= Category::get();
        return view('admin.categories.index',compact('categories'));
    }
}
