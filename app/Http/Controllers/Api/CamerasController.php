<?php

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Camera;
use App\Models\Photo;
use App\Models\Firmware;
use App\Models\LogApi;
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

    public function TXT_Source($txt) {
        if ($txt == 'setup') {
            $txt = 'Menu';
        } else if ($txt == 'mt') {
            $txt = 'Motion';
        } else if ($txt == 'tl') {
            $txt = 'Timelapse';
        } else if ($txt == 'ps') {
            $txt = 'Photo Snap';
        } else if ($txt == 'sc') {
            $txt = 'Scheduled Upload';
        }
        return $txt;
    }

    public function TXT_UploadResolution($txt) {
        if ($txt == 1) {
            $txt = 'Standard Low';
        } else if ($txt == 2) {
            $txt = 'Standard Medium';
        } else if ($txt == 3) {
            $txt = 'Standard High';
        } else if ($txt == 4) {
            $txt = 'High Def';
        } else if ($txt == 5) {
            $txt = 'High-Res MAX';
        } else if ($txt == 6) {
            $txt = 'Original Photo';
        //} else if ($txt == 7) {
        //    $txt = '';
        } else if ($txt == 8) {
            $txt = 'Standard Low';
        } else if ($txt == 9) {
            $txt = 'Standard Medium';
        } else if ($txt == 10) {
            $txt = 'Standard High';
        } else if ($txt == 11) {
            $txt = 'High Def';
        }
        return $txt;
    }

    public function TXT_UploadQuality($txt) {
        if ($txt == 1) {
            $txt = 'Standard';
        } else if ($txt == 2) {
            $txt = 'Medium';
        } else if ($txt == 3) {
            $txt = 'High';
        }
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    public function LogApi_Add($api, $type, $user_id, $camera_id, $request, $response) {
        if ($user_id && $camera_id) {
            $logapi = new LogApi;

            $logapi->user_id = $user_id;
            $logapi->camera_id = $camera_id;

            $logapi->imei = $request->module_id;
            $logapi->iccid = $request->iccid;

            $logapi->api = $api;
            $logapi->type = $type;
//            $logapi->request = $request->getContent();
            $logapi->request = json_encode($request->all()); // string
            $logapi->response = json_encode($response);

            $logapi->save();
        }
    }

    public function LogApi_Search($user_id, $imei) {
        $ret = DB::table('log_apis')
            ->where('request->module_id', $imei)
            ->get();
        return $ret;
    }

    public function LogApi_Text($name, $value) {
        return sprintf('%25s: %s%c', $name, $value, 0x0a);
    }

    public function LogApi_List($log_apis) {
        $handle = '';
        foreach ($log_apis as $log_api) {
            $show = 0;
            $result = null;
            $request = json_decode($log_api->request);
            $response = json_decode($log_api->response);
            if ($log_api->api == 'report') {
                $api = 'HeartBeat';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'status') {
                $api = 'Status';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'downloadsettings') {
                $api = 'Download Settings';
                $request_type = 0;
                $response_type = 2;
                $show = 1;

            } else if ($log_api->api == 'uploadblock') {
                $api = 'Upload Block';
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'uploadthumb') {
                $api = 'Upload Photo';
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'uploadoriginal') {
                if ($request->upload_resolution == 6) {
                    $api = 'Upload Original';
                } else {
                    $api = 'Upload HighResMax';
                }
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'uploadvideothumb') {
                $api = 'Upload Video Thumb';
                $request_type = 2;
                $response_type = 1;
                $show = 1;

            } else if ($log_api->api == 'uploadvideo') {
                $api = 'Upload Video';
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'imagemissing') {
                $api = 'Missing Photo';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'videomissing') {
                $api = 'Missing Video';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'firmwareinfo') {
                $api = 'Firmware Info';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            //} else if ($log_api->api == 'firmware') {
            //    $api = 'Firmware Download';
            //    $request_type = 1;
            //    $response_type = 0;
            //    $show = 1;

            } else if ($log_api->api == 'firmwaredone') {
                $api = 'Firmware Upgrade Success';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'firmwarefail') {
                $api = 'Firmware Upgrade Fail';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'cardfull') {
                $api = 'Card Full';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'formatdone') {
                $api = 'Format Done';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'schedule_start') {
                $api = 'Schedule Start';
                $request_type = 1; // -> 0
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'schedule_finish') {
                $api = 'Schedule Finish';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'schedule_abort') {
                $api = 'Schedule Abort';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else {
                $api = 'Unknown';
                $request_type = 0;
                $response_type = 0;
                $show = 1;
            }

            if ($show == 1) {
                if ($result == null) {
                    if ($response->ResultCode == 0) {
                        $result = 'Success';
                        $btn_attr = 'btn-primary';
                    } else if ($response->ResultCode == 1) {
                        $result = 'Success';
                        $btn_attr = 'btn-primary';
                    } else {
                        $result = 'Fail';
                        $btn_attr = 'btn-danger';
                    }
                }

                $datetime = $log_api->created_at;

                if ($request_type == 1) {
                    $link_request = '<a class="btn btn-xs '.$btn_attr.' view-request" data-request="';
                    if(isset($request->iccid)) {
                        $link_request .= $this->LogApi_Text('ICCID', $request->iccid);
                    }
                    if(isset($request->module_id)) {
                        $link_request .= $this->LogApi_Text('Module ID', $request->module_id);
                    }

                    if (isset($request->DataList)) {
                        $data = $request->DataList;
                        if(isset($data->Battery)) {
                            $link_request .= $this->LogApi_Text('Battery', $data->Battery);
                        }
                        if(isset($data->SignalValue)) {
                            $link_request .= $this->LogApi_Text('Signal', $data->SignalValue);
                        }
                        if(isset($data->Cardspace)) {
                            $link_request .=  $this->LogApi_Text('Card Space', $data->Cardspace);
                        }
                        if(isset($data->Cardsize)) {
                            $link_request .= $this->LogApi_Text('Card Size', $data->Cardsize);
                        }
                        if(isset($data->Temperature)) {
                            $link_request .= $this->LogApi_Text('Temperature', $data->Temperature);
                        }
                    }
                    $link_request .= '">View</a>';

                } else if ($request_type == 2) {
                    $link_request = '<a class="btn btn-xs '.$btn_attr.' view-request" data-request="';
                    if(isset($request->iccid)) {
                        $link_request .= $this->LogApi_Text('ICCID', $request->iccid);
                    }
                    if(isset($request->module_id)) {
                        $link_request .= $this->LogApi_Text('Module ID', $request->module_id);
                    }

                    if(isset($request->FileName)) {
                        $link_request .= $this->LogApi_Text('FileName', $request->FileName);
                    }
                    if(isset($request->upload_resolution)) {
                        $link_request .= $this->LogApi_Text('Upload Resolution', $request->upload_resolution);
                    }
                    if(isset($request->Source)) {
                        $link_request .= $this->LogApi_Text('Source', $request->Source);
                    }

                    $data = $request;
                    if(isset($data->Battery)) {
                        $link_request .= $this->LogApi_Text('Battery', $data->Battery);
                    }
                    if(isset($data->SignalValue)) {
                        $link_request .= $this->LogApi_Text('Signal', $data->SignalValue);
                    }
                    if(isset($data->Cardspace)) {
                        $link_request .=  $this->LogApi_Text('Card Space', $data->Cardspace);
                    }
                    if(isset($data->Cardsize)) {
                        $link_request .= $this->LogApi_Text('Card Size', $data->Cardsize);
                    }
                    if(isset($data->Temperature)) {
                        $link_request .= $this->LogApi_Text('Temperature', $data->Temperature);
                    }
                    $link_request .= '">View</a>';

                } else {
                    $link_request = '';
                }

                if ($response_type == 1) {
                    $link_response = '<a class="btn btn-xs '.$btn_attr.' view-response" data-response="';
                    if(isset($response->ResultCode)) {
                        $link_response .= $this->LogApi_Text('Result Code', $response->ResultCode);
                    }
                    if(isset($response->ErrorMsg)) {
                        $link_response .= $this->LogApi_Text('Error Message', $response->ErrorMsg);
                    }
                    if(isset($response->DateTimeStamp)) {
                        $link_response .= $this->LogApi_Text('DateTime', $response->DateTimeStamp);
                    }

                    $link_response .= '">View</a>';
                } else if ($response_type == 2) {
                    if (isset($response->DataList)) {
                        $data = $response->DataList;
                        $link_response = '<a class="btn btn-xs '.$btn_attr.' view-response" data-response="';

                        if(isset($data->photoresolution)) {
                            $link_response .= $this->LogApi_Text('Photo Resolution', $data->photoresolution);
                        }
                        if(isset($data->video_resolution)) {
                            $link_response .= $this->LogApi_Text('Video Resolution', $data->video_resolution);
                        }
                        if(isset($data->video_rate)) {
                            $link_response .= $this->LogApi_Text('Frame Rate', $data->video_rate);
                        }
                        if(isset($data->video_bitrate)) {
                            $link_response .= $this->LogApi_Text('Quality Level', $data->video_bitrate);
                        }
                        if(isset($data->video_length)) {
                            $link_response .= $this->LogApi_Text('Video Length', $data->video_length);
                        }
                        if(isset($data->video_sound)) {
                            $link_response .= $this->LogApi_Text('Video Sound', $data->video_sound);
                        }
                        if(isset($data->photoburst)) {
                            $link_response .= $this->LogApi_Text('Photo Burst', $data->photoburst);
                        }
                        if(isset($data->burst_delay)) {
                            $link_response .= $this->LogApi_Text('Burst Delay', $data->burst_delay);
                        }
                        if(isset($data->upload_resolution)) {
                            $link_response .= $this->LogApi_Text('Upload Resolution', $data->upload_resolution);
                        }
                        if(isset($data->photo_quality)) {
                            $link_response .= $this->LogApi_Text('Upload Quality', $data->photo_quality);
                        }
                        if(isset($data->timestamp)) {
                            $link_response .= $this->LogApi_Text('Time Stamp', $data->timestamp);
                        }
                        if(isset($data->date_format)) {
                            $link_response .= $this->LogApi_Text('Date Format', $data->date_format);
                        }
                        if(isset($data->time_format)) {
                            $link_response .= $this->LogApi_Text('Time Format', $data->time_format);
                        }
                        if(isset($data->temperature)) {
                            $link_response .= $this->LogApi_Text('Temperature', $data->temperature);
                        }
                        if(isset($data->quiettime)) {
                            $link_response .= $this->LogApi_Text('Quiet Time', $data->quiettime);
                        }
                        if(isset($data->timelapse)) {
                            $link_response .= $this->LogApi_Text('Time Lapse', $data->timelapse);
                        }
                        if(isset($data->tls_start)) {
                            $link_response .= $this->LogApi_Text('Timelapse Start Time', $data->tls_start);
                        }
                        if(isset($data->tls_stop)) {
                            $link_response .= $this->LogApi_Text('Timelapse Stop Time', $data->tls_stop);
                        }
                        if(isset($data->tls_interval)) {
                            $link_response .= $this->LogApi_Text('Timelapse Interval', $data->tls_interval);
                        }
                        if(isset($data->wireless_mode)) {
                            $link_response .= $this->LogApi_Text('Wireless Mode', $data->wireless_mode);
                        }
                        if(isset($data->wm_schedule)) {
                            $link_response .= $this->LogApi_Text('Schedule Interval', $data->wm_schedule);
                        }
                        if(isset($data->wm_sclimit)) {
                            $link_response .= $this->LogApi_Text('Schedule File Limit', $data->wm_sclimit);
                        }
                        if(isset($data->hb_interval)) {
                            $link_response .= $this->LogApi_Text('Heartbeat Interval', $data->hb_interval);
                        }
                        if(isset($data->online_max_time)) {
                            $link_response .= $this->LogApi_Text('Action Process Time Limit', $data->online_max_time);
                        }
                        if(isset($data->cellularpw)) {
                            $link_response .= $this->LogApi_Text('Cellular Password', $data->cellularpw);
                        }
                        if(isset($data->remotecontrol)) {
                            $link_response .= $this->LogApi_Text('Remote Control', $data->remotecontrol);
                        }
                    }
                    $link_response .= '">View</a>';
                } else {
                    $link_response = '';
                }

                $handle .= '<tr>';
                $handle .=    '<td>'.$log_api->id.'</td>';
                $handle .=    '<td>'.$api.'</td>';
                $handle .=    '<td>'.$result.'</td>';
                $handle .=    '<td>'.$link_request.'</td>';
                $handle .=    '<td>'.$link_response.'</td>';
                $handle .=    '<td>'.$datetime.'</td>';
                $handle .= '</tr>';
            }
       }
       return $handle;
    }

    public function apilog($camera_id) {
        //return $camera_id;
        //return view('camera.apilog', compact('user', 'camera', 'photos'));
        //return view('camera.apilog', compact('user', 'camera'));

        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $user_id = $user->id;

        $camera = Camera::find($camera_id);

        $log_apis = DB::table('log_apis')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            ->where(['camera_id' => $camera_id])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('camera.apilog', compact('user', 'camera', 'log_apis'));
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

        if (isset($param['photo_id'])) {
            $action->photo_id = $param['photo_id'];
        }
        if (isset($param['filename'])) {
            $action->filename = $param['filename'];
        }
        if (isset($param['image_size'])) {
            $action->image_size = $param['image_size'];
        }
        if (isset($param['compression'])) {
            $action->compression = $param['compression'];
        }
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
        $request_id = (integer) $param['request_id'];
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

        Photo Original

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

        Video
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
                $ret['err'] = ERR_PLAN_EMPTY;
            }
        } else {
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

    //public function Camera_Status_Update($param, $api_type = null) {
    public function Camera_Status_Update($param, $api_type = null, $upload_original = 0) {
        $module_id = $param->module_id;
        $cameras = DB::table('cameras')->where('module_id', $module_id);
        $camera = $cameras->first();

        $data['iccid'] = $param->iccid;
        $data['model_id'] = $param->model_id;

        if ($api_type == 'log') {
            if ($param->status == 'enable') {
                $data['log'] = 1;
            } else {
                $data['log'] = 0;
            }

        } else if ($api_type == 'upload') {
            $data['battery']      = $param->Battery;
            $data['signal_value'] = $param->SignalValue;
            $data['card_space']   = $param->Cardspace;
            $data['card_size']    = $param->Cardsize;
            $data['temperature']  = $param->Temperature;
            $data['dsp_version']  = $param->FirmwareVersion;
            $data['mcu_version']  = $param->mcu;
            $data['cellular']     = $param->cellular;

            $data['last_filename'] = $param->filename;

            if ($upload_original == 0) {
                $data['last_savename'] = $param->savename;
            }

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
    //public function Photo_Add($param) {
    //    $photo = new Photo;
    //    $photo->camera_id           = $param->camera_id; // TODO
    //    $photo->filename            = $param->filename;
    //    $photo->imagename           = $param->imagename;
    //    $photo->savename            = $param->savename;
    //    $photo->filesize            = $param->filesize;
    //    $photo->filetype            = 1;
    //    $photo->points              = $param->points;
    //
    //    $photo->resolution          = $param->upload_resolution;
    //    $photo->photo_quality       = $param->photo_quality;
    //    $photo->photo_compression   = $param->photo_compression;
    //    $photo->source              = $param->Source;
    //    $photo->datetime            = $param->DateTime;
    //    $photo->save();
    //    return $photo;
    //}

    //public function Video_Add($param) {
    //    $photo = new Photo;
    //    $photo->camera_id           = $param->camera_id; // TODO
    //    $photo->filename            = $param->filename;
    //    $photo->imagename           = $param->imagename;
    //    $photo->savename            = $param->savename;
    //    $photo->filesize            = $param->filesize; // $param->video_filesize;
    //    $photo->filetype            = 2;
    //    $photo->points              = $param->points;
    //
    //    $photo->resolution          = $param->upload_resolution;
    //    $photo->photo_quality       = $param->photo_quality;
    //    $photo->video_length        = (integer) ($param->video_length);
    //    $photo->video_sound         = $param->video_sound;
    //    $photo->video_rate          = $param->video_rate;
    //    $photo->video_bitrate       = $param->video_bitrate;
    //    $photo->source              = $param->Source;
    //    $photo->datetime            = $param->DateTime;
    //    $photo->save();
    //    return $photo;
    //}

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
        //return $request;
        //return $request->getContent();
        //return gettype($request); // object
        //return gettype($request->getContent()); // string
        //return gettype($request->all()); // array
        //return gettype(json_encode($request->all())); // string

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

        $response = $this->Response_Result($err, $camera);
//return gettype($response); // array
//return gettype(json_encode($response)); // string
//return gettype(json_decode(json_encode($response))); // object
//return gettype(json_decode(json_encode($response), true)); // array
        if ($user_id && $camera) {
            //$param = array(
            //    'api' => 'report',
            //    'user_id' => $user_id,
            //    'camera' => $camera,
            //    'request' => $request,
            //    'response' => $response,
            //);
            $this->LogApi_Add('report', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
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
                $this->Action_CancellAll($camera->id);

                $param = array(
                    'camera_id'   => $camera->id,
                    'action_code' => 'DS',
                    'status'      => ACTION_REQUESTED, //1,
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

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('status', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function downloadsettings(Request $request) {
        $datalist = [];
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        $user_id = $ret['user_id'];
        if ($err == 0) {
            $this->Camera_Status_Update($request, 'settings');

            $datalist['cameramode']        = (string) $camera->camera_mode;
            $datalist['photoresolution']   = (string) $camera->photo_resolution;
            $datalist['video_resolution']  = (string) $camera->video_resolution;
            $datalist['video_rate']        = (string) $camera->video_fps;
            $datalist['video_bitrate']     = (string) $camera->video_bitrate;
            $datalist['video_bitrate7']    = (string) $camera->video_bitrate7;
            $datalist['video_bitrate8']    = (string) $camera->video_bitrate8;
            $datalist['video_bitrate9']    = (string) $camera->video_bitrate9;
            $datalist['video_bitrate10']   = (string) $camera->video_bitrate10;
            $datalist['video_bitrate11']   = (string) $camera->video_bitrate11;
            $datalist['video_length']      = (string) $camera->video_length;
            $datalist['video_sound']       = (string) $camera->video_sound;
            $datalist['photoburst']        = (string) $camera->photo_burst;
            $datalist['burst_delay']       = (string) $camera->burst_delay;
            $datalist['upload_resolution'] = (string) $camera->upload_resolution;
            $datalist['photo_quality']     = (string) $camera->photo_quality;
            $datalist['photo_compression'] = (string) $camera->photo_compression;
            $datalist['timestamp']         = (string) $camera->timestamp;
            $datalist['date_format']       = (string) $camera->date_format;

            $datalist['time_format']     = (string) $camera->time_format;
            $datalist['temperature']     = (string) $camera->temperature;
            $datalist['quiettime']       = (string) $camera->quiettime;
            $datalist['timelapse']       = (string) $camera->timelapse;
            $datalist['tls_start']       = date('H:i', strtotime($camera->tls_start));
            $datalist['tls_stop']        = date('H:i', strtotime($camera->tls_stop));
            $datalist['tls_interval']    = (string) $camera->tls_interval;
            $datalist['wireless_mode']   = (string) $camera->wireless_mode;
            $datalist['wm_schedule']     = (string) $camera->wm_schedule;
            $datalist['wm_sclimit']      = (string) $camera->wm_sclimit;
            $datalist['hb_interval']     = (string) $camera->hb_interval;
            $datalist['online_max_time'] = (string) $camera->online_max_time;
            $datalist['cellularpw']      = (string) $camera->cellularpw;
            $datalist['remotecontrol']   = (string) $camera->remotecontrol;

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

            $cameras = DB::table('cameras')->where('id', $camera->id);
            $cameras->update(['remotecurrent' => $camera->remotecontrol]);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'DS',
                );
                $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera, $datalist);
        if ($user_id && $camera) {
            $this->LogApi_Add('downloadsettings', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
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
                //$blockid = date('ymdhis').'_'.$camera_id; // 'rt5bb7b9586d6fb'
                $blockid = $camera_id.'_'.date('ymdhis');
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
                    $crc32 = hexdec(hash_file('crc32b', $ret['savepath']));
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

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('uploadblock', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
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

        $camera_id = null;
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;

            if (isset($request->blockid)) {
                $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                $err = $ret['err'];
            } else {
                $file = $request->Image;
                if ($file && $file->isValid()) {
                    $ret = $uploader->save_file($camera_id, $file);
                    $err = $ret['err'];
                } else {
                    $err = ERR_NO_UPLOAD_FILE;
                }
            }

            if ($err == 0) {
                $param = $request;
                //$param['camera_id'] = $camera_id;
                //$param['filename'] = $request->FileName;
                //$param['imagename'] = $ret['imagename'];
                $param['savename'] = $ret['savename'];
                $param['filesize'] = $ret['filesize'];

                $points = $this->Plan_Update($param);
                //$param['points'] = $points;

                $photo = new Photo;
                $photo->camera_id           = $camera_id;
                $photo->filename            = $request->FileName;
                $photo->imagename           = $ret['imagename'];
                $photo->thumb_name          = $ret['savename'];
                $photo->filesize            = $ret['filesize'];
                $photo->points              = $points;
                $photo->resolution          = $request->upload_resolution;
                $photo->source              = $request->Source;
                $photo->datetime            = $request->DateTime;

                if ($api == 'video_thumb') {
                    $photo->filetype   = 2;
                    $photo->uploadtype = 3;
                    //$photo = $this->Video_Add($param);

                    //$photo->photo_quality       = $param->photo_quality;
                    $photo->video_length        = (integer) ($param->video_length);
                    $photo->video_sound         = $param->video_sound;
                    $photo->video_rate          = $param->video_rate;
                    $photo->video_bitrate       = $param->video_bitrate;
                    $photo->save();

                } else {
                    $photo->filetype   = 1;
                    $photo->uploadtype = 1;
                    //$photo = $this->Photo_Add($param);

                    $photo->photo_quality       = $param->photo_quality;
                    $photo->photo_compression   = $param->photo_compression;
                    $photo->save();
                }
                $this->Camera_Status_Update($param, 'upload');

                if ($request->RequestID) {
                    $request_id = $request->RequestID;
                    $actions = DB::table('actions')->where('id', $request_id);
                    $action  = $actions->first();
                    if ($action) {
                        if ($action->camera_id == $camera_id) {
                            if ($action->action == 'PS') {
                                $data['filename'] = $request->FileName;
                                $data['photo_id'] = $photo->id;
                                $data['photo_cnt'] = 1;
                                $data['status'] = ACTION_COMPLETED;

                            } else if ($action->action == 'SC') {
                                $data['filename'] = $request->FileName;
                                $data['photo_id'] = $photo->id;
                                if ($request->FileName != $action->filename) {
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
            //$crc32 = $ret['CRC32'];
            $response = $this->Response_Result($err, $camera);
            $response['CRC32'] = $ret['CRC32'];
        } else {
            $response = $this->Response_Result($err, $camera);
        }

        $ret = [];
        $ret['user_id'] = $user_id;
        $ret['camera'] = $camera;
        $ret['response'] = $response;
        return $ret;
    }

    public function uploadthumb(Request $request) {
//$file = $request->Image;
//return $file->getClientOriginalName();

        $ret = $this->uploadfile($request, 'photo_thumb');
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        $response = $ret['response'];
        if ($user_id && $camera) {
            //$this->LogApi_Add('uploadthumb', 1, $ret['user_id'], $ret['camera_id'], $request, $response);
            $this->LogApi_Add('uploadthumb', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    public function upload_check($request, $action) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;

            if (isset($request->RequestID)) {
                /* search Action by RequestID */
                $query = array(
                    'id' => $request->RequestID,
                    'camera_id' => $camera_id,
                    'action' => $action, //'UO',
                    'status' => ACTION_REQUESTED,
                );
                $actions = DB::table('actions')->where($query);
                $action  = $actions->first();
                if ($action) {
                    $photo_id = $action->photo_id;

                    /* search Photo */
                    $query = array(
                        'id' => $photo_id,
                        'camera_id' => $camera_id,
                    );
                    $photos = DB::table('photos')->where($query);
                    $photo = $photos->first();
                    if (!$photo) {
                        //return $this->Response_Result(ERR_INVALID_PHOTO_ID, $camera);
                        $response = $this->Response_Result(ERR_INVALID_PHOTO_ID, $camera);
                        $this->LogApi_Add('uploadoriginal', 1, $user_id, $camera->id, $request, $response);
                        return $response;
                    }

                } else {
                    //return $this->Response_Result(ERR_INVALID_REQUEST_ID, $camera);
                    $response = $this->Response_Result(ERR_INVALID_REQUEST_ID, $camera);
                    $this->LogApi_Add('uploadoriginal', 1, $user_id, $camera->id, $request, $response);
                    return $response;
                }

            } else {
                $err = ERR_NO_REQUEST_ID;
            }


        }
        //$ret = [];
        $ret['err'] = $err;
        //$ret['user_id'] = $user_id;
        //$ret['camera'] = $camera;
        return $ret;
    }

    public function uploadoriginal(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;
            if (isset($request->RequestID)) {
                /* search Action */
                $query = array(
                    'id' => $request->RequestID,
                    'camera_id' => $camera_id,
                    'action' => 'UO',
                    'status' => ACTION_REQUESTED,
                );
                $actions = DB::table('actions')->where($query);
                $action  = $actions->first();
                if ($action) {
                    /* search Photo */
                    $query = array(
                        'id' => $action->photo_id,
                        'camera_id' => $camera_id,
                    );
                    $photos = DB::table('photos')->where($query);
                    $photo = $photos->first();
                    if ($photo) {
                        if (isset($request->blockid)) {
                            $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                            $err = $ret['err'];
                        } else {
                            $file = $request->Image;
                            if ($file && $file->isValid()) {
                                $ret = $uploader->save_file($camera_id, $file);
                                $err = $ret['err'];
                            } else {
                                $err = ERR_NO_UPLOAD_FILE;
                            }
                        }

                    } else {
                        $err = ERR_INVALID_PHOTO_ID;
                    }
                } else {
                    $err = ERR_INVALID_REQUEST_ID;
                }
            } else {
                $err = ERR_NO_REQUEST_ID;
            }

            if ($err == 0) {
                $filesize = $ret['filesize'];

                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $request->FileName;
                $param['imagename'] = $ret['imagename'];
                $param['savename'] = $ret['savename'];
                $param['filesize'] = $filesize;

                /* update Plan */
                $points = $this->Plan_Update($param);
                $param['points'] = $points;

                /* update Photo */
                $data = [];
                $data['action'] = 0;
                $data['uploadtype'] = 2; // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                $data['resolution'] = $request->upload_resolution;
                $data['photo_compression'] = $request->photo_compression;
                $data['imagename'] = $ret['imagename'];
                $data['original_name'] = $ret['savename'];
                $data['filesize'] = $filesize;
                $data['points'] = $points;
                $photos->update($data);

                /* update Camera Status */
                $this->Camera_Status_Update($param, 'upload', 1);

                /* update Action */
                $data = [];
                $data['status'] = ACTION_COMPLETED;
                $data['completed'] = date('Y-m-d H:i:s');
                $data['photo_cnt'] = 1;
                $actions->update($data);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('uploadoriginal', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*
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
    */
    public function uploadvideothumb(Request $request) {
//$file = $request->Image;
//return $file->getClientOriginalName();

        $ret = $this->uploadfile($request, 'video_thumb');
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        $response = $ret['response'];
        if ($user_id && $camera) {
            $this->LogApi_Add('uploadvideothumb', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    public function uploadvideo(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;
            if (isset($request->RequestID)) {
                /* search Action */
                $query = array(
                    'id' => $request->RequestID,
                    'camera_id' => $camera_id,
                    'action' => 'UV',
                    'status' => ACTION_REQUESTED,
                );
                $actions = DB::table('actions')->where($query);
                $action  = $actions->first();
                if ($action) {
                    /* search Photo */
                    $query = array(
                        'id' => $action->photo_id,
                        'camera_id' => $camera_id,
                    );
                    $photos = DB::table('photos')->where($query);
                    $photo = $photos->first();
                    if ($photo) {
                        if (isset($request->blockid)) {
                            $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                            $err = $ret['err'];
                        } else {
                            $file = $request->Image;
                            if ($file && $file->isValid()) {
                                $ret = $uploader->save_file($camera_id, $file);
                                $err = $ret['err'];
                            } else {
                                $err = ERR_NO_UPLOAD_FILE;
                            }
                        }
                    } else {
                        $err = ERR_INVALID_PHOTO_ID;
                    }
                } else {
                    $err = ERR_INVALID_REQUEST_ID;
                }
            } else {
                $err = ERR_NO_REQUEST_ID;
            }

            if ($err == 0) {
                $filesize = $ret['filesize'];

                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $request->FileName;
                $param['imagename'] = $ret['imagename'];
                //$param['extension'] = $ret['extension'];
                $param['filesize'] = $ret['filesize'];

                /* update Plan */
                $points = $this->Plan_Update($param, 1);
                $param['points'] = $points;

                /* update Photo */
                $data = [];
                $data['action'] = 0;
                $data['uploadtype'] = 4; // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                $data['resolution'] = $request->upload_resolution;
                //$data['photo_compression'] = $request->photo_compression;
                $data['imagename'] = $ret['imagename'];
//                $data['savename'] = $ret['savename'];
                $data['original_name'] = $ret['savename'];
                $data['filesize'] = $filesize;
                $data['points'] = $points;
                $photos->update($data);

                /* update Camera Status */
                $this->Camera_Status_Update($param, 'upload', 1);

                /* update Action */
                $data = [];
                $data['status'] = ACTION_COMPLETED;
                $data['completed'] = date('Y-m-d H:i:s');
                $data['photo_cnt'] = 1;
                $actions->update($data);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('uploadvideo', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function imagemissing(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
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

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('imagemissing', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    public function videomissing(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
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

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('videomissing', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
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
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            //$version = '20180816'; // TODO
            $firmware = DB::table('firmwares')
                ->where(['model' => $camera->model_id, 'active' => 1])
                ->first();
            if ($firmware) {
                $version = $firmware->version;
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
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('firmwareinfo', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*{"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na",
       "RequestID":"4980","version":"20180720"}*/
    public function firmware(Request $request) {
        $model_id = $request->model_id;
        $firmware = DB::table('firmwares')
            ->where(['model' => $model_id, 'active' => 1])
            ->first();
        if ($firmware) {
            $version = $firmware->version;
            if ($firmware->type == 1) {
                $filename = 'IMAGE.ZIP';
            } else {
                $filename = 'IMAGE.BIN';
            }
            /* /firmware/lookout-na/20180816/IMAGE.ZIP */
            $pathToFile = public_path().'/firmware/'.$model_id.'/'.$version.'/'.$filename;

            // TODO: check file exist
            return response()->download($pathToFile, $filename);
        }
    }

    public function firmwaredone(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
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

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('firmwaredone', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    public function firmwarefail(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
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

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('firmwarefail', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function cardfull(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            /* send email */

        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('cardfull', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function formatdone(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
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

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('formatdone', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
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
        $user_id = $ret['user_id'];
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

                $response = $this->Response_Result($err, $camera);

                $action = $this->Action_FindFirst($camera->id, ACTION_PENDING);
                if ($action) {
                    $response['RequestID'] = (string) $action->id;
                }

                if ($user_id && $camera) {
                    $this->LogApi_Add('schedule_start', 1, $user_id, $camera->id, $request, $response);
                }

            } else if ($request->status == 'finish') {
                if ($request->RequestID) {
                    $param['request_id'] = $request->RequestID;
                    //$param['photo_id'] = ;
                    //$param['photo_cnt'] = ;
                    $this->Action_Completed($param);
                }

                $response = $this->Response_Result($err, $camera);
                if ($user_id && $camera) {
                    $this->LogApi_Add('schedule_finish', 1, $user_id, $camera->id, $request, $response);
                }

            } else if ($request->status == 'abort') {
                if ($request->RequestID) {
                    $param['request_id'] = $request->RequestID;
                    $this->Action_Failed($param);
                    //$this->Action_Aborted($param);
                }
                $response = $this->Response_Result($err, $camera);
                if ($user_id && $camera) {
                    $this->LogApi_Add('schedule_abort', 1, $user_id, $camera->id, $request, $response);
                }
            }
        }
        return $response;
    }


    /*----------------------------------------------------------------------------------*/
    //{"iccid":"89860117851014783507","module_id":"861107030190590","model_id":"lookout-na","status":"enable","RequestID":"3"}
    public function logstatus(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {

                if ($request->status == 'enable') {
                    $action_code = 'LE';
                } else {
                    $action_code = 'LU';
                }

                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => $action_code,
                );
                $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('logstatus', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

/*
{
    "iccid": "89860117851014783481",
    "module_id": "861107032685597",
    "model_id": "lookout-na",
    "RequestID": "2",
    "log": []
}
*/
    //{"ResultCode":0,"ActionCode":"LU","ParameterList":{"REQUESTID":"4"},"DateTimeStamp":"2018-10-18 06:08:25"}
    public function uploadlog(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;
            //if (isset($request->RequestID)) {
                /* search Action */
                //$query = array(
                //    'id' => $request->RequestID,
                //    'camera_id' => $camera_id,
                //    'action' => 'LU',
                //    'status' => ACTION_REQUESTED,
                //);
                //$actions = DB::table('actions')->where($query);
                //$action  = $actions->first();
                //if ($action) {

                    /* search Photo */
                    //$query = array(
                    //    'id' => $action->photo_id,
                    //    'camera_id' => $camera_id,
                    //);
                    //$photos = DB::table('photos')->where($query);
                    //$photo = $photos->first();
                    //if ($photo) {
                        $filename = 'LOG.TXT';
                        if (isset($request->blockid)) {
                            $ret =$this->uploadblock_merge($camera, $filename, $request->blockid, $request->crc32);
                            $err = $ret['err'];
                        } else {
                            //$file = $request->Image;
                            $file = $request->log;
                            if ($file && $file->isValid()) {
                                $ret = $uploader->save_log($camera_id, $file);
                                $err = $ret['err'];
                            } else {
                                $err = ERR_NO_UPLOAD_FILE;
                            }
                        }

                    //} else {
                    //    $err = ERR_INVALID_PHOTO_ID;
                    //}
                //} else {
                //    $err = ERR_INVALID_REQUEST_ID;
                //}
            //} else {
            //    $err = ERR_NO_REQUEST_ID;
            //}

            if ($err == 0) {
                $filesize = $ret['filesize'];

                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $request->FileName;
                $param['imagename'] = $ret['imagename'];
                $param['savename'] = $ret['savename'];
                //$param['extension'] = $ret['extension'];
                $param['filesize'] = $ret['filesize'];

                /* update Camera Status */
                $this->Camera_Status_Update($param, 'log');

                /* update Action */
                if ($request->RequestID) {
                    $param = array(
                        'request_id'  => $request->RequestID,
                        'camera_id'   => $camera->id,
                        'action_code' => 'LU',
                    );
                    $this->Action_Completed($param);
                }

                //$data = [];
                //$data['status'] = ACTION_COMPLETED;
                //$data['completed'] = date('Y-m-d H:i:s');
                ////$data['photo_cnt'] = 1;
                //$actions->update($data);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('uploadlog', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    /* Common Functions */
    public function CameraFieldValueConvert($camera, $column, $name) {
        //if ($name == 'off') {
        //    $name = 'Off';
       //
        //} else if ($name == 'on') {
        //    $name = 'On';
       //
        //} else
        if ($column == 'camera_mode') {
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
            $name = $free . ' GB (' . $percent . '% free)';

        //} elseif ($column == 'points_used') {
        //    $used    = $name;
        //    $size    = $camera['points'];
        //
        //    if ($size > 0) {
        //        $percent = round(($used / $size) * 100, 0);
       //
        //        $used = number_format($used, 2, '.', '');
        //        $name = $used . ' (' . $percent . '%free)';
        //    }
        }
        return $name;
    }

    public function CameraPanelBody($id, $lists) {
        $camera = Camera::findOrFail($id);

        $handle = '';
        foreach ($lists as $key => $value) {
            $field_name  = $key;
            $field_value = $camera[$key];
            $field_title = $value;
            $field_text  = $this->CameraFieldValueConvert($camera, $field_name, $field_value);
//$field_text  = $field_value;

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
    /* TAB Function
    /*----------------------------------------------------------------------------------*/
    /* TAB Overview */
    public function OverviewStatus($camera) {
        $lists = array(
            'description'  => 'Description',
//            'location'     => 'Location',
            'module_id'    => 'Module ID',
            'iccid'        => 'SIM ICCID',
//            'points'       => 'Plan Points',
//            'points_used'  => 'Points Used',
//            'model_id'     => 'Model',
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
//            'cellularpw'        => 'Cellular Password',
//            'remotecontrol'     => 'Remote Control',
//            'blockmode1'        => 'Block Mode 1',
//            'blockmode2'        => 'Block Mode 2',
//            'blockmode3'        => 'Block Mode 3',
//            'blockmode4'        => 'Block Mode 4',
//            'blockmode5'        => 'Block Mode 5',
//            'blockmode7'        => 'Block Mode 7',
//            'blockmode8'        => 'Block Mode 8',
//            'blockmode9'        => 'Block Mode 9',
//            'blockmode10'       => 'Block Mode 10',
//            'blockmode11'       => 'Block Mode 11',
        );

        $handle = $this->CameraPanelBody($camera->id, $lists);
        return $handle;
    }

    public function OverviewEvent($camera) {
        $lists = array(
//            'last_contact'     => 'Last Contact',
            'last_armed'       => 'Last Armed',
            'arm_photos'       => 'Photos since armed',
            'arm_points'       => 'Points since armed',
            'last_hb'          => 'Last Heartbeat',
            'last_photo'       => 'Last Photo',
//            'last_schedule'    => 'Last Scheduled Upload',
            'last_settings'    => 'Last Settings',
//            'expected_contact' => 'Expected Contact',
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
    /* TAB Gallery */
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

    public function Camera_Gallery_Photo($camera, $photos) {
        $handle = '';
        $camera_id = $camera->id;
        $column = 1;
        $col = 12/$camera->columns;
        foreach ($photos as $photo) {
            $photo_id = $photo->id;

            $source = $this->TXT_Source($photo->source);
            $resolution = $this->TXT_UploadResolution($photo->resolution);
            $quality = $this->TXT_UploadQuality($photo->photo_quality);

            if ($photo->filetype == 2) {
                // PICT0004.MP4 | 10/16/2018 9:13:31 am | Time Lapse | Standard Low | Points: 2.00 (Video Cost: 0 pts)
                $caption = sprintf('%s | %s | %s | %s | Points: %.2f', $photo->filename, $photo->datetime, $source, $resolution, $photo->points);
            } else {
                // PICT0055.JPG | 10/15/2018 6:14:02 am | Menu       | Standard Low (Q=Standard) | Points: 1.00
                $caption = sprintf('%s | %s | %s | %s (Q=%s) | Points: %.2f', $photo->filename, $photo->datetime, $source, $resolution, $quality, $photo->points);
            }
            $title = sprintf('%s (%d)', $photo->filename, $photo->id); // PICT0001.JPG (1)
//            $filepath = sprintf('/uploads/%d/%s', $camera_id, $photo->savename);
            $filepath = sprintf('/uploads/%d/%s', $camera_id, $photo->thumb_name);
            $download = sprintf('/cameras/download/%d/%d', $camera_id, $photo_id);

            $handle .= '<div class="col-xs-'.$col.' custom-thumbnail-grid-column column-number-'.$column.'">';
            $handle .=     '<div class="image-checkbox">';
            $handle .=         '<label style="font-size: 1.5em" class="check-label hidden">';
            $handle .=             '<input type="checkbox" class="image-check" value="'.$photo_id.'" id="check_'.$photo_id.'" />';
            $handle .=             '<span class="cr span-cr"></span>';
            $handle .=         '</label>';
            $handle .=     '</div>';

            /* pending request */
            $hidden = ($photo->action) ? '' : 'hidden';
            $handle .=     '<div class="image-highdef pull-right" '.$hidden.' id="pending-'.$photo_id.'">';
            $handle .=         '<label style="font-size: 1.0em; margin-right: 4px;">';
            $handle .=             '<span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>';
            $handle .=         '</label>';
            $handle .=     '</div>';

            if (!$photo->action) {
                // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                if ($photo->uploadtype == 2) {
                    $handle .= '<div class="image-highdef pull-right">';
                    $handle .= '    <label style="font-size: 1.5em; margin-right: 4px;">';
                    $handle .= '        <span class="cr"><i class="cr-icon fa fa-camera" style="color:lime;"></i></span>';
                    $handle .= '    </label>';
                    $handle .= '</div>';
                } else if ($photo->uploadtype == 3) {
                    $handle .=     '<div class="image-highdef pull-right">';
                    $handle .=         '<label style="font-size: 1.5em; margin-right: 4px;">';
                    $handle .=             '<span class="cr"><i class="cr-icon fa fa-play-circle" style="color:lime;"></i></span>';
                    $handle .=         '</label>';
                    $handle .=     '</div>';
                }
            }

            if ($photo->uploadtype == 4) { /* original video */
                $videopath = sprintf('/uploads/%d/%s', $camera_id, $photo->original_name);

                $handle .= '<div class="thumb-anchor">';
                $handle .=     '<img src="'.$filepath.'"';
                $handle .= '        class="img-responsive custom-thumb"';
                $handle .=         'title="'.$title.'" ';
                $handle .=         'alt="'.$photo->filename.'" ';
                $handle .=         'data-description="'.$photo->filename.'">';
                $handle .= '</div>';

                $handle .= '<div class="popup-video" video-url="'.$videopath.'"';
                //$handle .=     'data-caption="PICT0003.MP4 | 10/26/2018 12:26:44 am | Motion | Standard Low | Points: 24.00" ';
                $handle .=     'data-caption="'. $caption.'"';
                $handle .=     'data-camera="'.$camera_id.'" ';
                $handle .=     'data-id="'.$photo_id.'" ';
                $handle .=     'data-poster="" ';
                $handle .=     'data-width="640" ';
                $handle .=     'data-height="360" controls>';
                $handle .= '</div>';

            } else {
                if ($photo->uploadtype == 2) {
                    $photo_path = sprintf('/uploads/%d/%s', $camera_id, $photo->original_name);
                } else {
                    $photo_path = $filepath;
                }

                $handle .= '<a class="thumb-anchor" data-fancybox="gallery-'.$camera_id.'" ';
                //$handle .=     'href="'.$filepath.'" ';
                $handle .=     'href="'.$photo_path.'" ';
                $handle .=     'data-caption="'. $caption.'"';
                $handle .=     'data-camera="'.$camera_id.'" ';
                $handle .=     'data-id="'.$photo_id.'" ';
                $handle .=     'data-highres="0" ';
                $handle .=     'data-pending="0">';

                $handle .=     '<img src="'.$filepath.'"';
                $handle .=         'class="img-responsive custom-thumb"';
                $handle .=         'title="'.$title.'" ';
                $handle .=         'alt="'.$photo->filename.'" ';
                $handle .=         'data-description="'.$photo->filename.'">';
                $handle .= '</a>';
            }

            $handle .=     '<p class="thumbnail-timestamp pull-right" style="font-size: .70em">';
            $handle .=         '<a href="'.$download.'"><i class="fa fa-download"></i></a> ';
            $handle .=         $photo->datetime;
            $handle .=     '</p>';
            $handle .= '</div>';

            if ($column == $camera->columns) {
                $column = 1;
            } else {
                $column++;
            }
        }
        return $handle;
    }

    /*----------------------------------------------------------------------------------*/
    /* TAB Settings */
    public function Settings_Body($id, $lists) {
        // $id = $camera->id;
        $camera = Camera::findOrFail($id);

        $handle = '';
        foreach ($lists as $key => $value) {
            $field_name  = $key;
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

            $zz = $id.'_'.$field_name;

            /* Camera Mode:camera_mode=p */
            // $handle .= '<div>'.$title.':'.$field_name.'='.$field_value.'</div>';

            /*
                <div class="form-group" id="field-wrapper-54-cameramode">
                    <label class="col-md-4 control-label" for="inputSmall">Camera Mode</label>
                    <div class="col-md-7">
                        <select id="54_cameramode" class="bs-select form-control input-sm" name="54_cameramode">
                            <option value="p" selected="selected">Photo</option>
                            <option value="v">Video</option>
                        </select>
                ** OR **
                        <input type="text" class="form-control input-sm" id="54_xxx" name="54_xxx" maxlength="30" value="yyy" placeholder="zzz">
                ** OR **
                        <input type="text" class="form-control input-sm" id="54_xxx" name="54_xxx" pattern="[0-9]{6}" value="yyy" placeholder="zzz">

                        <span class="help-block"> .....</span>
                    </div>
                </div>
            */
            //$handle .= '<div class="form-group hidden" id="field-wrapper-'.$id.'-'.$field_name.'">';
            $handle .= '<div class="form-group" id="field-wrapper-'.$id.'-'.$field_name.'">';
            $handle .=      '<label class="col-md-4 control-label" for="inputSmall">'.$title.'</label>';
            $handle .=      '<div class="col-md-7">';

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
                //<select class="bs-select form-control input-sm" id="54_cameramode" name="54_cameramode">
                $handle .= '<select class="bs-select form-control input-sm" id="'.$zz.'" name="'.$zz.'">';
                foreach ($options as $option) {
                    if ($option['value'] == $field_value) {
                        //<option value="p" selected="selected">Photo</option>
                        $handle .= '<option value="'.$option['value'].'" selected="selected">'.$option['name'].'</option>';
                    } else {
                        //<option value="v">Video</option>
                        $handle .= '<option value="'.$option['value'].'">'.$option['name'].'</option>';
                    }
                }
                $handle .= '</select>';
            }

            if (!empty($help)) {
                // $handle .= '<span class="help-block">'.$help.'</span>';
            }
            $handle .=      '</div>';
            $handle .= '</div>';
        }
        //$handle .= '<hr>';
        return $handle;
    }

    public function Settings_Region($region) {
        $regions = array(
            'USA' => array(
                'title' => 'United States',
                'options' => array(
                    array('name'=>'Eastern Time',                   'value'=>'America/New_York'),
                    array('name'=>'Central Time',                   'value'=>'America/Chicago'),
                    array('name'=>'Mountain Time',                  'value'=>'America/Denver'),
                    array('name'=>'Mountain Time (no DST)',         'value'=>'America/Phoenix'),
                    array('name'=>'Pacific Time',                   'value'=>'America/Los_Angeles'),
                    array('name'=>'Alaska Time',                    'value'=>'America/Anchorage'),
                    array('name'=>'Hawaii-Aleutian',                'value'=>'America/Adak'),
                    array('name'=>'Hawaii-Aleutian Time (no DST)',  'value'=>'Pacific/Honolulu'),
                ),
            ),
            'CA' => array(
                'title' => 'Canada',
                'options' => array(
                    array('name'=>'Atlantic',       'value'=>'Canada/Atlantic'),
                    array('name'=>'Central',        'value'=>'Canada/Central'),
                    array('name'=>'Eastern',        'value'=>'Canada/Eastern'),
                    array('name'=>'Mountain',       'value'=>'Canada/Mountain'),
                    array('name'=>'Newfoundland',   'value'=>'Canada/Newfoundland'),
                    array('name'=>'Pacific',        'value'=>'Canada/Pacific'),
                    array('name'=>'Saskatchewan',   'value'=>'Canada/Saskatchewan'),
                    array('name'=>'Yukon',          'value'=>'Canada/Yukon'),

                ),
            ),
            'AU' => array(
                'title' => 'Australia',
                'options' => array(
                    array('name'=>'Adelaide',       'value'=>'Australia/Adelaide'),
                    array('name'=>'Brisbane',       'value'=>'Australia/Brisbane'),
                    array('name'=>'Broken_Hill',    'value'=>'Australia/Broken_Hill'),
                    array('name'=>'Currie',         'value'=>'Australia/Currie'),
                    array('name'=>'Darwin',         'value'=>'Australia/Darwin'),
                    array('name'=>'Eucla',          'value'=>'Australia/Eucla'),
                    array('name'=>'Hobart',         'value'=>'Australia/Hobart'),
                    array('name'=>'Lindeman',       'value'=>'Australia/Lindeman'),
                    array('name'=>'Lord_Howe',      'value'=>'Australia/Lord_Howe'),
                    array('name'=>'Melbourne',      'value'=>'Australia/Melbourne'),
                    array('name'=>'Perth',          'value'=>'Australia/Perth'),
                    array('name'=>'Sydney',         'value'=>'Australia/Sydney'),
                ),
            ),
            'CN' => array(
                'title' => 'China',
                'options' => array(
                    array('name'=>'Hong_Kong',       'value'=>'Asia/Hong_Kong'),
                ),
            ),
            'EU' => array(
                'title' => 'Europe',
                'options' => array(
                    array('name'=>'Amsterdam',      'value'=>'Europe/Amsterdam'),
                    array('name'=>'Andorra',        'value'=>'Europe/Andorra'),
                    array('name'=>'Astrakhan',      'value'=>'Europe/Astrakhan'),
                    array('name'=>'Athens',         'value'=>'Europe/Athens'),
                    array('name'=>'Belgrade',       'value'=>'Europe/Belgrade'),
                    array('name'=>'Berlin',         'value'=>'Europe/Berlin'),
                    array('name'=>'Bratislava',     'value'=>'Europe/Bratislava'),
                    array('name'=>'Brussels',       'value'=>'Europe/Brussels'),
                    array('name'=>'Bucharest',      'value'=>'Europe/Bucharest'),
                    array('name'=>'Budapest',       'value'=>'Europe/Budapest'),
                    array('name'=>'Busingen',       'value'=>'Europe/Busingen'),
                    array('name'=>'Chisinau',       'value'=>'Europe/Chisinau'),
                    array('name'=>'Copenhagen',     'value'=>'Europe/Copenhagen'),
                    array('name'=>'Dublin',         'value'=>'Europe/Dublin'),
                    array('name'=>'Gibraltar',      'value'=>'Europe/Gibraltar'),
                    array('name'=>'Guernsey',       'value'=>'Europe/Guernsey'),
                    array('name'=>'Helsinki',       'value'=>'Europe/Helsinki'),
                    array('name'=>'Isle_of_Man',    'value'=>'Europe/Isle_of_Man'),
                    array('name'=>'Istanbul',       'value'=>'Europe/Istanbul'),
                    array('name'=>'Jersey',         'value'=>'Europe/Jersey'),
                    array('name'=>'Kaliningrad',    'value'=>'Europe/Kaliningrad'),
                    array('name'=>'Kiev',           'value'=>'Europe/Kiev'),
                    array('name'=>'Kirov',          'value'=>'Europe/Kirov'),
                    array('name'=>'Lisbon',         'value'=>'Europe/Lisbon'),
                    array('name'=>'Ljubljana',      'value'=>'Europe/Ljubljana'),
                    array('name'=>'London',         'value'=>'Europe/London'),
                    array('name'=>'Luxembourg',     'value'=>'Europe/Luxembourg'),
                    array('name'=>'Madrid',         'value'=>'Europe/Madrid'),
                    array('name'=>'Malta',          'value'=>'Europe/Malta'),
                    array('name'=>'Mariehamn',      'value'=>'Europe/xMariehamnxxx'),
                    array('name'=>'Minsk',          'value'=>'Europe/Minsk'),
                    array('name'=>'Monaco',         'value'=>'Europe/Monaco'),
                    array('name'=>'Moscow',         'value'=>'Europe/Moscow'),
                    array('name'=>'Oslo',           'value'=>'Europe/Oslo'),
                    array('name'=>'Paris',          'value'=>'Europe/Paris'),
                    array('name'=>'Podgorica',      'value'=>'Europe/Podgorica'),
                    array('name'=>'Prague',         'value'=>'Europe/Prague'),
                    array('name'=>'Riga',           'value'=>'Europe/Riga'),
                    array('name'=>'Rome',           'value'=>'Europe/Rome'),
                    array('name'=>'Samara',         'value'=>'Europe/Samara'),
                    array('name'=>'San_Marino',     'value'=>'Europe/San_Marino'),
                    array('name'=>'Sarajevo',       'value'=>'Europe/Sarajevo'),
                    array('name'=>'Saratov',        'value'=>'Europe/Saratov'),
                    array('name'=>'Simferopol',     'value'=>'Europe/Simferopol'),
                    array('name'=>'Skopje',         'value'=>'Europe/Skopje'),
                    array('name'=>'Sofia',          'value'=>'Europe/Sofia'),
                    array('name'=>'Stockholm',      'value'=>'Europe/Stockholm'),
                    array('name'=>'Tallinn',        'value'=>'Europe/Tallinn'),
                    array('name'=>'Tirane',         'value'=>'Europe/Tirane'),
                    array('name'=>'Ulyanovsk',      'value'=>'Europe/Ulyanovsk'),
                    array('name'=>'Uzhgorod',       'value'=>'Europe/Uzhgorod'),
                    array('name'=>'Vaduz',          'value'=>'Europe/Vaduz'),
                    array('name'=>'Vatican',        'value'=>'Europe/Vatican'),
                    array('name'=>'Vienna',         'value'=>'Europe/Vienna'),
                    array('name'=>'Vilnius',        'value'=>'Europe/Vilnius'),
                    array('name'=>'Volgograd',      'value'=>'Europe/Volgograd'),
                    array('name'=>'Warsaw',         'value'=>'Europe/Warsaw'),
                    array('name'=>'Zagreb',         'value'=>'Europe/Zagreb'),
                    array('name'=>'Zaporozhye',     'value'=>'Europe/Zaporozhye'),
                    array('name'=>'Zurich',         'value'=>'Europe/Zurich'),
                ),
            ),
        );
        return $regions[$region];
    }

    public function Settings_Option($id, $label, $options, $field_name, $field_value) {
        $zz = $id.'_'.$field_name;

        $handle = '';
        $handle .= '<div class="form-group" id="field-wrapper-'.$id.'-'.$field_name.'">';
        $handle .=      '<label class="col-md-4 control-label" for="inputSmall">'.$label.'</label>';
        $handle .=      '<div class="col-md-7">';
//            $options = $value['options'];
            $handle .= '<select class="bs-select form-control input-sm" id="'.$zz.'" name="'.$zz.'">';
            foreach ($options as $option) {
                if ($option['value'] == $field_value) {
                    //<option value="p" selected="selected">Photo</option>
                    $handle .= '<option value="'.$option['value'].'" selected="selected">'.$option['name'].'</option>';
                } else {
                    //<option value="v">Video</option>
                    $handle .= '<option value="'.$option['value'].'">'.$option['name'].'</option>';
                }
            }
            $handle .= '</select>';
        $handle .=      '</div>';
        $handle .= '</div>';
        return $handle;
    }

    public function Settings_Identification($camera) {
        //return var_dump($this->Settings_Region('USA'));
        $lists = array(
            'description' => array(
                'title'       => 'Camera Description',
                'type'        => 'input',
                'format'      => 'maxlength="30"',
                'placeholder' => 'Input Camera Description',
                'help'        => '',
            ),

            //'location'    => array(
            //    'title'       => 'Camera Location',
            //    'type'        => 'input',
            //    'format'      => 'maxlength="30"',
            //    'placeholder' => 'Input Camera Location',
            //    'help'        => '',
            //),

            'region' => array(
                'title' => 'Camera Region',
                'options' => array(
                    array('name'=>'United States',  'value'=>'USA'),
                    array('name'=>'Canada',         'value'=>'CA'),
                    array('name'=>'Australia',      'value'=>'AU'),
                    array('name'=>'China',          'value'=>'CN'),
                    array('name'=>'Europe',         'value'=>'EU'),
                ),
                'help'    => '',
            ),
        );

        $handle = $this->Settings_Body($camera->id, $lists);

        //$region = $this->Settings_Region('USA');
        $region = $this->Settings_Region($camera['region']);
        $label = 'Time Zone';
        $options = $region['options'];
        $field_name = 'timezone';
        $field_value = $camera[$field_name];
        $handle .= $this->Settings_Option($camera->id, $label, $options, $field_name, $field_value);

        return $handle;
    }

    public function Settings_Basic($camera) {
        $lists = array(
            'camera_mode' => array(
                'title' => 'Camera Mode',
                'options' => array(
                    array('name' => 'Photo', 'value' => 'p'),
                    array('name' => 'Video', 'value' => 'v'),
                ),
                'help'    => '',
            ),

            /* photo */
            'photo_resolution' => array(
                'title' => 'Photo Resolution',
                'options' => array(
                    array('name' => '4MP 16:9', 'value' => '4'),
                    array('name' => '6MP 16:9', 'value' => '6'),
                    array('name' => '8MP 16:9', 'value' => '8'),
                    array('name' => '12MP 16:9', 'value' => '12'),
                ),
                'help' => 'Use this setting to control the size of the Photo saved on the SD Card.',
            ),
            'photo_burst' => array(
                'title' => 'Photo Burst',
                'options' => array(
                    array('name' => '1', 'value' => '1'),
                    array('name' => '2', 'value' => '2'),
                    array('name' => '3', 'value' => '3'),
                ),
                'help' => 'Photo Burst is used to set the number of photos captured per event in Photo Mode. It is not used for Video mode. If Cellular mode is ON, then the camera will upload each photo of the burst to the portal.',
            ),
            'burst_delay' => array(
                'title' => 'Burst Delay',
                'options' => array(
                    array('name' => '250ms', 'value' => '250'),
                    array('name' => '500ms', 'value' => '500'),
                    array('name' => '1s', 'value' => '1000'),
                    array('name' => '3s', 'value' => '3000'),
                ),
                'help' => 'The Burst Delay is the elapsed time between each burst photo.',
            ),
            'upload_resolution' => array(
                'title' => 'Upload Resolution',
                'options' => array(
                    array('name' => 'Standard Low', 'value' => '1'),
                    array('name' => 'Standard Medium', 'value' => '2'),
                    array('name' => 'Standard High', 'value' => '3'),
                    array('name' => 'High Def', 'value' => '4'),
                ),
                'help' => 'Use this setting to control the size of the uploaded thumbnail.',
            ),
            'photo_quality' => array(
                'title' => 'Upload Quality',
                'options' => array(
                    array('name' => 'Standard', 'value' => '1'),
                    array('name' => 'Medium', 'value' => '2'),
                    array('name' => 'High', 'value' => '3'),
                ),
                'help' => 'Use this setting to control the image quality and size of the uploaded thumbnail. A higher quality means clearer images but larger file sizes when uploaded to the portal. Use a Photo quality that best meets your application and budget. [Standard] quality will reduce the size and cost to upload each photo to the portal and is generally good enough for most applications. Keep in mind that you can request a High-res Max or the Original file from the SD card when/if you need it for more detail on this particular photo event.',
            ),

            /* video */
            'video_resolution' => array(
                'title' => 'Video Resolution',
                'options' => array(
                    array('name' => 'Standard Low', 'value' => '8'),
                    array('name' => 'Standard Medium', 'value' => '9'),
                    array('name' => 'Standard High', 'value' => '10'),
                    array('name' => 'High Def', 'value' => '11'),
                ),
                'help' => 'This determines the frame size of the video in pixels, or how wide it is when viewed on your computer monitor. A higher resolution means the video file saved to the SD card is larger and when uploaded uses more battery and costs more image points from your data plan, but it will have more detail on the other hand.',
            ),
            'video_fps' => array(
                'title' => 'Frame Rate',
                'options' => array(
                    array('name' => '4fps', 'value' => '4'),
                    array('name' => '6fps', 'value' => '6'),
                    array('name' => '8fps', 'value' => '8'),
                    array('name' => '10fps', 'value' => '10'),
                    array('name' => '12fps', 'value' => '12'),
                    array('name' => '15fps', 'value' => '15'),
                    array('name' => '30fps', 'value' => '30'),
                ),
                'help' => 'Capture rate does not affect the size of the video file captured or reduce the points used to upload to the portal. A lower frame rate in low motion will improve the quality of each frame while motion blur may increase. A faster frame rate may reduce motion blur when there is higher motion and may reduce the image quality of each frame. Every environment is different. Please experiment to find the right value for your environment and needs.',
            ),
            'video_bitrate' => array(
                'title' => 'Quality Level',
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
                'help' => 'Use quality level to control the image quality for each frame in the video. A higher value will increase quality while also increasing the size of the file captured. If you frequently make video upload requests you may want a lower quality in order to minimize image points used in your data plan. There is no set quality level for a particular application. Please experiment with video quality to achieve an acceptable balance for your environment and budget.',
            ),
            'video_length' => array(
                'title' => 'Video Length',
                'options' => array(
                    array('name' => '2s', 'value' => '2'),
                    array('name' => '3s', 'value' => '3'),
                    array('name' => '4s', 'value' => '4'),
                    array('name' => '5s', 'value' => '5'),
                    array('name' => '6s', 'value' => '6'),
                    array('name' => '7s', 'value' => '7'),
                    array('name' => '8s', 'value' => '8'),
                    array('name' => '9s', 'value' => '9'),
                    array('name' => '10s', 'value' => '10'),
                ),
                'help' => 'Note: The longer the duration, the larger the video file will be if uploaded to the portal.',
            ),
            'video_sound' => array(
                'title' => 'Video Sound',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),

            /* other */
            'timestamp' => array(
                'title' => 'Time Stamp',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'date_format' => array(
                'title' => 'Date Format',
                'options' => array(
                    array('name' => 'mdY', 'value' => 'mdY'),
                    array('name' => 'Ymd', 'value' => 'Ymd'),
                    array('name' => 'dmY', 'value' => 'dmY'),
                ),
                'help' => '',
            ),
            'time_format' => array(
                'title' => 'Time Format',
                'options' => array(
                    array('name' => '12 Hour', 'value' => '12'),
                    array('name' => '24 Hour', 'value' => '24'),
                ),
                'help' => '',
            ),
            'temp_unit' => array(
                'title' => 'Temperature',
                'options' => array(
                    array('name' => 'Fahrenheit', 'value' => 'f'),
                    array('name' => 'Celsius', 'value' => 'c'),
                ),
                'help' => '',
            ),
        );

        $handle = $this->Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Settings_Trigger($camera) {
        $lists = array(
            'quiettime' => array(
                'title' => 'Quiet Time',
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
                'help' => 'Quiet Time is a delay after the current event is complete (photo or video). It can be used to reduce the number of PIR events in a given time. If your camera is taking too many photos or videos, then increase the quiet time to reduce the frequency of PIR (motion) activations. PIR or motion capture, as well as Time Lapse capture is disabled while sleeping in the quiet time period.',
            ),

        );

        $handle = $this->Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Settings_Timelapse($camera) {
        $lists = array(
            'tls_start' => array(
                'title' => 'Timelapse Start Time',
                'type' => 'hhmm',
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
                'help' => '',
            ),

            'tls_stop' => array(
                'title' => 'Timelapse Stop Time',
                'type' => 'hhmm',
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
                'help' => '',
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
                'help' => '',
            ),
        );

        $handle = $this->Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Settings_Wireless_Mode($camera) {
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
            'hb_interval' => array(
                'title' => 'Heartbeat Interval',
                'options' => array(
                    array('name' => 'Every Hour', 'value' => '1h'),
                    array('name' => 'Every 2 Hours', 'value' => '2h'),
                    array('name' => 'Every 4 Hours', 'value' => '4h'),
                    array('name' => 'Every 8 Hours', 'value' => '8h'),
                    array('name' => 'Every 12 Hours', 'value' => '12h'),
                ),
                'help' => 'This timer will fire on the whole hour and will send a status to the server. The mobile app will recieve a notification when this occurs. This lets you know your camera is still functioning and its curent status. It will also process any pending Action items you have queued like High-Res Max, Video, Original, Settings.',
            ),
            'online_max_time' => array(
                'title' => 'Max Online Time',
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
                'help' => 'Use this setting to control the amount of time the camera will remain online, per event, processing queued action requests. A shorter time means the camera can return to PIR mode more quickly and continue capturing Photo and Video, otherwise the camera is busy and may miss PIR events due to queue processing. A longer time means your queued Action items should get completed sooner if the queue is large.',
            ),
            'cellularpw' => array(
                'title' => 'Cellular Password',
                'type' => 'input',
                //'pattern' => '[0-9]{6}',
                'format' => 'pattern="[0-9]{6}"',
                'placeholder' => 'Input Cellular Password',
                'help' => 'Input 6 digits. Blank for no password. If you input a password, it is required when you power the camera into Setup mode. This means if your camera is stolen, the thief is not able to set cellular mode to OFF, which means he can only use the camera in cellular mode.',
            ),
            //'remotecontrol' => array(
            //    'title' => 'Remote Control',
            //    'options' => array(
            //        array('name' => 'Disabled', 'value' => 'off'),
            //        array('name' => '24 Hour', 'value' => '24h'),
            //    ),
            //    'help' => 'This option will cause the camera to sleep in a high power state waiting on SMS commands from the network. It will use more battery power at rest in this mode. You will see additional buttons on the Actions tab, used to wake your camera up immediately. When clicked, those buttons [SNAP] and [WAKE] will send an SMS message to wake the camera up. [SNAP] will cause the camera to capture a photo or video and upload it to the portal. The camera will then process any Action items you have queued up.',
            //),

        );

        $handle = $this->Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Settings_Block_Mode($camera) {
        $lists = array(
            'blockmode1' => array(
                'title' => 'Block Mode 1',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode2' => array(
                'title' => 'Block Mode 2',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode3' => array(
                'title' => 'Block Mode 3',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode4' => array(
                'title' => 'Block Mode 4',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode5' => array(
                'title' => 'Block Mode 5',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),

            'blockmode7' => array(
                'title' => 'Block Mode 7',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode8' => array(
                'title' => 'Block Mode 8',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode9' => array(
                'title' => 'Block Mode 9',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode10' => array(
                'title' => 'Block Mode 10',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
            'blockmode11' => array(
                'title' => 'Block Mode 11',
                'options' => array(
                    array('name' => 'On', 'value' => 'on'),
                    array('name' => 'Off', 'value' => 'off'),
                ),
                'help' => '',
            ),
        );

        $handle = $this->Settings_Body($camera->id, $lists);
        return $handle;
    }

    public function Settings_DutyTime($camera) {
        $hour = array(
            '12 AM', '01 AM', '02 AM', '03 AM', '04 AM', '05 AM',
            '06 AM', '07 AM', '08 AM', '09 AM', '10 AM', '11 AM',
            '12 PM', '01 PM', '02 PM', '03 PM', '04 PM', '05 PM',
            '06 PM', '07 PM', '08 PM', '09 PM', '10 PM', '11 PM',
        );

        $dt_week = array(
            'dt_sun','dt_mon','dt_tue','dt_wed','dt_thu','dt_fri','dt_sat',
        );

        $id = $camera->id;

        $handle = '';
        for ($week=0; $week<7; $week++) {
            $tabs_id = 'tabs'.$id.'-'.($week+1); // tabs54-1
            $control_group = 'controlgroup'.$id.'-'.($week+1); // controlgroup54-1

            $value = hexdec($camera[$dt_week[$week]]);
            $bit = 0x800000;

            $handle .= '<div id="'.$tabs_id.'">';
            $handle .=    '<div id="'.$control_group.'" class="mobile-dutytime-div">';
            $handle .=        '<table>';
            for ($h=0; $h<24; $h++) {
                $zz = $id.'_hour_'.($week+1).'_'.($h+1); //54_hour_1_1
                if (($h%6) == 0) {
                    $handle .= '<tr>';
                }

                /*
                    <td class="custom-time-toggle-td">
                    <span class="button-checkbox" style="font-size: .80em;">
                        <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                        <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_1" id="54_hour_1_1"  checked />
                    </span>
                    </td>
                */
                $handle .= '<td class="custom-time-toggle-td">';
                $handle .= '<span class="button-checkbox" style="font-size: .80em;">';
                $handle .=     '<button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">'.$hour[$h].'</button>';
                //$handle .=     '<input type="checkbox" class="hidden custom-time-button" name="54_hour_1_1" id="54_hour_1_1"  checked />';
                if ($value & $bit) {
                    $handle .=   '<input type="checkbox" class="hidden custom-time-button" name="'.$zz.'" id="'.$zz.'" checked />';
                } else {
                    $handle .=   '<input type="checkbox" class="hidden custom-time-button" name="'.$zz.'" id="'.$zz.'" />';
                }
                $handle .= '</span>';
                $handle .= '</td>';
                if (($h+1)%6 == 0) {
                    $handle .= '</tr>';
                }

                $bit >>= 1;
            }
            $handle .=        '</table>';
            $handle .=    '</div>';
            $handle .= '</div>';
        }
        return $handle;
    }

    /*----------------------------------------------------------------------------------*/
    /* TAB Actions */

    /*----------------------------------------------------------------------------------*/
    /* TAB Options */

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
            <a class="btn thumb-select" data-id="54" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;">
                <img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz,,," class="img-responsive" />
            </a>
        </td>
    </tr>
    */
    public function Camera_List($active_camera_id) {
        //return $active_camera_id;

        $user    = Auth::user();
        $user_id = $user->id;
        $cameras = DB::table('cameras')
            //->select('id', 'description', 'battery', 'last_contact', 'last_filename', 'last_savename')
            ->where('user_id', $user_id)
            ->get();

        $style  = 'padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;';
        $handle = '';
        foreach ($cameras as $camera) {
            $camera_id    = $camera->id;
            $description  = $camera->description;
            $battery      = $this->CameraFieldValueConvert($camera, 'battery', $camera->battery);
            $last_contact = $camera->last_contact;

            if (!empty($camera->last_savename)) {
                //$url = 'http://sample.test/uploads/images/'.$camera->last_filename;
                //$url = url('/uploads/images/').$camera->last_filename; // NG
                // $url = url('/uploads/images/').'/'.$camera->last_filename;
                $url = url('/uploads/'.$camera_id.'/').'/'.$camera->last_savename;
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
            $handle .= $battery.'<br/>';
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
    /* Web Function */

    public function activetab() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $sel_camera_tab = $_POST['tab'];
        $data['sel_camera_tab'] = $sel_camera_tab;
        Auth::user()->update($data);
        return $sel_camera_tab;
    }

    // https://blog.csdn.net/woshihaiyong168/article/details/52992812
    //public function cameras($camera_id) {
    public function cameras() {
        if (!Auth::check()) {
            //session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $user_id = $user->id;
        $camera_id = $user->sel_camera;

        $data['sel_menu'] = 'camera';
        $user->update($data);

        //$camera = DB::table('cameras')
        //    ->select('id', 'description', 'battery', 'last_contact', 'last_filename')
        //    ->where('user_id', $user_id)
        //    ->first();

        $cameras = DB::table('cameras')
            ->where('user_id', $user_id);

        if ($cameras->count() > 0) {
            //$camera = Camera::findOrFail($camera_id);
            $camera = Camera::find($camera_id);
            if (!$camera) {
                $camera = Camera::first();
            }

            $photos = $camera->photos()
                ->orderBy('created_at', 'desc')
                ->paginate($camera->thumbs);
            //return view('cameras', compact('user', 'camera', 'photos'));
            return view('cameras', compact('user', 'cameras', 'camera', 'photos'));
        } else {
            return view('cameras_empty', compact('user'));
        }
    }

    public function delete(Request $request) {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        //{"_token":"Gx4z780KFvDst56qycsDMh4gSx3bF2vkBtsLUmmR","id":"1","password":"kevin816"}
        //return $request;

        //if (Auth::attempt(['password' => $request->password])) {
        //    return 'OK';
        //} else {
        //    return 'NG';
        //}

        //$camera = DB::table('cameras')->find($request->id); // NG
        $camera = Camera::find($request->id); // OK
        if ($camera) {
            $camera->delete();
            $camera->photos()->delete();
            $camera->actions()->delete();
            $camera->log_apis()->delete();
        }
        return redirect()->route('cameras');
    }

    public function download($camera_id, $photo_id) {
        //return 'camera_id='.$camera_id.', photo_id='.$photo_id;

        //$user   = Auth::user();
        $camera = Camera::findOrFail($camera_id);
        $photos = $camera->photos()->where('id', $photo_id);
        //$photos = DB::table('photos')->where('id', $photo_id);
        $photo  = $photos->first();

        /* /uploads/camera_id/1539695099_2Q7NJJh7ur.ZIP */
        $pathToFile = public_path().'/uploads/'.$camera_id.'/'.$photo->thumb_name;

        // TODO: check file exist
        return response()->download($pathToFile, $photo->imagename);
    }

    /* /cameras/getdetail/{camera_id} */
    public function getdetail($camera_id) {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $data['sel_camera'] = $camera_id;
        $user->update($data);
        return redirect()->route('cameras');
    }

    public function gallery(Request $request) {
        //$medialist = $_POST['medialist'];
        //{"id":"1","action":"d","medialist":"[\"check_22\"]"}
        //return $request;

        $action = $request->action;
        $param = array(
            'camera_id'   => $request->id,
            'status'      => ACTION_REQUESTED,
        );

        $medialist = json_decode($request->medialist);
        foreach ($medialist as $media) {
            /*
                Array(
                    [0] => check
                    [1] => 22
                )
            */
            $x = explode("_", $media);
            $photo_id = $x[1];
            //echo $photo_id; echo '<br>';

            $photo = Photo::findOrFail($photo_id);
            $filename = $photo->filename;
            //echo $filename; echo '<br>';

            if ($photo->action == 0) {
                if ($action == 'd') {
                    $photo->delete();

                } else if ($action == 'h') {
                    //if ($photo->filetype == 1) {
                    // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                    if ($photo->uploadtype == 1) {
                        $param['action_code'] = 'UO';
                        $param['photo_id'] = $photo_id;
                        $param['filename'] = $filename;
                        $param['image_size'] = 5;
                        $param['compression'] = 28; //$compression;
                        $this->Action_Add($param);

                        $data['action'] = 1;
                        $photo->update($data);
                    }

                } else if ($action == 'o') {
                    //if ($photo->filetype == 1) {
                    // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                    if ($photo->uploadtype == 1) {
                        $param['action_code'] = 'UO';
                        $param['photo_id'] = $photo_id;
                        $param['filename'] = $filename;
                        $param['image_size'] = 6;
                        $this->Action_Add($param);

                        $data['action'] = 1;
                        $photo->update($data);
                    }

                } else if ($action == 'v') {
                    //if ($photo->filetype == 2) {
                    // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                    if ($photo->uploadtype == 3) {
                        $param['action_code'] = 'UV';
                        $param['photo_id'] = $photo_id;
                        $param['filename'] = $filename;
                        $this->Action_Add($param);

                        $data['action'] = 1;
                        $photo->update($data);
                    }
                }
            }
        }
        return redirect()->route('cameras');
    }

    public function gallerylayout($camera_id, $number) {
        $cameras = DB::table('cameras')->where('id', $camera_id);
        $cameras->update(['columns' => $number]);
        return redirect()->route('cameras');
    }

    public function gallerythumbs($camera_id, $number) {
        $cameras = DB::table('cameras')->where('id', $camera_id);
        $cameras->update(['thumbs' => $number]);
        return redirect()->route('cameras');
    }

    //public function activetab(Request $request) {
    //    return $request;
    //}

    public function overview($cameras_id) {
        //return '/cameras/overview/'.$cameras_id;
        $camera = Camera::findOrFail($cameras_id);
        return view('camera.tab_overview', compact('camera'));
    }

    //public function actions($cameras_id) {
    //    $ret = '/cameras/actions/' . $cameras_id;
    //    return $ret;
    //}

    public function actions($cameras_id) {
        //return '/cameras/actions/'.$cameras_id;
        $camera = Camera::findOrFail($cameras_id);
        return view('camera.tab_actions', compact('camera'));
    }

    public function settings(Request $request) {
        $Control_Settings = array(
            /* Identification Settings */
            "description",
            "location",
            "region",
            "timezone",

            /* Basic Settings */
            "camera_mode",
            "photo_resolution",
            "photo_burst",
            "burst_delay",
            "upload_resolution",
            "photo_quality",
            "video_resolution", "video_fps", "video_bitrate", "video_length", "video_sound",
            "timestamp", "date_format", "time_format",
            "temp_unit",

            /* Trigger Settings */
            "quiettime",

            /* Wireless Settings */
            "wireless_mode", "wm_schedule", "wm_sclimit",
            "hb_interval",
            "online_max_time",
            "cellularpw",
//            "remotecontrol",
        );

        $Timelapse_Settings = array(
            "timelapse","tls_start","tls_stop","tls_interval",
        );

        $Block_Mode_Settings = array(
            "blockmode1","blockmode2","blockmode3","blockmode4","blockmode5",
            "blockmode7","blockmode8","blockmode9","blockmode10","blockmode11",
        );

        $dt_week = array(
            'dt_sun','dt_mon','dt_tue','dt_wed','dt_thu','dt_fri','dt_sat',
        );

        $camera_id = $request->id;

        for ($week=1; $week<=7; $week++) {
            $value = 0;
            $bit = 0x800000;
            for ($hour=1; $hour<=24; $hour++) {
                $zz = $camera_id.'_hour_'.$week.'_'.$hour; //54_hour_1_1
                if($request[$zz]) {
                    $value |= $bit;
                }
                $bit >>= 1;
            }
            $key = $dt_week[$week-1];
            $data[$key] = sprintf("%06x", $value);
        }
        //return var_dump($data);
//        return $data;

        foreach ($Control_Settings as $key) {
            //$name = $camera_id.'_'.$key;
            //$data[$key] = $request[$name];
            if (isset($request[$camera_id.'_'.$key])) {
                $data[$key] = $request[$camera_id.'_'.$key];
            }
        }
//return $data;

        if (isset($request[$camera_id.'_timelapse'])) {
            foreach ($Timelapse_Settings as $key) {
                $data[$key] = $request[$camera_id.'_'.$key];
            }
        } else {
            $data['timelapse'] = 'off';
        }

        if (isset($request[$camera_id.'_dutytime'])) {
            $data['dutytime'] = 'on';
            //foreach ($Timelapse_Settings as $key) {
            //    $data[$key] = $request[$camera_id.'_'.$key];
            //}
        } else {
            $data['dutytime'] = 'off';
        }

        foreach ($Block_Mode_Settings as $key) {
            if (isset($request[$camera_id.'_'.$key])) {
                $data[$key] = $request[$camera_id.'_'.$key];
            }
        }
//return $data;

        $cameras = DB::table('cameras')->where('id', $camera_id);
        $cameras->update($data);

        $ret = $this->Action_Search($camera_id, 'DS', ACTION_REQUESTED);
        if ($ret == 0) {
            $param = array(
                'camera_id'   => $camera_id,
                'action_code' => 'DS',
                'status'      => ACTION_REQUESTED,
            );
            $this->Action_Add($param);
        }

        //$camera = Camera::findOrFail($camera_id);
        //return view('camera.tab_settings', compact('camera'));
        return redirect()->route('cameras');
    }

    /* Action */
    public function sendsms($camera_id, $sms) {
        $ret = '/cameras/sendsms/'.$camera_id.'/'.$sms;
        return $ret;

        if ($sms == 'snap') {
            // send SMS 'snap'
        } else if ($sms == 'wake') {
            // send SMS 'wake'
        }
    }

    public function actionqueue($camera_id, $action_code) {
        /* /cameras/actionqueue/2/LD */
        //$ret = '/cameras/actionqueue/'.$camera_id.'/'.$action_code;
        //return $ret;

        $camera = Camera::find($camera_id);
        if ($camera) {
            $ret = $this->Action_Search($camera_id, $action_code, ACTION_REQUESTED);
            if ($ret == 0) {
                $param = array(
                    'camera_id'   => $camera_id,
                    'action_code' => $action_code,
                    'status'      => ACTION_REQUESTED,
                );
                $this->Action_Add($param);
            }
            return view('camera.tab_actions', compact('camera'));

        } else {
            session()->flash('warning', 'camera not found');
            return redirect()->route('cameras');
        }
    }

    public function actionqueue_post(Request $request) {
        /*
            {
                "_token":"D6RyLJ5esCNGbgPPcw6D18sAgY9X3UZQNsesJDvO",
                "id":"2",
                "action":"FC",
                "password":"12345"
            }
        */
        //return $request;

        $camera_id = $request->id;
        $action_code = $request->action;

        $ret = $this->Action_Search($camera_id, $action_code, ACTION_REQUESTED);
        if ($ret == 0) {
            $param = array(
                'camera_id'   => $camera_id,
                'action_code' => $action_code,
                'status'      => ACTION_REQUESTED,
            );
            $this->Action_Add($param);
        }

        //$camera = Camera::find($camera_id);
        //return view('camera.tab_actions', compact('camera'));
        return redirect()->back();
    }

    public function actioncancel($action_id) {
        /* /cameras/actioncancel/18 */
        //$ret = '/cameras/actioncancel/'.$action_id;
        //return $ret;

        $actions = DB::table('actions')->where('id', $action_id);
        $action  = $actions->first();
        if ($action) {
            $camera_id = $action->camera_id;
            $data['status'] = ACTION_CANCELLED;
            $data['completed'] = date('Y-m-d H:i:s');
            $actions->update($data);

            $photo_id = $action->photo_id;
            if ($photo_id) {
                $photo = Photo::findOrFail($photo_id);
                $filename = $photo->filename;

                $data['action'] = 0;
                $photo->update($data);
            }
        }

        $camera = Camera::findOrFail($camera_id);
        return view('camera.tab_actions', compact('camera'));
    }

    public function clearmissing($cameras_id) {
        //return '/cameras/clearmissing/'.$cameras_id;
        $camera = Camera::findOrFail($camera_id);
        return view('camera.tab_actions', compact('camera'));
    }

    public function requestmissing($cameras_id, $missing_id) {
        //return '/cameras/requestmissing/'.$cameras_id.'/'.$missing_id;
        $camera = Camera::findOrFail($camera_id);
        return view('camera.tab_actions', compact('camera'));
    }

    //public function emailpolicy() {
    //    $user   = Auth::user();
    //    //$camera = Camera::findOrFail($camera_id);
    //    $camera = Camera::find($camera_id);
    //    $photos = $camera->photos()
    //        ->orderBy('created_at', 'desc')
    //        ->paginate(10);
    //
    //    return view('support.emailpolicy', compact('user', 'camera', 'photos'));
    //}

    //public function account_profile() {
    //    if (!Auth::check()) {
    //        session()->flash('warning', 'Please Login first');
    //        return redirect()->route('login');
    //    }
    //
    //    $user = Auth::user();
    //    $data['sel_menu'] = 'account';
    //    $user->update($data);
    //    return view('account.profile', compact('user'));
    //}

    /*----------------------------------------------------------------------------------*/
    public function admin() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    public function admin_users() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $users = DB::table('users')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);

        //return view('admin.users', compact('user', 'users'));
        return view('admin.user', compact('users'));
    }

    public function admin_email() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $emails = DB::table('emails')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.email', compact('user', 'emails'));
    }

    public function admin_cameras() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $cameras = DB::table('cameras')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.camera', compact('user', 'cameras'));
    }

    public function admin_plans() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $plans = DB::table('plans')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.plan', compact('user', 'plans'));
    }

    public function admin_firmware() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $firmwares = DB::table('firmwares')->get();
        return view('admin.firmware', compact('user', 'firmwares'));
    }

    public function admin_sims() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $sims = DB::table('sims')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.sim', compact('user', 'sims'));
    }

    public function admin_rmas() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('admin.rma', compact('user'));
    }

    public function admin_siteactivity() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('admin.siteactivity', compact('user'));
    }

    public function admin_apilog() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $log_apis = DB::table('log_apis')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.apilog', compact('user', 'log_apis'));
    }

    public function admin_viewlog() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('admin.viewlog', compact('user'));
    }

    /* search */
    public function admin_user_search(Request $request) {
        //return 'admin_user_search';
        //{"_token":"J6pv3ftu1s5fbRGolbBgMIPd9kG0KQuuQKEGbxOB","email":null,"username":null}
        return $request;
    }

    public function admin_email_search(Request $request) {
        return $request;
    }

    public function admin_camera_search(Request $request) {
        return $request;
    }

    public function admin_api_search(Request $request) {
        return $request;
    }

    /* clear search */
    public function admin_clear_search_users() {
        return 'admin_clear_search_users';
    }

    public function admin_clear_search_cameras() {
        return 'admin_clear_search_cameras';
    }

    public function admin_clear_search_sims() {
        return 'admin_clear_search_sims';
    }

    public function admin_clear_search_apilog() {
        return 'admin_clear_search_apilog';
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
}

/*
// https://laravelacademy.org/post/6140.html
$users = DB::table('users')->select('name', 'email as user_email')->get();

// 强制查询返回不重复的结果�?$users = DB::table('users')->distinct()->get();

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

// 原生表达�?$users = DB::table('users')
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