<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function index(string $username) {
        $user = $this->userService->getUserByUserName($username);
        return view('profile.notification',[
            'notifications'=>$user->notifications
            ]);
    }
}
