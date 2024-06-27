<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MeetingInvitation extends Notification
{
    use Queueable;

    private $meetingUrl;

    public function __construct($meetingUrl)
    {
        $this->meetingUrl = $meetingUrl;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have been invited to a meeting.')
                    ->action('Join Meeting', $this->meetingUrl)
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You have been invited to a meeting.',
            'url' => $this->meetingUrl,
        ];
    }
}

