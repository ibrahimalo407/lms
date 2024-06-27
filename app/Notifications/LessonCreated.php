<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class LessonCreated extends Notification
{
    use Queueable;

    protected $lesson;

    public function __construct($lesson)
    {
        $this->lesson = $lesson;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new lesson has been created: ' . $this->lesson->title)
                    ->action('View Lesson', url('/lessons/' . $this->lesson->id))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new lesson has been created: ' . $this->lesson->title,
            'url' => url('/lessons/' . $this->lesson->id)
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'A new lesson has been created: ' . $this->lesson->title,
            'url' => url('/lessons/' . $this->lesson->id)
        ]);
    }
}

