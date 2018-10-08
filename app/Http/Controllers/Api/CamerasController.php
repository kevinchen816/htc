<?php

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Camera;
use App\Models\Photo;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Schema;
//use Storage;

/*
ICCID:
UniCOM #1   - 89860117851014783481
UniCOM #2   - 89860117851014783507
Truphone #1 - 8944503540145562672 F
Truphone #2 - 8944503540145561039 F
*/

//define(ERR_INVALID_SIM_CARD, '801');
const ERR_INVALID_SIM_CARD          = 801;
const ERR_PLAN_EMPTY                = 802;
const ERR_INVALID_CAMERA            = 803;
const ERR_NOT_CAMERA_OWNER          = 804;
const ERR_NO_UPLOAD_FILE            = 805;
const ERR_NO_REQUEST_ID             = 806;
const ERR_INVALID_REQUEST_ID        = 807;
const ERR_INVALID_PHOTO_ID          = 808;

const ERR_NO_BLOCK_NUMBER           = 811;
const ERR_NO_BLOCK_ID               = 812;
const ERR_NO_CRC32                  = 813;
const ERR_NO_FILE_BUFFER            = 814;
const ERR_CRC32_FAIL                = 815;
const ERR_INVALID_BLOCK_NUMBER      = 816;
const ERR_INVALID_BLOCK_ID          = 817;
const ERR_COPY_MERGE_FILE_FAIL      = 818;

/* 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending */
const ACTION_REQUESTED              = 1;
const ACTION_COMPLETED              = 2;
const ACTION_CANCELLED              = 3;
const ACTION_FAILED                 = 4;
const ACTION_PENDING                = 5;
//const ACTION_ABORT                = 6;

class CamerasController extends Controller
{
    //const ERR_INVALID_SIM_CARD = 801;

    private $error;

    /* reference vendor/symfony/dom-crawler/Field/FileFormField.php */
    public function setErrorCode($error) {
        //$codes = array(UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE, UPLOAD_ERR_PARTIAL, UPLOAD_ERR_NO_FILE, UPLOAD_ERR_NO_TMP_DIR, UPLOAD_ERR_CANT_WRITE, UPLOAD_ERR_EXTENSION);
        //if (!in_array($error, $codes)) {
        //    throw new \InvalidArgumentException(sprintf('The error code %s is not valid.', $error));
        //}
        //
        //$this->value = array('name' => '', 'type' => '', 'tmp_name' => '', 'error' => $error, 'size' => 0);
    }

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

    public function getErrorMessage($errorCode) {
        static $errors = array(
            ERR_INVALID_SIM_CARD => 'Invalid SIM card',
            ERR_PLAN_EMPTY => 'Plan points empty',
            ERR_INVALID_CAMERA => 'Invalid Camera Module',
            ERR_NOT_CAMERA_OWNER => 'Not Camera Owner',
            ERR_NO_UPLOAD_FILE => 'No Upload File',
            ERR_NO_REQUEST_ID => 'No Request ID',
            ERR_INVALID_REQUEST_ID => 'Invalid Request ID',
            ERR_INVALID_PHOTO_ID => 'Invalid Photo ID',

            ERR_NO_BLOCK_NUMBER => 'Missing blocknbr',
            ERR_NO_BLOCK_ID => 'Missing blockid',
            ERR_NO_CRC32 => 'Missing CRC32',
            ERR_NO_FILE_BUFFER => 'Missing file buffer',
            ERR_CRC32_FAIL => 'CRC32 hash failure',
            ERR_INVALID_BLOCK_NUMBER => 'Invalid blocknbr',
            ERR_INVALID_BLOCK_ID => 'Invalid blockid',
            ERR_COPY_MERGE_FILE_FAIL => 'Copy merge file failure',

            //900 => 'Invalid or Missing camera Module',
            //901 => 'Invalid SIM card',
            //// 901 =>'Invalid or Missing camera Model',
            //902 => 'test or Missing camera Model',

//900-> "Unknown Exception: Creating default object from empty value",
//902-> "Required parameter(s) missing: [blocknbr, crc32]"
//902-> "Invalid blocknbr: 0",
//904-> "CRC32 hash failure"
//907-> "file buffer is missing"
//907-> "Invalid Block ID or No Blocks Uploaded",
//910-> "The Request ID sent is for an non-pending Action."

            //991 => 'add Camera',
            //992 => 'update Camera',
            //UPLOAD_ERR_INI_SIZE => 'The file "%s" exceeds your upload_max_filesize ini directive (limit is %d KiB).',
        );

        /* reference vendor/symfony/http-foundation/File/UploadedFile.php */
        //$errorCode = $this->error;
        //$maxFilesize = UPLOAD_ERR_INI_SIZE === $errorCode ? self::getMaxFilesize() / 1024 : 0;
        //$message = isset($errors[$errorCode]) ? $errors[$errorCode] : 'The file "%s" was not uploaded due to an unknown error.';
        //return sprintf($message, $this->getClientOriginalName(), $maxFilesize);

        $message = isset($errors[$errorCode]) ? $errors[$errorCode] : 'Unknown Error';
        return $message;
    }

    /*----------------------------------------------------------------------------------*/
    public function Action_Search($camera_id, $action_code, $status = 1) {
        // $actions = DB::table('actions')->where(['camera_id' => $camera_id, 'action' => $action_code]);
        $query['camera_id'] = $camera_id;
        $query['action'] = $action_code;
        $query['status'] = $status;
        $actions = DB::table('actions')->where($query);
        $action = $actions->first();
        return ($action) ? 1 : 0;
    }

    public function Action_FindFirst($camera_id, $status = 1) {
        $query['camera_id'] = $camera_id;
        $query['status'] = $status;
        $actions = DB::table('actions')->where($query);
        $action = $actions->first();
        return $action;
    }

//    public function Action_AddX($camera_id, $action_code, $status = 1) {
//        $action = new Action;
//        $action->camera_id = $camera_id;
//        $action->action = $action_code;
//        $action->status = $status; // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending
//        $action->requested = date('Y-m-d H:i:s');
//        $action->save();
//    }

    public function Action_Add($param) {
        $action = new Action;
        $action->camera_id = $param['camera_id'];
        $action->action = $param['action_code'];
        $action->status = $param['status']; // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending
        $action->requested = date('Y-m-d H:i:s');

        if (isset($param['first_number'])) {
            $action->first_number = $param['first_number'];
        }

        if (isset($param['last_number'])) {
            $action->last_number = $param['last_number'];
        }

        $action->save();
    }

    public function Action_Update($param) {
        //$ret = 0;
        $request_id = $param['request_id'];
        $actions = DB::table('actions')->where('id', $request_id);
        $action  = $actions->first();
        if ($action) {
            if (($action->camera_id == $param['camera_id']) &&
                ($action->action == $param['action_code'])) {
                /* 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending */
                $data['status'] = $param['status'];
                $data['completed'] = date('Y-m-d H:i:s');

                if (isset($param['filename'])) { // isset, empty, is_null
                    $data['filename'] = $param['filename'];
                }

                if (isset($param['image_size'])) {
                    $data['image_size'] = $param['image_size'];
                }

                if (isset($param['compression'])) {
                    $data['compression'] = $param['compression'];
                }

                if (isset($param['photo_id'])) {
                    $data['photo_id'] = $param['photo_id'];
                }

                if (isset($param['photo_cnt'])) {
                    $data['photo_cnt'] = $param['photo_cnt'];
                }

                $actions->update($data);
                //$ret = 1;
            }
        }
        //return $ret;
        return $action;
    }

    public function Action_Completed($param) {
        $param['status'] = ACTION_COMPLETED;
        return $this->Action_Update($param);
    }

    public function Action_Cancelled($param) {
        $param['status'] = ACTION_CANCELLED;
        return $this->Action_Update($param);
    }

    public function Action_Failed($param) {
        $param['status'] = ACTION_FAILED;
        return $this->Action_Update($param);
    }

