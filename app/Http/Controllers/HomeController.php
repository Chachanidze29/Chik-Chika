<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService
    ) {}

    public function index() {
        return view('home',[
            'user'=>Auth::user(),
            'posts'=>$this->postService->getFeed(Auth::user())
        ]);
    }

    public function explore(string $category_name) {
        $posts = $this->postService->getPostsByCategoryName($category_name);

        return view('explore',[
            'posts'=>$posts,
            'category'=>$category_name
        ]);
    }

    public function search(Request $request) {
        $validated = $request->validate([
            'search'=>'required|string'
        ]);

        return view('search',[
            'users'=>$this->userService->getUsersByQuery($validated['search']),
            'username'=>$validated['search']
        ]);
    }
}
