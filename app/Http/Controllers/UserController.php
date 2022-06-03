<?php

namespace App\Http\Controllers;

use App\Events\FollowedEvent;
use App\Events\UnfollowedEvent;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserService $userService){}

    public function index(string $username) {
        return view('profile.userProfile',[
            'username'=> $username,
        ]);
    }

    public function makePrivate(string $username) {
        $user = $this->userService->getUserByUserName($username);
        $user->isPrivate = true;
        $user->save();

        return redirect()->back();
    }

    public function makePublic(string $username) {
        $user = $this->userService->getUserByUserName($username);
        $user->isPrivate = false;
        $user->save();

        return redirect()->back();
    }

    public function follow(int $id) {
        $user = $this->userService->getUserById($id);
        $authUser = $this->userService->getUserById(Auth::id());
        $authUser->followings()->attach($user);

        event(new FollowedEvent($user,$authUser->username));

        return redirect()->back();
    }

    public function unfollow(int $id) {
        $user = $this->userService->getUserById($id);
        $authUser = $this->userService->getUserById(Auth::id());
        $authUser->followings()->detach($user);

        event(new UnfollowedEvent($user,$authUser->username));

        return redirect()->back();
    }

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
