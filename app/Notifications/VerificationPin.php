<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationPin extends Notification
{
    use Queueable;
   /**
     * The password reset pinNumber.
     *
     * @var string
     */
    public $pinNumber;

    public $email;

    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pinNumber, $email, $name)
    {
        $this->pinNumber = $pinNumber;
        $this->email = $email;
        $this->name = $name;
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
        return (new MailMessage)
            ->line('Hello ' . $this->name . ',')
            ->line('You are receiving this email because we received a email verification request for your account.')
            ->line('This is your PIN number <b>' .$this->pinNumber.'</b>')
            //->action('Reset Password', route('admin.reset_password_link', [
              //  'pinNumber' => $this->pinNumber, 'email' => $this->email
            //]))
            ->line('If you did not request a password reset, no further action is required.')
        ;
    }
}
