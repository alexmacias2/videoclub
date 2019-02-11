<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $primaryKey = 'id';
    public function generos(){
        return $this->hasMany(Movie::class);
    }
}
