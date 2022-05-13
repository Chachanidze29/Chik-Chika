<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUserByUserName(string $userName) {
        return User::where('username',$userName)->first();
    }

    public function getUserById(int $uuid) {
        return User::find($uuid);
    }

    public function getUsersByQuery(string $query) {
        return User::where('username','like',$query.'%')->get();
    }
}
