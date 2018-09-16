<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Schema;

use App\Models\Camera;
use App\Models\Photo;
use App\Handlers\ImageUploadHandler;

class CamerasController extends Controller
{
    public function getErrorMessage($result_code) {
    //public function ErrorMessageGet($result_code) {
        $error_msg = array(
            900 =>'Invalid or Missing camera Module',
            901 =>'Invalid or Missing camera Model',
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
    public function ControlSettings() {
        // $menus = array(
        //     0 => array( 'name' => 'camera_mode',
        //                 'type' => 'select',
        //                 'option' => array (
        //                         0 => array ('name' => 'Photo', 'value' => 'p'),
        //                         1 => array ('name' => 'Video', 'value' => 'v'),
        //                 ),
        //                 'help'  => ''
        //     ),
        //     1 => array( 'name' => 'photo_resolution',
        //                 'type' => 'select',
        //                 'option' => array (
        //                     0 => array ('name' => '4MP 16:9', 'value' => '4'),
        //                     1 => array ('name' => '6MP 16:9', 'value' => '6'),
        //                     2 => array ('name' => '8MP 16:9', 'value' => '8'),
        //                     3 => array ('name' => '12MP 16:9', 'value' => '12'),
        //                 ),
        //                 'help'  => ''
        //     ),
        // );

        // $menus = array('aaa', 'bbb');

        // $menus = array(
        //     '0' => array('id' => 1, 'name' => 'name1'),
        //     '1' => array('id' => 2, 'name' => 'name2'),
        //     '2' => array('id' => 3, 'name' => 'name3'),
        //     '3' => array('id' => 4, 'name' => 'name4'),
        //     '4' => array('id' => 5, 'name' => 'name5'),
        // );

        $menus = array(
            array(
                'name'      => 'camera_mode',
                'heading'   => 'Camera Mode',
                'options'   => array (
                    array ('name' => 'Photo', 'value' => 'p'),
                    array ('name' => 'Video', 'value' => 'v'),
                ),
            ),
            array(
                'name'      => 'photo_resolution',
                'heading'   => 'Photo Resolution',
                'options'   => array (
                    array ('name' => '4MP 16:9', 'value' => '4'),
                    array ('name' => '6MP 16:9', 'value' => '6'),
                    array ('name' => '8MP 16:9', 'value' => '8'),
                    array ('name' => '12MP 16:9', 'value' => '12'),
                ),
            ),

        );
        return $menus;
    }

    public function show() {
        //return 'Hello';


        $menus = $this->ControlSettings();
        // return $menus;

        // //$camera = DB::table('cameras')->first();
        // $camera = DB::table('cameras')->find(1);
        // //return $camera; // NG
        // return compact('camera'); //OK


        // (2)
        $id = 1;
        $camera = Camera::findOrFail($id);
//return compact('camera');
//return $camera->module_id;

        $photos = $camera->photos()
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        //return $camera; // OK
        //return compact('photos'); // OK
        //return view('camera.show5', compact('camera', 'photos')); // OK
        return view('camera.show5', compact('camera', 'photos', 'menus')); // OK

        // $camera = DB::table('cameras')
        //                 ->where('module_id', $request->module_id)
        //                 ->first();
        // return $camera;

           // $camera = DB::table('cameras')
           //                 ->first();
         // return $camera->id;

//$photos = $camera->photos();

//$photos = $camera->photos()->first();
        // $photos = $camera->photos()
        //                  ->orderBy('created_at', 'desc')
        //                  ->paginate(30);
        //return $photos->filename;
  //      return view('camera.show', compact('camera', 'photos'));
        //return view('camera.show', compact('photos'));
        //return view('camera.show', compact('camera'));
    }

    public function show2(Camera $camera) {
        return $camera; // OK
        //return $camera->id; // OK
        //return $camera->first()->id; // OK
    }

/*
<div class="form-group " id="field-wrapper-54-cameramode">
    <label class="col-md-4 control-label" for="inputSmall">{{$menu['heading']}}</label>
    <div class="col-md-7">
        <select id="54_cameramode" class="bs-select form-control input-sm" name="54_cameramode">
            @foreach ($menu['options'] as $option)
                @if ($camera->camera_mode == 'p')
                    <option value={{$option['value']}} selected="selected">{{$option['name']}}</option>
                @else
                    <option value={{$option['value']}}>{{$option['name']}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
*/

    /*----------------------------------------------------------------------------------*/
    public function test() {

        // $menus = $this->ControlSettings();
        // return $menus;

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

        /*
        [
            {"Tables_in_htc":"cameras"},
            {"Tables_in_htc":"photos"},
            .....
            {"Tables_in_htc":"users"}
        ]
        */
        $tables = DB::select('show tables');
        //print_r($tables);
        //return $tables;

        /*
        [
            "cameras",
            "photos",
            ...
            "users"
        ]
        */
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

    /*----------------------------------------------------------------------------------*/
    // public function Menu($camera) {
    //     //return $camera->camera_mode;
    //     return $camera->module_id;

    //     $id = $camera->id;

    //     $handle = '<div class="form-group" id="field-wrapper-'.$id.'-cameramode">';

    //     $handle .= '</div>';

    //     return $handle;
    // }


    /*----------------------------------------------------------------------------------*/
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
}
