<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectIt extends Model
{
    //
    public function object_tos()
    {
        return $this->hasMany('App\Object_to');
    }
}
