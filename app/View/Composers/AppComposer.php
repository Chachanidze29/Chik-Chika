<?php

namespace App\View\Composers;

use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AppComposer
{
    public function __construct(protected UserService $userService) {}

    public function compose(View $view) {
        $view->with('categories',DB::table('categories')->get());
        $view->with('usersToConnect',$this->userService->getUsersToConnect());
    }
}
