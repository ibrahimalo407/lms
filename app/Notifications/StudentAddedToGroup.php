<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class StudentAddedToGroup extends Notification
{
    use Queueable;

    protected $group;

    public function __construct($group)
    {
        $this->group = $group;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have been added to a new group: ' . $this->group->name)
                    ->action('View Group', url('/groups/' . $this->group->id))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'You have been added to a new group: ' . $this->group->name,
            'url' => url('/groups/' . $this->group->id)
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'You have been added to a new group: ' . $this->group->name,
            'url' => url('/groups/' . $this->group->id)
        ]);
    }
}
