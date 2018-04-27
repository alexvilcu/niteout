<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Hangout;
use Illuminate\Notifications\Messages\MailMessage;

class HangoutRequest extends Notification
{
    use Queueable;

    private $hangout;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Hangout $hangout)
    {
        $this->hangout = $hangout;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase()
    {
        return [
            'id' => $this->hangout->id,
            'title' => $this->hangout->name,
            'inviter' => $this->hangout->inviter_id,
            'location' => $this->hangout->location_id,
            'date' => $this->hangout->created_at
        ];
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
