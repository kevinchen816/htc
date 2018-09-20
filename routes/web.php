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
    //return view('10ware');
    return view('home');
})->name('home');


/*
/register

/login
/logout
/password/reset(array)                      <-- Forgot Your Password ?

/email/verification

/admin

/account/profile
/account/showcameralist/open
/account/showcameralist/close

/cameras
/cameras/activetab
/cameras/getdetail/{camera_id}
/cameras/overview/{camera_id}
/cameras/actions/{camera_id}
/cameras/gallery
/cameras/download/{camera_id}/{photo_id}
/cameras/gallerylayout/{camera_id}/{xx}         <-- xx = 2,3,4,6,12
/cameras/gallerythumbs/{camera_id}/{xx}         <-- xx = 10,20,30,40,60,80

/cameras/actionqueue
/cameras/actionqueue/' + id + '/' + action
/cameras/actioncancel/' + actionid;
/cameras/requestmissing/54/' + missingid;
/cameras/clearmissing/54';

/cameras/getmediaurl/' + actionid;              <-- show-highres
/cameras/sendsms/' + id + '/' + sms

    /plans/add-plan

    /tour/start

    /help/plans
    /help/privacy                               <-- Privacy Policy
    /help/terms                                 <-- Terms and Conditions
    /help/privacy                               <--

    /support/emailpolicy
    /support/contact                            <--  Contact Us
*/

Route::resource('/users', 'UsersController');

Route::get('/signup', 'UsersController@create')->name('signup');
//Route::get('/register', 'UsersController@register')->name('register');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');

//Route::delete('/logout', 'SessionsController@destroy')->name('logout');
Route::post('/logout', 'SessionsController@destroy')->name('logout');
Route::get('/admin', function() {return '/admin';})->name('admin');

Route::get('/cameras_xx', 'Api\CamerasController@cameras_xx')->name('cameras_xx');
//Route::get('/cameras', 'Api\CamerasController@cameras')->name('cameras');
//Route::get('/cameras_ex/{camera_id}', 'Api\CamerasController@cameras_ex')->name('cameras_ex'); /* for test */
Route::get('/cameras/{camera_id}', 'Api\CamerasController@cameras')->name('cameras'); /* for test */

/* tab_gallery.blade.php */
// <form method="POST" action="http://www.ridgetec.us/cameras/gallery" accept-charset="UTF-8" class="form-horizontal" role="form" name="pictureForm" id="gallery-form-54">
// <form method="POST" action="{{ route('camera.gallery')" accept-charset="UTF-8" class="form-horizontal" role="form" name="pictureForm" id="gallery-form-{{ $camerta->id }}">
Route::post('/cameras/gallery', 'Api\CamerasController@gallery')->name('camera.gallery');

// <a href="/cameras/gallerylayout/54/2"> // 2,3,4,6,12
Route::get('/cameras/gallerylayout/{camera_id}/{number}', 'Api\CamerasController@gallerylayout')->name('camera.gallerylayout');

// <li><a href="/cameras/gallerythumbs/54/10">10 Per Page</a></li> // 10,20,30,40,60.80
Route::get('/cameras/gallerythumbs/{camera_id}/{number}', 'Api\CamerasController@gallerythumbs')->name('camera.gallerythumbs');

Route::post('/camera/settings', 'Api\CamerasController@settings')->name('camera.settings');

Route::get('/account/profile', function() {return '/account/profile';})->name('account.profile');
Route::get('/plans/add-plan', function() {return 'add-plan';})->name('add.plan');


Route::get('/tour/start', function() {return '/tour/plans';})->name('tour.start');
Route::get('/help/plans', function() {return '/help/plans';})->name('help.plans');
Route::get('/help/privacy', function() {return '/help/privacy';})->name('help.privacy');
Route::get('/help/terms', function() {return '/help/terms';})->name('help.terms');
Route::get('/help/privacy', function() {return '/help/plans';})->name('help.privacy');

Route::get('/support/emailpolicy', function() {return '/support/emailpolicy';})->name('support.emailpolicy');
//Route::get('/support/emailpolicy', function() {return view('support.emailpolicy');})->name('support.emailpolicy');
//Route::get('/support/emailpolicy', function() {'Api\CamerasController@emailpolicy';})->name('support.emailpolicy');

Route::get('/support/contact', function() {return '/support/contact';})->name('support.contact');
//Route::get('/support/contact', function() {return view('support.contact');})->name('support.contact');
Route::post('/support/contact', function() {return '/support/contact';})->name('support.contact');

Route::get('/email/optin', function() {return '/email/optin';})->name('email.optin');
Route::get('/email/optout', function() {return '/email/optout';})->name('email.optout');



/* TODO */
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

    Route::post('/cameras/activetab', 'Api\CamerasController@activetab')->name('camera.activetab'); /* default.blade.php */

    // $("#notify_photo").click(function () {   /* default.blade.php */
    // var url = '/cameras/testnotify/photo/' + cam + '/62830';

    // $("#notify_video").click(function () {   /* default.blade.php */
    // var url = '/cameras/testnotify/video/' + cam + '/62852';

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

/* _actions.blade.php */
    // <form class="form-horizontal" role="form" method="POST" action="http://www.ridgetec.us/cameras/actionqueue" id="action-formatsd-form-54">
    //Route::get('/cameras/actionqueue', 'Api\CamerasController@xxx');

    // $(".action-queue-54").click(function() {
    //url = '/cameras/actionqueue/' + id + '/' + action;

    // $( ".action-cancel-54" ).click(function(event) {
    //url='/cameras/actioncancel/' + actionid;

    // $('.missing-request').click(function(event) {
    //var url = '/cameras/requestmissing/54/' + missingid;

    // $('#clear-missing').click(function(event) {
    //var url = '/cameras/clearmissing/54';

    // $('.show-highres').click(function(event) {
    //url = '/cameras/getmediaurl/' + actionid;

    // $(".sms-button").click(function() {
    //url = '/cameras/sendsms/' + id + '/' + sms;

//Route::get('/test', 'Api\PhotosController@store');
Route::get('/test', 'Api\CamerasController@test');

Route::get('/bootstrap', function () {
    return view('bootstrap');
});
