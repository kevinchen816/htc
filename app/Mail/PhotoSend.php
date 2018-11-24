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
        //return $this->from('kevin@10ware.com')
        //            ->view('emails.photo');
        return $this->view('emails.photo');
    }
}
