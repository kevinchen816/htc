<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class HelpsController extends Controller
{
    public function terms(Request $request) {
        if (env('APP_REGION') == 'au') {
            $html = 'help.au.terms';
        } else {
            $html = 'help.terms';
        }

        // if (!Auth::check()) {
        //     session()->flash('warning', 'Please Login first');
        //     return redirect()->route('login');
        // }

        if (Auth::check()) {
            $user = Auth::user();
            //$data['sel_menu'] = 'help';
            //$user->update($data);
            // return view('help.terms', compact('user'));
            return view($html, compact('user'));
        } else {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }
    }

    public function plans() {
        if (env('APP_REGION') == 'au') {
            $html = 'help.au.plans';
        } else {
            $html = 'help.plans';
        }

        // if (!Auth::check()) {
        //     // //session()->flash('warning', 'Please Login first');
        //     // //return redirect()->route('login');
        //     // return view('help.plans');
        //     return view($html);
        // }

        if (Auth::check()) {
            $user = Auth::user();
            $data['sel_menu'] = 'help';
            $user->update($data);
            // return view('help.plans', compact('user'));
            return view($html, compact('user'));
        } else {
            return view($html);
        }
    }

    public function quick_start(Request $request) {
        if (env('APP_REGION') == 'au') {
            $html = 'help.au.quick-start';
        } else {
            $html = 'help.quick-start';
        }

        //if (!Auth::check()) {
        //    session()->flash('warning', 'Please Login first');
        //    return redirect()->route('login');
        //}

        if (Auth::check()) {
            $user = Auth::user();
            $data['sel_menu'] = 'support';
            $user->update($data);
            // return view('help.quick-start', compact('user'));
            return view($html, compact('user'));
        } else {
            // return view('help.quick-start');
            return view($html);
        }
    }
}