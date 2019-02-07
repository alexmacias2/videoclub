<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()) {
            return redirect()->action('CatalogController@getIndex');
        } else {
            return view('login');
        }
    }

    public function getHome() {
        if (Auth::check()) {
            return redirect()->action('CatalogController@getIndex');
        } else {
            return view('login');
        }
    }

}
