<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    public $timestamps = 'True';

    public function product_data() {
        return $this->belongsTo('App\Products','product_id');
    }
    public function product() {
        if ($this->product_data() !== null)
        {
            return $this->product_data();
        }else{
            return null;
        }
    }
    public function invoice() {
        return $this->belongsTo('App\invoices','invoice_id');
    }
}
