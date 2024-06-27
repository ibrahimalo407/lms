<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TestCreated extends Notification
{
    use Queueable;

    protected $test;

    public function __construct($test)
    {
        $this->test = $test;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new test has been created: ' . $this->test->title)
                    ->action('View Test', url('/tests/' . $this->test->id))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new test has been created: ' . $this->test->title,
            'url' => url('/tests/' . $this->test->id)
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'A new test has been created: ' . $this->test->title,
            'url' => url('/tests/' . $this->test->id)
        ]);
    }
}
