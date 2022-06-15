<?php

namespace App\Http\Livewire;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    private PostService $postService;
    private $p;

    public $posts;
    public int $perPage = 5;
    public $categories;

//    protected $listeners = [
//        'loadedMore'=>'getFeed',
//    ];

    public function mount(PostService $postService,CategoryService $categoryService) {
        $this->posts = $postService->getFeed();
//        $this->posts = collect($this->p->items());
        $this->categories = $categoryService->getCategories();
    }

    public function getFeed() {
        dd('Get Feed');
        $this->postService = app(PostService::class);

        $this->p = $this->postService->getFeed()->paginate($this->perPage);
        $this->posts = collect($this->p->items());
    }

    public function loadMore()
    {
        $this->perPage += 15;
        $this->emitSelf('loadedMore');
    }

    public function render()
    {
        return view('livewire.home');
    }
}
