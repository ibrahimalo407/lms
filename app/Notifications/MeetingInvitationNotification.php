<?php

// App/Notifications/MeetingInvitationNotification.php

namespace App\Notifications;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingInvitationNotification extends Notification
{
    use Queueable;

    protected $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have been invited to a meeting: ' . $this->meeting->roomName)
                    ->action('Join Meeting', $this->meeting->roomUrl)
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You have been invited to a meeting: ' . $this->meeting->roomName,
            'url' => $this->meeting->roomUrl,
        ];
    }
}

