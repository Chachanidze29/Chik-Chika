<?php

namespace App\Http\Controllers;

use App\Events\CommentedEvent;
use App\Models\Comment;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService
    ){}

    public function create(int $id,Request $request) {
        $validated = $request->validate([
            'content'=>'required|max:140'
        ]);

        $user = $this->userService->getUserById(Auth::id());
        $post = $this->postService->getPostById($id);

        $comment = Comment::create(['content'=>$validated['content'],'user_id'=>$user->id,'post_id'=>$post->id]);

        event(new CommentedEvent($post->user,$post->id,$comment->id));

        return redirect()->back();
    }
}
