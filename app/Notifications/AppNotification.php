<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Traits\SendNotificationTrait;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppNotification extends Notification
{
    use Queueable, SendNotificationTrait;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

       $this->sendFcmNotification($notifiable->firebase_tokens()->pluck('token_firebase'),$this->data,app()->getLocale());
        return $this->data;
    }
}
