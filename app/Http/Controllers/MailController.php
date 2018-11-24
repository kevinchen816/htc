<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Storage;

use App\Mail\PhotoSend;

class MailController extends Controller
{
    public function send() {
        $to = 'kevin@10ware.com';
        $subject = '测试邮件';

        //Mail::raw('Hello World !!', function ($message) use($to, $subject) {
        //    $message ->to($to)->subject($subject);
        //});

        $name = 'Hello';
        $imgPath = public_path().'/uploads/1/1541262076_Z1udRRMbPW.JPG';
        Mail::send('emails.test', ['name'=>$name, 'imgPath'=>$imgPath], function($message) use($to, $subject) {
            $message ->to($to)->subject($subject);

            $attachment = storage_path('test.jpg');
            $message->attach($attachment, ['as'=>'photo.jpg']);
            //$message->attach($attachment,['as'=>"=?UTF-8?B?".base64_encode('照片')."?=.jpg"]);
        });

        // Mail::send()的返回值为空，所以可以其他方法进行判断
        // 返回的一个错误数组，利用此可以判断是否发送成功
        if (count(Mail::failures()) < 1) {
            echo '发送邮件成功，请查收！';
        } else {
            echo '发送邮件失败，请重试！';
        }
    }

    /*----------------------------------------------------------------------------------*/
    public function email_photo_send($user, $camera, $filename) {
        $imgPath = public_path().'/uploads/'.$camera->id.'/'.$filename;

        $param = array(
            'user_name'=>$user->name,
            'camera_name'=>$camera->description,
            'imgPath'=>$imgPath,
        );

        $to = $user->email;
        $subject = $camera->description;
        Mail::send('emails.photo', $param, function($message) use($to, $subject) {
            $message ->to($to)->subject($subject);
        });
    }

    public function email_photo_queue($user, $camera, $filename) {
        $imgPath = public_path().'/uploads/'.$camera->id.'/'.$filename;

        //Mail::to($request->user())->send(new PhotoSend());
        //Mail::to('kevin@10ware.com')->send(new PhotoSend($user->name, $camera->description, $imgPath));
        Mail::to($user->email)->queue(new PhotoSend($user->name, $camera->description, $imgPath));
    }
}
