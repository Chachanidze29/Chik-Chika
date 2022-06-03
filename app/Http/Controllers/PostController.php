<?php

namespace App\Http\Controllers;

use App\Events\CommentedEvent;
use App\Events\TweetedEvent;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Misd\Linkify\Linkify;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService,
        protected Linkify $linkify
    ){}

    public function index(int $id) {
        $post = $this->postService->getPostById($id);
        $parent = $this->postService->getPostById($post->parent_id);
        $comments = $this->postService->getCommentsByPostId($id);
        return view('post',[
            'post'=>$post,
            'comments'=>$comments,
            'parent'=>$parent
        ]);
    }

    public function store(StorePostRequest $request) {
        $validated = $request->validated();
        $category_id = Category::where('name',strtolower($validated['category_name']))->first()->id;
        $user_id = Auth::id();

        $post = $this->postService->createPost($validated['content'],$user_id,$category_id);

        event(new TweetedEvent($user_id,$post->id));

        return redirect(RouteServiceProvider::HOME);
    }

    public function storeComment(StoreCommentRequest $request,int $id) {
        $validated = $request->validated();
        $post = $this->postService->getPostById($id);

        $comment = $this->postService->createComment($validated['content'],Auth::id(),$id);

        event(new CommentedEvent($post->user,$post->id,$comment->id));

        return redirect()->back();
    }
}
