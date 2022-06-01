<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ExploreController extends Controller
{
    public function index(string $category_name) {
        $posts = Post::whereHas('category',function ($q) use ($category_name) {
            $q->where('name',$category_name);
        })->latest()->get();

        return view('explore',[
            'posts'=>$posts,
            'category'=>$category_name
        ]);
    }
}
