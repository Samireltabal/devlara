<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;
use Illuminate\Support\Facades\Input;
use DB;
use App\Inventory;
use Response;
use App\Shifts;
class InventoryController extends Controller
{
    //
    public function index() {
        $time = new Carbon;
        $items = Inventory::where('type','=','2')->orWhere('type','=','3')->take(5)->orderBy('created_at','desc')->get();
        return view('admin.inventory.index')->with(compact('time','items'));
        }
    public function create(Request $request) {
     $this->validate($request, [
             'product_id' => 'required',
             'supplier_id' => 'required',
             'quantity' => 'required',
             'price' => 'required'
         ]);   

        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $product_id = $request->input('product_id');
        $supplier_id = $request->input('supplier_id');
        $inventory = new Inventory;
        $inventory->type = $request->input('type');
        $inventory->product_id = $product_id ;
        $inventory->quantity = $quantity ;
        $inventory->price = $price ;
        $inventory->shift_id = get_shift();
        $inventory->supplier_id = $supplier_id ;
        $inventory->total = $quantity * $price ;
        $inventory->save();
        return back()->with('success','Inventory Added Successfully');
        }
    public function ac_suppliers(){
        $term = Input::get('term');
        
        $results = array();
        
        $queries = DB::table('suppliers')
            ->where('supplier_name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->supplier_name ];
        }
        return Response::json($results);
    }
    public function ac_products(){
        $term = Input::get('term');
        
        $results = array();
        
        $queries = DB::table('products')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name ];
        }
        return Response::json($results);
    }
}
