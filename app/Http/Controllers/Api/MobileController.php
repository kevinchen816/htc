<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DB;

use App\Models\Mobile;
// use App\Models\LogApi;

class MobileController extends Controller
{
    public function postAccountCheck(Request $request) {
// return 'OK';
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $ResultCode = 0;
            $ret['ResultCode'] = 0;

            // $user = Auth::user();
            // $ret['id'] = $user->id;
            Auth::logout();

        } else {
            // $ResultCode = 1;
            $ret['ResultCode'] = 1;
        }

        // $ret['ResultCode'] = $ResultCode;
        return $ret;
    }

    /*----------------------------------------------------------------------------------*/
    public function mobileadd(Request $request) {
        // $logapi = new LogApi;
        // $logapi->user_id = 1;
        // $logapi->camera_id = 1;
        // $logapi->imei = 'imei';
        // $logapi->iccid = 'iccid';
        // $logapi->api = 'ajax_test';
        // $logapi->request = json_encode($request->all()); // string
        // // $logapi->response = json_encode($response);
        // $logapi->save();

        $device_id = $request->device_id;
        $mobile = DB::table('mobiles')->where('device_id', $device_id)->first();
        if ($mobile) {
            $mobile = Mobile::find($mobile->id);
            $flag = 0;

            $ret['id'] = $mobile->id;
            // $ret['device_id'] = $mobile->device_id;

            if ($mobile->push_id != $request->push_id) {
                $mobile->push_id = $request->push_id;
                $mobile->change = $mobile->change+1;
                $update['push_id'] = $mobile->push_id;
                $flag = 1;
            }

            if ($mobile->name != $request->name) {      // 设备名称 (KK)
                $mobile->name = $request->name;
                $update['name'] = $mobile->name;
                $flag = 1;
            }

            // if ($mobile->model != $request->model) { // 设备型号 (iPhone 4S)
            //     $mobile->model = $request->model;
            //     $update['model'] = $mobile->model;
            //     $flag = 1;
            // }

            // if ($mobile->os != $request->os) {       // 系统类型 (ios)
            //     $mobile->os = $request->os;
            //     $update['os'] = $mobile->os;
            //     $flag = 1;
            // }

            if ($mobile->ver != $request->ver) {        // 系统版本 (9.2.1)
                $mobile->ver = $request->ver;
                $update['ver'] = $mobile->ver;
                $flag = 1;
            }

            if ($flag) {
                $mobile->save();
                $ret['status'] = 'update';
                $ret = array_merge($ret, $update);
            } else {
                $ret['status'] = 'unchange';
            }

        } else {
            $mobile = new Mobile;
            $mobile->device_id = $device_id;
            $mobile->push_id = $request->push_id;
            $mobile->name = $request->name;     // 设备名称 (KK)
            $mobile->model = $request->model;   // 设备型号 (iPhone 4S)
            $mobile->os = $request->os;         // 系统类型 (ios)
            $mobile->ver = $request->ver;       // 系统版本 (9.2.1)
            $mobile->save();

            $ret['status'] = 'new';
            $ret['id'] = $mobile->id;
        }
        return $ret;
    }

    /*----------------------------------------------------------------------------------*/
    // public function deviceaddX(Request $request) {
    //     $push_id = $request->push_id;
    //     $devices = DB::table('devices')->where('push_id', $push_id)->get();
    //     if ($devices->count() == 0) {
    //         $device = new Device;
    //         $device->user_id = 1; //$user->id;
    //         $device->os = $request->os;         // 系统类型 (ios)
    //         $device->ver = $request->ver;       // 系统版本 (9.2.1)
    //         $device->name = $request->name;     // 设备名称 (KK)
    //         $device->model = $request->model;   // 设备型号 (iPhone 4S)
    //         $device->push_id = $push_id;
    //         $device->save();

    //         $ret['status'] = 1;
    //     } else {
    //         $ret['status'] = 0;
    //     }
    //     return $ret;
    // }
}