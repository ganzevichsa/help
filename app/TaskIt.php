<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskIt extends Model
{
    //
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}