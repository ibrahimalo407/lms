<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TestAddedToLesson extends Notification
{
    use Queueable;

    private $testName;
    private $lessonName;
    private $courseName;

    public function __construct($testName, $lessonName, $courseName)
    {
        $this->testName = $testName;
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
                    ->line('A new test "' . $this->testName . '" has been added to the lesson "' . $this->lessonName . '" in the course "' . $this->courseName . '".')
                    ->action('View Test', url('/courses/' . $this->courseName . '/lessons/' . $this->lessonName . '/tests/' . $this->testName))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'A new test "' . $this->testName . '" has been added to the lesson "' . $this->lessonName . '" in the course "' . $this->courseName . '".',
            'url' => url('/courses/' . $this->courseName . '/lessons/' . $this->lessonName . '/tests/' . $this->testName),
        ];
    }
}

