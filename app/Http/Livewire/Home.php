<?php

namespace App\Http\Livewire;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    private PostService $postService;
    private CategoryService $categoryService;
    private $p;

    public $posts;
    public int $perPage = 5;
    public $categories;

    protected $listeners = ['loadedMore'=>'get'];

    public function mount(PostService $postService,CategoryService $categoryService) {
        $this->postService = $postService;
        $this->categoryService = $categoryService;

        $this->p = $this->postService->getFeed(Auth::user())->paginate($this->perPage);
        $this->posts = collect($this->p->items());
        $this->categories = $this->categoryService->getCategories();
    }

    public function get() {
        $this->postService = app(PostService::class);

        $this->p = $this->postService->getFeed(Auth::user())->paginate($this->perPage);
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
