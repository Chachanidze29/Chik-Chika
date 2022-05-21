<?php

namespace App\Http\Controllers;

use App\Events\CommentedEvent;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService,
        protected CommentService $commentService
    ){}

    public function index(int $id) {
        $comment = $this->commentService->getCommentById($id);

        if($comment->parent_id != null) {
            $parent = $this->commentService->getCommentById($comment->commentable_id);
        } else {
            $parent = $this->postService->getPostById($comment->commentable_id);
        }

        return view('comment',[
            'parent'=>$parent,
            'comment'=>$comment,
            'replies'=>$comment->replies
        ]);
    }

    public function create(int $id,Request $request) {
        $validated = $request->validate([
            'content'=>'required|max:140'
        ]);

        $user = $this->userService->getUserById(Auth::id());
        $post = $this->postService->getPostById($id);

        $comment = Comment::create(['content'=>$validated['content'],'user_id'=>$user->id,'commentable_id'=>$post->id,'commentable_type'=>'post']);

        event(new CommentedEvent($post->user,$post->id,$comment->id));

        return redirect()->back();
    }

    public function createReply(int $commentId,Request $request) {
        $validated = $request->validate([
            'content'=>'required|max:140'
        ]);

        $user = $this->userService->getUserById(Auth::id());
        $comment = $this->commentService->getCommentById($commentId);

        $reply = Comment::create([
            'user_id'=>$user->id,
            'content'=>$validated['content'],
            'commentable_id'=>$comment->id,
            'commentable_type'=>'comment'
        ]);

        $comment->replies()->save($reply);

        return redirect()->back();
    }
}
