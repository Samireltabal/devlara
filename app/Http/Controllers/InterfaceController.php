<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Auth;
use App\Customers;
use App\Invoices;
use App\Inventory;
use App\Products;
use App\Items;
class InterfaceController extends Controller
{
    //
    /*
     * Sales Main Page ..  
     */
    public function index() {
        $invoices = Invoices::where('shift_id','=',get_shift())
                                   ->where('status' , '=' , 1)
                                   ->get();
        $current_invoice = array(
            'id' => 'null'
        );
        return view('dashboard.sales')->with(compact('invoices','current_invoice'));
    }
    public function invoice($id) {
        $invoices = Invoices::where('shift_id','=',get_shift())
                                   ->where('status' , '=' , 1)
                                   ->get();
        $current_invoice = Invoices::find($id);                                   
        return view('dashboard.sales')->with(compact('invoices','current_invoice'));
    }
    public function invoice_redirect(Request $request){
        $id = $request->input('invoice_id');
        if($id)
        {
            return redirect()->route('invoice.ID',$id);
        }else{
            return redirect()->route('sales.main');
        }
    }
    /*
    * Submit New Item To Current Invoice Or To null 
    */
    public function submit_item(Request $request) {
        $product_id = $request->input('product_id');
        $shift_id = $request->input('shift_id');
        $quantity = $request->input('product_quantity');
        $price = $request->input('product_price');
        $total = $quantity * $price ;
        $type = 1;
        $sn = $request->input('sn');
        $invoice_id = $request->input('invoice_id');
        // WIP
        return $request;
    }
    /*
    *   Customer Autocomplete LIst
    */
    public function customersAC() {
        $term = Input::get('term');
        
        $results = array();
        
        $queries = DB::table('customers')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name, 'phone' => $query->phone ];
        }
        return Response::json($results);
    }
    /*
    *   Given Invoice Id returns List Of Items Related .. 
    */
    public function invoice_ajax($id = 'null') {
        if ($id !== 'null') {
            $invoice = Invoices::find($id);
            $invoice_items = $invoice->items;
            return view('dashboard.invoice')->with(compact('invoice_items'));
        }else {
            // $invoice_items = Items::where('shift_id','=',get_shift())->groupBy('product_id')->get(); 
            $invoice_items = "public invoice";
            return view('dashboard.invoice')->with(compact('invoice_items'));
        }

        
    }
    /*
    *   Ajax Return List Of Products ( Auto Complete )
    */
    public function products_list() { 
        $term = Input::get('term');
        $results = array();
        $queries = DB::table('products')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $product = Products::find($query->id);
            $results[] = [ 'id' => $product->id, 'value' => $product->name, 'price' => $product->price , 'quantity' => $product->quantity_available() , 'barcode' => $product->barcode ];
        }
        return Response::json($results);
    }
    public function barcode() { 
        $term = Input::get('term');
        $results = array();
        $queries = DB::table('products')
            ->where('barcode', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $product = Products::find($query->id);
            $results[] = [ 'id' => $product->id, 'value' => $product->barcode, 'price' => $product->price , 'quantity' => $product->quantity_available() , 'name' => $product->name ];
        }
        return Response::json($results);
    }
    /*
    *   Create New Invoice 
    */
    public function create_invoice(Request $request) {
        $customer = Customers::firstOrCreate(['name' => $request->input('customer_name'),'phone' => $request->input('customer_phone')]);
        $customer_id = $customer->id ;
        $invoice = new Invoices;
        $invoice->user_id = Auth::user()->id ;
        $invoice->shift_id = get_shift();
        $invoice->customer_id = $customer_id;
        $invoice->status = 1;
        $invoice->save();
        return redirect()->route('invoice.ID',$invoice->id)->with('success','Invoice Created Successfully');
    }
}
