<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FeedbackSubmitted extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // حفظ في قاعدة البيانات
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'feedback',
            'message' => 'تم استلام فيدباكك: "' . $this->message . '"',
        ];
    }
}
