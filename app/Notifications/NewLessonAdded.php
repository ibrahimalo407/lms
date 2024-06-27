<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewLessonAdded extends Notification
{
    use Queueable;

    private $lessonName;
    private $courseName;

    public function __construct($lessonName, $courseName)
    {
        $this->lessonName = $lessonName;
        $this->courseName = $courseName;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new lesson "' . $this->lessonName . '" has been added to the course "' . $this->courseName . '".')
                    ->action('View Lesson', url('/courses/' . $this->courseName . '/lessons/' . $this->lessonName))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'A new lesson "' . $this->lessonName . '" has been added to the course "' . $this->courseName . '".',
            'url' => url('/courses/' . $this->courseName . '/lessons/' . $this->lessonName),
        ];
    }
}
