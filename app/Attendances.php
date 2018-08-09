<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    //
    public $timestamps = 'True';
    
    public function shift() {
        return $this->belongsTo('App\Shifts','shift_id');
    }
    public function employee() {
    return $this->belongsTo('App\Employees','employee_id');        
    }

}
