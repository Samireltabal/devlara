<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    public $timestamps = 'True';

    public function total() {
        return $this->hasMany('App\Products','category_id')->count();
    }
}
