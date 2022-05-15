<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;

class CheckIfExsits
{
    public function __construct(
        protected UserService $userService
    ){}

    public function handle(Request $request, Closure $next)
    {
        $user = $this->userService->getUserByUserName($request->username);

        if(!$user) {
            abort(404);
        }

        return $next($request);
    }
}
