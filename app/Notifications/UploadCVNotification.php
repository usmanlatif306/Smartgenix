<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UploadCVNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $cv, $info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($info, $cv)
    {
        $this->cv = $cv;
        $this->info = $info;
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
            ->subject('New CV')
            ->greeting('Hello')
            ->line('You have received new cv')
            ->line('The user information are given below')
            ->line($this->info)
            ->attach(public_path() . $this->cv, [
                'mime' => 'application/pdf',
            ]);
        // asset($this->cv)
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
