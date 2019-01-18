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

use Illuminate\Http\Request;

/*
    Route::group(['https'], function () {
        // your routers
    });
*/
//Route::get('/', function () { return view('home'); })->name('home');
Route::get('/', 'Api\CamerasController@home')->name('home');
Route::get('/10ware', 'Api\CamerasController@home_10ware')->name('home.10ware');
Route::get('/de', 'Api\CamerasController@home_germany')->name('home.de');

Route::post('stripe/webhook', 'WebhookController@handleWebhook');

Route::resource('/users', 'UsersController');
// Route::resource('/cameras', 'CameraController', ['only' => ['store', 'destroy']]);

/*-----------------------------------------------------------*/
/*
//Route::get('/register', 'UsersController@register')->name('register');
Route::get('/signup', 'UsersController@create')->name('signup');
Route::get('/10ware/signup', 'UsersController@create_10ware')->name('signup.10ware');
Route::get('/de/signup', 'UsersController@create_germany')->name('signup.de');

Route::get('/login', 'SessionsController@create')->name('login');
Route::get('/10ware/login', 'SessionsController@login_10ware')->name('login.10ware');
Route::get('/de/login', 'SessionsController@login_germany')->name('login.de');

Route::post('/login', 'SessionsController@store')->name('login');
//Route::post('/10ware/login', 'SessionsController@store_10ware')->name('login.10ware');
//Route::post('/de/login', 'SessionsController@store_germany')->name('login.de');

Route::delete('/logout', 'SessionsController@destroy')->name('logout');
Route::delete('/10ware/logout', 'SessionsController@destroy_10ware')->name('logout.10ware');
Route::delete('/de/logout', 'SessionsController@destroy_germany')->name('logout.de');

Route::post('/logout', 'SessionsController@destroy')->name('logout');
Route::post('/10ware/logout', 'SessionsController@destroy_10ware')->name('logout.10ware');
Route::post('/de/logout', 'SessionsController@destroy_germany')->name('logout.de');
*/

/*-----------------------------------------------------------*/
/*
    app/Http/Controllers/HomeController.php
    resources/views/home.blade.php
    --> delete files

    app/Http/Controllers/Auth/LoginController.php
    app/Http/Controllers/Auth/RegisterController.php
    app/Http/Controllers/Auth/ResetPasswordController.php
    --> modify $redirectTo from /home to /

    app/Http/Middleware/RedirectIfAuthenticated.php
    --> modify redirect('/home') to redirect('/')
*/
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/confirm/email', 'EmailConfirmController@getEmail')->name('confirm.email');
Route::get('/confirm/send', 'EmailConfirmController@getSend')->name('confirm.send');
Route::post('/confirm/send', 'EmailConfirmController@postSend')->name('confirm.send');
Route::get('/confirm/verify', 'EmailConfirmController@getVerify')->name('confirm.verify'); // IMPORTANT !!
// Route::get('/confirm/success', 'EmailConfirmController@getSuccess')->name('confirm.success'); // IMPORTANT !!

// Route::get('/confirm/notice', 'EmailConfirmController@notice')->name('confirm.notice');

