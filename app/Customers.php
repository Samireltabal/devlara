<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    public $timestamps = 'True';
    public $fillable = ['name','phone'];

}
