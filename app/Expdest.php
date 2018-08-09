<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expdest extends Model
{
    //
    public $fillable = ['name'];

    public function expenses() {
        return $this->hasMany('App\Expesnses');
    }
}
