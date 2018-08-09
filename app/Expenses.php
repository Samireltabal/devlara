<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //
    public $timestamps = 'True';

    public function expdest() {
        return $this->belongsTo('App\Expdest','expdest_id');
    }

}
