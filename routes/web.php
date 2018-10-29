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

/*
      Route::group(['https'], function () {

            // your routers

        });
*/

//Route::get('/', function () {
//    //return view('welcome');
//    // return view('10ware');
//    return view('home');
//})->name('home');

Route::get('/', 'Api\CamerasController@cameras')->name('home');
////Route::get('/', 'SessionsController@create')->name('home');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/10ware', 'Api\CamerasController@cameras_10ware')->name('home.10ware');
Route::get('/germany', 'Api\CamerasController@cameras_germany')->name('home.germany');

/*
/register

/login
/logout
/password/reset(array)                      <-- Forgot Your Password ?

*/

Route::resource('/users', 'UsersController');
// Route::resource('/cameras', 'CameraController', ['only' => ['store', 'destroy']]);

/*-----------------------------------------------------------*/
//Route::get('/register', 'UsersController@register')->name('register');
Route::get('/signup', 'UsersController@create')->name('signup');
Route::get('/10ware/signup', 'UsersController@create_10ware')->name('signup.10ware');
Route::get('/germany/signup', 'UsersController@create_germany')->name('signup.germany');

Route::get('/login', 'SessionsController@create')->name('login');
Route::get('/10ware/login', 'SessionsController@login_10ware')->name('login.10ware');
Route::get('/germany/login', 'SessionsController@login_germany')->name('login.germany');

Route::post('/login', 'SessionsController@store')->name('login');
//Route::post('/10ware/login', 'SessionsController@store_10ware')->name('login.10ware');
//Route::post('/germany/login', 'SessionsController@store_germany')->name('login.germany');

Route::delete('/logout', 'SessionsController@destroy')->name('logout');
Route::delete('/10ware/logout', 'SessionsController@destroy_10ware')->name('logout.10ware');
Route::delete('/germany/logout', 'SessionsController@destroy_germany')->name('logout.germany');

Route::post('/logout', 'SessionsController@destroy')->name('logout');
Route::post('/10ware/logout', 'SessionsController@destroy_10ware')->name('logout.10ware');
Route::post('/germany/logout', 'SessionsController@destroy_germany')->name('logout.germany');

//Route::get('/admin', function() {return view('/admin/home');})->name('admin');
Route::get('/admin', 'Api\CamerasController@admin')->name('admin');
Route::get('/admin/users', 'Api\CamerasController@admin_users')->name('admin.users');
Route::get('/admin/email', 'Api\CamerasController@admin_email')->name('admin.email');
Route::get('/admin/cameras', 'Api\CamerasController@admin_cameras')->name('admin.cameras');
Route::get('/admin/plans', 'Api\CamerasController@admin_plans')->name('admin.plans');
Route::get('/admin/firmware', 'Api\CamerasController@admin_firmware')->name('admin.firmware');
Route::get('/admin/sims', 'Api\CamerasController@admin_sims')->name('admin.sims');
Route::get('/admin/rmas', 'Api\CamerasController@admin_rmas')->name('admin.rmas');
Route::get('/admin/siteactivity', 'Api\CamerasController@admin_siteactivity')->name('admin.siteactivity');
Route::get('/admin/apilog', 'Api\CamerasController@admin_apilog')->name('admin.apilog');
Route::get('/admin/viewlog', 'Api\CamerasController@admin_viewlog')->name('admin.viewlog');

// **** post
Route::post('/admin/user-search', 'Api\CamerasController@admin_user_search')->name('admin.user-search');
Route::post('/admin/email-search', 'Api\CamerasController@admin_email_search')->name('admin.email-search');
Route::post('/admin/camera-search', 'Api\CamerasController@admin_camera_search')->name('admin.camera-search');
Route::post('/admin/api-search', 'Api\CamerasController@admin_camera_search')->name('admin.api-search');

Route::get('/admin/clear-search/users', 'Api\CamerasController@admin_clear_search_users')->name('admin.clear-search.users');
Route::get('/admin/clear-search/emails', 'Api\CamerasController@admin_clear_search_users')->name('admin.clear-search.emails');
Route::get('/admin/clear-search/cameras', 'Api\CamerasController@admin_clear_search_cameras')->name('admin.clear-search.cameras');
Route::get('/admin/clear-search/sims', 'Api\CamerasController@admin_clear_search_sims')->name('admin.clear-search.sims');
Route::get('/admin/clear-search/apilog', 'Api\CamerasController@admin_clear_search_apilog')->name('admin.clear-search.apilog');

/*-----------------------------------------------------------*/
//Route::get('/plans/add-plan','Api\CamerasController@plans_addplan_create')->name('add.plan');
Route::get('/plans/add-plan','PlansController@view')->name('add.plan');
Route::get('/10ware/plans/add-plan','PlansController@view')->name('add.plan.10ware');
Route::get('/germany/plans/add-plan','PlansController@view')->name('add.plan.germany');

Route::post('/plans/add-plan','PlansController@add')->name('add.plan');

Route::get('/plans/cancel', 'AccountsController@profile')->name('plans.cancel');
Route::resource('/plans', 'PlansController');
Route::get('/plans/delete/{plan}', 'PlansController@delete')->name('plans.delete');

//Route::get('/myplans','PlansController@my_plans')->name('my.plans');
Route::get('/myplans','PlansController@my_plans2')->name('my.plans');
Route::get('/10ware/myplans','PlansController@my_plans2')->name('my.plans.10ware');
Route::get('/germany/myplans','PlansController@my_plans2')->name('my.plans.germany');

/*-----------------------------------------------------------*/
Route::get('/cameras', 'Api\CamerasController@cameras')->name('cameras');
Route::get('/10ware/cameras', 'Api\CamerasController@cameras_10ware')->name('cameras.10ware');
Route::get('/germany/cameras', 'Api\CamerasController@cameras_germany')->name('cameras.germany');

Route::post('/cameras/activetab', 'Api\CamerasController@activetab')->name('camera.activetab');
Route::get('/cameras/getdetail/{camera_id}', 'Api\CamerasController@getdetail')->name('camera.getdetail');

/* Overview */
Route::get('/cameras/overview/{camera_id}', 'Api\CamerasController@overview')->name('camera.overview');

/* Gallery */
Route::post('/cameras/gallery', 'Api\CamerasController@gallery')->name('camera.gallery');
Route::get('/cameras/gallerylayout/{camera_id}/{number}', 'Api\CamerasController@gallerylayout')->name('camera.gallerylayout'); // 2,3,4,6,12
Route::get('/cameras/gallerythumbs/{camera_id}/{number}', 'Api\CamerasController@gallerythumbs')->name('camera.gallerythumbs'); // 10,20,30,40,60,80
Route::get('/cameras/download/{camera_id}/{photo_id}', 'Api\CamerasController@download')->name('camera.download');

/* Settings */
Route::post('/camera/settings', 'Api\CamerasController@settings')->name('camera.settings');

/* Actions */
Route::get('/cameras/actions/{camera_id}', 'Api\CamerasController@actions')->name('camera.actions');;

/* Options */
Route::post('/cameras/delete', 'Api\CamerasController@delete')->name('camera.delete');

    // $("#notify_photo").click(function () {   /* default.blade.php */
    // var url = '/cameras/testnotify/photo/' + cam + '/62830';

    // $("#notify_video").click(function () {   /* default.blade.php */
    // var url = '/cameras/testnotify/video/' + cam + '/62852';

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
