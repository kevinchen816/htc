<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\CamerasController;
use Illuminate\Http\Request;
use Auth;
use DB;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    /*
        GET    /login       -> create()     // 显示登录页面
        POST   /login       -> store()      // 创建新会话（登录）
        DELETE /logout      -> destroy()    // 销毁会话（退出登录）
    */

    // GET /login
    public function create() {
        //return view('sessions.create');
        $portal = 0;
        $portal_name = '';
        return view('sessions.create', compact('portal', 'portal_name'));
    }

    public function login_10ware() {
        //return view('portal.10ware.sessions.create');
        $portal = 10;
        $portal_name = '10ware';
        return view('sessions.create', compact('portal', 'portal_name'));
    }

    public function login_germany() {
        //return view('portal.germany.sessions.create');
        $portal = 11;
        $portal_name = 'germany';
        return view('sessions.create', compact('portal', 'portal_name'));
    }

    // POST /login
    public function store(Request $request) {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        //return $credentials;

        if (Auth::attempt($credentials, $request->has('remember'))) {
            //session()->flash('success', 'Welcome');

            $user = Auth::user();
            $data['sel_menu'] = 'camera';
            $data['sel_camera_tab'] = 'overview';
            $data['sel_account_tab'] = 'plans';
            $user->update($data);

            $portal = $request->portal;
            if ($portal == 10) {
                return redirect()->route('cameras.10ware');
            } else if ($portal == 11) {
                return redirect()->route('cameras.germany');
            } else {
                return redirect()->route('cameras');
            }
            //return redirect()->route('cameras');

            /* intended 方法，该方法可将页面重定向到上一次请求尝试访问的页面上，
               并接收一个默认跳转地址参数，当上一次请求记录为空时，跳转到默认地址上 */
            //return redirect()->intended(route('cameras'));
        } else {
            session()->flash('danger', 'Error: These credentials do not match our records.');
            return redirect()->back(); // return redirect('/');
        }
    }

    // DELETE /logout
    public function destroy() {
        Auth::logout();
        //session()->flash('success', '您已成功退出！');
        //return redirect('login');
        return redirect()->route('login');
    }

    public function destroy_10ware() {
        Auth::logout();
        //return redirect('admin');
//        return redirect('login');
        //return redirect('login.10ware');
        //return 'logout';

        //$portal = 10;
        //return view('sessions.create', compact('portal'));
        return redirect()->route('login.10ware');
    }

    public function destroy_germany() {
        Auth::logout();
        return redirect()->route('login.germany');
    }
}


