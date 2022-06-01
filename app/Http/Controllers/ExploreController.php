<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;

class ExploreController extends Controller
{
    public function __construct(public PostService $postService){}

    public function index(string $category_name) {
        $posts = $this->postService->getPostsByCategoryName($category_name);

        return view('explore',[
            'posts'=>$posts,
            'category'=>$category_name
        ]);
    }
}
