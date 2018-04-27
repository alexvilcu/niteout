<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Hangout;
use \App\User;
use \App\Location;
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
        $location = Location::find($this->hangout->location_id);
        $location_name = $location->name;
        $user = User::find($this->hangout->inviter_id);
        $user_name = $user->name;
        return [
            'id' => $this->hangout->id,
            'title' => $this->hangout->name,
            'inviter' => $user_name,
            'location' => $location_name,
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
