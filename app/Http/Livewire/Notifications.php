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
    public int $perPage = 15;
    private $noti;

    protected $listeners = [
        'loadedMore'=>'get',
        'activatedAll'=>'get',
        'activatedUnread'=>'get'
    ];

    public function mount(NotificationService $notificationService,string $username) {
        $this->username = $username;

        $this->noti = $notificationService->getNotificationsByUserName($username)->paginate($this->perPage);
        $this->notifications = collect($this->noti->items());
        $this->active = 'All';
    }

    public function get() {
        $this->notificationService = app(NotificationService::class);

        if($this->active === 'All') {
            $this->noti = $this->notificationService->getNotificationsByUserName($this->username)->paginate($this->perPage);
        } else {
            $this->noti = $this->notificationService->getUnreadNotificationsByUserName($this->username)->paginate($this->perPage);
        }
        $this->notifications = collect($this->noti->items());
    }

    public function readAll() {
        $this->notificationService = app(NotificationService::class);
        $this->notifications = $this->notificationService->getUnreadNotificationsByUserName($this->username)->get();
        $this->notifications->markAsRead();
        $this->active = 'Unread';
    }

    public function setActiveAll()
    {
        $this->active = 'All';
        $this->emitSelf('activatedAll');
    }

    public function setActiveUnread()
    {
        $this->active = 'Unread';
        $this->emitSelf('activatedUnread');
    }

    public function loadMore()
    {
        $this->perPage += 15;
        $this->emitSelf('loadedMore');
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
