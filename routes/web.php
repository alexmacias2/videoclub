<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::group(['middleware' => 'auth'], function() {

    Route::get('movie/{id?}', 'Movie\MoviesController@showMovie');
    Route::get('catalog', 'CatalogController@getIndex');
    Route::get('catalog/show/{id}', 'CatalogController@getShow');
    Route::get('catalog/create', 'CatalogController@getCreate');
    Route::get('catalog/edit/{id}', 'CatalogController@getEdit');
    Route::post('catalog/create', 'CatalogController@postCreate');
    Route::put('catalog/rent/{id}', 'CatalogController@putRent');
    Route::put('catalog/return/{id}', 'CatalogController@putReturn');
    Route::put('catalog/compruebaFavorita/{id}', 'CatalogController@compruebaFavorita');
    Route::put('catalog/pintaBoton/{id}', 'CatalogController@pintaBoton');
    Route::put('catalog/añadirFavorita/{id}', 'CatalogController@añadirFavorita');
    Route::delete('catalog/delete/{id}', 'CatalogController@deleteMovie');
    Route::put('catalog/edit/{id}', 'CatalogController@putEdit');
    
   
});
Route::get('/', 'HomeController@getHome');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
//Route::get('logout', function () {
//    return 'Logout usuario';
//});






