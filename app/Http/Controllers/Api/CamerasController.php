<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use Schema;

use App\Models\Camera;
use App\Models\Photo;
use App\Handlers\ImageUploadHandler;

class CamerasController extends Controller
{
    // var $camera_id;
    // function __construct() {
    //     $this->camera_id = 999;
    // }
    // static function setCameraID($id) {
    //     echo 'XXX';
    //     $camera_id = $id;
    // }
    // static function getCameraID() {
    //     return $camera_id;
    // }

    public function getErrorMessage($result_code) {
        $error_msg = array(
            900 =>'Invalid or Missing camera Module',
            901 =>'Invalid SIM card',
            // 901 =>'Invalid or Missing camera Model',
            902 =>'test or Missing camera Model',
            999 =>'Unknown Error');
        //return ($error_msg[$result_code]) ? $error_msg[$result_code] : $status[500];
        return ($error_msg[$result_code]) ? $error_msg[$result_code] : $error_msg[999];
    }

    public function responseResult($ret) {
        // date_default_timezone_set("Asia/Shanghai");
        $result = $ret['result'];
        $response['ResultCode'] = $result;
        if ($result) {
            $response['ErrorMsg'] = $this->getErrorMessage($result);
        }

        if (empty($ret['datetime'])) {
            $datetime = date('Y-m-d H:i:s');
        } else {
            $datetime = $ret['datetime'];
        }
        $response['DateTimeStamp'] = $datetime;
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    //public function addCamera($new_camera, $request) {
    public function addCamera($request) {
        $new_camera = new Camera;

        $datetime = date('Y-m-d H:i:s');

// search iccid to find the user_id ??
$new_camera->user_id = 1;

        $new_camera->module_id = $request->module_id;
        $new_camera->iccid = $request->iccid;
        $new_camera->model_id = $request->model_id;

        $datalist = $request->DataList;
        $new_camera->battery = $datalist['Battery'];
        $new_camera->signal_value = $datalist['SignalValue'];
        $new_camera->card_space = $datalist['Cardspace'];
        $new_camera->card_size = $datalist['Cardsize'];
        $new_camera->temperature = $datalist['Temperature'];
        $new_camera->dsp_version = $datalist['FirmwareVersion'];
        $new_camera->mcu_version = $datalist['mcu'];
        $new_camera->cellular = $datalist['cellular'];

        $new_camera->last_contact = $datetime;
        $new_camera->last_hb = $datetime;

        $new_camera->save();

        $ret['result'] = 0;
        $ret['datetime'] = $datetime;
        return $ret;
    }

    public function updateCamera($cameras, $camera, $request) {
        $datetime = date('Y-m-d H:i:s');

        $data['iccid'] = $request->iccid;
        $data['model_id'] = $request->model_id;

        $datalist = $request->DataList;
        $data['battery'] = $datalist['Battery'];
        $data['signal_value'] = $datalist['SignalValue'];
        $data['card_space'] = $datalist['Cardspace'];
        $data['card_size'] = $datalist['Cardsize'];
        $data['temperature'] = $datalist['Temperature'];
        $data['dsp_version'] = $datalist['FirmwareVersion'];
        $data['mcu_version'] = $datalist['mcu'];
        $data['cellular'] = $datalist['cellular'];

        $data['last_contact'] = $datetime;
        $data['last_hb'] = $datetime;
        $cameras->update($data);

        $ret['result'] = 0;
        $ret['datetime'] = $datetime;
        return $ret;
    }

    /*----------------------------------------------------------------------------------*/
    public function hello(Request $request) {
        $result['ResultCode'] = 0;
        return $result;
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {
            "iccid":"89860117851014783481","module_id":"861107030190590","model_id":"lookout-na",
            "DataList":{
                "Battery":"f",
                "SignalValue":"31",
                "Cardspace":"7848MB",
                "Cardsize":"7854MB",
                "Temperature":"41C",
                "mcu":"4.1",
                "FirmwareVersion":"20180313",
                "cellular":"4G LTE"
            }
        }
    */
    //public function report(Request $request, Camera $new_camera) {
    public function report(Request $request) {
        $iccid = $request->iccid;


        $module_id = $request->module_id;

        $cameras = DB::table('cameras')->where('module_id', $request->module_id);
        $camera = $cameras->first();
        if ($camera) {
            $ret = $this->updateCamera($cameras, $camera, $request);
        } else {
            $ret = $this->addCamera($request);
        }
        return $this->responseResult($ret);
    }

    /*----------------------------------------------------------------------------------*/
    //public function report(Request $request) {
    public function status(Request $request, Camera $new_camera) {
        $cameras = DB::table('cameras')->where('module_id', $request->module_id);
        $camera = $cameras->first();

        if ($camera) {
            $ret = $this->updateCamera($cameras, $camera, $request);
        } else {
            $ret = $this->addCamera($request);
        }
        return $this->responseResult($ret);
    }

    /*----------------------------------------------------------------------------------*/
    public function downloadsettings(Request $request) {
        //date_default_timezone_set("Asia/Shanghai");

        $error_msg = array (
            '900' =>'Invalid or Missing camera Module',
            '901' =>'Invalid or Missing camera Model',
            '902' =>'test or Missing camera Model',
        );

        //$cameras = DB::table('cameras')->select('module_id')->get();
        //return $cameras;

        //$cameras = DB::table('cameras')->first();
        //$cameras = DB::table('cameras')->select('module_id')->first();
        //return $cameras->module_id;

        //$cameras = DB::table('cameras')->where('module_id', $request->module_id);
        //return $cameras->count();

        //$cameras = DB::table('cameras')->where('module_id', $request->module_id)->get(); // NG
        $cameras = DB::table('cameras')->where('module_id', $request->module_id);
        $camera = $cameras->first();
        //return $camera->module_id;

        if ($camera) {
            $datalist['cameramode'] = $camera->camera_mode;
            $datalist['photoresolution'] = $camera->photo_resolution;
            $datalist['video_resolution'] = $camera->video_resolution;
            $datalist['video_rate'] = $camera->video_fps;
            $datalist['video_bitrate'] = $camera->video_bitrate;
            $datalist['video_bitrate7'] = $camera->video_bitrate7;
            $datalist['video_bitrate8'] = $camera->video_bitrate8;
            $datalist['video_bitrate9'] = $camera->video_bitrate9;
            $datalist['video_bitrate10'] = $camera->video_bitrate10;
            $datalist['video_bitrate11'] = $camera->video_bitrate11;
            $datalist['video_length'] = $camera->video_length;
            $datalist['video_sound'] = $camera->video_sound;
            $datalist['photoburst'] = $camera->photo_burst;
            $datalist['burst_delay'] = $camera->burst_delay;
            $datalist['upload_resolution'] = $camera->upload_resolution;
            $datalist['photo_quality'] = $camera->photo_quality;
            $datalist['photo_compression'] = $camera->photo_compression;
            $datalist['timestamp'] = $camera->timestamp;
            $datalist['date_format'] = $camera->date_format;

            $datalist['time_format'] = $camera->time_format;
            $datalist['temperature'] = $camera->temperature;
            $datalist['quiettime'] = $camera->quiettime;
            $datalist['timelapse'] = $camera->timelapse;
            $datalist['tls_start'] = date('H:i', strtotime($camera->tls_start));
            $datalist['tls_stop'] = date('H:i', strtotime($camera->tls_stop));
            $datalist['tls_interval'] = $camera->tls_interval;
            $datalist['wireless_mode'] = $camera->wireless_mode;
            $datalist['wm_schedule'] = $camera->wm_schedule;
            $datalist['wm_sclimit'] = $camera->wm_sclimit;
            $datalist['hb_interval'] = $camera->hb_interval;
            $datalist['online_max_time'] = $camera->online_max_time;
            $datalist['cellularpw'] = $camera->cellularpw;
            $datalist['remotecontrol'] = $camera->remotecontrol;

            $datalist['dutytime'] = $camera->dutytime;
            $datalist['dt_sun'] = $camera->dt_sun;
            $datalist['dt_mon'] = $camera->dt_mon;
            $datalist['dt_tue'] = $camera->dt_tue;
            $datalist['dt_wed'] = $camera->dt_wed;
            $datalist['dt_thu'] = $camera->dt_thu;
            $datalist['dt_fri'] = $camera->dt_fri;
            $datalist['dt_sat'] = $camera->dt_sat;

            $datalist['use_crc32'] = $camera->use_crc32;

            $datalist['blockmode1'] = $camera->blockmode1;
            $datalist['blockmode2'] = $camera->blockmode2;
            $datalist['blockmode3'] = $camera->blockmode3;
            $datalist['blockmode4'] = $camera->blockmode4;
            $datalist['blockmode5'] = $camera->blockmode5;
            $datalist['blockmode7'] = $camera->blockmode7;
            $datalist['blockmode8'] = $camera->blockmode8;
            $datalist['blockmode9'] = $camera->blockmode9;
            $datalist['blockmode10'] = $camera->blockmode10;
            $datalist['blockmode11'] = $camera->blockmode11;

            $result = 0;

        } else {
            $result = 900;
            //$result = 901;
        }

        $datetime = date('Y-m-d H:i:s');

        $response['ResultCode'] = $result;
        if ($result == 0) {
            $response['DataList'] = $datalist;
            if (0) {
                //"ActionCode":"PS","ParameterList":{"REQUESTID":"5941"}
                $action_code = 'PS';
                $parameter_list['REQUESTID'] = '5941';
                $response['ActionCode'] = $action_code;
                $response['ParameterList'] = $parameter_list;
            }

            $data['last_contact'] = $datetime;
            $data['last_settings'] = $datetime;
            $cameras->update($data);

        } else {
            $response['ErrorMsg'] = $this->getErrorMessage($result);
        }
        $response['DateTimeStamp'] = $datetime;
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function uploadblock(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'uploadblock';
        return $result;
    }

    /*----------------------------------------------------------------------------------*/
    /*
        $request =
        {
            "iccid": "89860117851014783481",
            "module_id": "861107032685597",
            "model_id": "lookout-na",
            "FileName": "PICT0001.JPG",
            "upload_resolution": "1",
            "Source": "setup",
            "DateTime": "20180910123456",
            "Image": []
        }
    */
    //public function uploadthumb(Request $request, ImageUploadHandler $uploader) {
    //public function uploadthumb(Request $request, Camera $camera, Photo $photo, ImageUploadHandler $uploader) {
    public function uploadthumb(Request $request, Photo $photo, ImageUploadHandler $uploader) {
        //return $request;
        //$camera = $camera->find(1);
        //return $camera;


        /*//$cameras = $camera->where('module_id', '861107032685597')->get();
        //$camera = DB::table('cameras')->where('model_id', 'lookout-na')->get();
        //$cameras = DB::table('cameras')->where('module_id', '861107032685597')->get();
        //$camera = DB::table('cameras')->where('module_id', $request->module_id)->get();*/

        // $camera = DB::table('cameras')
        //                 ->where('module_id', $request->module_id)
        //                 ->first();

        $cameras = DB::table('cameras')->where('module_id', $request->module_id);
        $camera = $cameras->first();

        if ($camera) {
            $file = $request->Image;
            if ($file && $file->isValid()) {
                $ret = $uploader->save_file($file);
                /*
                $ret =
                {
                "clientName": "PICT0001.JPG",
                "extension": "JPG",
                "tmpName": "phpYfxl7a",
                "realPath": "/tmp/phpYfxl7a",
                "mimeTye": "image/jpeg",
                "filename": "1536576315_VWraupBCZT.JPG",
                "result": 0
                }
                */
                $result = $ret['result'];
                if ($result == 0) {
                    //$photo = DB::table('photos')->get(); // NG
                    $photo->camera_id = $camera->id; // TODO
                    $photo->filename = $request->FileName;
                    $photo->upload_resolution = $request->upload_resolution;
                    $photo->photo_quality = $request->photo_quality;
                    $photo->photo_compression = $request->photo_compression;
                    $photo->source = $request->Source;
                    $photo->datetime = $request->DateTime;
                    $photo->filepath = $ret['filename']; //$request->FileName;
                    $photo->save();
                    //return $photo;

                    /* update camera status */
                    $data['iccid'] = $request->iccid;
                    $data['model_id'] = $request->model_id;

                    //$datalist = $request->DataList;
                    $data['battery'] = $request->Battery;
                    $data['signal_value'] = $request->SignalValue;
                    $data['card_space'] = $request->Cardspace;
                    $data['card_size'] = $request->Cardsize;
                    $data['temperature'] = $request->Temperature;
                    $data['dsp_version'] = $request->FirmwareVersion;
                    $data['mcu_version'] = $request->mcu;
                    $data['cellular'] = $request->cellular;

                    $data['last_filename'] = $ret['filename'];

                    // $data['last_contact'] = $datetime;
                    // $data['last_hb'] = $datetime;
                    $cameras->update($data);
                }

            } else {
                $result = 901;
            }

        } else {
            $result = 900;
        }

        $ret['result'] = $result;
        $response = $this->responseResult($ret);
        return $response;
    }

    public function uploadoriginal(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        return $response;
    }

    public function uploadvideothumb(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    public function uploadvideo(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;t;
    }

    /*----------------------------------------------------------------------------------*/
    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na","RequestID":"831"}
    */
    public function imagemissing(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na","RequestID":"831"}
    */
    public function videomissing(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na",
    "RequestID":"4980","version":"20180720","Battery":"f","Cardspace":"30405MB","Cardsize":"30432MB"}
    */
    public function firmwareinfo(Request $request) {
        // $request->version;
        // $request->Battery;
        // $request->Cardspace;

        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    public function firmware(Request $request) {
        $name = 'IMAGE.ZIP';
        $pathToFile = public_path() . '/firmware/' . $name;
        //$result['pathToFile'] = $pathToFile;
        //return $result;

        //return response()->download($pathToFile);
        return response()->download($pathToFile, $name);
    }

    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na","version":"20180313"}
    */
    public function firmwaredone(Request $request) {
        // $request->version;

        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na","RequestID":"4977"}
    */
    public function firmwarefail(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function cardfull(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;lt;
    }

    /*----------------------------------------------------------------------------------*/
    public function formatdone(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function schedule(Request $request) {
        $ret['result'] = 0;
        $response = $this->responseResult($ret);
        $response['api'] = __FUNCTION__;
        return $response;
    }

    /*-------------------------------------------------------------------------*/
    public function settings(Request $request) {
        //return 'settings';
        return $request;
    }

    /*----------------------------------------------------------------------------------*/
    /* Web Function */
    // https://blog.csdn.net/woshihaiyong168/article/details/52992812
    //public function cameras() {
    public function cameras($camera_id) {
        //return 'id='.$camera_id;

        //if (Auth::user()) {
        if (Auth::check()) {
            session()->flash('success', 'Welcome !!');

            //$user_id = Auth::user()->id;
            //$camera = DB::table('cameras')->where('user_id', $user_id)->first();
            //return $camera->description;

            $user = Auth::user();
            $user_id = $user->id;
            //$cameras = DB::table('cameras')->where('user_id', $user_id)->get();
            // foreach ($cameras as $camera) {
            //     echo $camera->description;
            //     echo '<br/>';
            // }
            //return;

            //$camera = DB::table('cameras')->where('user_id', $user_id)->first();
            //$camera_id = $camera->id;
            //$camera_id = 8; // for test
            $camera = Camera::findOrFail($camera_id);
            $photos = $camera->photos()
                             ->orderBy('created_at', 'desc')
                             ->paginate(10);

            return view('cameras', compact('user', 'camera', 'photos'));

        } else {
            session()->flash('warning', 'Please login first.');
            return redirect()->route('login');
        }
    }

    // public function cameras_ex($camera_id) {
    //     $user = Auth::user();
    //     $camera = Camera::findOrFail($camera_id);
    //     $photos = $camera->photos()
    //                      ->orderBy('created_at', 'desc')
    //                      ->paginate(10);
    //     // /return view('cameras', compact('camera', 'photos')); // OK
    //     return view('cameras', compact('user', 'camera', 'photos')); // OK
    // }

    /* /cameras/getdetail/{camera_id} */
    public function getdetail($camera_id) {
        $user = Auth::user();
        $camera = Camera::findOrFail($camera_id);
        $photos = $camera->photos()
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        //return view('cameras', compact('camera', 'photos')); // OK
        return view('cameras', compact('user', 'camera', 'photos')); // OK

        //return redirect()->route('cameras_ex', $camera_id);
    }

    public function gallery() {
        $token = $_POST['_token'];
        $camera_id = $_POST['id'];
        $action = $_POST['action'];
        $medialist = $_POST['medialist'];
        echo $token;
        echo '<br/>';
        echo $camera_id;
        echo '<br/>';
        echo $action;
        echo '<br/>';
        echo $medialist;
        echo '<br/>';

        /* push to Action queue .... */

        return;
    }

    public function gallerylayout($camera_id, $number) {
        echo $camera_id;
        echo '<br/>';
        echo $number;
        echo '<br/>';
        return;
    }

    public function gallerythumbs($camera_id, $number) {
        echo $camera_id;
        echo '<br/>';
        echo $number;
        echo '<br/>';
        return;
    }

    /* /cameras/activetab */
    public function activetab() {
        $tab = $_POST['tab'];
        return $tab;

        // $ret['a'] = 1;
        // $ret['b'] = 2;
        // $ret['c'] = 3;
        // return json_encode($ret); // OK
    }

    public function overview($cameras_id) {
        //$ret = '/cameras/overview/'.$cameras_id;
        //return $ret;

        $camera = Camera::findOrFail($cameras_id);
        return view('camera.tab_overview', compact('camera'));
    }

    public function actions($cameras_id) {
        $ret = '/cameras/actions/'.$cameras_id;
        return $ret;
    }

    public function emailpolicy() {
        $user = Auth::user();
        $camera = Camera::findOrFail($camera_id);
        $photos = $camera->photos()
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

        return view('support.emailpolicy', compact('user', 'camera', 'photos'));
    }

    /*----------------------------------------------------------------------------------*/
    /* Common Functions */
    public function CameraFieldValueConvert($camera, $column, $name) {

        if ($name == 'off') {
            $name = 'Off';

        } else if ($name == 'on') {
            $name = 'On';

        } else if ($column == 'camera_mode') {
            if ($name === 'p') {
                $name = 'Photo';
            } else if ($name === 'v') {
                $name = 'Video';
            } else {
                $name = 'Unknown';
            }

        } else if ($column == 'model_id') {
            if ($name === 'lookout-na') {
                $name = 'Lookout North America';
            } else {
                $name = 'Unknown';
            }

        } elseif ($column == 'signal_value') {

        } elseif ($column == 'battery') {
            if ($name === 'f') {
                $name = '<i class="fa fa-battery-full" style="color: lime;"> </i> ';
                $name .= '100%';
            } else if ($name === 'h') {
                $name = '<i class="fa fa-battery-three-quarters" style="color: lime;"> </i> ';
                $name .= '75%';
            } else if ($name === 'm') {
                $name = '<i class="fa fa-battery-half" style="color: lime;"> </i> ';
                $name .= '50%';
            } else if ($name === 'l') {
                $name = '<i class="fa fa-battery-quarter" style="color: lime;"> </i> ';
                $name .= '25%';
            } else if ($name === 'e') {
                $name = '<i class="fa fa-battery-empty" style="color: lime;"> </i> ';
                $name .= '0%';
            } else {
                $name = 'Unknown';
            }

        } elseif ($column == 'card_size') {
            settype($name, "integer");
            //$value = round($name/1024, 2);
            $value = number_format($name/1024, 2);
            $name = $value.' GB';

        } elseif ($column == 'card_space') {
            $free = $name;
            $size = $camera['card_size'];
            settype($free, 'integer');
            settype($size, 'integer');
            $percent = round(($free/$size)*100, 0);

            $free = round($free/1024, 2);
            $name = $free.' GB ('.$percent.'%free)';

        } elseif ($column == 'points_used') {
            $used = $name;
            $size = $camera['points'];
            $percent = round(($used/$size)*100, 0);

            $used = number_format($used, 2, '.', '');
            $name = $used.' ('.$percent.'%free)';
        }
        return $name;
    }

    public function CameraPanelBody($id, $lists) {
        $camera = Camera::findOrFail($id);

        $handle = '';
        foreach ($lists as $key => $value) {
            $field_mame = $key;
            $field_value = $camera[$key];
            $field_title = $value;
            $field_text = $this->CameraFieldValueConvert($camera, $field_mame, $field_value);

            $handle .= '<div class="row">';
            $handle .= '<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">';
            $handle .= '<span class="pull-right">'.$field_title.'</span>';
            $handle .= '</div>';
            $handle .= '<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">';
            $handle .= '<strong>'.$field_text.'</strong>';
            $handle .= '</div>';
            $handle .= '</div>';
            //$handle .= PHP_EOL;
        }
        return $handle;
    }

    /*----------------------------------------------------------------------------------*/
    /* Camera List */
    /*
        <tr>
            <td class="col-sm-1">
            </td>
            <td class="col-sm-5 ">
                <a href="/cameras/getdetail/50">New Camera</a><br />
                <i class="fa fa-battery-full" style="color: lime;"> </i> 100%<br />
                <span style="font-size: .95em">07/12/2018 5:49:00 am</span>
            </td>
            <td class="col-sm-6">
                <!--<a class="btn thumb-select" data-id="54" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;"><img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=8e1e0e2ac491275350a4091d1b00b06b56f71477371a4eafbbab13995200d36e" class="img-responsive" /></a>-->
            </td>
        </tr>
    */
    public function Camera_List($active_camera_id) {

        //return $active_camera_id;

        $user = Auth::user();
        $user_id = $user->id;
        $cameras = DB::table('cameras')
                        ->select('id', 'description', 'battery', 'last_contact', 'last_filename')
                        ->where('user_id', $user_id)
                        ->get();

        $style = 'padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;';
        $handle = '';
        foreach ($cameras as $camera) {
            $camera_id = $camera->id;
            $description = $camera->description;
            $battery = $this->CameraFieldValueConvert($camera, 'battery', $camera->battery);
            $last_contact = $camera->last_contact;

            if (!empty($camera->last_filename)){
                //$url = 'http://sample.test/uploads/images/'.$camera->last_filename;
                //$url = url('/uploads/images/').$camera->last_filename; // NG
                $url = url('/uploads/images/').'/'.$camera->last_filename;
            } else {
                $url = '';
            }
            //$url = 'http://sample.test/uploads/images/1537233425_2YDReN47PS.JPG';

            $handle .= '<tr>';

            $handle .= '    <td class="col-sm-1">';
            if ($camera_id == $active_camera_id) {
                $handle .= '<i class="fa fa-camera"> </i>';
            }
            $handle .= '    </td>';

            if ($camera_id == $active_camera_id) {
                $handle .= '    <td class="col-sm-5 active">';
            } else {
                $handle .= '    <td class="col-sm-5">';
            }

            $handle .= '        <a href="/cameras/getdetail/'.$camera_id.'">'.$description.'</a><br/>';
            // $handle .= '        <i class="fa fa-battery-full" style="color: lime;"> </i>'.$battery.'<br />';
            $handle .=              $battery.'<br/>';
            $handle .= '        <span style="font-size: .95em">'.$last_contact.'</span>';
            $handle .= '    </td>';

            $handle .= '    <td class="col-sm-6">';
            if (!empty($url)) {
                // $handle .= '        <a class="btn thumb-select" data-id="15" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;"><img src="'.$url.'" class="img-responsive"/></a>';
                $handle .= '        <a class="btn thumb-select" data-id="'.$camera_id.'" style="'.$style.'"><img src="'.$url.'" class="img-responsive"/></a>';
            }
            $handle .= '    </td>';
            $handle .= '</tr>';
        }
        return $handle;
    }

    /*----------------------------------------------------------------------------------*/
    /* Camera Data
    /*----------------------------------------------------------------------------------*/
    /* Overview */
    public function OverviewStatus($camera) {
        $lists = array(
            'description'   => 'Description',
            'location'      => 'Location',
            'module_id'     => 'Module ID',
            'iccid'         => 'SIM ICCID',
            'points'        => 'Plan Points',
            'points_used'   => 'Points Used',
            'model_id'      => 'Model',
            'signal_value'  => 'Signal',
            'battery'       => 'Battery',
            'card_size'     => 'Card Size',
            'card_space'    => 'Card Space',
            'temperature'   => 'Temperature',
            'dsp_version'   => 'Firmware',
            'mcu_version'   => 'MCU',
            'cellular'      => 'Last Connection',
        );

        $handle = $this->CameraPanelBody($camera->id, $lists);
        return $handle;
    }

    public function OverviewSettings($camera) {
        $lists = array(
            'last_settings'     => 'Last Downloaded',
            'camera_mode'       => 'Camera Mode',
            'photo_resolution'  => 'Photo Resolution',
            'video_resolution'  => 'Video Resolution',
            'video_fps'         => 'Capture Rate',
            'video_bitrate'     => 'Quality Level',
            'video_length'      => 'Video Duration',
            'video_sound'       => 'Video Sound',
            'photo_burst'       => 'Photo Burst',
            'burst_delay'       => 'Burst Delay',
            'upload_resolution' => 'Upload Resolution',
            'photo_quality'     => 'Upload Quality',
            'timestamp'         => 'Time Stamp',
            'date_format'       => 'Date Format',
            'time_format'       => 'Time Format',
            'temp_unit'         => 'Temperature',
            'quiettime'         => 'Quiet Time',
            'timelapse'         => 'Time Lapse',
            'tls_start'         => 'Timelapse Start Time',
            'tls_stop'          => 'Timelapse Stop Time',
            'tls_interval'      => 'Timelapse Interval',
            'wireless_mode'     => 'Wireless Mode',
            'wm_schedule'       => 'Schedule Interval',
            'wm_sclimit'        => 'Schedule File Limit',
            'hb_interval'       => 'Heartbeat Interval',
            'online_max_time'   => 'Max Online Time',
            'cellularpw'        => 'Cellular Password',
            'remotecontrol'     => 'Remote Control',
            'blockmode1'        => 'Block Mode 1',
            'blockmode2'        => 'Block Mode 2',
            'blockmode3'        => 'Block Mode 3',
            'blockmode4'        => 'Block Mode 4',
            'blockmode5'        => 'Block Mode 5',
            'blockmode7'        => 'Block Mode 7',
            'blockmode8'        => 'Block Mode 8',
            'blockmode9'        => 'Block Mode 9',
            'blockmode10'       => 'Block Mode 10',
            'blockmode11'       => 'Block Mode 11',
        );

        $handle = $this->CameraPanelBody($camera->id, $lists);
        return $handle;
    }

    public function OverviewEvent($camera) {
        $lists = array(
            'last_contact'   => 'Last Contact',
            'last_armed'   => 'Last Armed',
            'arm_photos'   => 'Photos since armed',
            'arm_points'   => 'Points since armed',
            'last_hb'   => 'Last Heartbeat',
            'last_photo'   => 'Last Photo',
            'last_schedule'   => 'Last Scheduled Upload',
            'last_settings'   => 'Last Settings',
            'expected_contact'   => 'Expected Contact',
        );

        $handle = $this->CameraPanelBody($camera->id, $lists);
        return $handle;
    }

    public function OverviewStatisics($camera) {
        // $lists = array(
        //     'description'   => 'Time Lapse Last Hour',
        //     'description'   => 'Quiet Time Override',
        //     'description'   => 'Motions Last 15 Mins',
        //     'description'   => 'Motions Last Hour',
        //     'description'   => 'Motions 5 Min Average',
        // );

        // $handle = $this->CameraPanelBody($camera->id, $lists);
        // return $handle;
        return '';
    }

    /*----------------------------------------------------------------------------------*/
    /* Gallery */
    public function Camera_Gallery_Select_Camera() {
        // $handle = '';
        // $handle .= '<li><a href="/cameras/getdetail/15">Camera #1</a></li>';
        // $handle .= '<li><a href="/cameras/getdetail/50">Camera #2</a></li>';
        // $handle .= '<li><a href="/cameras/getdetail/59">Camera #3</a></li>';
        // $handle .= '<li><a href="/cameras/getdetail/54">Camera #4</a></li>';

        $user = Auth::user();
        $user_id = $user->id;
        $cameras = DB::table('cameras')
                        ->select('id', 'description')
                        ->where('user_id', $user_id)
                        ->get();

        $style = 'padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;';
        $handle = '';
        foreach ($cameras as $camera) {
            $camera_id = $camera->id;
            $description = $camera->description;
            $handle .= '<li><a href="/cameras/getdetail/'.$camera_id.'">'.$description.'</a></li>';
        }
        return $handle;
    }

    /*----------------------------------------------------------------------------------*/
    /* Settings */
    /*
        <div class="form-group" id="field-wrapper-54-cameramode">
            <label class="col-md-4 control-label" for="inputSmall">Camera Mode</label>
            <div class="col-md-7">
                <select class="bs-select form-control input-sm" id="54_cameramode" name="54_cameramode">
                    <option value="p" selected="selected">Photo</option>
                    <option value="v">Video</option>
                </select>

                <span class="help-block"> .....</span>
            </div>
        </div>
    */

    /*
        <div class="form-group" id="field-wrapper-54-cellularpw">
            <label class="col-md-4 control-label" for="inputSmall">Cellular Password</label>
            <div class="col-md-7">
                <input type="text" class="form-control input-sm" id="54_cellularpw" name="54_cellularpw"
                    pattern="[0-9]{6}"
                    value="xxx" placeholder="Input Cellular Password">
                <span class="help-block"> .....</span>
            </div>
        </div>

            <input type="text" class="form-control input-sm" id="54_camera_desc" name="54_camera_desc"
                maxlength="30"
                value="Truphone #1" placeholder="Input Camera Description">
    */
    public function Camera_Settings_Body($id, $lists) {
        // $id = $camera->id;
        $camera = Camera::findOrFail($id);

        $handle = '';
        foreach ($lists as $key => $value) {
            $field_mame = $key;
            $field_value = $camera[$key];

            $title = $value['title'];
            $help = $value['help'];

            if (!empty($value['type'])) {
                $type = $value['type'];
            } else {
                $type = 'select';
            }

            if ($type == 'hhmm') {
                $field_value = substr($field_value, 0, 5); /* 23:59:00 */
                //$handle .= $field_value; /* debug */
            } else {
                $field_value = $camera[$key];
            }

            $zz = $id.'_'.$field_mame;

            /* Camera Mode:camera_mode=p */
            // $handle .= '<div>'.$title.':'.$field_mame.'='.$field_value.'</div>';

            $handle .=  '<div class="form-group" id="field-wrapper-'.$id.'-'.$field_mame.'">';
            $handle .=  '<label class="col-md-4 control-label" for="inputSmall">'.$title.'</label>';
            $handle .=  '<div class="col-md-7">';

            if ($type == 'input') {
                $format = $value['format'];
                $placeholder = $value['placeholder'];
                // if (!empty($value['pattern']) {
                //     $pattern = $value['pattern'];
                //     //<input type="text" class="form-control input-sm" id="54_cellularpw" name="54_cellularpw" pattern="[0-9]{6}" value="xxx" placeholder="xxx">
                //     $handle .= '<input type="text" class="form-control input-sm" id="'.$zz.'" name="'.$zz.'" pattern="'.$pattern.'" value="'.$field_value.'" placeholder="'.$placeholder.'">';

                // } else if (!empty($value['maxlength']) {
                    // $maxlength = $value['maxlength'];

                    //<input type="text" class="form-control input-sm" id="54_camera_desc" name="54_camera_desc" maxlength="30" value="xxx" placeholder="xxx">
                    $handle .= '<input type="text" class="form-control input-sm" id="'.$zz.'" name="'.$zz.'" '.$format.' value="'.$field_value.'" placeholder="'.$placeholder.'">';
                // }


            } else {
                $options = $value['options'];
                // $handle .=  '<select class="bs-select form-control input-sm" id="54_cameramode" name="54_cameramode">';
                $handle .=  '<select class="bs-select form-control input-sm" id="'.$zz.'" name="'.$zz.'">';
                foreach ($options as $option) {
                    // $option['name'] = Photo
                    // $option['value'] = p
                    // $handle .= '<div>'.$option['name'].'='.$option['value'].'</div>';
                    if ($option['value'] == $field_value) {
                        $handle .= '<option value="'.$option['value'].'" selected="selected">'.$option['name'].'</option>';
                    } else {
                        $handle .= '<option value="'.$option['value'].'">'.$option['name'].'</option>';
                    }
                }
                $handle .= '</select>';
            }

            if (!empty($help)) {
               // $handle .= '<span class="help-block">'.$help.'</span>';
            }
            $handle .= '</div>';
            $handle .= '</div>';
        }
        //$handle .= '<hr>';
        return $handle;
    }

    public function Camera_Settings_Camera_Identification($camera) {
        $lists = array(
            'description' => array(
                'title' => 'Camera Description',
                'type' => 'input',
                'format' => 'maxlength="30"',
                'placeholder' => 'Input Camera Description',
                'help' => ''
            ),

            'location' => array(
                'title' => 'Camera Location',
                'type' => 'input',
                'format' => 'maxlength="30"',
                'placeholder' => 'Input Camera Location',
                'help' => ''
            ),

        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Control_Settings($camera) {
        $lists = array(
            'camera_mode' => array(
                'title'   => 'Camera Mode',
                'options'   => array(
                    array('name' => 'Photo', 'value' => 'p'),
                    array('name' => 'Video', 'value' => 'v'),
                ),
                'help' => ''
            ),

            /* photo */
            'photo_resolution' => array(
                'title'   => 'Photo Resolution',
                'options'   => array(
                    array('name' => '4MP 16:9',     'value' => '4'),
                    array('name' => '6MP 16:9',     'value' => '6'),
                    array('name' => '8MP 16:9',     'value' => '8'),
                    array('name' => '12MP 16:9',    'value' => '12'),
                ),
                'help' => 'Use this setting to control the size of the Photo saved on the SD Card.'
            ),
            'photo_burst' => array(
                'title'   => 'Photo Burst',
                'options'   => array(
                    array('name' => '1', 'value' => '1'),
                    array('name' => '2', 'value' => '2'),
                    array('name' => '3', 'value' => '3'),
                ),
                'help' => 'Photo Burst is used to set the number of photos captured per event in Photo Mode. It is not used for Video mode. If Cellular mode is ON, then the camera will upload each photo of the burst to the portal.'
            ),
            'burst_delay' => array(
                'title'   => 'Burst Delay',
                'options'   => array(
                    array('name' => '250ms', 'value' => '250'),
                    array('name' => '500ms', 'value' => '500'),
                    array('name' => '1s',    'value' => '1000'),
                    array('name' => '3s',    'value' => '3000'),
                ),
                'help' => 'The Burst Delay is the elapsed time between each burst photo.'
            ),
            'upload_resolution' => array(
                'title'   => 'Upload Resolution',
                'options'   => array(
                    array('name' => 'Standard Low',     'value' => '1'),
                    array('name' => 'Standard Medium',  'value' => '2'),
                    array('name' => 'Standard High',    'value' => '3'),
                    array('name' => 'High Def',         'value' => '4'),
                ),
                'help' => 'Use this setting to control the size of the uploaded thumbnail.'
            ),
            'photo_quality' => array(
                'title'   => 'Upload Quality',
                'options'   => array(
                    array('name' => 'Standard', 'value' => '1'),
                    array('name' => 'Medium',   'value' => '2'),
                    array('name' => 'High',     'value' => '3'),
                ),
                'help' => 'Use this setting to control the image quality and size of the uploaded thumbnail. A higher quality means clearer images but larger file sizes when uploaded to the portal. Use a Photo quality that best meets your application and budget. [Standard] quality will reduce the size and cost to upload each photo to the portal and is generally good enough for most applications. Keep in mind that you can request a High-res Max or the Original file from the SD card when/if you need it for more detail on this particular photo event.'
            ),

            /* video */
            'video_resolution' => array(
                'title'   => 'Video Resolution',
                'options'   => array(
                    array('name' => 'Standard Low',     'value' => '8'),
                    array('name' => 'Standard Medium',  'value' => '9'),
                    array('name' => 'Standard High',    'value' => '10'),
                    array('name' => 'High Def',         'value' => '11'),
                ),
                'help' => 'This determines the frame size of the video in pixels, or how wide it is when viewed on your computer monitor. A higher resolution means the video file saved to the SD card is larger and when uploaded uses more battery and costs more image points from your data plan, but it will have more detail on the other hand.'
            ),
            'video_fps' => array(
                'title'   => 'Capture Rate',
                'options'   => array(
                    array('name' => '4fps',     'value' => '4'),
                    array('name' => '6fps',     'value' => '6'),
                    array('name' => '8fps',     'value' => '8'),
                    array('name' => '10fps',    'value' => '10'),
                    array('name' => '12fps',    'value' => '12'),
                    array('name' => '15fps',    'value' => '15'),
                    array('name' => '30fps',    'value' => '30'),
                ),
                'help' => 'Capture rate does not affect the size of the video file captured or reduce the points used to upload to the portal. A lower frame rate in low motion will improve the quality of each frame while motion blur may increase. A faster frame rate may reduce motion blur when there is higher motion and may reduce the image quality of each frame. Every environment is different. Please experiment to find the right value for your environment and needs.'
            ),
            'video_bitrate' => array(
                'title'   => 'Quality Level',
                'options'   => array(
                    array('name' => '1 (default/smallest)', 'value' => '300'),
                    array('name' => '2',                    'value' => '400'),
                    array('name' => '3',                    'value' => '500'),
                    array('name' => '4',                    'value' => '600'),
                    array('name' => '5',                    'value' => '700'),
                    array('name' => '6',                    'value' => '800'),
                    array('name' => '7',                    'value' => '900'),
                    array('name' => '8 (balanced)',         'value' => '1000'),
                    array('name' => '9',                    'value' => '1200'),
                    array('name' => '10',                   'value' => '1400'),
                    array('name' => '11',                   'value' => '1800'),
                    array('name' => '12 (High)',            'value' => '2500'),
                    array('name' => '13 (Maximum/LARGE!)',  'value' => '5000'),
                ),
                'help' => 'Use quality level to control the image quality for each frame in the video. A higher value will increase quality while also increasing the size of the file captured. If you frequently make video upload requests you may want a lower quality in order to minimize image points used in your data plan. There is no set quality level for a particular application. Please experiment with video quality to achieve an acceptable balance for your environment and budget.'
            ),
            'video_length' => array(
                'title'   => 'Video Duration',
                'options'   => array(
                    array('name' => '2s', 'value' => '2s'),
                    array('name' => '3s', 'value' => '3s'),
                    array('name' => '4s', 'value' => '4s'),
                    array('name' => '5s', 'value' => '5s'),
                    array('name' => '6s', 'value' => '6s'),
                    array('name' => '7s', 'value' => '7s'),
                    array('name' => '8s', 'value' => '8s'),
                    array('name' => '9s', 'value' => '9s'),
                    array('name' => '10s', 'value' => '10s'),
                ),
                'help' => 'Note: The longer the duration, the larger the video file will be if uploaded to the portal.'
            ),
            'video_sound' => array(
                'title'   => 'Video Sound',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),

            /* other */
            'timestamp' => array(
                'title'   => 'Time Stamp',
                'options'   => array(
                    array('name' => 'On',   'value' => 'on'),
                    array('name' => 'Off',  'value' => 'off'),
                ),
                'help' => ''
            ),
            'date_format' => array(
                'title'   => 'Date Format',
                'options'   => array(
                    array('name' => 'mdY', 'value' => 'mdY'),
                    array('name' => 'Ymd', 'value' => 'Ymd'),
                    array('name' => 'dmY', 'value' => 'dmY'),
                ),
                'help' => ''
            ),
            'time_format' => array(
                'title'   => 'Time Format',
                'options'   => array(
                    array('name' => '12 Hour', 'value' => '12'),
                    array('name' => '24 Hour', 'value' => '24'),
                ),
                'help' => ''
            ),
            'temp_unit' => array(
                'title'   => 'Temperature',
                'options'   => array(
                    array('name' => 'Fahrenheit', 'value' => 'f'),
                    array('name' => 'Celsius', 'value' => 'c'),
                ),
                'help' => ''
            ),
        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Trigger_Settings($camera) {
        $lists = array(
            'quiettime' => array(
                'title'   => 'Quiet Time',
                'options'   => array(
                    array('name' => '0s', 'value' => '0s'),
                    array('name' => '5s', 'value' => '5s'),
                    array('name' => '10s', 'value' => '10s'),
                    array('name' => '15s', 'value' => '15s'),
                    array('name' => '20s', 'value' => '20s'),
                    array('name' => '25s', 'value' => '25s'),
                    array('name' => '30s', 'value' => '30s'),
                    array('name' => '35s', 'value' => '35s'),
                    array('name' => '40s', 'value' => '40s'),
                    array('name' => '45s', 'value' => '45s'),
                    array('name' => '50s', 'value' => '50s'),
                    array('name' => '55s', 'value' => '55s'),
                    array('name' => '1m', 'value' => '1m'),
                    array('name' => '2m', 'value' => '2m'),
                    array('name' => '3m', 'value' => '3m'),
                    array('name' => '4m', 'value' => '4m'),
                    array('name' => '5m', 'value' => '5m'),
                    array('name' => '10m', 'value' => '10m'),
                    array('name' => '15m', 'value' => '15m'),
                    array('name' => '20m', 'value' => '20m'),
                    array('name' => '25m', 'value' => '25m'),
                    array('name' => '30m', 'value' => '30m'),
                    array('name' => '35m', 'value' => '35m'),
                    array('name' => '40m', 'value' => '40m'),
                    array('name' => '45m', 'value' => '45m'),
                    array('name' => '50m', 'value' => '50m'),
                    array('name' => '55m', 'value' => '55m'),
                    array('name' => '60m', 'value' => '60m'),
                ),
                'help' => 'Quiet Time is a delay after the current event is complete (photo or video). It can be used to reduce the number of PIR events in a given time. If your camera is taking too many photos or videos, then increase the quiet time to reduce the frequency of PIR (motion) activations. PIR or motion capture, as well as Time Lapse capture is disabled while sleeping in the quiet time period.'
            ),

        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Time_Lapse($camera) {
        $lists = array(
            'tls_start'     => array(
                'title'     => 'Timelapse Start Time',
                'type'      => 'hhmm',
                'options'   => array(
                    array('name' => '00:00', 'value' => '00:00'),
                    array('name' => '00:15', 'value' => '00:15'),
                    array('name' => '00:30', 'value' => '00:30'),
                    array('name' => '00:45', 'value' => '00:45'),
                    array('name' => '01:00', 'value' => '01:00'),
                    array('name' => '01:15', 'value' => '01:15'),
                    array('name' => '01:30', 'value' => '01:30'),
                    array('name' => '01:45', 'value' => '01:45'),
                    array('name' => '02:00', 'value' => '02:00'),
                    array('name' => '02:15', 'value' => '02:15'),
                    array('name' => '02:30', 'value' => '02:30'),
                    array('name' => '02:45', 'value' => '02:45'),
                    array('name' => '03:00', 'value' => '03:00'),
                    array('name' => '03:15', 'value' => '03:15'),
                    array('name' => '03:30', 'value' => '03:30'),
                    array('name' => '03:45', 'value' => '03:45'),
                    array('name' => '04:00', 'value' => '04:00'),
                    array('name' => '04:15', 'value' => '04:15'),
                    array('name' => '04:30', 'value' => '04:30'),
                    array('name' => '04:45', 'value' => '04:45'),
                    array('name' => '05:00', 'value' => '05:00'),
                    array('name' => '05:15', 'value' => '05:15'),
                    array('name' => '05:30', 'value' => '05:30'),
                    array('name' => '05:45', 'value' => '05:45'),
                    array('name' => '06:00', 'value' => '06:00'),
                    array('name' => '06:15', 'value' => '06:15'),
                    array('name' => '06:30', 'value' => '06:30'),
                    array('name' => '06:45', 'value' => '06:45'),
                    array('name' => '07:00', 'value' => '07:00'),
                    array('name' => '07:15', 'value' => '07:15'),
                    array('name' => '07:30', 'value' => '07:30'),
                    array('name' => '07:45', 'value' => '07:45'),
                    array('name' => '08:00', 'value' => '08:00'),
                    array('name' => '08:15', 'value' => '08:15'),
                    array('name' => '08:30', 'value' => '08:30'),
                    array('name' => '08:45', 'value' => '08:45'),
                    array('name' => '09:00', 'value' => '09:00'),
                    array('name' => '09:15', 'value' => '09:15'),
                    array('name' => '09:30', 'value' => '09:30'),
                    array('name' => '09:45', 'value' => '09:45'),
                    array('name' => '10:00', 'value' => '10:00'),
                    array('name' => '10:15', 'value' => '10:15'),
                    array('name' => '10:30', 'value' => '10:30'),
                    array('name' => '10:45', 'value' => '10:45'),
                    array('name' => '11:00', 'value' => '11:00'),
                    array('name' => '11:15', 'value' => '11:15'),
                    array('name' => '11:30', 'value' => '11:30'),
                    array('name' => '11:45', 'value' => '11:45'),
                    array('name' => '12:00', 'value' => '12:00'),
                    array('name' => '12:15', 'value' => '12:15'),
                    array('name' => '12:30', 'value' => '12:30'),
                    array('name' => '12:45', 'value' => '12:45'),
                    array('name' => '13:00', 'value' => '13:00'),
                    array('name' => '13:15', 'value' => '13:15'),
                    array('name' => '13:30', 'value' => '13:30'),
                    array('name' => '13:45', 'value' => '13:45'),
                    array('name' => '14:00', 'value' => '14:00'),
                    array('name' => '14:15', 'value' => '14:15'),
                    array('name' => '14:30', 'value' => '14:30'),
                    array('name' => '14:45', 'value' => '14:45'),
                    array('name' => '15:00', 'value' => '15:00'),
                    array('name' => '15:15', 'value' => '15:15'),
                    array('name' => '15:30', 'value' => '15:30'),
                    array('name' => '15:45', 'value' => '15:45'),
                    array('name' => '16:00', 'value' => '16:00'),
                    array('name' => '16:15', 'value' => '16:15'),
                    array('name' => '16:30', 'value' => '16:30'),
                    array('name' => '16:45', 'value' => '16:45'),
                    array('name' => '17:00', 'value' => '17:00'),
                    array('name' => '17:15', 'value' => '17:15'),
                    array('name' => '17:30', 'value' => '17:30'),
                    array('name' => '17:45', 'value' => '17:45'),
                    array('name' => '18:00', 'value' => '18:00'),
                    array('name' => '18:15', 'value' => '18:15'),
                    array('name' => '18:30', 'value' => '18:30'),
                    array('name' => '18:45', 'value' => '18:45'),
                    array('name' => '19:00', 'value' => '19:00'),
                    array('name' => '19:15', 'value' => '19:15'),
                    array('name' => '19:30', 'value' => '19:30'),
                    array('name' => '19:45', 'value' => '19:45'),
                    array('name' => '20:00', 'value' => '20:00'),
                    array('name' => '20:15', 'value' => '20:15'),
                    array('name' => '20:30', 'value' => '20:30'),
                    array('name' => '20:45', 'value' => '20:45'),
                    array('name' => '21:00', 'value' => '21:00'),
                    array('name' => '21:15', 'value' => '21:15'),
                    array('name' => '21:30', 'value' => '21:30'),
                    array('name' => '21:45', 'value' => '21:45'),
                    array('name' => '22:00', 'value' => '22:00'),
                    array('name' => '22:15', 'value' => '22:15'),
                    array('name' => '22:30', 'value' => '22:30'),
                    array('name' => '22:45', 'value' => '22:45'),
                    array('name' => '23:00', 'value' => '23:00'),
                    array('name' => '23:15', 'value' => '23:15'),
                    array('name' => '23:30', 'value' => '23:30'),
                    array('name' => '23:45', 'value' => '23:45'),
                    // array('name' => '23:59', 'value' => '23:59'),
                ),
                'help' => '',
            ),

            'tls_stop'     => array(
                'title'     => 'Timelapse Stop Time',
                'type'      => 'hhmm',
                'options'   => array(
                    array('name' => '00:00', 'value' => '00:00'),
                    array('name' => '00:15', 'value' => '00:15'),
                    array('name' => '00:30', 'value' => '00:30'),
                    array('name' => '00:45', 'value' => '00:45'),
                    array('name' => '01:00', 'value' => '01:00'),
                    array('name' => '01:15', 'value' => '01:15'),
                    array('name' => '01:30', 'value' => '01:30'),
                    array('name' => '01:45', 'value' => '01:45'),
                    array('name' => '02:00', 'value' => '02:00'),
                    array('name' => '02:15', 'value' => '02:15'),
                    array('name' => '02:30', 'value' => '02:30'),
                    array('name' => '02:45', 'value' => '02:45'),
                    array('name' => '03:00', 'value' => '03:00'),
                    array('name' => '03:15', 'value' => '03:15'),
                    array('name' => '03:30', 'value' => '03:30'),
                    array('name' => '03:45', 'value' => '03:45'),
                    array('name' => '04:00', 'value' => '04:00'),
                    array('name' => '04:15', 'value' => '04:15'),
                    array('name' => '04:30', 'value' => '04:30'),
                    array('name' => '04:45', 'value' => '04:45'),
                    array('name' => '05:00', 'value' => '05:00'),
                    array('name' => '05:15', 'value' => '05:15'),
                    array('name' => '05:30', 'value' => '05:30'),
                    array('name' => '05:45', 'value' => '05:45'),
                    array('name' => '06:00', 'value' => '06:00'),
                    array('name' => '06:15', 'value' => '06:15'),
                    array('name' => '06:30', 'value' => '06:30'),
                    array('name' => '06:45', 'value' => '06:45'),
                    array('name' => '07:00', 'value' => '07:00'),
                    array('name' => '07:15', 'value' => '07:15'),
                    array('name' => '07:30', 'value' => '07:30'),
                    array('name' => '07:45', 'value' => '07:45'),
                    array('name' => '08:00', 'value' => '08:00'),
                    array('name' => '08:15', 'value' => '08:15'),
                    array('name' => '08:30', 'value' => '08:30'),
                    array('name' => '08:45', 'value' => '08:45'),
                    array('name' => '09:00', 'value' => '09:00'),
                    array('name' => '09:15', 'value' => '09:15'),
                    array('name' => '09:30', 'value' => '09:30'),
                    array('name' => '09:45', 'value' => '09:45'),
                    array('name' => '10:00', 'value' => '10:00'),
                    array('name' => '10:15', 'value' => '10:15'),
                    array('name' => '10:30', 'value' => '10:30'),
                    array('name' => '10:45', 'value' => '10:45'),
                    array('name' => '11:00', 'value' => '11:00'),
                    array('name' => '11:15', 'value' => '11:15'),
                    array('name' => '11:30', 'value' => '11:30'),
                    array('name' => '11:45', 'value' => '11:45'),
                    array('name' => '12:00', 'value' => '12:00'),
                    array('name' => '12:15', 'value' => '12:15'),
                    array('name' => '12:30', 'value' => '12:30'),
                    array('name' => '12:45', 'value' => '12:45'),
                    array('name' => '13:00', 'value' => '13:00'),
                    array('name' => '13:15', 'value' => '13:15'),
                    array('name' => '13:30', 'value' => '13:30'),
                    array('name' => '13:45', 'value' => '13:45'),
                    array('name' => '14:00', 'value' => '14:00'),
                    array('name' => '14:15', 'value' => '14:15'),
                    array('name' => '14:30', 'value' => '14:30'),
                    array('name' => '14:45', 'value' => '14:45'),
                    array('name' => '15:00', 'value' => '15:00'),
                    array('name' => '15:15', 'value' => '15:15'),
                    array('name' => '15:30', 'value' => '15:30'),
                    array('name' => '15:45', 'value' => '15:45'),
                    array('name' => '16:00', 'value' => '16:00'),
                    array('name' => '16:15', 'value' => '16:15'),
                    array('name' => '16:30', 'value' => '16:30'),
                    array('name' => '16:45', 'value' => '16:45'),
                    array('name' => '17:00', 'value' => '17:00'),
                    array('name' => '17:15', 'value' => '17:15'),
                    array('name' => '17:30', 'value' => '17:30'),
                    array('name' => '17:45', 'value' => '17:45'),
                    array('name' => '18:00', 'value' => '18:00'),
                    array('name' => '18:15', 'value' => '18:15'),
                    array('name' => '18:30', 'value' => '18:30'),
                    array('name' => '18:45', 'value' => '18:45'),
                    array('name' => '19:00', 'value' => '19:00'),
                    array('name' => '19:15', 'value' => '19:15'),
                    array('name' => '19:30', 'value' => '19:30'),
                    array('name' => '19:45', 'value' => '19:45'),
                    array('name' => '20:00', 'value' => '20:00'),
                    array('name' => '20:15', 'value' => '20:15'),
                    array('name' => '20:30', 'value' => '20:30'),
                    array('name' => '20:45', 'value' => '20:45'),
                    array('name' => '21:00', 'value' => '21:00'),
                    array('name' => '21:15', 'value' => '21:15'),
                    array('name' => '21:30', 'value' => '21:30'),
                    array('name' => '21:45', 'value' => '21:45'),
                    array('name' => '22:00', 'value' => '22:00'),
                    array('name' => '22:15', 'value' => '22:15'),
                    array('name' => '22:30', 'value' => '22:30'),
                    array('name' => '22:45', 'value' => '22:45'),
                    array('name' => '23:00', 'value' => '23:00'),
                    array('name' => '23:15', 'value' => '23:15'),
                    array('name' => '23:30', 'value' => '23:30'),
                    array('name' => '23:45', 'value' => '23:45'),
                    array('name' => '23:59', 'value' => '23:59'),
                ),
                'help' => '',
            ),
            'tls_interval' => array(
                'title'   => 'Timelapse Interval',
                'options'   => array(
                    array('name' => '5m', 'value' => '5m'),
                    array('name' => '10m', 'value' => '10m'),
                    array('name' => '15m', 'value' => '15m'),
                    array('name' => '20m', 'value' => '20m'),
                    array('name' => '25m', 'value' => '25m'),
                    array('name' => '30m', 'value' => '30m'),
                    array('name' => '35m', 'value' => '35m'),
                    array('name' => '40m', 'value' => '40m'),
                    array('name' => '45m', 'value' => '45m'),
                    array('name' => '50m', 'value' => '50m'),
                    array('name' => '55m', 'value' => '55m'),
                    array('name' => '1h', 'value' => '1h'),
                    array('name' => '2h', 'value' => '2h'),
                    array('name' => '4h', 'value' => '4h'),
                    array('name' => '6h', 'value' => '6h'),
                    array('name' => '8h', 'value' => '8h'),
                    array('name' => '10h', 'value' => '10h'),
                    array('name' => '12h', 'value' => '12h'),
                ),
                'help' => ''
            ),
        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Wireless_Settings($camera) {
        $lists = array(
            'wireless_mode' => array(
                'title'   => 'Wireless Mode',
                'options'   => array(
                    array('name' => 'Instant', 'value' => 'instant'),
                    array('name' => 'Schedule', 'value' => 'schedule'),
                ),
                'help' => 'In [Instant] the camera will capture a photo or video then attach to the network and upload the file. In [Schedule] it will wake up either when the timer is up (Schedule Interval) or when the file limit is reached (File Limit)  and upload the pending files to the server.  Using [Schedule] will save battery because it reduces the handshaking that occurs each time the camera has to connect to the network (5 to 10 seconds per photo in Instant mode).  The mobile app will recieve a notification as each scheduled upload starts and completes.  The Action tab will show the scheduled event and the number of photos uploaded.'
            ),

            /* schedule */
            'wm_schedule' => array(
                'title'   => 'Schedule Interval',
                'options'   => array(
                    array('name' => 'Every Hour',       'value' => '1h'),
                    array('name' => 'Every 2 Hours',    'value' => '2h'),
                    array('name' => 'Every 4 Hours',    'value' => '4h'),
                ),
                'help' => 'The camera will use a timer to wake up and determine if there are files to upload based on the interval you select. If there are pending files, they will be uploaded to the server at that time.'
            ),
            'wm_sclimit' => array(
                'title'   => 'Schedule File Limit',
                'options'   => array(
                    array('name' => '20 Files', 'value' => '20'),
                    array('name' => '30 Files', 'value' => '30'),
                    array('name' => '40 Files', 'value' => '40'),
                    array('name' => '50 Files', 'value' => '50'),
                ),
                'help' => 'As the camera captures photos or videos, it will maintain a file count. If the file count reaches your selected File Limit, then the camera will attach to the network at that time (not the Scheduled Interval) and upload all pending files. A lower limit may increase network connections and use more battery, while a higher value may reduce network connections and battery usage. File Limit will be more important during periods of high activity. If the File Limit is not reached in a schedule interval period then it has no effect. File Limit is the only way to ensure that all media files captured will get uploaded to the pportal.'
            ),

            /* other */
            'hb_interval' => array(
                'title'   => 'Heartbeat Interval',
                'options'   => array(
                    array('name' => 'Every Hour',       'value' => '1h'),
                    array('name' => 'Every 2 Hours',    'value' => '2h'),
                    array('name' => 'Every 4 Hours',    'value' => '4h'),
                    array('name' => 'Every 8 Hours',    'value' => '8h'),
                    array('name' => 'Every 12 Hours',   'value' => '12h'),
                ),
                'help' => 'This timer will fire on the whole hour and will send a status to the server. The mobile app will recieve a notification when this occurs. This lets you know your camera is still functioning and its curent status. It will also process any pending Action items you have queued like High-Res Max, Video, Original, Settings.'
            ),
            'online_max_time' => array(
                'title'   => 'Max Online Time',
                'options'   => array(
                    array('name' => '2m', 'value' => '2'),
                    array('name' => '3m', 'value' => '3'),
                    array('name' => '4m', 'value' => '4'),
                    array('name' => '5m', 'value' => '5'),
                    array('name' => '6m', 'value' => '6'),
                    array('name' => '7m', 'value' => '7'),
                    array('name' => '8m', 'value' => '8'),
                    array('name' => '9m', 'value' => '9'),
                    array('name' => '10m', 'value' => '10'),
                ),
                'help' => 'Use this setting to control the amount of time the camera will remain online, per event, processing queued action requests. A shorter time means the camera can return to PIR mode more quickly and continue capturing Photo and Video, otherwise the camera is busy and may miss PIR events due to queue processing. A longer time means your queued Action items should get completed sooner if the queue is large.'
            ),
            'cellularpw' => array(
                'title' => 'Cellular Password',
                'type' => 'input',
                //'pattern' => '[0-9]{6}',
                'format' => 'pattern="[0-9]{6}"',
                'placeholder' => 'Input Cellular Password',
                'help' => 'Input 6 digits. Blank for no password. If you input a password, it is required when you power the camera into Setup mode. This means if your camera is stolen, the thief is not able to set cellular mode to OFF, which means he can only use the camera in cellular mode.'
            ),
            'remotecontrol' => array(
                'title'   => 'Remote Control',
                'options'   => array(
                    array('name' => 'Disabled', 'value' => 'off'),
                    array('name' => '24 Hour', 'value' => '24h'),
                ),
                'help' => 'This option will cause the camera to sleep in a high power state waiting on SMS commands from the network. It will use more battery power at rest in this mode. You will see additional buttons on the Actions tab, used to wake your camera up immediately. When clicked, those buttons [SNAP] and [WAKE] will send an SMS message to wake the camera up. [SNAP] will cause the camera to capture a photo or video and upload it to the portal. The camera will then process any Action items you have queued up.'
            ),

        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Block_Mode_Settings($camera) {
        $lists = array(
            'blockmode1'    => array(
                'title'     => 'Block Mode 1',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode2'    => array(
                'title'     => 'Block Mode 2',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode3'    => array(
                'title'     => 'Block Mode 3',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode4'    => array(
                'title'     => 'Block Mode 4',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode5' => array(
                'title'   => 'Block Mode 5',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),

            'blockmode7'    => array(
                'title'     => 'Block Mode 7',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode8'    => array(
                'title'     => 'Block Mode 8',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode9'    => array(
                'title'     => 'Block Mode 9',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode10'   => array(
                'title'     => 'Block Mode 10',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
            'blockmode11'   => array(
                'title'     => 'Block Mode 11',
                'options'   => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => ''
            ),
        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    /*
            'xxxx' => array(
                'title'   => 'xxxx',
                'options'   => array(
                    array('name' => '', 'value' => ''),
                    array('name' => '', 'value' => ''),
                    array('name' => '', 'value' => ''),
                    array('name' => '', 'value' => ''),
                ),
                'help' => ''
            ),
    */

    /*----------------------------------------------------------------------------------*/
    /* Actions */


    /*----------------------------------------------------------------------------------*/
    /* Options */


    /*----------------------------------------------------------------------------------*/
    public function account_profile() {
        if (Auth::check()) {
            $user = Auth::user();
            return view('account.profile', compact('user'));
        } else {
            return view('account.profile');
        }
        // return view('help.plans');
    }

    public function plans_addplan_create() {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     return view('account.profile', compact('user'));
        // } else {
        //     return view('account.profile');
        // }
        return view('plans.add-plan');
    }

    public function plans_addplan_store() {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     return view('account.profile', compact('user'));
        // } else {
        //     return view('account.profile');
        // }
        // return view('plans.add-plan');

        session()->flash('danger', 'Error: Please input an ICCID.');
        return redirect()->back();
    }
    public function help_plans() {
        if (Auth::check()) {
            $user = Auth::user();
            return view('help.plans', compact('user'));
        } else {
            return view('help.plans');
        }
        // return view('help.plans');
    }

    /*----------------------------------------------------------------------------------*/
    public function test() {
        $id = 1;
        $camera = Camera::findOrFail($id);
        //dd($camera);
        return $camera;

        //return $camera->module_id;
        //return $camera['module_id'];
        $field = 'module_id';
        return $camera[$field];

        $columns = Schema::getColumnListing('cameras');
        print_r($columns);
        return $columns;

        $tables = DB::select('show tables');
        //print_r($tables);
        //return $tables;

        $tables = array_column($tables, 'Tables_in_htc');
        $columns = ['email', 'user_name', 'nick_name', 'first_name', 'last_name'];
        foreach ($tables as $key => $value) {
            // foreach ($columns as $k => $v) {
            //     if (Schema::hasColumn($value, $v)) {
            //         $table[] = $value;
            //     };
            // }
            // $columns[] = Schema::getColumnListing('users');
            //print_r($key);
            print_r($value);
        }
        print_r($tables);
        return $tables;
    }

/*
    // https://laravelacademy.org/post/6140.html
    $users = DB::table('users')->select('name', 'email as user_email')->get();

    // 强制查询返回不重复的结果集
    $users = DB::table('users')->distinct()->get();

    $query = DB::table('users')->select('name');
    $users = $query->addSelect('age')->get();

    $users = DB::table('users')->where('votes', '=', 100)->get();
    $users = DB::table('users')->where('votes', 100)->get();

    $users = DB::table('users')->where([
        ['status', '=', '1'],
        ['subscribed', '<>', '1'],
    ])->get();

    $users = DB::table('users')
                    ->orderBy('name', 'desc')
                    ->get();

    // whereDate / whereMonth / whereDay / whereYear
    $users = DB::table('users')
                ->whereDate('created_at', '2016-10-10')
                ->get();

    // 原生表达式
    $users = DB::table('users')
                         ->select(DB::raw('count(*) as user_count, status'))
                         ->where('status', '<>', 1)
                         ->groupBy('status')
                         ->get();

    // 10.3
    $statuses = $user->statuses()
                     ->orderBy('created_at', 'desc')
                     ->paginate(30);

    $topics = $topic->withOrder($request->order)
                    ->where('category_id', $category->id)
                    ->paginate(20);
*/
}
