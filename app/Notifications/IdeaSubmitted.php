<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IdeaSubmitted extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // نخزنها في قاعدة البيانات
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'تم استلام فكرتك وهي الآن قيد المراجعة من قبل الإدارة.',
        ];
    }
}
