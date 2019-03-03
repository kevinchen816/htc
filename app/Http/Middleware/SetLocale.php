<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use Debugbar;

class SetLocale
{
    // const SESSION_KEY = 'locale';
    // const LOCALES = ['en', 'zh-CN', 'zh-TW'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('APP_REGION') == 'cn') {
            return $next($request);
        }

        // if (Session::has('locale') && in_array(Session::get('locale'), ['en', 'zh'])) {
        //     App::setLocale(Session::get('locale'));
        // } else {
        //     App::setLocale('en');
        // }

        $langArray = array('en', 'zh-cn', 'zh-CN', 'zh-tw', 'zh-TW', 'de');

        // Debugbar::debug($request->server('HTTP_ACCEPT_LANGUAGE'));
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            // zh-TW,zh;q=0.9,en-US;q=0.8,en;q=0.7,zh-CN;q=0.6
            Debugbar::debug($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        } else {
            $languages[0] = 'en';
        }
        Debugbar::debug($languages);

        // if (Session::has('locale') && in_array(Session::get('locale'), $langArray)) {
        if (Session::has('locale')) {
            Debugbar::debug('locale='.Session::get('locale'));
            App::setLocale(Session::get('locale'));
        } else {
            if (in_array($languages[0], $langArray)) {
                Debugbar::debug('$languages[0]='.$languages[0]);
                App::setLocale($languages[0]);
            } else {
                Debugbar::debug('use default=en');
                App::setLocale('en');
            }
        }

        Debugbar::debug('getLocale()='.App::getLocale());
        return $next($request);
    }
}