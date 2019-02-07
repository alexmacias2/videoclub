<?php

namespace App\Http\Controllers\Movie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoviesController extends Controller
{
    public function showMovie($id='HOLA')
    {
//        $user = Movie::findOrFail($id);
//        return view('user.profile', ['user' => $user]);
        return "MOVIES $id";
    }
}
