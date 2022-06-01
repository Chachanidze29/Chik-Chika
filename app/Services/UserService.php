<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUserByUserName(string $userName) {
        return User::where('username',$userName)->first();
    }

    public function getUserById(int|null $uuid) {
        if($uuid) {
            return User::find($uuid);
        }
        return null;
    }

    public function getUsersByQuery(string $query) {
        return User::where('username','like',$query.'%')->get();
    }

    public function getUserLikedPosts(string $username) {
        $user = User::where('username',$username)->first();
        return $user->likes()->latest()->get();
    }

    public function getUsersToConnect() {
        $authUser = User::find(Auth::id());

        $users = User::all()->filter(function ($user) use ($authUser) {
            return !$user->followers->contains($authUser) && $user->id !== $authUser->id && !$user->isPrivate;
        });
        return $users;
    }
}
