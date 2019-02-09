<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use Debugbar;

class SetLocale
{
    const SESSION_KEY = 'locale';
    // const LOCALES = ['en', 'cs'];
    const LOCALES = ['en', 'zh-CN', 'zh-TW'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $session = $request->getSession();
        // if (!$session->has(self::SESSION_KEY)) {
            // $session->put(self::SESSION_KEY, $request->getPreferredLanguage(self::LOCALES));

            // Debugbar::debug($request->getPreferredLanguage(self::LOCALES));
        // }

        // if (Session::has('locale') && in_array(Session::get('locale'), ['en', 'zh'])) {
        //     App::setLocale(Session::get('locale'));
        // } else {
        //     App::setLocale('en');
        // }

Debugbar::debug($request->server('HTTP_ACCEPT_LANGUAGE'));

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