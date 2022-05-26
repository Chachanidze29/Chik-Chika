<?php

namespace App\Http\Livewire;

use App\Events\FollowedEvent;
use App\Events\UnfollowedEvent;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfile extends Component
{
    private UserService $userService;
    private PostService $postService;

    public User $user;
    public User $authUser;
    public $posts;
    public string $username;

    public function mount(string $username) {
        $this->userService = app(UserService::class);
        $this->postService = app(PostService::class);

        $this->username = $username;
        $this->user = $this->userService->getUserByUserName($this->username);
        $this->authUser = $this->userService->getUserById(Auth::id());
        $this->posts = $this->postService->getPostsByUserName($this->username);
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