Route::group(['middleware' => 'auth'], function() {
    // Route::get('/confirm/notice', 'EmailConfirmController@notice')->name('confirm.notice');
    // Route::get('/confirm/send', 'EmailConfirmController@send')->name('confirm.send');

    Route::group(['middleware' => 'email_confirm'], function() {

        /*-----------------------------------------------------------*/
        /* Add Plan */
        /*
            /plans/add-plan                 -> /plan/add
            /plans/setup-plan               -> /plan/setup

            /plans/buy-reserve/{iccid}      -> /plan/buy/{iccid}
            /plans/setup-renewal/{iccid}    -> /plan/renew/{iccid}
        */
        Route::get('/plans/add','PlansController@getPlanAdd')->name('plans.add');
        Route::post('/plans/add','PlansController@postPlanAdd')->name('plans.add');

        Route::get('/plans/create/{plan}', 'PlansController@getPlanCreate')->name('plan.create');
        Route::post('/plans/create', 'PlansController@postPlanCreate')->name('plans.create');

        // Route::get('/plans/update/{plan}', 'PlansController@getPlanUpdate')->name('plans.update');
        // Route::post('/plans/update/', 'PlansController@postPlanUpdate')->name('plans.update');

        Route::get('/plans/renew/{plan}', 'PlansController@getPlanRenew')->name('plans.renew');
        Route::post('/plans/renew', 'PlansController@postPlanRenew')->name('plans.renew');

        Route::get('/plans/reactive/{plan}', 'PlansController@getPlanReactive')->name('plans.reactive');
        Route::post('/plans/reactive', 'PlansController@postPlanReactive')->name('plans.reactive');

        Route::get('/plans/cancel', 'PlansController@getPlanCancel')->name('plans.cancel');
        //Route::get('/plans/delete/{plan}', 'PlansController@delete')->name('plans.delete');

        // Route::get('/plans/buy','PlansController@getBuyPlan')->name('plan.buy');
        // Route::post('/plans/buy','PlansController@postBuyPlan')->name('plan.buy');

// Route::post('/cart/add', 'CartController@postAddCart')->name('cart.add');
// Route::post('cart', 'CartController@postAddCart')->name('cart.add');

        // for test
        // Route::get('/plan/pause/{plan}', 'PlansController@pause')->name('plan.pause');
        // Route::get('/plan/active/{plan}', 'PlansController@active')->name('plan.active');
        // Route::get('/plan/change/{plan}', 'PlansController@change')->name('plan.change');
        // Route::get('/plan/cancel/{plan}', 'PlansController@cancel')->name('plan.cancel');

        /*-----------------------------------------------------------*/
        /* My Cameras */
        Route::get('/cameras', 'Api\CamerasController@cameras')->name('cameras');
        Route::get('/10ware/cameras', 'Api\CamerasController@cameras_10ware')->name('cameras.10ware');
        Route::get('/de/cameras', 'Api\CamerasController@cameras_germany')->name('cameras.de');

        Route::get('/cameras/getdetail/{camera_id}', 'Api\CamerasController@getdetail')->name('camera.getdetail');
        Route::get('/10ware/cameras/getdetail/{camera_id}', 'Api\CamerasController@getdetail_10ware')->name('camera.getdetail.10ware');
        Route::get('/de/cameras/getdetail/{camera_id}', 'Api\CamerasController@getdetail_germany')->name('camera.getdetail.de');

        Route::post('/cameras/activetab', 'Api\CamerasController@postActiveTab')->name('camera.activetab');

        /* My Cameras - Overview */
        Route::get('/cameras/overview/{camera_id}', 'Api\CamerasController@overview')->name('camera.overview');

        /* My Cameras - Gallery */
        Route::post('/cameras/gallery', 'Api\CamerasController@gallery')->name('camera.gallery');
        Route::get('/cameras/gallerylayout/{camera_id}/{number}', 'Api\CamerasController@gallerylayout')->name('camera.gallerylayout'); // 2,3,4,6,12
        Route::get('/cameras/gallerythumbs/{camera_id}/{number}', 'Api\CamerasController@gallerythumbs')->name('camera.gallerythumbs'); // 10,20,30,40,60,80
        Route::get('/cameras/download/{camera_id}/{photo_id}', 'Api\CamerasController@download')->name('camera.download');

        /* My Cameras - Settings */
        Route::post('/camera/settings', 'Api\CamerasController@postSettings')->name('camera.settings');

        /* My Cameras - Actions */
        Route::get('/cameras/actions/{camera_id}', 'Api\CamerasController@actions')->name('camera.actions');;
        Route::get('/10ware/cameras/actions/{camera_id}', 'Api\CamerasController@actions_10ware')->name('camera.actions.10ware');;
        Route::get('/de/cameras/actions/{camera_id}', 'Api\CamerasController@actions_germany')->name('camera.actions.de');;

        Route::get('/cameras/sendsms/{camera_id}/{sms}', 'Api\CamerasController@sendsms')->name('camera.sendsms');

        // Route::get('/cameras/actionqueue/{portal}/{camera_id}/{action}', 'Api\CamerasController@actionqueue')->name('camera.actionqueue');
        // Route::get('/cameras/actioncancel/{portal}/{action_id}', 'Api\CamerasController@actioncancel')->name('camera.actioncancel');
        // Route::get('/cameras/clearmissing/{portal}/{camera_id}', 'Api\CamerasController@clearmissing')->name('camera.clearmissing');
        // Route::get('/cameras/requestmissing/{portal}/{camera_id}/{missingid}', 'Api\CamerasController@requestmissing')->name('camera.requestmissing');
        Route::get('/cameras/actionqueue/{camera_id}/{action}', 'Api\CamerasController@getActionQueue')->name('camera.actionqueue');
        Route::post('/cameras/actionqueue/', 'Api\CamerasController@postActionQueue')->name('camera.actionqueue_post');
        Route::get('/cameras/actioncancel/{action_id}', 'Api\CamerasController@getActionCancel')->name('camera.actioncancel');
        Route::get('/cameras/clearmissing/{camera_id}', 'Api\CamerasController@getClearMissing')->name('camera.clearmissing');
        Route::get('/cameras/requestmissing/{camera_id}/{missingid}', 'Api\CamerasController@getRequestMissing')->name('camera.requestmissing');

        /*-----------------------------------------------------------*/
        /* My Cameras - Options */
        Route::post('/cameras/delete', 'Api\CamerasController@postDelete')->name('camera.delete');
        // Route::get('/cameras/delete', 'Api\CamerasController@delete')->name('camera.delete'); // IMPORTANT !!
        Route::get('/cameras/apilog/{camera_id}', 'Api\CamerasController@getApiLog')->name('camera.apilog');

        /*-----------------------------------------------------------*/
        /* My Account */
        Route::get('/account/profile', 'AccountsController@getProfile')->name('account.profile');

        Route::post('/account/activetab', 'AccountsController@postActiveTab')->name('account.activetab');
        Route::post('/account/plans', 'AccountsController@postPlans')->name('account.plans');
        Route::post('/account/billing', 'AccountsController@postBilling')->name('account.billing');
        Route::post('/account/devices', 'AccountsController@postDevices')->name('account.devices');
        Route::post('/account/options', 'AccountsController@postOptions')->name('account.options');
        Route::post('/account/emails', 'AccountsController@postEmails')->name('account.emails');
        Route::post('/account/email-change', 'AccountsController@postEmailChange')->name('account.email-change');
        Route::get('/account/password/send-reset-email', 'AccountsController@getPasswordSendResetEmail')->name('account.password-send-reset-email');
        //Route::get('/account/password/reset/{id}', 'AccountsController@password_reset')->name('account.password-reset');

        Route::get('/account/deviceremove/{device_id}', 'AccountsController@getDeviceRemove')->name('account.deviceremove');

        /*-----------------------------------------------------------*/
        /* Shop */
        /*
            /shop/collectpayment    -> /shop/pay
        */
        // Route::get('/shop/cart', 'CartController@postAddCart')->name('shop.cart');

        Route::get('/shop/cart', 'CartController@getShopCart')->name('shop.cart');
        Route::get('/shop/cart-remove/{id}', 'CartController@getShopCartRemove')->name('shop.cart-remove');
        Route::get('/shop/cart-clear', 'CartController@getShopCartClear')->name('shop.cart-clear');
        Route::get('/shop/editcard', 'CartController@getShopEditCard')->name('shop.editcard');

        Route::post('/shop/pay', 'CartController@postShopPay')->name('shop.pay');

        Route::get('/currency/us', 'CartController@getCurrencyUS')->name('currency.us');
        Route::get('/currency/ca', 'CartController@getCurrencyCA')->name('currency.ca');
        Route::get('/currency/au', 'CartController@getCurrencyAU')->name('currency.au');
        Route::get('/currency/eu', 'CartController@getCurrencyEU')->name('currency.eu');

        /* for test */
        // Route::get('/invoice', 'CartController@getInvoice')->name('invoice');
        // Route::get('/invoice/{id}', 'CartController@getInvoiceDownload')->name('invoice.download');
        // Route::get('/invoice/test', 'CartController@getInvoiceTest')->name('invoice.test');

        /*-----------------------------------------------------------*/
        /* Admin */
        //Route::get('/admin', function() {return view('/admin/home');})->name('admin');
        // Route::get('/admin', 'Api\CamerasController@admin')->name('admin');
        Route::get('/adminx', 'Api\CamerasController@admin')->name('admin');
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

        Route::post('/admin/cameras/operation', 'Api\CamerasController@admin_cameras_operation')->name('admin.cameras.operation');


        Route::post('/admin/user-search', 'Api\CamerasController@admin_user_search')->name('admin.user-search');
        Route::post('/admin/email-search', 'Api\CamerasController@admin_email_search')->name('admin.email-search');
        Route::post('/admin/camera-search', 'Api\CamerasController@admin_camera_search')->name('admin.camera-search');
        Route::post('/admin/api-search', 'Api\CamerasController@admin_api_search')->name('admin.api-search');
        // Route::get('/admin/api-search', 'Api\CamerasController@admin_api_search')->name('admin.api-search');

        Route::get('/admin/clear-search/users', 'Api\CamerasController@admin_clear_search_users')->name('admin.clear-search.users');
        Route::get('/admin/clear-search/emails', 'Api\CamerasController@admin_clear_search_emails')->name('admin.clear-search.emails');
        Route::get('/admin/clear-search/cameras', 'Api\CamerasController@admin_clear_search_cameras')->name('admin.clear-search.cameras');
        Route::get('/admin/clear-search/apilog', 'Api\CamerasController@admin_clear_search_apilog')->name('admin.clear-search.apilog');
        Route::get('/admin/clear-search/sims', 'Api\CamerasController@admin_clear_search_sims')->name('admin.clear-search.sims');
    });

});

