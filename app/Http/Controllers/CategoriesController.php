<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use carbon\Carbon;
class CategoriesController extends Controller
{
    //
    public function index(){
        //$categories = Categories::all();
        $time = new Carbon;
        return view('admin.categories.index')->with(compact('time'));
    }
    public function showCategories() {
        $categories = Categories::all();
        return view('admin.categories.ajax')->with(compact('categories'));
    }
    public function create(Request $request){
        $category = new Categories;
        $category->cat_name = $request->input('category_name');
        $category->save();
        return response('success',200);
        }
    public function edit(Request $request){
        $category  = Categories::find($request->input('id'));
        $category->cat_name = $request->input('category_name');
        $category->save();
        return back()->with('success',"Category updated successfully");
    }
    public function delete(Request $request){
        $category = Categories::find($request->input('id'));
        $category->delete();
        return response('success',200);
    }
}
