<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected PostService $postService,
    ){}

    public function index(string $username) {
        return view('profile.userProfile',[
            'user'=>$this->userService->getUserByUserName($username),
            'posts'=>$this->postService->getPostsByUserName($username)
        ]);
    }
}
