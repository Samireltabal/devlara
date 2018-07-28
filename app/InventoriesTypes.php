<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoriesTypes extends Model
{
    //
    public $timestamps = "True";

    public function inventories() {
        return $this->hasMany('App/Inventory');
    }
}
