<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnValue;

class TweetController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService,
        protected CategoryService $categoryService
    ){}

    public function mainFeed() {
        $tweets = $this->postService->getFeed();

        return $tweets->toJson();
    }

    public function tweet(StorePostRequest $request) {
        $validated = $request->validated();
        $category_id = $this->categoryService->getCategoryByName($validated['category_name'])->id;

        $post = $this->postService->createPost($validated['content'],Auth::id(),$category_id);
        return $post->toJson();
    }

    public function show(int $tweet_id) {
        $tweet = $this->postService->getPostById($tweet_id);
        return $tweet->toJson();
    }

    public function comments(int $tweet_id) {
        $replies = $this->postService->getCommentsByPostId($tweet_id);
        return $replies->toJson();
    }

    public function reply(StoreCommentRequest $request,int $tweet_id) {
        $validated = $request->validated();
        $comment = $this->postService->createComment($validated['content'],Auth::id(),$tweet_id);
        return $comment;
    }

    public function like(int $tweet_id) {
        $post = $this->postService->getPostById($tweet_id);
        $user = $this->userService->getUserById(Auth::id());
        $user->likes()->attach($post);

        return response('', 204);
    }

    public function unlike(int $tweet_id) {
        $post = $this->postService->getPostById($tweet_id);
        $user = $this->userService->getUserById(Auth::id());
        $user->likes()->detach($post);

        return response('', 204);
    }
}
