<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Storage;
use DB;

use App\Mail\PhotoSend;

class MailController extends Controller
{
    public function test() {
        $to = 'kevin@10ware.com';
        // $to = '18664933085@163.com';
        // $to = 'kevin2@10ware.com';
        // $to = 'xx18664933089zzkhkhjk@gmail.com';
        // $subject = '测试邮件';
        $subject = 'New Camera';

        Mail::raw('Hello World !!', function ($message) use($to, $subject) {
           $message ->to($to)->subject($subject);
        });

        // $name = 'Hello';
        // $imgPath = public_path().'/uploads/1/1543584581_UG1RNPj2TS.JPG';
        // Mail::send('emails.test', ['name'=>$name, 'imgPath'=>$imgPath], function($message) use($to, $subject) {
        //     $message ->to($to)->subject($subject);

        //     //$attachment = storage_path('test.jpg');
        //     //$message->attach($attachment, ['as'=>'photo.jpg']);
        //     ////$message->attach($attachment,['as'=>"=?UTF-8?B?".base64_encode('照片')."?=.jpg"]);
        // });

        //$imgPath = public_path().'/uploads/1/1543048626_2fqndZFZnT.MP4';
        //Mail::send('emails.video', ['name'=>$name, 'imgPath'=>$imgPath], function($message) use($to, $subject) {
        //    $message ->to($to)->subject($subject);
        //});

        if (count(Mail::failures()) < 1) {
            echo '发送邮件成功';
        } else {
            echo '发送邮件失败';
        }
    }

    /*----------------------------------------------------------------------------------*/
    public function photo_Send($user, $camera, $filename) {
        $imgPath = public_path().'/uploads/'.$camera->id.'/'.$filename;

        //$emails = array(
        //    array('email'=>'kevin@10ware.com', 'name'=>'Kevin'),
        //    array('email'=>'18664933085@163.com', 'name'=>'18664933085'),
        //);

        //$emails = array(
        //    array('email'=>'kevin@10ware.com'),
        //    array('email'=>'18664933085@163.com'),
        //);

        //Mail::to($emails)
        //Mail::to($user) // Kevin<kevin@10ware.com>
        Mail::to($user->email) // kevin<kevin@10ware.com>
            ->queue(new PhotoSend($user->name, $camera->description, $imgPath));

        //Mail::to($request->user())->send(new PhotoSend());
    }
}
