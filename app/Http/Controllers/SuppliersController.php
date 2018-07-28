<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\redirect;

use App\Suppliers;
class SuppliersController extends Controller
{
    //
    public function index() {
        $suppliers = Suppliers::all();
        $time = new Carbon;
        return view('admin.suppliers.index')->with(compact('suppliers','time'));
    }
    public function create(Request $request) {
        $supplier = new Suppliers;
        $supplier->supplier_name = $request->input('supplier_name');
        $supplier->phone = $request->input('supplier_phone');
        $supplier->address = $request->input('supplier_address');
        $supplier->save();
        return back()->with('success','Supplier Added Successfully');
    }
}
