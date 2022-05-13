<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Providers\RouteServiceProvider;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ){}

    public function index(int $id) {
        return view('post',[
            'post'=>$this->postService->getPostById($id),
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'content' => 'required|string|max:140'
        ]);

        Post::create([
            'content' => $validated['content'],
            'user_id' => Auth::id()
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
