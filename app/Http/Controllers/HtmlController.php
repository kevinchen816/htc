<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Browser;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

// https://packagist.org/packages/hisorange/browser-detect
// composer require hisorange/browser-detect

class HtmlController extends Controller
{
    // public function get_template_dir() {
    //     if (BrowserDetect::isMobile()) {
    //         return $this->mobile_template_dir;
    //     } elseif (BrowserDetect::isTablet()) {
    //         return $this->tablet_template_dir;
    //     } else {
    //         return $this->pc_template_dir;
    //     }
    // }

    public function changeLocale($locale) {
        if (in_array($locale, ['en', 'zh'])) {
            session()->put('locale', $locale);
        }
        return redirect()
            ->back()
            ->withInput();
    }

    public function getLocale_EN() {
        session()->put('locale', 'en');
        return redirect()
            ->back()
            ->withInput();

        // App::setLocale('en');
        // return redirect()->route('home');
    }

    public function getLocale_DE() {
        session()->put('locale', 'de');
        return redirect()
            ->back()
            ->withInput();
    }

    public function getLocale_CN() {
        session()->put('locale', 'zh-CN');
        return redirect()
            ->back()
            ->withInput();
    }

    public function getLocale_TW() {
        session()->put('locale', 'zh-TW');
        return redirect()
            ->back()
            ->withInput();
    }

    /*----------------------------------------------------------------------------------*/
    public function html_LoginExt() {
        if (Browser::isDesktop()) {
            return view('auth.login_ext');
        }
    }

    /*----------------------------------------------------------------------------------*/
    public function html_Footer() {
        // $ret = Browser::isDesktop();
        if (Browser::isDesktop()) {
            return view('layouts._footer');
        }

        // $txt = '';
        // $txt .= '<footer id="footer" class="container-fluid">';
        // $txt .=     '<section id="top-footer" class="row">';
        // $txt .=         '<div class="col-lg-12 col-md-12 col-xs-12 footer-list">';
        // $txt .=             '<div class="row">';
        // $txt .=                 '<div class="col-md-4 col-sm-4 footer-list-item">';
        // $txt .=                     '<div class="address alert" style="background-color:#444; height: 200px;">';
        // $txt .=                         '<p><strong>Australia</strong></p>';
        // $txt .=                         '<p>Unit 11, 189 Anzac Avenue</p>';
        // $txt .=                         '<p>Toowoomba, Queensland 4350</p>';
        // $txt .=                         '<p>Tel: 1300 544 249</p>';
        // $txt .=                         '<p>info@outdoorcameras.com.au</p>';
        // $txt .=                         '<p></p>';
        // $txt .=                         '<a>https://outdoorcameras.com.au/</a>';
        // $txt .=                     '</div>';
        // $txt .=                 '</div>';
        // $txt .=                 '<div class="col-md-4 col-sm-4 footer-list-item">';
        // $txt .=                     '<div class="address alert" style="background-color:#444; height: 200px;">';
        // //$txt .=                         <!--<p><strong>Contact</strong></p>-->
        // $txt .=                         '<p>Technical Support</p>';
        // //$txt .=                         <!--<p><a href="tel:x-xxx-xxx-xxx">x-xxx-xxx-xxx</a></p>-->
        // $txt .=                         '<p><a href="mailto:xxx@xxx.com">support@kmcampro.com</a></p>';
        // $txt .=                     '</div>';
        // $txt .=                 '</div>';
        // $txt .=             '</div>';
        // $txt .=         '</div>';
        // $txt .=     '</section>';
        // $txt .=     '<section class="row" id="footer-bottom">';
        // $txt .=         '<div class="col-sm-12 text-center">';
        // $txt .=             '<p class="copyright">&copy;2018 KMCam Pro All rights reserved.</p>';
        // $txt .=         '</div>';
        // $txt .=     '</section>';
        // $txt .= '</footer>';
        // return $txt;
    }
}