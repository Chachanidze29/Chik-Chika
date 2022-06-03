<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsPrivate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __construct(
        protected UserService $userService
    ){}

    public function handle(Request $request, Closure $next)
    {
        $user = $this->userService->getUserByUserName($request->username);
        $authUser = $this->userService->getUserById(Auth::id());
        if($user->isPrivate && $user->id != $authUser && !$authUser?->followings->contains($user)) {
            return redirect('/'.$user->username);
        }

        return $next($request);
    }
}
