<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function getCommentsByPostId(int $id) {
        return Comment::whereHas('post',function ($q) use ($id) {
            $q->where('id',$id);
        })->latest()->get();
    }
}
