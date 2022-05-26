<?php

namespace App\Http\Livewire;

use App\Services\NotificationService;
use Livewire\Component;

class Notification extends Component
{
    private NotificationService $notificationService;

    public string $username;
    public string $notificationId;
    public $notification;

    public function mount(NotificationService $notificationService,string $username,string $notificationId) {
        $this->username = $username;
        $this->notificationId = $notificationId;
        $this->notificationService = $notificationService;

        $this->notification = $this->notificationService->getNotificationByUsernameAndId($this->username,$this->notificationId);
        $this->notification->markAsRead();
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
