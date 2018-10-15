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

//Route::get('/', function () {
//    //return view('welcome');
//    // return view('10ware');
//    return view('home');
//})->name('home');

Route::get('/', 'Api\CamerasController@cameras')->name('home');

// Route::get('/', 'SessionsController@create')->name('home');

Route::get('/test', function () {
    return view('test');
})->name('test');

/*
/register

/login
/logout
/password/reset(array)                      <-- Forgot Your Password ?

*/

Route::resource('/users', 'UsersController');
// Route::resource('/cameras', 'CameraController', ['only' => ['store', 'destroy']]);

/*-----------------------------------------------------------*/
Route::get('/signup', 'UsersController@create')->name('signup');
//Route::get('/register', 'UsersController@register')->name('register');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');
Route::delete('/logout', 'SessionsController@destroy')->name('logout');
// Route::post('/logout', 'SessionsController@destroy')->name('logout');

// Route::get('/admin', function() {return '/admin';})->name('admin');
Route::get('/admin', function() {return view('/admin/home');})->name('admin');

/*-----------------------------------------------------------*/
//Route::get('/plans/add-plan','Api\CamerasController@plans_addplan_create')->name('add.plan');
Route::get('/plans/add-plan','PlansController@view')->name('add.plan');
Route::post('/plans/add-plan','PlansController@add')->name('add.plan');
Route::get('/plans/cancel', 'AccountsController@profile')->name('plans.cancel');
Route::resource('/plans', 'PlansController');
Route::get('/plans/delete/{plan}', 'PlansController@delete')->name('plans.delete');

/*-----------------------------------------------------------*/
/*
    /cameras
    /cameras/activetab
    /cameras/getdetail/{camera_id}
    /cameras/overview/{camera_id}
    /cameras/actions/{camera_id}
    /cameras/gallery
    /cameras/download/{camera_id}/{photo_id}
    /cameras/gallerylayout/{camera_id}/{xx}         <-- xx = 2,3,4,6,12
    /cameras/gallerythumbs/{camera_id}/{xx}         <-- xx = 10,20,30,40,60,80
*/
Route::get('/cameras', 'Api\CamerasController@cameras')->name('cameras');
Route::post('/cameras/delete', 'Api\CamerasController@delete')->name('camera.delete');
Route::post('/cameras/activetab', 'Api\CamerasController@activetab')->name('camera.activetab');

/* tab_gallery.blade.php */
// <form method="POST" action="http://www.ridgetec.us/cameras/gallery" accept-charset="UTF-8" class="form-horizontal" role="form" name="pictureForm" id="gallery-form-54">
// <form method="POST" action="{{ route('camera.gallery')" accept-charset="UTF-8" class="form-horizontal" role="form" name="pictureForm" id="gallery-form-{{ $camerta->id }}">
Route::post('/cameras/gallery', 'Api\CamerasController@gallery')->name('camera.gallery');

// <a href="/cameras/gallerylayout/54/2"> // 2,3,4,6,12
Route::get('/cameras/gallerylayout/{camera_id}/{number}', 'Api\CamerasController@gallerylayout')->name('camera.gallerylayout');

// <li><a href="/cameras/gallerythumbs/54/10">10 Per Page</a></li> // 10,20,30,40,60.80
Route::get('/cameras/gallerythumbs/{camera_id}/{number}', 'Api\CamerasController@gallerythumbs')->name('camera.gallerythumbs');
Route::post('/camera/settings', 'Api\CamerasController@settings')->name('camera.settings');

/* Camera List (_list.blade.php) */
    // <a href="/cameras/getdetail/50">New Camera</a><br />
    Route::get('/cameras/getdetail/{camera_id}', 'Api\CamerasController@getdetail')->name('camera.getdetail');

/* Camera Data (_data.blade.php) */
    // <li><a href="/cameras/getdetail/50">New Camera</a></li>
    //Route::get('/cameras/getdetail/{camera_id}', 'Api\CamerasController@getdetail');

    // <li ><a href="#overview-54" data-toggle="tab" data-tab="overview" data-url="/cameras/overview/54" aria-expanded="true">
    Route::get('/cameras/overview/{camera_id}', 'Api\CamerasController@overview')->name('camera.overview');

    // <a href="#action-54" data-toggle="tab" data-tab="commands" data-url="/cameras/actions/54" aria-expanded="false">
    //Route::get('/cameras/actions/{camera_id}', 'Api\CamerasController@actions')->name('camera.actions');;

    /* photo.blade.php */
    // <a href="/cameras/download/54/90815">
    //Route::get('/cameras/download/{camera_id}/{photo_id}', 'Api\CamerasController@download');

    // $("#notify_photo").click(function () {   /* default.blade.php */
    // var url = '/cameras/testnotify/photo/' + cam + '/62830';

    // $("#notify_video").click(function () {   /* default.blade.php */
    // var url = '/cameras/testnotify/video/' + cam + '/62852';

