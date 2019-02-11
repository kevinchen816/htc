<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

/* 1:Request, 2:Completed, 3:Cancelled, 4:Failed, 5:Pending */
const ACTION_REQUESTED              = 1;
const ACTION_COMPLETED              = 2;
const ACTION_CANCELLED              = 3;
const ACTION_FAILED                 = 4;
const ACTION_PENDING                = 5;
//const ACTION_ABORT                = 6;

class ActionsController extends Controller
{

    public function _user_dateformat($user, $datetime) {
        //$dt = date_create('2013-03-15 23:40:00', timezone_open('Europe/Oslo'));
        $dt = '';
        if ($datetime) {
            $dt = date_create($datetime);
            $dt = date_format($dt, $user->date_format);
        }
        return $dt;
    }

    //public function terms(Request $request) {
    //    if (Auth::check()) {
    //        $user = Auth::user();
    //        return view('help.terms', compact('user'));
    //
    //    } else {
    //        session()->flash('warning', 'Please Login first');
    //        return redirect()->route('login');
    //    }
    //}

    /*-----------------------------------------------------------*/
    //public function back_to_login($portal) {
    //    //if (!Auth::check()) {
    //        //session()->flash('warning', 'Please Login first');
    //        //return redirect()->route('login');
    //        if ($portal == 10) {
    //            return redirect()->route('login.10ware');
    //        } else if ($portal == 11) {
    //            return redirect()->route('login.de');
    //        } else {
    //            return redirect()->route('login');
    //        }
    //    //}
    //}

    /*-----------------------------------------------------------*/
    function ts($code) {
        $txt = 'htc.'.$code;
        $trans = trans($txt);
        if (empty($trans) || $trans == $txt) {
            $trans = $code;
        }
        return $trans;
    }

    /*-----------------------------------------------------------*/
    /*
        <tr>
            <td>Scheduled Update</td>
            <td>Completed</td>
            <td>09/10/2018 1:31:14 pm</td>
            <td>09/10/2018 1:34:53 pm</td>
            <td>49 photos uploaded.</td>
        </tr>
    */
    //public function html_History($portal, $user, $camera) {
    public function html_History($user, $camera) {
        //if (!Auth::check()) {
        //    return $this->back_to_login($portal);
        //}

        //$action_txt = array (
        //    'DS' => 'Request Settings Download',
        //    'UO' => 'Request Original', // Request Original - PICT0593.JPG, Request High-Res MAX - PICT0595.JPG
        //    'UV' => 'Request Video', // Request Video - PICT1052.MP4
        //    'SC' => 'Scheduled Updated',
        //    'PS' => 'Request Snap Photo',
        //    'SR' => 'Status Report',
        //    'FW' => 'Request Firmware Update',
        //    'FC' => 'Erase SD Card',
        //    'MP' => 'Request Missing Photo', // Request Missing Photo - PICT1038.JPG
        //);

        $camera_id = $camera->id;
        $actions = DB::table('actions')
            ->where('camera_id', $camera_id)
            // ->orderBy('requested', 'desc') // NG: must consider change timezone issue
            ->orderBy('id', 'desc')
            ->get();

        $txt = '';
        foreach ($actions as $action) {
            $note = '';
            $action_id = $action->id;
            $action_code = $action->action;
            if ($action_code == 'DS') {
                $action_txt = 'Request Settings Download';

            } else if ($action_code == 'UO') {
                if ($action->image_size == 6) {
                    /* Request Original - PICT0593.JPG */
                    $action_txt = 'Request Original - '.$action->filename;
                } else {
                    /* Request High-Res MAX - PICT0595.JPG */
                    $action_txt = 'Request High-Res MAX - '.$action->filename;
                }
            } else if ($action_code == 'UV') {
                /* Request Video - PICT1052.MP4 */
                $action_txt = 'Request Video - '.$action->filename;

            } else if ($action_code == 'SC') {
                /* Scheduled Updated .......... 20 photos uploaded. */
                $action_txt = 'Scheduled Updated';
                $photo_total = $action->last_number - $action->first_number + 1;
                if ($action->status == ACTION_COMPLETED) {
                    $note = $photo_total.' photos uploaded.';
                } else if ($action->status == ACTION_FAILED) {
                    $note = $action->photo_cnt.'/'.$photo_total.' photos uploaded.';
                }

            } else if ($action_code == 'PS') {
                $action_txt = 'Request Snap Photo';
            } else if ($action_code == 'FW') {
                $action_txt = 'Request Firmware Update';
            } else if ($action_code == 'FC') {
                $action_txt = 'Erase SD Card';
            } else if ($action_code == 'MP') {
                $action_txt = 'Request Missing Photo';
            } else if ($action_code == 'LE') {
                $action_txt = 'Enable Debug Log';
            } else if ($action_code == 'LD') {
                $action_txt = 'Disable Debug Log';
            } else if ($action_code == 'LU') {
                $action_txt = 'Upload Debug Log';
            } else if ($action_code == 'SR') {
                $action_txt = 'Status Report';
            } else if ($action_code == 'US') {
                $action_txt = 'Request Settings Upload';
            } else {
                $action_txt = 'Unknown';
            }

            if ($action->status == ACTION_REQUESTED) {
                // $status_txt = 'Request';
                $status_txt = 'Cancel';
            } else if ($action->status == ACTION_COMPLETED) {
                $status_txt = 'Completed';
            } else if ($action->status == ACTION_CANCELLED) {
                $status_txt = 'Cancelled';
            } else if ($action->status == ACTION_FAILED) {
                $status_txt = 'Failed';
            } else if ($action->status == ACTION_PENDING) {
                $status_txt = 'Pending';
            //} else if ($action->status == ACTION_ABORT) {
            //    $status_txt = 'Abort';
            } else {
                $status_txt = 'Unknown';
            }
            $status_txt = $this->ts($status_txt);

            $requested_time = $this->_user_dateformat($user, $action->requested);
            $completed_time = $this->_user_dateformat($user, $action->completed);

            $txt .= '<tr>';
            $txt .=     '<td>'.$action_txt.'</td>';
            if ($action->status == ACTION_REQUESTED) {
                // $txt .= '<td><a class="btn btn-xs btn-success action-cancel-'.$camera_id.'" data-param="'.$action_id.'">Cancel</a></td>';
                $txt .= '<td><a class="btn btn-xs btn-success action-cancel-'.$camera_id.'" data-param="'.$action_id.'">'.$status_txt.'</a></td>';
            } else {
                $txt .= '<td>'.$status_txt.'</td>';
            }
            $txt .=     '<td>'.$requested_time.'</td>';
            $txt .=     '<td>'.$completed_time.'</td>';
            $txt .=     '<td>'.$note.'</td>';
            $txt .= '</tr>';
        }
        return $txt;
    }

