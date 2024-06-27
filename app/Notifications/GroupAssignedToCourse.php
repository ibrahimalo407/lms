<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GroupAssignedToCourse extends Notification
{
    use Queueable;

    private $courseName;

    public function __construct($courseName)
    {
        $this->courseName = $courseName;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your group has been assigned to the course: ' . $this->courseName)
                    ->action('View Course', url('/courses/' . $this->courseName))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your group has been assigned to the course: ' . $this->courseName,
            'url' => url('/courses/' . $this->courseName),
        ];
    }
}

