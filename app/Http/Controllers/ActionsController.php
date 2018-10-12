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

    /*
        <tr>
            <td>Scheduled Update</td>
            <td>Completed</td>
            <td>09/10/2018 1:31:14 pm</td>
            <td>09/10/2018 1:34:53 pm</td>
            <td>49 photos uploaded.</td>
        </tr>
    */
    public function History($camera) {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

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
            ->orderBy('requested', 'desc')
            ->get();

        $handle = '';
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
                $status_txt = 'Request';
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
            }

            //$requested_time =  date_format($action->requested, "Y/m/d H:i:s");
            //$completed_time =  date_format($action->completed, "Y/m/d H:i:s");

            $handle .= '<tr>';
            $handle .=     '<td>'.$action_txt.'</td>';
            if ($action->status == ACTION_REQUESTED) {
                $handle .= '<td><a class="btn btn-xs btn-success action-cancel-'.$camera_id.'" data-param="'.$action_id.'">Cancel</a></td>';
            } else {
                $handle .= '<td>'.$status_txt.'</td>';
            }
            $handle .=     '<td>'.$action->requested.'</td>'; // $requested_time
            $handle .=     '<td>'.$action->completed.'</td>'; // $completed_time
            $handle .=     '<td>'.$note.'</td>';
            $handle .= '</tr>';
        }
        return $handle;
    }
}
