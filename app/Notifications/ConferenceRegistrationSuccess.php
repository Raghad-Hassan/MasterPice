<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ConferenceRegistrationSuccess extends Notification
{
    use Queueable;

    protected $conference;

    public function __construct($conference)
    {
        $this->conference = $conference;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'تم تسجيلك في المؤتمر بنجاح!',
            'url' => route('conferences.register.form', ['conference' => $this->conference->id])
        ];
    }
}
