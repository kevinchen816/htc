<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class HelpsController extends Controller
{
    public function terms(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            return view('help.terms', compact('user'));

        } else {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }
    }

    public function plans() {
        if (Auth::check()) {
            $user = Auth::user();
            return view('help.plans', compact('user'));
        } else {
            return view('help.plans');
        }
    }

    public function quick_start(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            return view('help.quick-start', compact('user'));

        } else {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }
    }
}
