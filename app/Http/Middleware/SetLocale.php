<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use Debugbar;

class SetLocale
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

        // if (Session::has('locale') && in_array(Session::get('locale'), ['en', 'zh'])) {
        //     App::setLocale(Session::get('locale'));
        // } else {
        //     App::setLocale('en');
        // }

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale('en');
        }

        // App::setLocale('zh-TW');

Debugbar::debug('.......1');
Debugbar::debug(App::getLocale());
Debugbar::debug('.......2');

        return $next($request);
    }
}