    public function Action_Pending($param) {
        $param['status'] = ACTION_PENDING;
        return $this->Action_Update($param);
    }

    //public function Action_Completed($param) {
    //    $ret = 0;
    //    $request_id = $param['request_id'];
    //    if ($request_id) {
    //        //$actions = DB::table('actions')->find($request_id);
    //        //$action  = DB::table('actions')->first();
    //        $actions = DB::table('actions')->where('id', $request_id);
    //        $action  = $actions->first();
    //        if ($action) {
    //            if (($action->camera_id == $param['camera_id']) &&
    //                ($action->action == $param['action_code'])) {
    //
    //                if (($action->status == ACTION_REQUESTED) || ($action->status ==ACTION_PENDING)) {
    //                    /* 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending */
    //                    $data['status'] = ACTION_COMPLETED;
    //                    $data['completed'] = date('Y-m-d H:i:s');
    //
    //                    if (isset($param['filename'])) { // isset, empty, is_null
    //                        $data['filename'] = $param['filename'];
    //                    }
    //
    //                    if (isset($param['photo_id'])) {
    //                        $data['photo_id'] = $param['photo_id'];
    //                    }
    //
    //                    if (isset($param['photo_cnt'])) {
    //                        $data['photo_cnt'] = $param['photo_cnt'];
    //                    }
    //
    //                    $actions->update($data);
    //                    $ret = 1;
    //                }
    //            }
    //        }
    //    }
    //    return $ret;
    //}

    public function Action_CancellAll($camera_id) {
        /*
        $query['camera_id'] = $camera_id;
        $query['status'] = ACTION_REQUESTED; //$status;
        $actions = DB::table('actions')->where($query);
        //$action = $actions->first();

        $data['status'] = ACTION_CANCELLED;
        $actions->update($data);
        return $actions;
        */

        $affected = DB::update(
            'update actions set status = ? where camera_id = ? AND (status = ? OR status = ?)',
            [ACTION_CANCELLED, $camera_id, ACTION_REQUESTED, ACTION_PENDING]
        );
        return $affected;
    }

    public function Action_CancellSchedulePending($camera_id) {
        $query['camera_id'] = $camera_id;
        $query['status'] = ACTION_PENDING;
        $actions = DB::table('actions')->where($query);
        //$action = $actions->first();

        $data['status'] = ACTION_CANCELLED;
        $actions->update($data);
        return $actions;
    }

//    public function Action_Failed($param) {
//        $ret = 0;
//        $request_id = $param['request_id'];
//        if ($request_id) {
//            $actions = DB::table('actions')->where('id', $request_id);
//            $action  = $actions->first();
//            if ($action) {
//                if (($action->camera_id == $param['camera_id']) &&
//                    ($action->action == $param['action_code'])) {
//
//                    //if (($action->status == 1) || ($action->status == 5)) {
//                        $data['status'] = 4; // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending
//                        $data['completed'] = date('Y-m-d H:i:s');
//                        $actions->update($data);
//                        $ret = 1;
//                    //}
//                }
//            }
//        }
//        return $ret;
//    }

