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
        return view('sessions.create');
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

            return redirect()->route('cameras');

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
        return redirect('login');
    }
}
