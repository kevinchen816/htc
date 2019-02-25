<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Str;
use Cache;

use Illuminate\Support\Facades\App;
// use Debugbar;

// class EmailConfirmNotification extends Notification
class EmailConfirmNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function ts($code)
    {
        $txt = 'htc.'.$code;
        $trans = trans($txt);
        if (empty($trans) || $trans == $txt) {
            $trans = $code;
        }
        return $trans;
    }

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

        // $language = strtolower(App::getLocale());
        // if (($language == 'zh-cn') || ($language == 'zh-tw')) {
        //     $greeting = sprintf('%s %s，', $this->ts('Hello,'), $notifiable->name); // Hello Kevin,
        // } else {
        //     $greeting = sprintf('%s %s,', $this->ts('Hello,'), $notifiable->name); // Hello Kevin,
        // }

        // $greeting = sprintf('%s%s,', $this->ts('Hello, '), $notifiable->name); // Hello Kevin,
        // $greeting = sprintf('%s %s,', $this->ts('Hello'), $notifiable->name); // Hello Kevin,

        $greeting = sprintf($this->ts('Hello,'));
        $subject = $this->ts('Verify Email Address');
        $line1 = $this->ts('Please click the button below to verify your email address.');
        $action = $this->ts('Verify Email Address');
        $line2 = $this->ts('If you did not create an account, no further action is required.');

        return (new MailMessage)
                    ->greeting($greeting)
                    ->subject($subject)
                    ->line($line1)
                    ->action($action, $url)
                    ->line($line2);

        // return (new MailMessage)
        //         ->greeting('Hello '.$notifiable->name.',')
        //         ->subject('Verify Email Address') // 'Email Verification'
        //         // ->line('Click on the below button to verify your email address and confirm your account registration.')
        //         ->line('Please click the button below to verify your email address.')
        //         ->action('Verify Email Address', $url) // 'Verify', $url
        //         ->line('If you did not create an account, no further action is required.');
        //         // ->line('Thank you');


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