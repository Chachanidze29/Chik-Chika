<?php

namespace App\Http\Controllers;

use App\Events\FollowedEvent;
use App\Events\UnfollowedEvent;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function __construct(
        protected UserService $userService
    ){}

    public function store(int $id) {
        $user = $this->userService->getUserById($id);
        $authUser = $this->userService->getUserById(Auth::id());
        $authUser->followings()->attach($user);

        event(new FollowedEvent($user,$authUser->username));

        return redirect()->back();
    }

    public function destroy(int $id) {
        $user = $this->userService->getUserById($id);
        $authUser = $this->userService->getUserById(Auth::id());
        $authUser->followings()->detach($user);

        event(new UnfollowedEvent($user,$authUser->username));

        return redirect()->back();
    }
}
