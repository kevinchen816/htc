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

Route::get('/', function () {
    //return view('welcome');
    return view('10ware');
});

//Route::get('/', 'StaticPagesController@home');
//Route::get('/help', 'StaticPagesController@help');
//Route::get('/about', 'StaticPagesController@about');

Route::resource('/users', 'UsersController');

Route::get('/show', 'Api\CamerasController@show');
Route::get('/show2/{camera}', 'Api\CamerasController@show2');

Route::post('/camera/settings', 'Api\CamerasController@settings')->name('camera.settings');;

//Route::get('/test', 'Api\PhotosController@store');


Route::get('/test', 'Api\CamerasController@test');

Route::get('/bootstrap', function () {
    return view('bootstrap');
});