    public function html_Commands($camera) {
        $txt = '';
        $camera_id = $camera->id;

        $firmware = DB::table('firmwares')
            ->where(['model' => $camera->model_id, 'active' => 1])
            ->first();
        if ($firmware) {
            $version = $firmware->version;
            // $version = '20190101';
            $zz = $this->ts('Update Firmware to').' ('.$version.')';

            if ($version > $camera->dsp_version) {
                $txt .= '<tr>';
                $txt .=     '<td>';
                // $txt .=         '<a data-param="FW" class="btn btn-sm btn-success action-queue-'.$camera_id.'" camera-id="'.$camera_id.'">Update Firmware to ('.$version.')</a>';
                $txt .=         '<a data-param="FW" class="btn btn-sm btn-success action-queue-'.$camera_id.'" camera-id="'.$camera_id.'">'.$zz.'</a>';
                $txt .=     '</td>';
                $txt .= '</tr>';
            }
        }

        $user = Auth::user();
        if ($user->permission == 1) {
            $txt .= '<tr>';
            $txt .=     '<td>';
            if ($camera->log == 1) {
                $txt .=     '<a data-param="LD" class="btn btn-sm btn-success action-queue-'.$camera_id.'" camera-id="'.$camera_id.'">'.$this->ts('Log Disable').'</a> ';
            } else {
                $txt .=     '<a data-param="LE" class="btn btn-sm btn-success action-queue-'.$camera_id.'" camera-id="'.$camera_id.'">'.$this->ts('Log Enable').'</a> ';
            }
            $txt .=         '<a data-param="LU" class="btn btn-sm btn-success action-queue-'.$camera_id.'" camera-id="'.$camera_id.'">'.$this->ts('Log Upload').'</a> ';
            $txt .=     '</td>';
            $txt .= '</tr>';
        }
        return $txt;
    }
}