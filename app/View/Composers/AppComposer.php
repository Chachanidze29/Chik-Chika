<?php

namespace App\View\Composers;

use App\Services\CategoryService;
use App\Services\UserService;
use Illuminate\View\View;

class AppComposer
{
    public function __construct(
        protected UserService $userService,
        protected CategoryService $categoryService
    ) {}

    public function compose(View $view) {
        $view->with('categories',$this->categoryService->getCategories());
        $view->with('usersToConnect',$this->userService->getUsersToConnect());
    }
}