/*
    /cameras/sendsms/' + id + '/' + sms

    /cameras/actionqueue/' + id + '/' + action
    /cameras/actioncancel/' + actionid;

    /cameras/clearmissing/54';
    /cameras/requestmissing/54/' + missingid;
    /cameras/getmediaurl/' + actionid;              <-- show-highres
*/
Route::get('/cameras/sendsms/{camera_id}/{sms}', 'Api\CamerasController@sendsms')->name('camera.sendsms');

Route::get('/cameras/actionqueue/{camera_id}/{action}', 'Api\CamerasController@actionqueue')->name('camera.actionqueue');
Route::post('/cameras/actionqueue/', 'Api\CamerasController@actionqueue_post')->name('camera.actionqueue_post');
Route::get('/cameras/actioncancel/{action_id}', 'Api\CamerasController@actioncancel')->name('camera.actioncancel');

Route::get('/cameras/clearmissing/{camera_id}', 'Api\CamerasController@clearmissing')->name('camera.clearmissing');
Route::get('/cameras/requestmissing/{camera_id}/{missingid}', 'Api\CamerasController@requestmissing')->name('camera.requestmissing');

Route::get('/cameras/apilog/{camera_id}', 'Api\CamerasController@apilog')->name('camera.apilog');

/*-----------------------------------------------------------*/
Route::get('/account/profile', 'AccountsController@profile')->name('account.profile');
Route::post('/account/activetab', 'AccountsController@activetab')->name('account.activetab');
Route::post('/account/profile-emails', 'AccountsController@Emails_Save')->name('account.profile-emails');
Route::get('/account/profile-emails', 'AccountsController@profile_emails')->name('account.profile-emails');

/* default.blade.php */
    // $('#show_cameras').click(function() { /* default.blade.php */
    //$.get('/account/showcameralist/open'); // $.get() 方法使用 HTTP GET 请求从服务器加载数据 (JQuery)
    Route::get('/account/showcameralist/open', function() {
        return 'open';
    });

    // $('#close_cameras').click(function() { /* default.blade.php */
    //$.get('/account/showcameralist/close');
    Route::get('/account/showcameralist/close', function() {
        return 'close';
    });

/*-----------------------------------------------------------*/
Route::get('/help/terms', 'HelpsController@terms')->name('help.terms');
Route::get('/help/plans', 'HelpsController@plans')->name('help.plans');
Route::get('/help/quick-start', 'HelpsController@quick_start')->name('help.quick-start');
//Route::get('/help/privacy', function() {return '/help/privacy';})->name('help.privacy');

/*-----------------------------------------------------------*/
Route::get('/support/emailpolicy', function() {return '/support/emailpolicy';})->name('support.emailpolicy');
//Route::get('/support/emailpolicy', function() {return view('support.emailpolicy');})->name('support.emailpolicy');
//Route::get('/support/emailpolicy', function() {'Api\CamerasController@emailpolicy';})->name('support.emailpolicy');

Route::get('/support/contact', function() {return '/support/contact';})->name('support.contact');
//Route::get('/support/contact', function() {return view('support.contact');})->name('support.contact');
Route::post('/support/contact', function() {return '/support/contact';})->name('support.contact');

/*-----------------------------------------------------------*/
/*
    /email/verification
*/
Route::get('/email/optin', function() {return '/email/optin';})->name('email.optin');
Route::get('/email/optout', function() {return '/email/optout';})->name('email.optout');

/*-----------------------------------------------------------*/
Route::get('/tour/start', function() {return '/tour/plans';})->name('tour.start');

/* TODO */
//Route::get('/camera/test', 'Api\PhotosController@store');
Route::get('/camera/test', 'Api\CamerasController@test');
Route::get('/bootstrap', function () {
    return view('bootstrap');
});
