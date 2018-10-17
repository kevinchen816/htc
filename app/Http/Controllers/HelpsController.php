<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class HelpsController extends Controller
{
    public function terms(Request $request) {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        //$data['sel_menu'] = 'help';
        //$user->update($data);
        return view('help.terms', compact('user'));
    }

    public function plans() {
        if (!Auth::check()) {
            //session()->flash('warning', 'Please Login first');
            //return redirect()->route('login');
            return view('help.plans');
        }

        $user = Auth::user();
        $data['sel_menu'] = 'help';
        $user->update($data);
        return view('help.plans', compact('user'));
    }

    public function quick_start(Request $request) {
        //if (!Auth::check()) {
        //    session()->flash('warning', 'Please Login first');
        //    return redirect()->route('login');
        //}

        if (Auth::check()) {
            $user = Auth::user();
            $data['sel_menu'] = 'support';
            $user->update($data);
            return view('help.quick-start', compact('user'));
        } else {
            return view('help.quick-start');
        }
    }
}
