<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileStatsController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function following(string $username) {
        $user = $this->userService->getUserByUserName($username);
        return view('profile.following',['username'=>$username,'following'=>$user->followings]);
    }

    public function followers(string $username) {
        $user = $this->userService->getUserByUserName($username);
        return view('profile.followers',['username'=>$username,'followers'=>$user->followers]);
    }

    public function likes(string $username) {
        $likes = $this->userService->getUserLikedPosts($username);
        return view('profile.likes',['username'=>$username,'likes'=>$likes]);
    }
}