    /*----------------------------------------------------------------------------------*/
    /*
    {
        "RequestID": "18679", <-- schedule
        "ResultCode": 0,
        "ActionCode": "UO",
        "ParameterList": {
            "FILENAME": "PICT0089.JPG",
            "IMAGESIZE": "5",
            "COMPRESSION": "28",
            "REQUESTID": "18372"
        },
        "DateTimeStamp": "2018-10-01 20:45:55"
    }
    */
    public function Response_Result($err, $camera = null, $datalist = null) {
        // date_default_timezone_set("Asia/Shanghai");
        $ret['ResultCode'] = $err;
        //if ($err == 0) {
        if (($err == 0)||($err == 1)||($err == 2)) {
            if ($datalist) {
                $ret['DataList'] = $datalist;
            }

            if ($camera) {
                $action = $this->Action_FindFirst($camera->id);
                if ($action) {
                    $action_code = $action->action;
                    if ($action_code == 'UO') {
                        $param_list["FILENAME"] = $action->filename;
                        $param_list["IMAGESIZE"] = (string) $action->image_size;
                        if ($action->compression) {
                            $param_list["COMPRESSION"] = (string) $action->compression;
                        }
                    } else if ($action_code == 'UV') {
                        $param_list["FILENAME"] = $action->filename;
                    }
                    $param_list["REQUESTID"] = (string) $action->id;

                    $ret['ActionCode'] = $action_code;
                    $ret['ParameterList'] = $param_list;
                }
            }
        //} else if ($err == 1) {
            // do nothing

        //} else if ($err == 2) {
            // do nothing

        } else {
            $ret['ErrorMsg'] = $this->getErrorMessage($err);
        }
        $ret['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $ret;
    }

    /*----------------------------------------------------------------------------------*/
    public function Plan_Check($iccid) {
        $plan = DB::table('plans')->where('iccid', $iccid)->first();
        if ($plan) {
            if ($plan->points_used < $plan->points) {
                $ret['err'] = 0;
                $ret['user_id'] = $plan->user_id;
            } else {
                //$ret['err'] = 802;
                $ret['err'] = ERR_PLAN_EMPTY;
            }
        } else {
            //$ret['err'] = 801;
            $ret['err'] = ERR_INVALID_SIM_CARD;
        }
        return $ret;
    }

    public function Plan_Update($param, $original = 0) {
        $point_photo_thumb = array(
            array( 1.0,  1.5 ,  2.0 ),  // 1
            array( 2.5,  3.25,  4.25),  // 2
            array( 4.0,  6.75,  8.25),  // 3
            array( 7.0, 10.0 , 14.5 ),  // 4
            array(13.0, 15.5 , 19.5 ),  // 5
        );

        $point_video_thumb = array(1.0, 2.0, 3.0, 6.0);

        $resolution = (integer) ($param->upload_resolution);
        if (isset($param->photo_quality)) {
            $quality = (integer) ($param->photo_quality);
        } else {
            $quality = 1;
        }
        $points = 0;

        if ($original) {
            $points = $param->filesize/(30*1024);
        } else {
            if ($resolution >= 8) {
                $resolution -= 8;
                $points = $point_video_thumb[$resolution];
            } else if ($resolution == 6) {
                $points = $param->filesize/(30*1024);
            } else {
                $resolution -= 1;
                $quality -= 1;
                $points = $point_photo_thumb[$resolution][$quality];
            }
        }

        $plans = DB::table('plans')->where('iccid', $param['iccid']);
        $plan = $plans->first();
        if ($plan) {
            $data['points_used'] = $plan->points_used + $points;
            $plans->update($data);
        }
        //return $plan;
        return $points;
    }

    /*----------------------------------------------------------------------------------*/
    public function Camera_Find($module_id) {
        $camera = DB::table('cameras')->where('module_id', $module_id)->first();
        return $camera;
    }

    public function Camera_Check($param) {
        $camera = null;
        $user_id = null;
        $ret = $this->Plan_Check($param->iccid);
        $err = $ret['err'];
        if ($err == 0) {
            $user_id = $ret['user_id'];
            $camera = $this->Camera_Find($param->module_id);
            if ($camera) {
                if ($camera->user_id == $user_id) {
                    //$this->Camera_Status_Update($param);
                    $err = 0;
                } else {
                    $err = ERR_NOT_CAMERA_OWNER;
                }
            } else {
                $err = ERR_INVALID_CAMERA;
            }
        }
        $ret['err'] = $err;
        $ret['camera'] = $camera;
        $ret['user_id'] = $user_id;
        return $ret;
    }

    public function Camera_Add($user_id, $request) {
        $camera = new Camera;

        $camera->user_id = $user_id; /* search iccid to find the user_id */

        $camera->module_id = $request->module_id;
        $camera->iccid     = $request->iccid;
        $camera->model_id  = $request->model_id;

        $datalist             = $request->DataList;
        $camera->battery      = $datalist['Battery'];
        $camera->signal_value = $datalist['SignalValue'];
        $camera->card_space   = $datalist['Cardspace'];
        $camera->card_size    = $datalist['Cardsize'];
        $camera->temperature  = $datalist['Temperature'];
        $camera->dsp_version  = $datalist['FirmwareVersion'];
        $camera->mcu_version  = $datalist['mcu'];
        $camera->cellular     = $datalist['cellular'];

        $datetime             = date('Y-m-d H:i:s');
        $camera->last_contact = $datetime;
        $camera->last_hb      = $datetime;

        $camera->save();
        return 0;
    }

    public function Camera_Status_Update($param, $api_type = null) {
        $module_id = $param->module_id;
        $cameras = DB::table('cameras')->where('module_id', $module_id);
        $camera = $cameras->first();

        $data['iccid'] = $param->iccid;
        $data['model_id'] = $param->model_id;

        if ($api_type == 'upload') {
            $data['battery']      = $param->Battery;
            $data['signal_value'] = $param->SignalValue;
            $data['card_space']   = $param->Cardspace;
            $data['card_size']    = $param->Cardsize;
            $data['temperature']  = $param->Temperature;
            $data['dsp_version']  = $param->FirmwareVersion;
            $data['mcu_version']  = $param->mcu;
            $data['cellular']     = $param->cellular;

            $data['last_filename'] = $param->filename;

            if ($param->Source != 'setup') {
                $data['arm_photos'] = $camera->arm_photos+1;
                $data['arm_points'] = $camera->arm_points + $param->points;
            }

        } else {
            $datalist = $param->DataList;
            if ($datalist) {
                $data['battery']      = $datalist['Battery'];
                $data['signal_value'] = $datalist['SignalValue'];
                $data['card_space']   = $datalist['Cardspace'];
                $data['card_size']    = $datalist['Cardsize'];
                $data['temperature']  = $datalist['Temperature'];
                $data['dsp_version']  = $datalist['FirmwareVersion'];
                $data['mcu_version']  = $datalist['mcu'];
                $data['cellular']     = $datalist['cellular'];
            }
        }

        $datetime = date('Y-m-d H:i:s');
        $data['last_contact'] = $datetime;
        if ($api_type == 'arm') {
            $data['last_armed'] = $datetime;    // status with Arm='Y'
        } else if ($api_type == 'report') {
            $data['last_hb'] = $datetime;       // report
        } else if ($api_type == 'upload') {
            $data['last_photo'] = $datetime;    // upload_xxx
        } else if ($api_type == 'schedule') {
            $data['last_schedule'] = $datetime; // schedule
        } else if ($api_type == 'settings') {
            $data['last_settings'] = $datetime; // downloadsettings
        }
        //$data['expected_contact'] = ; // TODO

        $cameras->update($data);
        // $camera->update($data); // NG
        return 0;
    }

    /*----------------------------------------------------------------------------------*/
    public function Photo_Add($param) {
        $photo = new Photo;
        $photo->camera_id         = $param->camera_id; // TODO
        $photo->filename          = $param->FileName;
        $photo->filetype          = 1;
        $photo->filesize          = $param->filesize;
        $photo->resolution        = $param->upload_resolution;

        $photo->photo_quality     = $param->photo_quality;
        $photo->photo_compression = $param->photo_compression;

        $photo->source            = $param->Source;
        $photo->datetime          = $param->DateTime;
        $photo->filepath          = $param->filename;
        $photo->save();
        return $photo;
    }

    public function Video_Add($param) {
        $photo = new Photo;
        $photo->camera_id       = $param->camera_id; // TODO
        $photo->filename        = $param->FileName;
        $photo->filetype        = 2;
        $photo->filesize        = $param->filesize; // $param->video_filesize;
        $photo->resolution      = $param->upload_resolution;

        $photo->photo_quality   = $param->photo_quality;
        $photo->video_length    = (integer) ($param->video_length);
        $photo->video_sound     = $param->video_sound;
        $photo->video_rate      = $param->video_rate;
        $photo->video_bitrate   = $param->video_bitrate;

        $photo->source          = $param->Source;
        $photo->datetime        = $param->DateTime;
        $photo->filepath        = $param->filename;
        $photo->save();
        return $photo;
    }

    /*----------------------------------------------------------------------------------*/
    public function hello(Request $request) {
        $ret['ResultCode'] = 0;
        return $ret;
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {"iccid":"89860117851014783481","module_id":"861107030190590","model_id":"lookout-na",
         "DataList":{
             "Battery":"f",
             "SignalValue":"31",
             "Cardspace":"7848MB",
             "Cardsize":"7854MB",
             "Temperature":"41C",
             "mcu":"4.1",
             "FirmwareVersion":"20180313",
             "cellular":"4G LTE"}
        }
    */
    public function report(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        $user_id = $ret['user_id'];

        if ($err == ERR_INVALID_CAMERA) {
            $err = $this->Camera_Add($user_id, $request);
            $camera = $this->Camera_Find($request->module_id);
        }

        if ($err == 0) {
            $this->Camera_Status_Update($request, 'report');
        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {"iccid":"8944503540145562672","module_id":"861107030190590","model_id":"lookout-na",
         "Arm":"Y",
         "RequestID":"6"}

        {"ResultCode":0,
        "ActionCode":"DS",
        "ParameterList":{"REQUESTID":"829"},
        "DateTimeStamp":"2018-03-17 09:02:02"}
    */
    public function status(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        $user_id = $ret['user_id'];

        if ($err == ERR_INVALID_CAMERA) {
            $err = $this->Camera_Add($user_id, $request);
            $camera = $this->Camera_Find($request->module_id);
        }

        if ($err == 0) {
            $this->Camera_Status_Update($request, 'arm');

            if ($request->Arm == 'Y') {
                //if ($this->Action_Search($camera->id, 'DS', 1) == 0) {
                //    $param = array(
                //        'camera_id'   => $camera->id,
                //        'action_code' => 'DS',
                //        'status'      => 1,
                //    );
                //    $this->Action_Add($param);
                //}

                //if ($this->Action_Search($camera->id, 'PS', 1) == 0) {
                //    $param = array(
                //        'camera_id'   => $camera->id,
                //        'action_code' => 'PS',
                //        'status'      => 1,
                //    );
                //    $this->Action_Add($param);
                //}

                $this->Action_CancellAll($camera->id);

                $param = array(
                    'camera_id'   => $camera->id,
                    'action_code' => 'DS',
                    'status'      => 1,
                );
                $this->Action_Add($param);

                $param['action_code'] = 'PS';
                $this->Action_Add($param);
            }

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'SR',
                );
                $this->Action_Completed($param);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    public function downloadsettings(Request $request) {
        $datalist = [];
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $this->Camera_Status_Update($request, 'settings');

            $datalist['cameramode']        = $camera->camera_mode;
            $datalist['photoresolution']   = $camera->photo_resolution;
            $datalist['video_resolution']  = $camera->video_resolution;
            $datalist['video_rate']        = $camera->video_fps;
            $datalist['video_bitrate']     = $camera->video_bitrate;
            $datalist['video_bitrate7']    = $camera->video_bitrate7;
            $datalist['video_bitrate8']    = $camera->video_bitrate8;
            $datalist['video_bitrate9']    = $camera->video_bitrate9;
            $datalist['video_bitrate10']   = $camera->video_bitrate10;
            $datalist['video_bitrate11']   = $camera->video_bitrate11;
            $datalist['video_length']      = $camera->video_length;
            $datalist['video_sound']       = $camera->video_sound;
            $datalist['photoburst']        = $camera->photo_burst;
            $datalist['burst_delay']       = $camera->burst_delay;
            $datalist['upload_resolution'] = $camera->upload_resolution;
            $datalist['photo_quality']     = $camera->photo_quality;
            $datalist['photo_compression'] = $camera->photo_compression;
            $datalist['timestamp']         = $camera->timestamp;
            $datalist['date_format']       = $camera->date_format;

            $datalist['time_format']     = $camera->time_format;
            $datalist['temperature']     = $camera->temperature;
            $datalist['quiettime']       = $camera->quiettime;
            $datalist['timelapse']       = $camera->timelapse;
            $datalist['tls_start']       = date('H:i', strtotime($camera->tls_start));
            $datalist['tls_stop']        = date('H:i', strtotime($camera->tls_stop));
            $datalist['tls_interval']    = $camera->tls_interval;
            $datalist['wireless_mode']   = $camera->wireless_mode;
            $datalist['wm_schedule']     = $camera->wm_schedule;
            $datalist['wm_sclimit']      = $camera->wm_sclimit;
            $datalist['hb_interval']     = $camera->hb_interval;
            $datalist['online_max_time'] = $camera->online_max_time;
            $datalist['cellularpw']      = $camera->cellularpw;
            $datalist['remotecontrol']   = $camera->remotecontrol;

            $datalist['dutytime'] = $camera->dutytime;
            $datalist['dt_sun']   = $camera->dt_sun;
            $datalist['dt_mon']   = $camera->dt_mon;
            $datalist['dt_tue']   = $camera->dt_tue;
            $datalist['dt_wed']   = $camera->dt_wed;
            $datalist['dt_thu']   = $camera->dt_thu;
            $datalist['dt_fri']   = $camera->dt_fri;
            $datalist['dt_sat']   = $camera->dt_sat;

            $datalist['use_crc32'] = $camera->use_crc32;

            $datalist['blockmode1']  = $camera->blockmode1;
            $datalist['blockmode2']  = $camera->blockmode2;
            $datalist['blockmode3']  = $camera->blockmode3;
            $datalist['blockmode4']  = $camera->blockmode4;
            $datalist['blockmode5']  = $camera->blockmode5;
            $datalist['blockmode7']  = $camera->blockmode7;
            $datalist['blockmode8']  = $camera->blockmode8;
            $datalist['blockmode9']  = $camera->blockmode9;
            $datalist['blockmode10'] = $camera->blockmode10;
            $datalist['blockmode11'] = $camera->blockmode11;

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'DS',
                    //'photo_id'    => null,
                    //'photo_cnt'   => null,
                );
                $this->Action_Completed($param);
            }
        }
        return $this->Response_Result($err, $camera, $datalist);
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {"ResultCode":0,
         "blockid":"rt5b4ee59befce2",
         "blocknbr":1,
         "DateTimeStamp":"2018-07-18 03:00:43"}
    */
    public function uploadblock_response($blockid, $blocknbr) {
        // date_default_timezone_set("Asia/Shanghai");
        $ret['ResultCode'] = 0; //$err;
        $ret['blockid'] = $blockid;
        $ret['blocknbr'] = $blocknbr;
        $ret['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $ret;
    }

    public function uploadblock_merge($camera, $filename, $blockid, $crc32) {
        $uploader = new ImageUploadHandler;
        $camera_id = $camera->id;
        $ret = $uploader->merge($camera_id, $filename, $blockid, $crc32);
        $err = $ret['err'];
        if ($err == 0) {
            $ret['err'] = 0;
        } else if ($err == 1) {
            $ret['err'] = ERR_INVALID_BLOCK_ID;
        } else if ($err == 2) {
            $ret['err'] = ERR_CRC32_FAIL;
        } else if ($err == 3) {
            $ret['err'] = ERR_COPY_MERGE_FILE_FAIL;
        }
        return $ret;
    }

/*
PICT0001.JPG    336098999   140876b7
PICT0002.JPG    1184126564  46945664
*/
    public function uploadblock(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $camera_id = $camera->id;

            if (!isset($request->blocknbr)) {
                return $this->Response_Result(ERR_NO_BLOCK_NUMBER, $camera);
            }

            if (!isset($request->crc32)) {
                return $this->Response_Result(ERR_NO_CRC32, $camera);
            }

            if (!isset($request->buffer)) {
                return $this->Response_Result(ERR_NO_FILE_BUFFER, $camera);
            }

            $blocknbr = $request->blocknbr;
            if ($blocknbr <= 0) {
                return $this->Response_Result(ERR_INVALID_BLOCK_NUMBER, $camera);
            } else if ($blocknbr == 1) {
                $blockid = date('ymdhis').'_'.$camera_id; // 'rt5bb7b9586d6fb'
            } else {
                if (!isset($request->blockid)) {
                    return $this->Response_Result(ERR_NO_BLOCK_ID, $camera);
                }
                $blockid = $request->blockid;
            }

            $file = $request->buffer; // $request->Image;
            if ($file && $file->isValid()) {
                /* https://www.cnblogs.com/mslagee/p/6223140.html */
                //$crc32 = hexdec(hash_file('crc32b', $file->getRealPath()));
                //if ($crc32 != $request->crc32) {
                //    $ret = $this->Response_Result(ERR_CRC32_FAIL, $camera);
                //    $ret['CRC32'] = $crc32;
                //    return $ret;
                //}

                $ret = $uploader->save_buffer($camera_id, $file, $blockid, $blocknbr);
                $err = $ret['err'];
                if ($err == 0) {
                    /* https://www.cnblogs.com/mslagee/p/6223140.html */
                    $crc32 = hexdec(hash_file('crc32b', $ret['path']));
                    if ($crc32 != $request->crc32) {
                        $ret = $this->Response_Result(ERR_CRC32_FAIL, $camera);
                        $ret['CRC32'] = $crc32;
                    } else {
                        $ret = $this->uploadblock_response($blockid, $blocknbr);
                    }
                    return $ret;
                }

            } else {
                $err = ERR_NO_FILE_BUFFER;
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    /*
        $request = {
            "iccid": "89860117851014783481",
            "module_id": "861107032685597",
            "model_id": "lookout-na",

            "FileName": "PICT0436.JPG",
            "upload_resolution": "2",
            "photo_quality": "1",
            "photo_compression": "29",
            "Source": "tl",
            "DateTime": "20181001172018",

            "Battery": "f",
            "SignalValue": "25",
            "Cardspace": "30041MB",
            "Cardsize": "30432MB",
            "Temperature": "27C",
            "mcu": "4.36",
            "FirmwareVersion": "20180912",
            "cellular": "4G LTE",
            "Image": {}
        }
    */
    //public function uploadfile(Request $request, ImageUploadHandler $uploader) {
    public function uploadfile($request, $api) {
        //$camera = $camera->find(1);
        //return $camera;

        //$camera = DB::table('cameras')->where('module_id', $request->module_id)->get();
        // $camera = DB::table('cameras')
        //                 ->where('module_id', $request->module_id)
        //                 ->first();

        $uploader = new ImageUploadHandler;

        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $camera_id = $camera->id;

            if (isset($request->blockid)) {
                $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                $err = $ret['err'];
            } else {
                $file = $request->Image;
                if ($file && $file->isValid()) {
                    // $ret = $uploader->save_file($file);
                    $ret = $uploader->save_file_ex($camera_id, $file);
                    $err = $ret['err'];
                } else {
                    $err = ERR_NO_UPLOAD_FILE;
                }
            }

            if ($err == 0) {
                //$OriginalName = $ret['OriginalName'];
                $OriginalName = $request->FileName;     // PICT0001.JPG
                $filename = $ret['filename'];           // 1538422239_Cf7PQK04w4.JPG
                $filesize = $ret['filesize'];

                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $filename;
                $param['filesize'] = $filesize;

                if ($api == 'video_thumb') {
                    $photo = $this->Video_Add($param);
                } else {
                    $photo = $this->Photo_Add($param);
                }

                $points = $this->Plan_Update($param);
                $param['points'] = $points;
                $this->Camera_Status_Update($param, 'upload');

                if ($request->RequestID) {
                    $request_id = $request->RequestID;
                    $actions = DB::table('actions')->where('id', $request_id);
                    $action  = $actions->first();
                    if ($action) {
                        if ($action->camera_id == $camera_id) {
                            if ($action->action == 'PS') {
                                $data['filename'] = $OriginalName;
                                $data['photo_id'] = $photo->id;
                                $data['photo_cnt'] = 1;
                                $data['status'] = ACTION_COMPLETED;

                            } else if ($action->action == 'SC') {
                                $data['filename'] = $OriginalName;
                                $data['photo_id'] = $photo->id;
                                if ($OriginalName != $action->filename) {
                                    $data['photo_cnt'] = $action->photo_cnt + 1;
                                }
                            }
                            $data['completed'] = date('Y-m-d H:i:s');
                            $actions->update($data);
                        }
                    }
                }
            }
        }

        if ($err == ERR_CRC32_FAIL) {
            $crc32 = $ret['CRC32'];
            $ret = $this->Response_Result($err, $camera);
            $ret['CRC32'] = $crc32;
        } else {
            $ret = $this->Response_Result($err, $camera);
        }
        return $ret;
    }

    //public function uploadthumb(Request $request, ImageUploadHandler $uploader) {
    public function uploadthumb(Request $request) {
        return $this->uploadfile($request, 'photo_thumb');
    }

/*
HighRes Max
{
    "ResultCode": 0,
    "ActionCode": "UO",
    "ParameterList": {
        "FILENAME": "PICT0089.JPG",
        "IMAGESIZE": "5",
        "COMPRESSION": "28",
        "REQUESTID": "18372"
    },
    "DateTimeStamp": "2018-10-01 20:45:55"
}

{
    "ResultCode": 0,
    "ActionCode": "UO",
    "ParameterList": {
        "FILENAME": "PICT0593.JPG",
        "IMAGESIZE": "6",
        "REQUESTID": "7572"
    },
    "DateTimeStamp": "2018-10-01 20:55:51"
}
*/
    public function uploadoriginal(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $camera_id = $camera->id;

            if (!isset($request->RequestID)) {
                return $this->Response_Result(ERR_NO_REQUEST_ID, $camera);
            }

            /* search Action */
            $request_id = $request->RequestID;
            $query = array(
                'id' => $request_id,
                'camera_id' => $camera_id,
                'action' => 'UO',
                'status' => ACTION_REQUESTED,
            );
            $actions = DB::table('actions')->where($query);
            $action  = $actions->first();
            if (!$action) {
                return $this->Response_Result(ERR_INVALID_REQUEST_ID, $camera);
            }
            $photo_id = $action->photo_id;

            /* search Photo */
            $query = array(
                'id' => $photo_id,
                'camera_id' => $camera_id,
            );
            $photos = DB::table('photos')->where($query);
            $photo = $photos->first();
            if (!$photo) {
                return $this->Response_Result(ERR_INVALID_PHOTO_ID, $camera);
            }

            if (isset($request->blockid)) {
                $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                $err = $ret['err'];
            } else {
                $file = $request->Image;
                if ($file && $file->isValid()) {
                    $ret = $uploader->save_file_ex($camera_id, $file);
                    $err = $ret['err'];
                } else {
                    $err = ERR_NO_UPLOAD_FILE;
                }
            }

            if ($err == 0) {
                //$OriginalName = $ret['OriginalName'];
                $OriginalName = $request->FileName;     // PICT0001.JPG
                $filename = $ret['filename'];           // 1538422239_Cf7PQK04w4.JPG
                $filesize = $ret['filesize'];

                /* update Photo */
                $data = [];
                $data['resolution'] = $request->upload_resolution;
                $data['filesize'] = $filesize;
                $data['photo_compression'] = $request->photo_compression;
                $data['filepath'] = $filename;
                $photos->update($data);

                /* update Plan */
                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $filename;
                $param['filesize'] = $filesize;
                $points = $this->Plan_Update($param);

                /* update Camera Status */
                $param['points'] = $points;
                $this->Camera_Status_Update($param, 'upload');

                /* update Action */
                $data = [];
                $data['status'] = ACTION_COMPLETED;
                $data['completed'] = date('Y-m-d H:i:s');
                $data['photo_cnt'] = 1;
                $actions->update($data);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*
        $request = {
            "iccid": "89860117851014783481",
            "module_id": "861107032685597",
            "model_id": "lookout-na",

            "FileName": "PICT0439.MP4",
            "upload_resolution": "8",
            "video_resolution": "8",
            "video_length": "5s",
            "video_sound": "on",
            "video_rate": "4",
            "video_bitrate": "1000",
            "video_filesize": "597939",
            "Source": "tl",
            "DateTime": "20181001213044",

            "RequestID": "7574",

            "Battery": "f",
            "SignalValue": "22",
            "Cardspace": "30039MB",
            "Cardsize": "30432MB",
            "Temperature": "27C",
            "mcu": "4.36",
            "FirmwareVersion": "20180912",
            "cellular": "4G LTE",
            "Image": {}
        }
    */
    public function uploadvideothumb(Request $request) {
        return $this->uploadfile($request, 'video_thumb');
    }

    /*
    {
        "ResultCode": 0,
        "ActionCode": "UV",
        "ParameterList": {
            "FILENAME": "PICT0478.MP4",
            "REQUESTID": "7576"
        },
        "DateTimeStamp": "2018-10-02 01:00:10"
    }
    */
    public function uploadvideo(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $camera_id = $camera->id;

            if (!isset($request->RequestID)) {
                return $this->Response_Result(ERR_NO_REQUEST_ID, $camera);
            }

            /* search Action */
            $request_id = $request->RequestID;
            $query = array(
                'id' => $request_id,
                'camera_id' => $camera_id,
                'action' => 'UV',
                'status' => ACTION_REQUESTED,
            );
            $actions = DB::table('actions')->where($query);
            $action  = $actions->first();
            if (!$action) {
                return $this->Response_Result(ERR_INVALID_REQUEST_ID, $camera);
            }
            $photo_id = $action->photo_id;

            /* search Photo */
            $query = array(
                'id' => $photo_id,
                'camera_id' => $camera_id,
            );
            $photos = DB::table('photos')->where($query);
            $photo = $photos->first();
            if (!$photo) {
                return $this->Response_Result(ERR_INVALID_PHOTO_ID, $camera);
            }

            if (isset($request->blockid)) {
                $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                $err = $ret['err'];
            } else {
            $file = $request->Image;
                if ($file && $file->isValid()) {
                    $ret = $uploader->save_file_ex($camera_id, $file);
                    $err = $ret['err'];
                } else {
                    $err = ERR_NO_UPLOAD_FILE;
                }
            }

            if ($err == 0) {
                //$OriginalName = $ret['OriginalName'];
                $OriginalName = $request->FileName;     // PICT0001.JPG
                $filename = $ret['filename'];           // 1538422239_Cf7PQK04w4.JPG
                $filesize = $ret['filesize'];

                /* update Photo */
                $data = [];
                $data['resolution'] = $request->upload_resolution;
                $data['filesize'] = $filesize;
                //$data['photo_compression'] = $request->photo_compression;
                $data['filepath'] = $filename;
                $photos->update($data);

                /* update Plan */
                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $filename;
                $param['filesize'] = $filesize;
                $points = $this->Plan_Update($param, 1);

                /* update Camera Status */
                $param['points'] = $points;
                $this->Camera_Status_Update($param, 'upload');

                /* update Action */
                $data = [];
                $data['status'] = ACTION_COMPLETED;
                $data['completed'] = date('Y-m-d H:i:s');
                $data['photo_cnt'] = 1;
                $actions->update($data);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    public function imagemissing(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'UO',
                );
                $this->Action_Completed($param);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    public function videomissing(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'UV',
                );
                $this->Action_Completed($param);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na",
     "RequestID":"4980","version":"20180720",
     "Battery":"f","Cardspace":"30405MB","Cardsize":"30432MB"}
    */
    public function firmwareinfo(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $this->Camera_Status_Update($request);

            $version = '20180816'; // TODO
            if ($request->version < $version) {
                $freespace =  (integer) ($request->Cardspace);
                if ($freespace < 10) {
                    $err = 2;
                } else if ($request->Battery == 'l') {
                    $err = 2;
                } else if ($request->Battery == 'e') {
                    $err = 2;
                } else {
                    $err = 1;
                }
            } else {
                $err = 0;
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*{"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na",
       "RequestID":"4980","version":"20180720"}*/
    public function firmware(Request $request) {
        $name = 'IMAGE.ZIP';
        $pathToFile = public_path() . '/firmware/' . $name;
        //$result['pathToFile'] = $pathToFile;
        //return $result;

        //return response()->download($pathToFile);
        return response()->download($pathToFile, $name);
    }

    public function firmwaredone(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'FW',
                    //'photo_id'    => null,
                    //'photo_cnt'   => null,
                );
                $this->Action_Completed($param);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    public function firmwarefail(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'FW',
                    'status' => 4, // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending
                );
                $this->Action_Update($param);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    public function cardfull(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $this->Camera_Status_Update($request);

            /* send email */

        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    public function formatdone(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'FC',
                );
                $this->Action_Completed($param);
            }
        }
        return $this->Response_Result($err, $camera);
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {
	        "iccid": "xxx", "module_id": "xxx", "model_id": "xxx",
	        "status": "start",
	        "first_number": "92",
	        "last_number": "111"
        }
        {
        	"RequestID": "7583",
        	"ResultCode": 0,
        	"DateTimeStamp": "2018-10-02 19:47:18"
        }
    */
    /*
        {
        	"iccid": "xxx", "module_id": "xxx", "model_id": "xxx",
        	"status": "finish",
        	"RequestID": "7583"
        }
    */

/*
{
    "RequestID": "18679",
    "ResultCode": 0,
    "ActionCode": "DS",
    "ParameterList": {
        "REQUESTID": "18677"
    },
    "DateTimeStamp": "2018-10-03 18:23:28"
}
*/
    public function schedule(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $this->Camera_Status_Update($request, 'schedule');

            $param = array(
                'camera_id'   => $camera->id,
                'action_code' => 'SC',
            );

            //if ($request->RequestID) {
            //    $param['request_id'] = $request->RequestID;
            //}

            if ($request->status == 'start') {
                $this->Action_CancellSchedulePending($camera->id);

                $param['first_number'] = $request->first_number;
                $param['last_number'] = $request->last_number;
                $param['status'] = ACTION_PENDING;
                $this->Action_Add($param);

                $ret = $this->Response_Result($err, $camera);
                $action = $this->Action_FindFirst($camera->id, ACTION_PENDING);
                if ($action) {
                    $ret['RequestID'] = $action->id;
                }

            } else if ($request->status == 'finish') {
                if ($request->RequestID) {
                    $param['request_id'] = $request->RequestID;
                    //$param['photo_id'] = ;
                    //$param['photo_cnt'] = ;
                    $this->Action_Completed($param);
                }
                $ret = $this->Response_Result($err, $camera);

            } else if ($request->status == 'abort') {
                if ($request->RequestID) {
                    $param['request_id'] = $request->RequestID;
                    $this->Action_Failed($param);
                }
                $ret = $this->Response_Result($err, $camera);
            }
        }
        //return $this->Response_Result($err, $camera);
        return $ret;
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

            $user    = Auth::user();
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
        $user   = Auth::user();
        $camera = Camera::findOrFail($camera_id);
        $photos = $camera->photos()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        //return view('cameras', compact('camera', 'photos')); // OK
        return view('cameras', compact('user', 'camera', 'photos')); // OK

        //return redirect()->route('cameras_ex', $camera_id);
    }

    public function gallery() {
        $token     = $_POST['_token'];
        $camera_id = $_POST['id'];
        $action    = $_POST['action'];
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

    public function settings(Request $request) {
        //return 'settings';
        return $request;
    }

    public function actions($cameras_id) {
        $ret = '/cameras/actions/' . $cameras_id;
        return $ret;
    }

    public function emailpolicy() {
        $user   = Auth::user();
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
            $value = number_format($name / 1024, 2);
            $name  = $value . ' GB';

        } elseif ($column == 'card_space') {
            $free = $name;
            $size = $camera['card_size'];
            settype($free, 'integer');
            settype($size, 'integer');
            $percent = round(($free / $size) * 100, 0);

            $free = round($free / 1024, 2);
            $name = $free . ' GB (' . $percent . '%free)';

        } elseif ($column == 'points_used') {
            $used    = $name;
            $size    = $camera['points'];
            $percent = round(($used / $size) * 100, 0);

            $used = number_format($used, 2, '.', '');
            $name = $used . ' (' . $percent . '%free)';
        }
        return $name;
    }

    public function CameraPanelBody($id, $lists) {
        $camera = Camera::findOrFail($id);

        $handle = '';
        foreach ($lists as $key => $value) {
            $field_mame  = $key;
            $field_value = $camera[$key];
            $field_title = $value;
            $field_text  = $this->CameraFieldValueConvert($camera, $field_mame, $field_value);

            $handle .= '<div class="row">';
            $handle .= '<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">';
            $handle .= '<span class="pull-right">' . $field_title . '</span>';
            $handle .= '</div>';
            $handle .= '<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">';
            $handle .= '<strong>' . $field_text . '</strong>';
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

        $user    = Auth::user();
        $user_id = $user->id;
        $cameras = DB::table('cameras')
            ->select('id', 'description', 'battery', 'last_contact', 'last_filename')
            ->where('user_id', $user_id)
            ->get();

        $style  = 'padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;';
        $handle = '';
        foreach ($cameras as $camera) {
            $camera_id    = $camera->id;
            $description  = $camera->description;
            $battery      = $this->CameraFieldValueConvert($camera, 'battery', $camera->battery);
            $last_contact = $camera->last_contact;

            if (!empty($camera->last_filename)) {
                //$url = 'http://sample.test/uploads/images/'.$camera->last_filename;
                //$url = url('/uploads/images/').$camera->last_filename; // NG
                // $url = url('/uploads/images/').'/'.$camera->last_filename;
                $url = url('/uploads/' . $camera_id . '/') . '/' . $camera->last_filename;
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

            $handle .= '        <a href="/cameras/getdetail/' . $camera_id . '">' . $description . '</a><br/>';
            // $handle .= '        <i class="fa fa-battery-full" style="color: lime;"> </i>'.$battery.'<br />';
            $handle .= $battery . '<br/>';
            $handle .= '        <span style="font-size: .95em">' . $last_contact . '</span>';
            $handle .= '    </td>';

            $handle .= '    <td class="col-sm-6">';
            if (!empty($url)) {
                // $handle .= '        <a class="btn thumb-select" data-id="15" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;"><img src="'.$url.'" class="img-responsive"/></a>';
                $handle .= '        <a class="btn thumb-select" data-id="' . $camera_id . '" style="' . $style . '"><img src="' . $url . '" class="img-responsive"/></a>';
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
            'description'  => 'Description',
            'location'     => 'Location',
            'module_id'    => 'Module ID',
            'iccid'        => 'SIM ICCID',
            'points'       => 'Plan Points',
            'points_used'  => 'Points Used',
            'model_id'     => 'Model',
            'signal_value' => 'Signal',
            'battery'      => 'Battery',
            'card_size'    => 'Card Size',
            'card_space'   => 'Card Space',
            'temperature'  => 'Temperature',
            'dsp_version'  => 'Firmware',
            'mcu_version'  => 'MCU',
            'cellular'     => 'Last Connection',
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
            'last_contact'     => 'Last Contact',
            'last_armed'       => 'Last Armed',
            'arm_photos'       => 'Photos since armed',
            'arm_points'       => 'Points since armed',
            'last_hb'          => 'Last Heartbeat',
            'last_photo'       => 'Last Photo',
            'last_schedule'    => 'Last Scheduled Upload',
            'last_settings'    => 'Last Settings',
            'expected_contact' => 'Expected Contact',
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

        $user    = Auth::user();
        $user_id = $user->id;
        $cameras = DB::table('cameras')
            ->select('id', 'description')
            ->where('user_id', $user_id)
            ->get();

        $style  = 'padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;';
        $handle = '';
        foreach ($cameras as $camera) {
            $camera_id   = $camera->id;
            $description = $camera->description;
            $handle .= '<li><a href="/cameras/getdetail/' . $camera_id . '">' . $description . '</a></li>';
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
            $field_mame  = $key;
            $field_value = $camera[$key];

            $title = $value['title'];
            $help  = $value['help'];

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

            $zz = $id . '_' . $field_mame;

            /* Camera Mode:camera_mode=p */
            // $handle .= '<div>'.$title.':'.$field_mame.'='.$field_value.'</div>';

            $handle .= '<div class="form-group" id="field-wrapper-' . $id . '-' . $field_mame . '">';
            $handle .= '<label class="col-md-4 control-label" for="inputSmall">' . $title . '</label>';
            $handle .= '<div class="col-md-7">';

            if ($type == 'input') {
                $format      = $value['format'];
                $placeholder = $value['placeholder'];
                // if (!empty($value['pattern']) {
                //     $pattern = $value['pattern'];
                //     //<input type="text" class="form-control input-sm" id="54_cellularpw" name="54_cellularpw" pattern="[0-9]{6}" value="xxx" placeholder="xxx">
                //     $handle .= '<input type="text" class="form-control input-sm" id="'.$zz.'" name="'.$zz.'" pattern="'.$pattern.'" value="'.$field_value.'" placeholder="'.$placeholder.'">';

                // } else if (!empty($value['maxlength']) {
                // $maxlength = $value['maxlength'];

                //<input type="text" class="form-control input-sm" id="54_camera_desc" name="54_camera_desc" maxlength="30" value="xxx" placeholder="xxx">
                $handle .= '<input type="text" class="form-control input-sm" id="' . $zz . '" name="' . $zz . '" ' . $format . ' value="' . $field_value . '" placeholder="' . $placeholder . '">';
                // }

            } else {
                $options = $value['options'];
                // $handle .=  '<select class="bs-select form-control input-sm" id="54_cameramode" name="54_cameramode">';
                $handle .= '<select class="bs-select form-control input-sm" id="' . $zz . '" name="' . $zz . '">';
                foreach ($options as $option) {
                    // $option['name'] = Photo
                    // $option['value'] = p
                    // $handle .= '<div>'.$option['name'].'='.$option['value'].'</div>';
                    if ($option['value'] == $field_value) {
                        $handle .= '<option value="' . $option['value'] . '" selected="selected">' . $option['name'] . '</option>';
                    } else {
                        $handle .= '<option value="' . $option['value'] . '">' . $option['name'] . '</option>';
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
                'title'       => 'Camera Description',
                'type'        => 'input',
                'format'      => 'maxlength="30"',
                'placeholder' => 'Input Camera Description',
                'help'        => '',
            ),

            'location'    => array(
                'title'       => 'Camera Location',
                'type'        => 'input',
                'format'      => 'maxlength="30"',
                'placeholder' => 'Input Camera Location',
                'help'        => '',
            ),

        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Control_Settings($camera) {
        $lists = array(
            'camera_mode'       => array(
                'title'   => 'Camera Mode',
                'options' => array(
                    array('name' => 'Photo', 'value' => 'p'),
                    array('name' => 'Video', 'value' => 'v'),
                ),
                'help'    => '',
            ),

            /* photo */
            'photo_resolution'  => array(
                'title'   => 'Photo Resolution',
                'options' => array(
                    array('name' => '4MP 16:9', 'value' => '4'),
                    array('name' => '6MP 16:9', 'value' => '6'),
                    array('name' => '8MP 16:9', 'value' => '8'),
                    array('name' => '12MP 16:9', 'value' => '12'),
                ),
                'help'    => 'Use this setting to control the size of the Photo saved on the SD Card.',
            ),
            'photo_burst'       => array(
                'title'   => 'Photo Burst',
                'options' => array(
                    array('name' => '1', 'value' => '1'),
                    array('name' => '2', 'value' => '2'),
                    array('name' => '3', 'value' => '3'),
                ),
                'help'    => 'Photo Burst is used to set the number of photos captured per event in Photo Mode. It is not used for Video mode. If Cellular mode is ON, then the camera will upload each photo of the burst to the portal.',
            ),
            'burst_delay'       => array(
                'title'   => 'Burst Delay',
                'options' => array(
                    array('name' => '250ms', 'value' => '250'),
                    array('name' => '500ms', 'value' => '500'),
                    array('name' => '1s', 'value' => '1000'),
                    array('name' => '3s', 'value' => '3000'),
                ),
                'help'    => 'The Burst Delay is the elapsed time between each burst photo.',
            ),
            'upload_resolution' => array(
                'title'   => 'Upload Resolution',
                'options' => array(
                    array('name' => 'Standard Low', 'value' => '1'),
                    array('name' => 'Standard Medium', 'value' => '2'),
                    array('name' => 'Standard High', 'value' => '3'),
                    array('name' => 'High Def', 'value' => '4'),
                ),
                'help'    => 'Use this setting to control the size of the uploaded thumbnail.',
            ),
            'photo_quality'     => array(
                'title'   => 'Upload Quality',
                'options' => array(
                    array('name' => 'Standard', 'value' => '1'),
                    array('name' => 'Medium', 'value' => '2'),
                    array('name' => 'High', 'value' => '3'),
                ),
                'help'    => 'Use this setting to control the image quality and size of the uploaded thumbnail. A higher quality means clearer images but larger file sizes when uploaded to the portal. Use a Photo quality that best meets your application and budget. [Standard] quality will reduce the size and cost to upload each photo to the portal and is generally good enough for most applications. Keep in mind that you can request a High-res Max or the Original file from the SD card when/if you need it for more detail on this particular photo event.',
            ),

            /* video */
            'video_resolution'  => array(
                'title'   => 'Video Resolution',
                'options' => array(
                    array('name' => 'Standard Low', 'value' => '8'),
                    array('name' => 'Standard Medium', 'value' => '9'),
                    array('name' => 'Standard High', 'value' => '10'),
                    array('name' => 'High Def', 'value' => '11'),
                ),
                'help'    => 'This determines the frame size of the video in pixels, or how wide it is when viewed on your computer monitor. A higher resolution means the video file saved to the SD card is larger and when uploaded uses more battery and costs more image points from your data plan, but it will have more detail on the other hand.',
            ),
            'video_fps'         => array(
                'title'   => 'Capture Rate',
                'options' => array(
                    array('name' => '4fps', 'value' => '4'),
                    array('name' => '6fps', 'value' => '6'),
                    array('name' => '8fps', 'value' => '8'),
                    array('name' => '10fps', 'value' => '10'),
                    array('name' => '12fps', 'value' => '12'),
                    array('name' => '15fps', 'value' => '15'),
                    array('name' => '30fps', 'value' => '30'),
                ),
                'help'    => 'Capture rate does not affect the size of the video file captured or reduce the points used to upload to the portal. A lower frame rate in low motion will improve the quality of each frame while motion blur may increase. A faster frame rate may reduce motion blur when there is higher motion and may reduce the image quality of each frame. Every environment is different. Please experiment to find the right value for your environment and needs.',
            ),
            'video_bitrate'     => array(
                'title'   => 'Quality Level',
                'options' => array(
                    array('name' => '1 (default/smallest)', 'value' => '300'),
                    array('name' => '2', 'value' => '400'),
                    array('name' => '3', 'value' => '500'),
                    array('name' => '4', 'value' => '600'),
                    array('name' => '5', 'value' => '700'),
                    array('name' => '6', 'value' => '800'),
                    array('name' => '7', 'value' => '900'),
                    array('name' => '8 (balanced)', 'value' => '1000'),
                    array('name' => '9', 'value' => '1200'),
                    array('name' => '10', 'value' => '1400'),
                    array('name' => '11', 'value' => '1800'),
                    array('name' => '12 (High)', 'value' => '2500'),
                    array('name' => '13 (Maximum/LARGE!)', 'value' => '5000'),
                ),
                'help'    => 'Use quality level to control the image quality for each frame in the video. A higher value will increase quality while also increasing the size of the file captured. If you frequently make video upload requests you may want a lower quality in order to minimize image points used in your data plan. There is no set quality level for a particular application. Please experiment with video quality to achieve an acceptable balance for your environment and budget.',
            ),
            'video_length'      => array(
                'title'   => 'Video Duration',
                'options' => array(
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
                'help'    => 'Note: The longer the duration, the larger the video file will be if uploaded to the portal.',
            ),
            'video_sound'       => array(
                'title'   => 'Video Sound',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),

            /* other */
            'timestamp'         => array(
                'title'   => 'Time Stamp',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'date_format'       => array(
                'title'   => 'Date Format',
                'options' => array(
                    array('name' => 'mdY', 'value' => 'mdY'),
                    array('name' => 'Ymd', 'value' => 'Ymd'),
                    array('name' => 'dmY', 'value' => 'dmY'),
                ),
                'help'    => '',
            ),
            'time_format'       => array(
                'title'   => 'Time Format',
                'options' => array(
                    array('name' => '12 Hour', 'value' => '12'),
                    array('name' => '24 Hour', 'value' => '24'),
                ),
                'help'    => '',
            ),
            'temp_unit'         => array(
                'title'   => 'Temperature',
                'options' => array(
                    array('name' => 'Fahrenheit', 'value' => 'f'),
                    array('name' => 'Celsius', 'value' => 'c'),
                ),
                'help'    => '',
            ),
        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Trigger_Settings($camera) {
        $lists = array(
            'quiettime' => array(
                'title'   => 'Quiet Time',
                'options' => array(
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
                'help'    => 'Quiet Time is a delay after the current event is complete (photo or video). It can be used to reduce the number of PIR events in a given time. If your camera is taking too many photos or videos, then increase the quiet time to reduce the frequency of PIR (motion) activations. PIR or motion capture, as well as Time Lapse capture is disabled while sleeping in the quiet time period.',
            ),

        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Time_Lapse($camera) {
        $lists = array(
            'tls_start'    => array(
                'title'   => 'Timelapse Start Time',
                'type'    => 'hhmm',
                'options' => array(
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
                'help'    => '',
            ),

            'tls_stop'     => array(
                'title'   => 'Timelapse Stop Time',
                'type'    => 'hhmm',
                'options' => array(
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
                'help'    => '',
            ),
            'tls_interval' => array(
                'title'   => 'Timelapse Interval',
                'options' => array(
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
                'help'    => '',
            ),
        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Wireless_Settings($camera) {
        $lists = array(
            'wireless_mode'   => array(
                'title'   => 'Wireless Mode',
                'options' => array(
                    array('name' => 'Instant', 'value' => 'instant'),
                    array('name' => 'Schedule', 'value' => 'schedule'),
                ),
                'help'    => 'In [Instant] the camera will capture a photo or video then attach to the network and upload the file. In [Schedule] it will wake up either when the timer is up (Schedule Interval) or when the file limit is reached (File Limit)  and upload the pending files to the server.  Using [Schedule] will save battery because it reduces the handshaking that occurs each time the camera has to connect to the network (5 to 10 seconds per photo in Instant mode).  The mobile app will recieve a notification as each scheduled upload starts and completes.  The Action tab will show the scheduled event and the number of photos uploaded.',
            ),

            /* schedule */
            'wm_schedule'     => array(
                'title'   => 'Schedule Interval',
                'options' => array(
                    array('name' => 'Every Hour', 'value' => '1h'),
                    array('name' => 'Every 2 Hours', 'value' => '2h'),
                    array('name' => 'Every 4 Hours', 'value' => '4h'),
                ),
                'help'    => 'The camera will use a timer to wake up and determine if there are files to upload based on the interval you select. If there are pending files, they will be uploaded to the server at that time.',
            ),
            'wm_sclimit'      => array(
                'title'   => 'Schedule File Limit',
                'options' => array(
                    array('name' => '20 Files', 'value' => '20'),
                    array('name' => '30 Files', 'value' => '30'),
                    array('name' => '40 Files', 'value' => '40'),
                    array('name' => '50 Files', 'value' => '50'),
                ),
                'help'    => 'As the camera captures photos or videos, it will maintain a file count. If the file count reaches your selected File Limit, then the camera will attach to the network at that time (not the Scheduled Interval) and upload all pending files. A lower limit may increase network connections and use more battery, while a higher value may reduce network connections and battery usage. File Limit will be more important during periods of high activity. If the File Limit is not reached in a schedule interval period then it has no effect. File Limit is the only way to ensure that all media files captured will get uploaded to the pportal.',
            ),

            /* other */
            'hb_interval'     => array(
                'title'   => 'Heartbeat Interval',
                'options' => array(
                    array('name' => 'Every Hour', 'value' => '1h'),
                    array('name' => 'Every 2 Hours', 'value' => '2h'),
                    array('name' => 'Every 4 Hours', 'value' => '4h'),
                    array('name' => 'Every 8 Hours', 'value' => '8h'),
                    array('name' => 'Every 12 Hours', 'value' => '12h'),
                ),
                'help'    => 'This timer will fire on the whole hour and will send a status to the server. The mobile app will recieve a notification when this occurs. This lets you know your camera is still functioning and its curent status. It will also process any pending Action items you have queued like High-Res Max, Video, Original, Settings.',
            ),
            'online_max_time' => array(
                'title'   => 'Max Online Time',
                'options' => array(
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
                'help'    => 'Use this setting to control the amount of time the camera will remain online, per event, processing queued action requests. A shorter time means the camera can return to PIR mode more quickly and continue capturing Photo and Video, otherwise the camera is busy and may miss PIR events due to queue processing. A longer time means your queued Action items should get completed sooner if the queue is large.',
            ),
            'cellularpw'      => array(
                'title'       => 'Cellular Password',
                'type'        => 'input',
                //'pattern' => '[0-9]{6}',
                'format'      => 'pattern="[0-9]{6}"',
                'placeholder' => 'Input Cellular Password',
                'help'        => 'Input 6 digits. Blank for no password. If you input a password, it is required when you power the camera into Setup mode. This means if your camera is stolen, the thief is not able to set cellular mode to OFF, which means he can only use the camera in cellular mode.',
            ),
            'remotecontrol'   => array(
                'title'   => 'Remote Control',
                'options' => array(
                    array('name' => 'Disabled', 'value' => 'off'),
                    array('name' => '24 Hour', 'value' => '24h'),
                ),
                'help'    => 'This option will cause the camera to sleep in a high power state waiting on SMS commands from the network. It will use more battery power at rest in this mode. You will see additional buttons on the Actions tab, used to wake your camera up immediately. When clicked, those buttons [SNAP] and [WAKE] will send an SMS message to wake the camera up. [SNAP] will cause the camera to capture a photo or video and upload it to the portal. The camera will then process any Action items you have queued up.',
            ),

        );

        $handle = $this->Camera_Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Camera_Settings_Block_Mode_Settings($camera) {
        $lists = array(
            'blockmode1'  => array(
                'title'   => 'Block Mode 1',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode2'  => array(
                'title'   => 'Block Mode 2',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode3'  => array(
                'title'   => 'Block Mode 3',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode4'  => array(
                'title'   => 'Block Mode 4',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode5'  => array(
                'title'   => 'Block Mode 5',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),

            'blockmode7'  => array(
                'title'   => 'Block Mode 7',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode8'  => array(
                'title'   => 'Block Mode 8',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode9'  => array(
                'title'   => 'Block Mode 9',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode10' => array(
                'title'   => 'Block Mode 10',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
            ),
            'blockmode11' => array(
                'title'   => 'Block Mode 11',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help'    => '',
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
        $user = Auth::user();
        return view('plans.add-plan', compact('user'));
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
        $id     = 1;
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

        $tables  = array_column($tables, 'Tables_in_htc');
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
