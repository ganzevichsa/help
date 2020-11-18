<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object_to extends Model
{
    //
    public function objectIt()
    {
        return $this->belongsTo('App\ObjectIt');
    }

}
