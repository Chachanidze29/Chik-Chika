<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\PostService;
use App\Services\UserService;
use Livewire\Component;

class UserProfile extends Component
{
    private UserService $userService;
    private PostService $postService;

    public User $user;
    public User $authUser;
    public $posts;
    public string $username;
    public $users;

    public function mount(string $username) {
        $this->userService = app(UserService::class);
        $this->postService = app(PostService::class);

        $this->username = $username;
        $this->user = $this->userService->getUserByUserName($this->username);
        $this->posts = $this->postService->getPostsByUserName($this->username);
    }

    public function followers() {
        $this->users = $this->user->followers;
    }

    public function followings() {
        $this->users = $this->user->followings;
    }

    public function likes() {
        $this->posts = $this->user->likes;
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
