<?php

namespace App\Http\Controllers;
use App\Events\LikedEvent;
use App\Models\User;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService
    ) {}

    public function like(int $id) {
        $post = $this->postService->getPostById($id);
        $user = $this->userService->getUserById(Auth::id());
        $user->likes()->attach($post);

        event(new LikedEvent($post,$user));

        return redirect()->back();
    }

    public function unlike(int $id) {
        $post = $this->postService->getPostById($id);
        $user = $this->userService->getUserById(Auth::id());
        $user->likes()->detach($post);

        return redirect()->back();
    }
}
