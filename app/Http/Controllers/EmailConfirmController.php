<?php

namespace App\Http\Controllers;

use Exception;
use App\User;
use Cache;
use Illuminate\Http\Request;

use App\Notifications\EmailConfirmNotification;
use Mail;

class EmailConfirmController extends Controller
{
    public function getSend(Request $request) {
        return view('auth.send_confirmation_email');
    }

    // public function notice(Request $request) {
    //     return view('auth.email_confirm_notice');
    // }

    // public function getSend(Request $request) {
    //     $user = $request->user();
    //     if ($user->email_verified) {
    //         // throw new Exception('You have verified your email address.');
    //         session()->flash('success', 'You have verified your email address.');
    //         return redirect(route('login'));
    //     }
    //     // 调用 notify() 方法用来发送我们定义好的通知类
    //     $user->notify(new EmailConfirmNotification());
    //     return view('auth.email_confirm_success', ['msg' => 'Email sent successfully']);
    // }

    public function postSend(Request $request) {
        // {"_token":"...","email":"kevin@10ware.com"}
        $email = $request->email;

        if (!$user = User::where('email', $email)->first()) {
            // throw new Exception('The user is not exist.');
            session()->flash('warning', 'The user is not exist.');
            // return redirect(route('login'));
            return redirect()->back();
        }

        if ($user->email_verified) {
            // throw new Exception('You have verified your email address.');
            session()->flash('warning', 'You have confirmed your email address.');
            return redirect(route('login'));
            // return redirect()->back();
        }

        // 调用 notify() 方法用来发送我们定义好的通知类
        $user->notify(new EmailConfirmNotification());

        session()->flash('success', 'Send confirmation email success.');
        return redirect(route('login'));
        // return view('auth.email_confirm_success', ['msg' => 'Email sent successfully']);
    }

    public function getVerify(Request $request) {
        $email = $request->input('email');
        $token = $request->input('token');

        if (!$email || !$token) {
            // throw new Exception('The link is incorrect.');
            session()->flash('warning', 'The link is incorrect.');
            return redirect(route('login'));
        }

        // 从缓存中读取数据，我们把从 url 中获取的 `token` 与缓存中的值做对比
        // 如果缓存不存在或者返回的值与 url 中的 `token` 不一致就抛出异常。
        if ($token != Cache::get('email_confirm_'.$email)) {
            // throw new Exception('The link is incorrect or has expired.');
            session()->flash('warning', 'The link is incorrect or has expired.');
            return redirect(route('login'));
        }

        // 根据邮箱从数据库中获取对应的用户
        // 通常来说能通过 token 校验的情况下不可能出现用户不存在
        // 但是为了代码的健壮性我们还是需要做这个判断
        if (!$user = User::where('email', $email)->first()) {
            // throw new Exception('The user is not exist.');
            session()->flash('warning', 'The user is not exist.');
            return redirect(route('login'));
        }

        Cache::forget('email_confirm_'.$email);
        $user->update(['email_verified' => true]);

        // session()->flash('success', 'Account Registration Email Verifecation.');
        session()->flash('success', 'Account registration email confirmation.');
        return redirect(route('login'));
        // return redirect(route('home'));
        // return view('auth.email_confirm_success', ['msg' => 'Account Registration Email Verifecation.']);
    }

}

