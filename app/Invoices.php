<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    //
    public $timestamps = 'True';

    public function customer() {
        return $this->belongsTo('App\Customers','customer_id');
    }
    public function items() {
        return $this->hasMany('App\Items','invoice_id');
    }
}
