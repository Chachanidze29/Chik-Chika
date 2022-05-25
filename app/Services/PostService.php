<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use function PHPUnit\Framework\isNull;

class PostService
{
    public function getFeed(User $user) {
        $userIds = $user->followings()->pluck('id');
        $userIds[] = $user->id;
        return Post::whereIn('user_id', $userIds)->where('parent_id',null)->latest()->get();
    }

    public function getPostsByUserName(string $username) {
        return Post::whereHas('user',function ($q) use($username) {
            $q->where('username',$username);
        })->latest()->get();
    }

    public function getPostById(?int $id) {
        if(!$id) {
            return null;
        }
        $post = Post::find($id);
        return $post;
    }

    public function getCommentsByPostId(int $id) {
        return Post::where('parent_id',$id)->get();
    }
}
