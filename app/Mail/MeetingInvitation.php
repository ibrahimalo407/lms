<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MeetingInvitation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('You are invited to a meeting')
                    ->line('You are invited to a meeting.')
                    ->action('Join Meeting', url($this->meeting->roomUrl))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'meeting_id' => $this->meeting->id,
            'roomName' => $this->meeting->roomName,
            'roomUrl' => $this->meeting->roomUrl,
        ];
    }
}
