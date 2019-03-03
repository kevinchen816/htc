<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

// class ResetPasswordNotification extends Notification implements ShouldQueue // NG
class ResetPasswordNotification extends Notification
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
    public function __construct($token)
    {
        $this->token = $token;
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
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');

        // return (new MailMessage)
        //     ->line('You are receiving this email because we received a password reset request for your account.')
        //     ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
        //     ->line('If you did not request a password reset, no further action is required.');


        // $language = strtolower(App::getLocale());
        // if (($language == 'zh-cn') || ($language == 'zh-tw')) {
        //     $greeting = sprintf('%s %s，', $this->ts('Hello'), $notifiable->name); // Hello Kevin,
        // } else {
        //     $greeting = sprintf('%s %s,', $this->ts('Hello'), $notifiable->name); // Hello Kevin,
        // }

        // $greeting = sprintf('%s %s,', $this->ts('Hello'), $notifiable->name); // Hello Kevin,
        $greeting = sprintf($this->ts('Hello,'));
        $subject = $this->ts('Reset Password');
        $line1 = $this->ts('You are receiving this email because we received a password reset request for your account.');
        $action = $this->ts('Reset Password');
        $url = url(config('app.url').route('password.reset', $this->token, false));
        $line2 = $this->ts('If you did not request a password reset, no further action is required.');

        /* 默认重置密码邮件的模板位于：resources/views/vendor/notifications/email.blade.php */
        return (new MailMessage)
                    ->greeting($greeting)
                    ->subject($subject)
                    // ->salutation('Regards,<br>'.config('app.name'))
                    ->line($line1)
                    ->action($action, $url)
                    ->line($line2);
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