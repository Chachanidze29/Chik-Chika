<?php

namespace App\Http\Controllers;

use App\Events\CommentedEvent;
use App\Events\TweetedEvent;
use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService
    ){}

    public function index(int $id) {
        $post = $this->postService->getPostById($id);
        $comments = $this->postService->getCommentsByPostId($id);
        $parent = $this->postService->getPostById($post->parent_id);
        return view('post',[
            'post'=>$post,
            'comments'=>$comments,
            'parent'=>$parent
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'content' => 'required|string|max:140'
        ]);

        $user = $this->userService->getUserById(Auth::id());
        $post = Post::create([
            'content' => $validated['content'],
            'user_id' => $user->id
        ]);

        event(new TweetedEvent($user,$post->id));

        return redirect(RouteServiceProvider::HOME);
    }

    public function storeComment(Request $request,int $id) {
        $validated = $request->validate([
            'content' => 'required|string|max:140'
        ]);

        $user = $this->userService->getUserById(Auth::id());
        $post = $this->postService->getPostById($id);
        $comment = Post::create([
            'content' => $validated['content'],
            'user_id' => $user->id,
            'parent_id'=>$post->id
        ]);

        event(new CommentedEvent($user,$post->id,$comment->id));

        return redirect()->back();
    }
}
