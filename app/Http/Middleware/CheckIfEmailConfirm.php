<?php

namespace App\Http\Middleware;

use Closure;

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
            return redirect(route('email_confirm.notice'));
        }
        return $next($request);
    }
}
