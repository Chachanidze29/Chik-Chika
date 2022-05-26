<?php

namespace App\Http\Controllers;

class NotificationsController extends Controller
{

    public function index(string $username) {
        return view('profile.notifications',[
            'username'=>$username
        ]);
    }

    public function getOne(string $username,string $notificationId) {
        return view('profile.notification',[
            'username'=>$username,
            'id'=>$notificationId
        ]);
    }
}
