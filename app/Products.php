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
            if($sum_count !== 0){
                return $sum_price / $sum_count ;
            }else{
                return $this->hasMany('App\Inventory','product_id')->where('type','=','2')->sum('price') / $this->hasMany('App\Inventory','product_id')->where('type','=','2')->count();
            }
        }else{
            return 0;
            // return $this->hasMany('App\Inventory','product_id')->where('type','=','2')->sum('price') / $this->hasMany('App\Inventory','product_id')->where('type','=','2')->count();
        }
    }
    public function quantity_available() {
        $purchased = $this->hasMany('App\Inventory','product_id')->where('type','=','2')->sum('quantity');
        $returns = $this->hasMany('App\Inventory','product_id')->where('type','=','3')->sum('quantity');
        $bought = $this->hasMany('App\Inventory','product_id')->where('type','=','1')->sum('quantity');
        return $purchased + $returns - $bought ;
    }
    public function Hasinventory() {
        $inventory = $this->hasMany('App\Inventory','product_id')->where('type','=','2');
        if($inventory->count() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function HasType($type) {
        if ($this->type == $type) {
            return true;
        }else{
            return false;
        }
    }
}
