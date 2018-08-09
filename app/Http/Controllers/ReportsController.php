<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Inventory;
use App\Items;
use App\Expenses;
use App\Shifts;
use App\SalaryPayments;
use carbon\Carbon;
use DB;
class ReportsController extends Controller
{
    //

    
    
    /**
     * Today Report
     */
    public function today() {
        $top_product = Items::select(DB::raw('sum(quantity) as cnt', 'product_id'), 'product_id',DB::raw('sum(total) as total', 'product_id'))->where('shift_id','=',get_shift())->groupBy('product_id')->orderBy('cnt', 'DESC')->first();
        return view('reports.today',compact('top_product'));
    }
    public function todayJson() {
        $shift_id = get_shift();
        $services = Items::where('shift_id','=',$shift_id)->where('type','=','service')->get();
        $products = Items::where('shift_id','=',$shift_id)->where('type','=','product')->get();
        $expenses = Expenses::where('shift_id','=',$shift_id)->get();
        $inventories = Inventory::where('type','=',2)->where('shift_id','=',get_shift())->get();
        $salaries = SalaryPayments::where('shift_id','=',$shift_id)->get();
        $hourly = Items::where('shift_id','=',get_shift())->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('H');
        });
        $hour_8 = DB::table('items')
                    ->select(DB::raw('count(*) as count, HOUR(created_at) as hour'))
                    ->where('shift_id','=',get_shift())
                    ->orderBy('hour', 'ASC')
                    ->groupBy('hour')
                    ->get();
        $report = [
            'totals' => [
            'sales' => $products->sum('total'),
            'services' => $services->sum('total'),
            'expenses' => $expenses->sum('expense_sum'),
            'salaries' => $salaries->sum('paid'),
            'Inventory Purchased' => $inventories->sum('total'),
            ],
            'hourly' => $hour_8

        ];
        return response()->json($report,200);
    }
   
    /**
     * Monthly Reports
     */
    public function month() {
        return view('reports.month');
    }
    public function monthJson() {
        $shifts = Shifts::where('created_at','>',Carbon::now()->subDays(30))
                        ->where('created_at','<=',Carbon::now())
                        ->get();
        $items = Items::select(DB::raw('sum(total) as total'))->where('created_at','>',Carbon::now()->subDays(30))->where('created_at','<=',Carbon::now())->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d');
        });        
        $results = array();
        foreach($shifts as $shift) {
            $results[] = [
                'shift_date' => $shift->created_at,
                'expenses' => $shift->expenses->sum('expense_sum'),
                'salaries' => $shift->salaries->sum('paid'),
                'inventoriesPurchased' => $shift->total_paid(),
                'sales' => $shift->sales_total(),
                'invoices' => $shift->invoices()->count(),
                'services' => $shift->service_total(),
            ];
        }
            $total_sales = Items::select(DB::raw('sum(total) as total'))->where('created_at','>',Carbon::now()->subDays(30))->where('created_at','<=',Carbon::now())->where('type','=','product')->get()->first();
            $total_services = Items::select(DB::raw('sum(total) as total'))->where('created_at','>',Carbon::now()->subDays(30))->where('created_at','<=',Carbon::now())->where('type','=','service')->get()->first();
            $total_expenses = Expenses::select(DB::raw('sum(expense_sum) as total'))->where('created_at','>',Carbon::now()->subDays(30))->where('created_at','<=',Carbon::now())->get()->first();
            $total_invetories = Inventory::select(DB::raw('sum(total) as total'))->where('created_at','>',Carbon::now()->subDays(30))->where('created_at','<=',Carbon::now())->where('type','=',2)->get()->first();
            $Salaries = SalaryPayments::select(DB::raw('sum(paid) as total'))->where('created_at','>',Carbon::now()->subDays(30))->where('created_at','<=',Carbon::now())->get()->first();
        $pieChart = [
            'Total Sales' => $total_sales->total,
            'Total Services' => $total_services->total,
            'Total Expenses' => $total_expenses->total,
            'Total Invetories' => $total_invetories->total,
            'Salaries' => $Salaries->total
        ];
        $return = [
            'data' => $results,
            'pie' => $pieChart,
        ];
        return response()->json($return,200);
    }
    /**
     * Custom Reports
     */
    public function custom() {

    }
    public function date($start,$end){

    }
    public function product($id) {

    }
    /*
    * Year Report
    */
    public function index() {
        $top_product = Items::select(DB::raw('sum(quantity) as cnt', 'product_id'), 'product_id')->groupBy('product_id')->orderBy('cnt', 'DESC')->first();
        return view('reports.index',compact('top_product'));
    }
    public function totalsJson() {
        $salaries = SalaryPayments::where('created_at','>',Carbon::now()->subDays(365))->where('created_at','<=',Carbon::now())->sum('paid');
        $expenses = Expenses::where('created_at','>',Carbon::now()->subDays(365))->where('created_at','<=',Carbon::now())->sum('expense_sum');
        $items_sold = Items::where('created_at','>',Carbon::now()->subDays(365))->where('created_at','<=',Carbon::now())->where('quantity','>','0')->get()->sum('total');
        $items_bought = Inventory::where('created_at','>',Carbon::now()->subDays(365))->where('created_at','<=',Carbon::now())->where('type','=','2')->get()->sum('total');

        $items = [
            __('Salaries') => $salaries,
            __('Expenses') => $expenses,
            __('Sales') => $items_sold,
            __('Inventory') => $items_bought
        ];
        return response()->json($items,200);

    }
    public function full_report() {
        $now = Carbon::now();
        $results = array();
        for ($month = $now->month - 11; $month <= $now->month ; $month++) {             
            $items = Items::whereMonth('created_at', $month)->get();
            $results[] = [
                'total_actions' => $items->count(),
                'total_Income' => $items->sum('total'),
                'total_pieces' => $items->sum('quantity'),
                'month_name' => date("F", mktime(0, 0, 0, $month, 1)),
            ];
        }
        return response()->json($results,200);
    }
    public function year() {

    }
 }
