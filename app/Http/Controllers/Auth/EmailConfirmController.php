<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\User;
use Cache;
use Illuminate\Http\Request;

use App\Notifications\EmailConfirmNotification;
use Mail;

class EmailConfirmController extends Controller
{
    public function verify(Request $request) {
        $email = $request->input('email');
        $token = $request->input('token');

        if (!$email || !$token) {
            throw new Exception('The link is incorrect.');
        }

        if ($token != Cache::get('email_confirm_'.$email)) {
            throw new Exception('This confirm token token is invalid.');
        }

        if (!$user = User::where('email', $email)->first()) {
            throw new Exception('The user not exist.');
        }

        Cache::forget('email_confirm_'.$email);

        $user->update(['email_verified' => true]);

        return view('auth.email_confirm_success', ['msg' => 'Account Registration Email Verification.']);
    }

    public function send(Request $request) {
        $user = $request->user();

        if ($user->email_verified) {
            throw new Exception('Account Registration Done.');
        }

        $user->notify(new EmailConfirmNotification());

        return view('auth.email_confirm_success', ['msg' => 'Resend Confirmation Email Success.']);
    }

    public function notice(Request $request) {
        //return view('auth.email_confirm_notice');
        return view('auth.confirm');
    }
}
