<?php

namespace App\Http\Controllers;

use App\Events\TweetedEvent;
use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected CommentService $commentService,
    ){}

    public function index(int $id) {
        return view('post',[
            'post'=>$this->postService->getPostById($id),
            'comments'=>$this->commentService->getCommentsByPostId($id)
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'content' => 'required|string|max:140'
        ]);

        $user = User::find(Auth::id());

        Post::create([
            'content' => $validated['content'],
            'user_id' => $user->id
        ]);

        event(new TweetedEvent($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
