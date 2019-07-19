<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Categories;
use carbon\Carbon;

class ProductsController extends Controller
{
    //
    public function index() {
        $time = new Carbon;
        $cats = Categories::all();
        return view('admin.products.index')->with(compact('time','cats'));
    }
    public function show() {
        $products = Products::all()->groupBy('category_id');
        $cats = Categories::all();
        return view('admin.products.ajax')->with(compact('products','cats'));
        //return $products;
    }
    public function create(Request $request) {
        $product = new Products;
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->category_id = $request->input('product_category');
        $product->active = $request->input('active');
        $product->type = $request->input('product_type');
        $product->save();
        $product->barcode = str_random(4) . $product->id . Carbon::today()->year.Carbon::today()->month.Carbon::today()->day ;
        $product->save();
        return response('success',200);
    }
    public function edit(Request $request) {
        $product = Products::find($request->input('id'));
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category');
        $product->type = $request->input('product_type');
        if($product->barcode == null) {
            $product->barcode = str_random(4) . $product->id . Carbon::today()->year.Carbon::today()->month.Carbon::today()->day ;
        }
        $product->save();
        return response('success',200);
    }
    public function toggle(Request $request) {
        $product = Products::find($request->input('id'));
        $product->toggleStat()->save();
        return response('success',200);
    }
    public function delete(Request $request) {
        $product = Products::find($request->input('id'));
        $product->delete();
        return response('Success',200);
    }
}
