<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class NotificationsController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function index(string $username) {
        $user = $this->userService->getUserByUserName($username);
        return view('profile.notifications',[
            'notifications'=>$user->notifications
            ]);
    }

    public function unread_index(string $username) {
        $user = $this->userService->getUserByUserName($username);
        return view('profile.notifications',[
            'notifications'=>$user->unreadNotifications
        ]);
    }

    public function showOne(string $username,string $id) {
        $user = $this->userService->getUserByUserName($username);
        $notification = $user->notifications->where('id',$id)->first();
        $notification->markAsRead();
        return view('profile.notification',['notification'=>$notification]);
    }
}
