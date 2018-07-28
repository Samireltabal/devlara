<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    public $timestamps = 'True';

    public function typeFn() {
        return $this->belongsTo('App\InventoriesTypes','type');
    }
    public function hasType($type)
    {
    if ($this->type()->where('name', $type)->first()) {
    return true;
    }
    return false;
    }
    public function product() {
        return $this->belongsTo('App\Products','product_id');
    }
    public function supplier() {
        return $this->belongsTo('App\Suppliers','supplier_id');
    }
    public function total_buy(){
        $balance = DB::table('inventories')->where('type','=','1');
        return $balance;
    }
}
