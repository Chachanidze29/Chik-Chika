<?php

namespace App\Services;

use App\Models\User;

class NotificationService
{
    public function getNotificationsByUserName(string $username) {
        $user = User::where('username',$username)->first();
        return $user->notifications();
    }

    public function getUnreadNotificationsByUserName(string $username) {
        $user = User::where('username',$username)->first();
        return $user->unreadNotifications();
    }

    public function getNotificationByUsernameAndId(string $username,string $id) {
        $user = User::where('username',$username)->first();
        return $user->notifications()->find($id);
    }
}
