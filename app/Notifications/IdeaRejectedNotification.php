<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IdeaRejectedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'تم رفض فكرتك من قبل الإدارة. نشكر لك مشاركتك ونتمنى لك التوفيق.',
        ];
    }
}
