<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

//class PhotoSend extends Mailable
class PhotoSend extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user_name;
    public $camera_name;
    public $imgPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $camera_name, $imgPath)
    {
        $this->user_name = $user_name;
        $this->camera_name = $camera_name;
        $this->imgPath = $imgPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$subject = $this->$camera_name;
        return $this->view('emails.photo');
        //return $this->from('kevin@10ware.com')
        //            ->subject($subject)
        //            ->view('emails.photo');
    }
}


/*
http://sample.test:8025/

.env
MAIL_DRIVER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
*/

/*
MAIL_DRIVER=smtp
MAIL_HOST=smtp.exmail.qq.com
MAIL_PORT=465
MAIL_USERNAME=no-reply@10ware.com
MAIL_PASSWORD=Caperplus7002
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=no-reply@10ware.com
MAIL_FROM_NAME=no-reply
*/

/*
Success: You are now registered, but your account is not yet confirmed.
Please look in your inbox for a confirmation email and click the Verify link.
*/