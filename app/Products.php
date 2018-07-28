<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    public $timestamps = 'True';

    public function categories() {
        return $this->belongsTo('App\Categories','category_id');
    }
    public function toggleStat() {
        $this->active = !$this->active;
        return $this;
    }
    public function average_price() {
        if ($this->Hasinventory())
        {
        $sum_price = $this->hasMany('App\Inventory','product_id')->where('type','=','2')->sum('total');
        $sum_count = $this->hasMany('App\Inventory','product_id')->where('type','=','2')->sum('quantity');
        return $sum_price / $sum_count ;
        }else{
            return '0.00';
        }
    }
    public function quantity_available() {
        $purchased = $this->hasMany('App\Inventory','product_id')->where('type','=','2')->sum('quantity');
        $returns = $this->hasMany('App\Inventory','product_id')->where('type','=','3')->sum('quantity');
        $bought = $this->hasMany('App\Inventory','product_id')->where('type','=','1')->sum('quantity');
        return $purchased - $bought + $returns ;
    }
    public function Hasinventory() {
        $inventory = $this->hasMany('App\Inventory','product_id')->where('type','=','2');
        if($inventory->count() > 0){
            return true;
        }else{
            return false;
        }
    }
}
