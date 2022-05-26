<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected PostService $postService,
    ){}

    public function index(string $username) {
        return view('profile.userProfile',[
            'username'=> $username,
        ]);
    }
}
