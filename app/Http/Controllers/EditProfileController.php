<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    public function __construct(protected UserService $userService){}

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
}