/*----------------------------------------------------------------------------------*/
// Route::get('/tour/start', function() {return '/tour/plans';})->name('tour.start');
Route::get('/help/terms', 'HelpsController@terms')->name('help.terms');
Route::get('/help/plans', 'HelpsController@plans')->name('help.plans');
Route::get('/help/quick-start', 'HelpsController@quick_start')->name('help.quick-start');
//Route::get('/help/privacy', function() {return '/help/privacy';})->name('help.privacy');

// Route::get('/support/emailpolicy', function() {'Api\CamerasController@emailpolicy';})->name('support.emailpolicy');
Route::get('/support/contact', function() {return '/support/contact';})->name('support.contact');
Route::post('/support/contact', function() {return '/support/contact';})->name('support.contact');

/* /email/verification */
Route::get('/email/optin', function() { return '/email/optin'; })->name('email.optin');
Route::get('/email/optout', function() { return '/email/optout'; })->name('email.optout');

/* default.blade.php */
    // $('#show_cameras').click(function() { /* default.blade.php */
    //$.get('/account/showcameralist/open'); // $.get() 方法使用 HTTP GET 请求从服务器加载数据 (JQuery)
    // Route::get('/account/showcameralist/open', function() {
    //     return 'open';
    // });

    // $('#close_cameras').click(function() { /* default.blade.php */
    //$.get('/account/showcameralist/close');
    // Route::get('/account/showcameralist/close', function() {
    //     return 'close';
    // });

