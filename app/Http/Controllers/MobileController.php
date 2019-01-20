<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MobileController extends Controller
{
    public function getLogin() {
    // public function getLogin($push_id) {
// return $push_id;
        return view('mobile.login');
        // return view('mobile.login', compact($push_id));
        // return view('auth.login');
    }

    public function postLogin(Request $request) {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'

        ]);

        //if (Auth::attempt(['email' => $email, 'password' => $password])) {
        if (Auth::attempt($credentials)) {
            session()->flash('success', 'Login Successful');
            return redirect()->route('home', [Auth::user()]);
        } else {
            session()->flash('danger', 'Login Fail');
            return redirect()->back()->withInput();
        }
    }

}
