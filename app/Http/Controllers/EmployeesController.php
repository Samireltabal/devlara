<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\Attendances;
use App\Shifts;
use App\SalaryPayments;
class EmployeesController extends Controller
{
    //
    public function index() {
        $shift_id = get_shift();
        return view('admin.employees.index',compact('shift_id'));
    }
    public function attendance() {
        $shift = Shifts::find(get_shift());
        $attendances = new Attendances;
        $employees = new Employees;
        return view('admin.employees.attendances',compact('shift'));
    }
    
    public function AddEntitlements(Request $request, $employee_id) {
        $payment = new SalaryPayments;
        $payment->paid = $request->input('paid');
        $payment->status = 1;
        $payment->Employee_id = $employee_id;
        $payment->shift_id = get_shift();
        $payment->save();
        return response()->json('success',200);
    }
    public function attend(Request $request) {
        $employee = $request->input('id');
        $attendance = new Attendances;
        $attendance->employee_id = $employee;
        $attendance->shift_id = get_shift();
        $attendance->save();
        return response()->json(['value'=>'success'],200);
        // return $request;
    }
    public function att_list() {
        $shift_id = get_shift();
        $shift = Shifts::find(get_shift());
        $attendances = new Attendances;
        $employees = new Employees;
        return view('admin.employees.attlist',compact('shift','attendances','employees'));

    }
    public function list_employees() {
        $employees = Employees::all();
        return view('admin.employees.list',compact('employees'));   
    }
    public function create_employee(Request $request) {
        $employee = new Employees;
        $employee->name = $request->input('name');
        $employee->phone = $request->input('phone');
        $employee->rate = $request->input('rate');
        $employee->info = $request->input('info');
        $employee->save();
        return response()->json('success',200);
    }
    public function delete(Request $request) {
        $id = $request->input('id');
        $employee = Employees::find($id);
        $employee->delete();
        return response()->json('success',200);
    }
}
