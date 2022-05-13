<?php

namespace App\Http\Controllers;

use App\Events\Followed;
use App\Events\Unfollowed;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function __construct(
        protected UserService $userService
    ){}

    public function store(int $id) {
        $user = $this->userService->getUserById($id);
        Auth::user()->followings()->attach($user);

        event(new Followed($user));

        return redirect()->back();
    }

    public function destroy(int $id) {
        $user = $this->userService->getUserById($id);
        Auth::user()->followings()->detach($user);

        event(new Unfollowed($user));

        return redirect()->back();
    }
}
