<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    //
    public $timestamps = 'True';

    public function inventories()
    {
        return $this->hasMany('App\Inventory','supplier_id')->where('type','=','2');
    }
    public function total_paid() {
        return $this->hasMany('App\Inventory','supplier_id')->where('type','=','2')->sum('total');
    }
    public function returns() {
        return $this->hasMany('App\Inventory','supplier_id')->where('type','=','3')->sum('total');
    }
    public function returns_count() {
        return $this->hasMany('App\Inventory','supplier_id')->where('type','=','3')->count();
    }
}
