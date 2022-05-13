<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;

class PostService
{
    public function getFeed(User $user) {
        $userIds = $user->followings()->pluck('id');
        $userIds[] = $user->id;
        return Post::whereIn('user_id', $userIds)->latest()->get();
    }

    public function getPostsByUserName(string $username) {
        return Post::whereHas('user',function ($q) use($username) {
            $q->where('username',$username);
        })->latest()->get();
    }

    public function getPostById(int $id) {
        $post = Post::find($id);
        return $post;
    }
}