/*----------------------------------------------------------------------------------*/
/* for test */
// Route::get('/test', function() {return 'OK';});
// Route::get('/test', 'Api\CamerasController@test');
// Route::get('/email/test', 'MailController@test')->name('email.test');
// Route::get('/email/test', 'Api\CamerasController@email_test')->name('email.test');

Route::get('/download/log/{camera_id}/{filename}', 'Api\CamerasController@download_log')->name('camera.download.log');

/* for stripe test */
// // Route::get('/stripe', 'AccountsController@stripe');
// Route::get('/stripe/test', 'AccountsController@getStripeTest');
// Route::get('/stripe/test1', 'AccountsController@getStripeTest1');
// Route::get('/stripe/test2', 'AccountsController@getStripeTest2');
// Route::get('/stripe/test3', 'AccountsController@getStripeTest3');
// Route::get('/stripe/test4', 'AccountsController@getStripeTest4');

Route::get('/push', 'Api\CamerasController@push_test');
Route::get('/push2', 'Api\CamerasController@push_test2');
Route::get('/device/add', 'Api\CamerasController@device_add');

//Route::get('/bootstrap', function () { return view('bootstrap'); });
//Route::get('/env', function () { return env('APP_ENV'); });

//Route::group(['prefix' => 'accounts/{account_id}'], function () {
//    Route::get('detail', function ($account_id)    {
//        // accounts/{account_id}/detail
//    });
//});

/*
https://restapi-telstra.jasper.com/rws/api/v1

curl -X POST
--header "Content-Type: application/json"
--header "Accept: application/json"
--header "Authorization: Basic ZHB0cmlhbFVzZXIxOmQ3MDNmNTJiLTEyMDAtNDMxOC1hZTBkLTBmNjA5MmIyZTZhYg=="
-d "{ \"messageText\": \"Hello world\" }" "https://restapi10.jasper.com/rws/api/v1/devices/{iccid}/smsMessages"
*/