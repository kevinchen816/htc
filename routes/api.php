<?php

use Illuminate\Http\Request;

use App\Handlers\ImageUploadHandler;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
    $api->get('version', function() {
        return response('version v1');
    });

    $api->get('path', function() {
        return public_path();
    });
});


// $api->version('v1', function($api) {
//     $api->post('hello', function() {
//         $result['ResultCode'] = 0;
//         return $result;
//     });
// });

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    $api->post('hello', 'CamerasController@hello')->name('api.camera.hello');
    $api->post('report', 'CamerasController@report')->name('api.camera.report');
    $api->post('status', 'CamerasController@status')->name('api.camera.status');
    $api->post('downloadsettings', 'CamerasController@downloadsettings')->name('api.camera.downloadsettings');

    $api->post('uploadblock', 'CamerasController@uploadblock')->name('api.camera.uploadblock');
    $api->post('uploadthumb', 'CamerasController@uploadthumb')->name('api.camera.uploadthumb');
    $api->post('uploadoriginal', 'CamerasController@uploadoriginal')->name('api.camera.uploadoriginal');
    $api->post('uploadvideothumb', 'CamerasController@uploadvideothumb')->name('api.camera.uploadvideothumb');
    $api->post('uploadvideo', 'CamerasController@uploadvideo')->name('api.camera.uploadvideo');

    $api->post('s3test', 'CamerasController@s3_test')->name('api.camera.s3test');

    $api->post('imagemissing', 'CamerasController@imagemissing')->name('api.camera.imagemissing');
    $api->post('videomissing', 'CamerasController@videomissing')->name('api.camera.videomissing');

    $api->post('firmwareinfo', 'CamerasController@firmwareinfo')->name('api.camera.firmwareinfo');
    $api->post('firmware', 'CamerasController@firmware')->name('api.camera.firmware');
    $api->post('firmwaredone', 'CamerasController@firmwaredone')->name('api.camera.firmwaredone');
    $api->post('firmwarefail', 'CamerasController@firmwarefail')->name('api.camera.firmwarefail');

    $api->post('moduleinfo', 'CamerasController@moduleinfo')->name('api.camera.moduleinfo');
    $api->post('moduledone', 'CamerasController@moduledone')->name('api.camera.moduledone');
    $api->post('modulefail', 'CamerasController@modulefail')->name('api.camera.modulefail');

    $api->post('cardfull', 'CamerasController@cardfull')->name('api.camera.cardfull');
    $api->post('carderror', 'CamerasController@carderror')->name('api.camera.carderror');
    $api->post('formatdone', 'CamerasController@formatdone')->name('api.camera.formatdone');

    $api->post('schedule', 'CamerasController@schedule')->name('api.camera.schedule');

    $api->post('logstatus', 'CamerasController@logstatus')->name('api.camera.logstatus');
    $api->post('uploadlog', 'CamerasController@uploadlog')->name('api.camera.uploadlog');

    $api->post('uploadlog', 'CamerasController@uploadlog')->name('api.camera.uploadlog');


    $api->post('mobileadd', 'MobileController@mobileadd')->name('api.mobile.add');
    // $api->post('deviceadd', 'MobileController@deviceaddX')->name('api.device.add');

    $api->post('account_check', 'MobileController@postAccountCheck')->name('api.mobile.account_check');

});

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});

/* web.php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
*/