<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
