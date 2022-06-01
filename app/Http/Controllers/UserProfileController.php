<?php

namespace App\Http\Controllers;

class UserProfileController extends Controller
{
    public function __construct(){}

    public function index(string $username) {
        return view('profile.userProfile',[
            'username'=> $username,
        ]);
    }
}
