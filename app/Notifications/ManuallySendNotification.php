<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ManuallySendNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $message, $notifier, $path;
    public function __construct($notifier, $message, $path = null)
    {
        $this->notifier = $notifier;
        $this->message = $message;
        $this->path = $path;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'author' => $this->notifier,
            'data' => $this->message,
            'path' => $this->path
        ];
    }
}
