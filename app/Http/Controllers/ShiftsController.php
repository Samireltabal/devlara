<?php

namespace App\Http\Controllers;
use App\Shifts;
use Auth;
use App\Invoices;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ShiftsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isActive');
        $this->middleware('role:admin');
    }
    public function index() {
        $shifts_obj = new Shifts;
        $today = Carbon::today();
        $times = new Carbon;
        $time = Carbon::today()->Format('Y-m-d');
        //$time = "2018-07-16";
        $shifts = $shifts_obj::where('active',1)->limit(1)->get();
        return view('admin.shifts.index')->with(compact(['shifts','time']));
    }
    public function create(Request $request) {
        $invoices = Invoices::where('status','=','1')->get();
        foreach ($invoices as $invoice) {
            $invoice->toggleStat()->save();
        }
        $shifts = Shifts::where('active',1)->get();
        if ($shifts->count() > 0)
        {
            foreach ($shifts as $shift)
            {
            $shift->active = 0;
            $shift->save();
            }
        }
        $shift = new Shifts;
        $shift->year = Carbon::today()->year;
        $shift->month = Carbon::today()->month;
        $shift->day = Carbon::today()->day;
        $shift->active = 1;
        $shift->created_by = Auth::user()->id;    
        $shift->save();
        return back()->with('success','Shift Changed Successfully');
    }
}
