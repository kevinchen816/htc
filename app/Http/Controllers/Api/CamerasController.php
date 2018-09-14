<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Camera;
use App\Models\Photo;
use App\Handlers\ImageUploadHandler;

class CamerasController extends Controller
{
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
    public function report(Request $request, Camera $new_camera) {
    //public function report(Request $request) {
        //return $request;

        $error_msg = array (
            '900' =>'Invalid or Missing camera Module',
            '901' =>'Invalid or Missing camera Model',
            '902' =>'test or Missing camera Model',
        );

        // $camera->module_id = $request->module_id;
        // $camera->iccid = $request->iccid;
        // $camera->model_id = $request->model_id;
        // $camera->save();
        // date_default_timezone_set("Asia/Shanghai");
        // $result['ResultCode'] = 0;
        // $result['DateTimeStamp'] = date('Y-m-d H:i:s');
        // return $result;

        $cameras = DB::table('cameras')->where('module_id', $request->module_id);
        $camera = $cameras->first();
        //return $camera->module_id;

        $datetime = date('Y-m-d H:i:s');
        if ($camera) {
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

            $result_code = 0;

        } else {
            //return $request->module_id;
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

            $result_code = 0;
        }

        $result['ResultCode'] = $result_code;
        if ($result_code == 0) {

        } else {
            $result['ErrorMsg'] = $error_msg[$result_code];
        }
        $result['DateTimeStamp'] = $datetime;
        return $result;
    }

    /*----------------------------------------------------------------------------------*/
    public function status(Request $request, Camera $new_camera) {
    //public function report(Request $request) {
        //return $request;

        $error_msg = array (
            '900' =>'Invalid or Missing camera Module',
            '901' =>'Invalid or Missing camera Model',
            '902' =>'test or Missing camera Model',
        );

        $cameras = DB::table('cameras')->where('module_id', $request->module_id);
        $camera = $cameras->first();
        //return $camera->module_id;

        $datetime = date('Y-m-d H:i:s');
        if ($camera) {
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

            $result_code = 0;

        } else {
            //return $request->module_id;
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

            $result_code = 0;
        }

        $result['ResultCode'] = $result_code;
        if ($result_code == 0) {

        } else {
            $result['ErrorMsg'] = $error_msg[$result_code];
        }
        $result['DateTimeStamp'] = $datetime;
        return $result;
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

            $result_code = 0;

        } else {
            $result_code = 900;
            //$result_code = 901;
        }

        $datetime = date('Y-m-d H:i:s');

        $result['ResultCode'] = $result_code;
        if ($result_code == 0) {
            $result['DataList'] = $datalist;
            if (0) {
                //"ActionCode":"PS","ParameterList":{"REQUESTID":"5941"}
                $action_code = 'PS';
                $parameter_list['REQUESTID'] = '5941';
                $result['ActionCode'] = $action_code;
                $result['ParameterList'] = $parameter_list;
            }

            $data['last_contact'] = $datetime;
            $data['last_settings'] = $datetime;
            $cameras->update($data);

        } else {
            $result['ErrorMsg'] = $error_msg[$result_code];
        }

        //$result['DateTimeStamp'] = date('Y-m-d H:i:s');
        $result['DateTimeStamp'] = $datetime;
        return $result;
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
    public function uploadthumb(Request $request, Photo $photo, ImageUploadHandler $uploader) {
    //public function uploadthumb(Request $request, Camera $camera, Photo $photo, ImageUploadHandler $uploader) {

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
                $result_code = $ret['result'];
                if ($result_code == 0) {
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
                $result_code = 901;
            }

        } else {
            $result_code = 900;
        }
        date_default_timezone_set("Asia/Shanghai");
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $result;
    }

    public function uploadoriginal(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'uploadoriginal';
        return $result;
    }

    public function uploadvideothumb(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'uploadvideothumb';
        return $result;
    }

    public function uploadvideo(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'uploadvideo';
        return $result;
    }

    /*----------------------------------------------------------------------------------*/
    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na","RequestID":"831"}
    */
    public function imagemissing(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'imagemissing';
        return $result;
    }

    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na","RequestID":"831"}
    */
    public function videomissing(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'videomissing';
        return $result;
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

        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'firmwareinfo';
        return $result;
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

        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'firmwaredone';
        return $result;
    }

    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na","RequestID":"4977"}
    */
    public function firmwarefail(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'firmwarefail';
        return $result;
    }

    /*----------------------------------------------------------------------------------*/
    public function cardfull(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'cardfull';
        return $result;
    }

    /*----------------------------------------------------------------------------------*/
    public function formatdone(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'formatdone';
        return $result;
    }


    /*----------------------------------------------------------------------------------*/
    public function schedule(Request $request) {
        $result_code = 0;
        $datetime = date('Y-m-d H:i:s');
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = $datetime;
        $result['api'] = 'schedule';
        return $result;
    }

    /*----------------------------------------------------------------------------------*/
    public function show() {
        //return 'Hello';

        // //$camera = DB::table('cameras')->first();
        // $camera = DB::table('cameras')->find(1);
        // //return $camera; // NG
        // return compact('camera'); //OK

        // (2)
        $id = 2;
        $camera = Camera::findOrFail($id);

        $photos = $camera->photos()
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        //return $camera; // OK
        //return compact('photos'); // OK
        return view('camera.show5', compact('camera', 'photos')); // OK

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
}
