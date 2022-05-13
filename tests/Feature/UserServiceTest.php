<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function __construct()
    {
    }

    public function test(UserService $userService) {
//        $this->assertSame(User::class,$userService->getUserByUserName('joker'));
    }
}

