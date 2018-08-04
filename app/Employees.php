<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    //
    public $timestamps = 'True';

    public function attendances() {
        return $this->hasMany('App\Attendances','employee_id');
    }
    public function attended() {
        if( $this->attendances()->where('shift_id', get_shift())->first() )
        {
            return true;
        }else{
            return false;
        }
    }
    public function payments() {
        return $this->hasMany('App\SalaryPayments','Employee_id');
    }

}
