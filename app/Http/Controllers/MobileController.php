<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\Device;

class MobileController extends Controller
{
    public function getLogin($device_id) {
        return view('mobile.login', ['device_id' => $device_id]);
    }

    public function postLogin(Request $request) {
        // {"_token":"xxx","push_id":"abc","email":"kevin@10ware.com","password":"123456"}
        // return $request;
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'

        ]);

        //if (Auth::attempt(['email' => $email, 'password' => $password])) {
        if (Auth::attempt($credentials)) {
            session()->flash('success', 'Login Successful');
            $this->device_add($request->device_id);
            return redirect()->route('home', [Auth::user()]);
        } else {
            session()->flash('danger', 'Login Fail');
            return redirect()->back()->withInput();
        }
    }

    // public function deviceadd(Request $request) {
    public function device_add($device_id) {
        $user = Auth::user();
        $devices = DB::table('devices')
            ->where([
                    ['user_id', '==', $user->id],
                    ['device_id', '==', $device_id],
            ])
            ->get();
        if ($devices->count() == 0) {
            $device = new Device;
            $device->user_id = $user->id;
            $device->device_id = $user->device_id;
            // $device->os = $request->os;         // 系统类型 (ios)
            // $device->ver = $request->ver;       // 系统版本 (9.2.1)
            // $device->name = $request->name;     // 设备名称 (KK)
            // $device->model = $request->model;   // 设备型号 (iPhone 4S)
            // $device->push_id = $push_id;
            $device->save();

            // $ret['status'] = 1;
        } else {
            // $ret['status'] = 0;
        }
        // return $ret;
    }

    public function mobile_test_add() {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 1;
        }


        $device = new Device;
        $device->user_id = $user_id;
        $device->device_id = '862860042483507';
        // $device->os = 'android';
        // $device->ver = '8.1.0';
        // $device->model = 'MI 8 SE';
        // $device->name = 'Xiaomi';
        // $device->push_id = '190e35f7e005b796d3b';
        $device->save();

        $device = new Device;
        $device->user_id = $user_id;
        $device->device_id = '48840369-5940-4F7A-B11A-E3CD210BF03C';
        // $device->os = 'ios';
        // $device->ver = '9.2.1';
        // $device->model = 'iPhone 4S';
        // $device->name = 'KK';
        // $device->push_id = '13165ffa4e282202377';
        $device->save();

        return 'Add Device OK';
    }
}
