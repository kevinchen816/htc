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

Route::post('/camera/settings', 'Api\CamerasController@settings')->name('camera.settings');;

/* TODO */
//Route::get('/login', 'Api\AccountController@login');
Route::get('/login', function() {
    //return 'login';
    return view('login');
});

Route::get('/cameras', 'Api\CamerasController@cameras');

/* default.blade.php */
    // $('#show_cameras').click(function() {
    //$.get('/account/showcameralist/open'); // $.get() 方法使用 HTTP GET 请求从服务器加载数据 (JQuery)
    Route::get('/account/showcameralist/open', function() {
        return 'open';
    });

    // $('#close_cameras').click(function() {
    //$.get('/account/showcameralist/close');
    Route::get('/account/showcameralist/close', function() {
        return 'close';
    });

    // Route::post('/cameras/activetab', function () {
    //     $tab = $_POST['tab'];
    //     return $tab;
    // });
    Route::post('/cameras/activetab', 'Api\CamerasController@activetab')->name('camera.activetab');;

    // $("#notify_photo").click(function () {
    // var url = '/cameras/testnotify/photo/' + cam + '/62830';

    // $("#notify_video").click(function () {
    // var url = '/cameras/testnotify/video/' + cam + '/62852';

/* _data.blade.php */
    // <li><a href="/cameras/getdetail/50">New Camera</a></li>
    //Route::get('/cameras/getdetail/{camera_id}', 'Api\CamerasController@getdetail');

    // <li ><a href="#overview-54" data-toggle="tab" data-tab="overview" data-url="/cameras/overview/54" aria-expanded="true">
    Route::get('/cameras/overview/{camera_id}', 'Api\CamerasController@overview')->name('camera.overview');;

    // <a href="#action-54" data-toggle="tab" data-tab="commands" data-url="/cameras/actions/54" aria-expanded="false">
    //Route::get('/cameras/actions/{camera_id}', 'Api\CamerasController@actions')->name('camera.actions');;

/* _list.blade.php */
    // <a href="/cameras/getdetail/50">New Camera</a><br />

/* _gallery.blade.php */
    // <form method="POST" action="http://www.ridgetec.us/cameras/gallery" accept-charset="UTF-8" class="form-horizontal" role="form" name="pictureForm" id="gallery-form-54">
    //Route::get('/cameras/gallery', 'Api\CamerasController@xxx');

/* photo.blade.php */
    // <a href="/cameras/download/54/90815">
    //Route::get('/cameras/download/{camera_id}/{photo_id}', 'Api\CamerasController@download');

/* _toolbar.blade.php */
    // <a href="/cameras/gallerylayout/54/2">
    // <a href="/cameras/gallerylayout/54/3">
    // <a href="/cameras/gallerylayout/54/4">
    // <a href="/cameras/gallerylayout/54/6">
    // <a href="/cameras/gallerylayout/54/12">
    //Route::get('/cameras/gallerythumbs/{camera_id}/{xx}', 'Api\CamerasController@gallerythumbs');

    // <li><a href="/cameras/gallerythumbs/54/10">10 Per Page</a></li>
    // <li><a href="/cameras/gallerythumbs/54/10">20 Per Page</a></li>
    // <li><a href="/cameras/gallerythumbs/54/10">30 Per Page</a></li>
    // <li><a href="/cameras/gallerythumbs/54/10">40 Per Page</a></li>
    // <li><a href="/cameras/gallerythumbs/54/10">60 Per Page</a></li>
    // <li><a href="/cameras/gallerythumbs/54/10">80 Per Page</a></li>
    //Route::get('/cameras/gallerythumbs/{camera_id}/{pagination}', 'Api\CamerasController@pagination');

/* _actions.blade.php */
    // <form class="form-horizontal" role="form" method="POST" action="http://www.ridgetec.us/cameras/actionqueue" id="action-formatsd-form-54">
    //Route::get('/cameras/actionqueue', 'Api\CamerasController@xxx');

    // $(".sms-button").click(function() {
    //url = '/cameras/sendsms/' + id + '/' + sms;

    // $(".action-queue-54").click(function() {
    //url = '/cameras/actionqueue/' + id + '/' + action;

    // $( ".action-cancel-54" ).click(function(event) {
    //url='/cameras/actioncancel/' + actionid;

    // $('#clear-missing').click(function(event) {
    //var url = '/cameras/clearmissing/54';

    // $('.missing-request').click(function(event) {
    //var url = '/cameras/requestmissing/54/' + missingid;

    // $('.show-highres').click(function(event) {
    //url = '/cameras/getmediaurl/' + actionid;


//Route::get('/test', 'Api\PhotosController@store');
Route::get('/test', 'Api\CamerasController@test');

Route::get('/bootstrap', function () {
    return view('bootstrap');
});
