<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    //
    public $timestamps = 'True';

    public function sales(){
     return $this->hasMany('App\Items','shift_id');
    }
    public function sales_total() {
        $sales = $this->hasMany('App\Items','shift_id')->where('type','=','product')->sum('total');
        return $sales ;
    }
    public function service_total() {
        $sales = $this->hasMany('App\Items','shift_id')->where('type','=','service')->sum('total');
        return $sales ;
    }
    public function expenses(){
        return $this->hasMany('App\Expenses','shift_id');
       }
       public function salaries() {
           return $this->hasMany('App\SalaryPayments','shift_id');
       }
    public function user() {
        return $this->belongsTo('App\User','created_by');
    }
    public function attendances() {
        return $this->hasMany('App\Attendances','shift_id');
    }
    public function invoices() {
        return $this->hasMany('App\Invoices','shift_id');
    }
    public function total_paid() {
        return $this->hasMany('App\Inventory','shift_id')->where('type','=','2')->sum('total');
    }
    public function total_returns() {
        return $this->hasMany('App\Inventory','shift_id')->where('type','=','3')->sum('total');
    }
    public function getCreatedAtAttribute($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}

public function getUpdatedAtAttribute($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}
}