<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $primaryKey = 'id';
    
     public function users(){
        return $this->belongsToMany(User::class);
    }
}
