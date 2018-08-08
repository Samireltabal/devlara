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
use App\Expdest;
use App\Expenses;
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
            'id' => '0'
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
        $product_type = $request->input('product_type');

        $total = $quantity * $price ;
        $type = 1;
        $sn = $request->input('sn');
        $invoice_id = $request->input('invoice_id');
        // WIP
        $item = new Items;
        $inventory = new Inventory;
        $item->price = $price ;
        $item->product_id = $product_id;
        $item->shift_id = $shift_id;
        $item->invoice_id = $invoice_id;
        $item->sn = $sn;
        $item->type = $product_type;
        $item->quantity = $quantity;
        $item->total = $total;
        $inventory->product_id = $product_id;
        $inventory->quantity = $quantity;
        $inventory->price = $price;
        $inventory->total = $total;
        $inventory->shift_id = $shift_id;
        $inventory->type = 1;
        $item->save();
        $inventory->save();
        return response('success',200);
    }
    /*
    *   sales.toggle.invoice
    */
    public function toggleInvoice($id) {
        $invoice = Invoices::find($id);
        $invoice->toggleStat()->save();
        return redirect()->route('sales.main')->with('success','Invoice Successfully Closed');
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
    public function invoice_ajax($id = '0') {
        if ($id !== '0') {
            $invoice = Invoices::find($id);
            $invoice_items = Items::where('shift_id','=',get_shift())->where('invoice_id','=',$invoice->id)->get();
            $invoice_items = $invoice_items->mapToGroups(function ($item, $key) {
                return [$item['product_id'] => $item];
            });
            $sum_invoice = Items::where('shift_id','=',get_shift())->where('invoice_id','=',$invoice->id)->get()->sum('total');
            return view('dashboard.invoice')->with(compact('invoice','invoice_items','sum_invoice','id'));
        }else {
            //$invoice_items = Items::where('shift_id','=',get_shift())->groupBy('product_id')->get(); 
            $invoice_items = Items::where('shift_id','=',get_shift())->where('invoice_id','=','0')->get();
            $invoice_items = $invoice_items->mapToGroups(function ($item, $key) {
                return [$item['product_id'] => $item];
            });
            $sum_invoice = Items::where('shift_id','=',get_shift())->where('invoice_id','=','0')->get()->sum('total');

            // $invoice_items = DB::table('items')
            // ->select('product_id', 'sn', DB::raw('sum(quantity) as count') , DB::raw('sum(total) as total'))
            // ->where('shift_id','=',get_shift())
            // ->where('invoice_id','=','0')
            // ->groupBy('product_id')
            // ->get();

            $invoice = null;
            return view('dashboard.invoice')->with(compact('invoice_items','invoice','sum_invoice','id'));
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
            $results[] = [ 'id' => $product->id, 'value' => $product->name, 'price' => $product->price , 'quantity' => $product->quantity_available() , 'barcode' => $product->barcode , 'type' => $product->type ];
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
            $results[] = [ 'id' => $product->id, 'value' => $product->barcode, 'price' => $product->price , 'quantity' => $product->quantity_available() , 'name' => $product->name , 'type' => $product->type ];
        }
        return Response::json($results);
    }
    public function print($id = '0') {
        if ($id !== '0') {
            $invoice = Invoices::find($id);
            $invoice_items = Items::where('shift_id','=',get_shift())->where('invoice_id','=',$invoice->id)->get();
            $invoice_items = $invoice_items->mapToGroups(function ($item, $key) {
                return [$item['product_id'] => $item];
            });
            $sum_invoice = Items::where('shift_id','=',get_shift())->where('invoice_id','=',$invoice->id)->get()->sum('total');
            return view('dashboard.print')->with(compact('invoice','invoice_items','sum_invoice','id'));
        }else {
            //$invoice_items = Items::where('shift_id','=',get_shift())->groupBy('product_id')->get(); 
            $invoice_items = Items::where('shift_id','=',get_shift())->where('invoice_id','=','0')->get();
            $invoice_items = $invoice_items->mapToGroups(function ($item, $key) {
                return [$item['product_id'] => $item];
            });
            $sum_invoice = Items::where('shift_id','=',get_shift())->where('invoice_id','=','0')->get()->sum('total');
            $invoice = null;
            return view('dashboard.print')->with(compact('invoice_items','invoice','sum_invoice','id'));
        }
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
    public function addExpdense(Request $request) {
        $expdest = Expdest::firstOrCreate(['name' => $request->input('expdest')]);
        $expdest_id = $expdest->id;
        $expense = new Expenses;
        $expense->paid = 1;
        $expense->shift_id = get_shift();
        $expense->expense_sum = $request->input('total');
        $expense->description = $request->input('description');
        $expense->expdest_id = $expdest_id;
        $expense->save();
        return response('success',200);
    }
    public function expdest_ac() {
        $term = Input::get('term');
        $results = array();
        $queries = DB::table('expdests')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name ];
        }
        return Response::json($results);
    }
}
