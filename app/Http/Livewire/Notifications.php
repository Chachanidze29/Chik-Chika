<?php

namespace App\Http\Livewire;

use App\Services\NotificationService;
use Livewire\Component;

class Notifications extends Component
{
    private NotificationService $notificationService;

    public $notifications;
    public string $username;
    public string $active;

    public function mount(NotificationService $notificationService,string $username) {
        $this->username = $username;

        $this->notifications = $notificationService->getNotificationsByUserName($username);
        $this->active = 'All';
    }

    public function all() {
        $this->notificationService = app(NotificationService::class);
        $this->notifications = $this->notificationService->getNotificationsByUserName($this->username);
        $this->active = 'All';
    }

    public function unread() {
        $this->notificationService = app(NotificationService::class);
        $this->notifications = $this->notificationService->getUnreadNotificationsByUserName($this->username);
        $this->active = 'Unread';
    }

    public function readAll() {
        $this->notificationService = app(NotificationService::class);
        $this->notifications = $this->notificationService->getUnreadNotificationsByUserName($this->username);
        $this->notifications->markAsRead();
        $this->active = 'Unread';
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
