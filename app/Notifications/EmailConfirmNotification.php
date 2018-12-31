<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Str;
use Cache;

class EmailConfirmNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $token = Str::random(16);
        Cache::set('email_confirm_'.$notifiable->email, $token, 30); /* 30min */

        /*
           http://portal.xxx.com/confirm/verify?email=kevin%4010ware.com&token=R9aJFp1yQmT0Jr6G
        */
        $url = route('confirm.verify', ['email' => $notifiable->email, 'token' => $token]);

        return (new MailMessage)
                    ->greeting('Hello '.$notifiable->name.',')
                    // ->subject('Email Verification')
                    ->subject('Verify Email Address')
                    // ->line('Click on the below button to verify your email address and confirm your account registration.')
                    ->line('Please click the button below to verify your email address.')
                    // ->action('Verify', $url)
                    ->action('Verify Email Address', $url)
                    ->line('If you did not create an account, no further action is required.');
                    // ->line('Thank you');

        // return (new MailMessage)
        //             ->greeting('Hello '.$notifiable->name.',')
        //             ->subject(Lang::getFromJson('Verify Email Address'))
        //             ->line(Lang::getFromJson('Please click the button below to verify your email address.'))
        //             ->action(
        //                 Lang::getFromJson('Verify'),
        //                 $url
        //             )
        //             ->line(Lang::getFromJson('Thank you'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
