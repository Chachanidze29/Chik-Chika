<?php

namespace App\Http\Livewire;

use App\Events\LikedEvent;
use App\Models\Post as PostModel;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{
    public PostModel $post;
    private UserService $userService;

    public function mount(PostModel $post) {
        $this->post = $post;
    }

    public function like() {
        $this->userService = app(UserService::class);

        $user = $this->userService->getUserById(Auth::id());
        $user->likes()->attach($this->post);

        event(new LikedEvent($this->post,$user));
    }

    public function unlike() {
        $this->userService = app(UserService::class);

        $user = $this->userService->getUserById(Auth::id());
        $user->likes()->detach($this->post);
    }

    public function render()
    {
        return view('livewire.post');
    }
}
