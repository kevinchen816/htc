<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfEmailConfirm
{
    function ts($code) {
        $txt = 'htc.'.$code;
        $trans = trans($txt);
        if (empty($trans) || $trans == $txt) {
            $trans = $code;
        }
        return $trans;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->email_verified) {

            /* return JSON when request by AJAX */
            if ($request->expectsJson()) {
               return response()->json(['msg' => 'Please verify email address first.'], 400);
            }

            // session()->flash('warning', 'Please verify email address first.');
            // return redirect(route('confirm.notice'));

            // session()->flash('success', 'You are now registered, but your account is not yet confirmed.
            // Please look in your inbox for a confirmation email and click the Verify link.');
            $txt = $this->ts('check_confirm_email');
            session()->flash('success', $txt);

            Auth::logout();
            return redirect(route('login'));
            // return redirect(route('confirm.send'));
        }
        return $next($request);
    }
}