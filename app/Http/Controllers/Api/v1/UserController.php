<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserService $userService){}

    public function user() {
        $user = $this->userService->getUserById(Auth::id());

        return $user->toJson();
    }

    public function followings() {
        $user = $this->userService->getUserById(Auth::id());

        return $user->followings->toJson();
    }

    public function followers()
    {
        $user = $this->userService->getUserById(Auth::id());

        return $user->followers->toJson();
    }
}
