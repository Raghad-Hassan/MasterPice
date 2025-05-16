<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class OpportunityNotification extends Notification
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];  // يخزن في جدول notifications
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'opportunity',
            'message' => $this->message,
        ];
    }
}
