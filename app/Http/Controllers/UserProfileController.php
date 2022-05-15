<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
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
        $user = $this->userService->getUserByUserName($username);
        return view('profile.userProfile',[
            'user'=> $user,
            'posts'=>$this->postService->getPostsByUserName($username)
        ]);
    }
}
