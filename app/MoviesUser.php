<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoviesUser extends Model
{
    use HasCompositeKey;
    protected $primaryKey = ['movie_id','user_id'];
}
