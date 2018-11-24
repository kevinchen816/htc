<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfEmailConfirm
{
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
               return response()->json(['msg' => 'Please verify email address'], 400);
            }

            //Auth::logout();
            return redirect(route('confirm.notice'));
        }
        return $next($request);
    }
}
