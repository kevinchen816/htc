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
        Cache::set('email_confirm_'.$notifiable->email, $token, 30); // 30min

        //https://portal.ridgetec.com/register/verify/M2FH0abL9p
        $url = route('confirm.verify', ['email' => $notifiable->email, 'token' => $token]);

        //return (new MailMessage)
        //            ->line('The introduction to the notification.')
        //            ->action('Notification Action', $url)
        //            ->line('Thank you for using our application!');

        return (new MailMessage)
                    ->greeting('Hello '.$notifiable->name.',')
                    ->subject('Email Verification')
                    ->line('Click on the below button to verify your email address and confirm your account registration.')
                    ->action('Verify', $url)
                    ->line('Thank you');
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
