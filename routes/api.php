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
        return response('this is version v1');
    });
});

$api->version('v1', function($api) {
    $api->post('hello', function() {
        //return response('Hello');
        //return response()->json(['ResultCode' => 0]);
        //return ['ResultCode' => 0];

        /* {"ResultCode":0} */
        /*
        $result = array(
            'ResultCode' => 0,
        );*/
        $result['ResultCode'] = 0;
        //return response($result);
        return $result;
    });
});

$api->version('v1', function($api) {
    $api->post('report', function(Request $request) {
        /*{"ResultCode":0,"DateTimeStamp":"2018-03-17 09:06:51"}*/

        //return $request;

        date_default_timezone_set("Asia/Shanghai");
        $result['ResultCode'] = 0;
        $result['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $result;
    });
});

$api->version('v1', function($api) {
    $api->post('status', function(Request $request) {
        /*{"ResultCode":0,"DateTimeStamp":"2018-03-17 09:06:51"}*/
        date_default_timezone_set("Asia/Shanghai");
        $result['ResultCode'] = 0;
        $result['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $result;
    });
});

/*
$api->version('v1', function($api) {
    $api->post('uploadthumb', 'ImagesController@store')->name('api.uploadthumb.store');
}
*/

$api->version('v1', function($api) {
    $api->post('uploadthumb', function(Request $request) {
    //$api->post('uploadthumb', function(Request $request, ImageUploadHandler $uploader, Image $image) {

        $file = $request->Image;

        if ($file && $file->isValid()) {
            $result['clientName'] = $file->getClientOriginalName();           // PICT0001.JPG
            $result['extension'] = $file->getClientOriginalExtension(); // JPG
            $result['tmpName'] = $file->getFileName();                  // php5qf3fj
            $result['realPath'] = $file->getRealPath();                 // /tmp/php5qf3fj
            $result['mimeTye'] = $file->getMimeType();                  // image/jpeg

            // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
            //$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
            $clientName = $file->getClientOriginalName();
            $extension = strtoupper($file->getClientOriginalExtension()); // JPG

            // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
            // 文件夹切割能让查找效率更高。
            //$folder_name = "uploads/images/$folder/" . date("Ym/d", time());
            $folder_name = "uploads/images";

            // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
            // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
            // 值如：/home/vagrant/Code/larabbs/public + / + uploads/images/
            $upload_path = public_path() . '/' . $folder_name;

            // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
            // 值如：1_1493521050_7BVc9v9ujP.png
            //$filename = md5(date('ymdhis').$clientName).".".$extension; // 0be0fa46c2062453c8e0a375fe68f5fd.JPG
            //$filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
            $filename = time() . '_' . str_random(10) . '.' . $extension;
            $result['filename'] = $filename;

            $path = $file->move($upload_path, $filename);
            $result['path'] = "$path";

            $result_code = 0;
        } else {
            $result_code = 900;
        }
        /*{"ResultCode":0,"DateTimeStamp":"2018-03-17 09:06:51"}*/
        date_default_timezone_set("Asia/Shanghai");
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $result;

/*
        $user = $this->user();

        $size = $request->type == 'avatar' ? 362 : 1024;
        $result = $uploader->save($request->image, str_plural($request->type), $user->id, $size);

        $image->path = $result['path'];
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->save();
*/
    });
});

$api->version('v1', function($api) {
    $api->post('firmware', function(Request $request) {
        //date_default_timezone_set("Asia/Shanghai");
        //$result['ResultCode'] = 0;
        //$result['DateTimeStamp'] = date('Y-m-d H:i:s');
        //return $result;

        $name = 'IMAGE.ZIP';
        $pathToFile = public_path() . '/firmware/' . $name;
        //return response()->download($pathToFile);
        return response()->download($pathToFile, $name);

        //$result['pathToFile'] = $pathToFile;
        //return $result;

    });
});

$api->version('v1', function($api) {
    $api->post('downloadsettings', function(Request $request) {
        date_default_timezone_set("Asia/Shanghai");

        $datalist['cameramode'] = 'p';
        $datalist['photoresolution'] = '4';
        $datalist['video_resolution'] = '8';
        $datalist['video_rate'] = '4';
        $datalist['video_bitrate'] = '500';
        $datalist['video_bitrate7'] = '500';
        $datalist['video_bitrate8'] = '500';
        $datalist['video_bitrate9'] = '500';
        $datalist['video_bitrate10'] = '1000';
        $datalist['video_bitrate11'] = '1000';
        $datalist['video_length'] = '5s';
        $datalist['video_sound'] = 'on';
        $datalist['photoburst'] = '1';
        $datalist['burst_delay'] = '500';
        $datalist['upload_resolution'] = '1';
        $datalist['photo_quality'] = '1';
        $datalist['photo_compression'] = '29';
        $datalist['timestamp'] = 'on';
        $datalist['date_format'] = 'mdY';
        $datalist['time_format'] = '12';
        $datalist['temperature'] = 'c';
        $datalist['quiettime'] = '0s';
        $datalist['timelapse'] = 'on';
        $datalist['tls_start'] = '00:00';
        $datalist['tls_stop'] = '23:59';
        $datalist['tls_interval'] = '5m';
        $datalist['wireless_mode'] = 'instant';
        $datalist['wm_schedule'] = '1h';
        $datalist['wm_sclimit'] = '50';
        $datalist['hb_interval'] = '1h';
        $datalist['online_max_time'] = '5';
        $datalist['cellularpw'] = '';
        $datalist['remotecontrol'] = 'off';
        $datalist['dutytime'] = 'off';
        $datalist['dt_sun'] = 'ffffff';
        $datalist['dt_mon'] = 'ffffff';
        $datalist['dt_tue'] = 'ffffff';
        $datalist['dt_wed'] = 'ffffff';
        $datalist['dt_thu'] = 'ffffff';
        $datalist['dt_fri'] = 'ffffff';
        $datalist['dt_sat'] = 'ffffff';
        $datalist['use_crc32'] = 'n';
        $datalist['blockmode1'] = 'off';
        $datalist['blockmode2'] = 'off';
        $datalist['blockmode3'] = 'off';
        $datalist['blockmode4'] = 'off';
        $datalist['blockmode5'] = 'off';
        $datalist['blockmode7'] = 'off';
        $datalist['blockmode8'] = 'off';
        $datalist['blockmode9'] = 'off';
        $datalist['blockmode10'] = 'off';
        $datalist['blockmode11'] = 'off';

        //"ActionCode":"PS","ParameterList":{"REQUESTID":"5941"}
        $action_code = 'PS';
        $parameter_list['REQUESTID'] = '5941';

        $result['ResultCode'] = 0;
        $result['DataList'] = $datalist;
        $result['ActionCode'] = $action_code;
        $result['ParameterList'] = $parameter_list;
        $result['DateTimeStamp'] = date('Y-m-d H:i:s');

        return $result;
    });
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
