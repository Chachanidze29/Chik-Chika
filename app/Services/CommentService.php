<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function getCommentsByPostId(int $id) {
        return Comment::where('commentable_id',$id)->where('parent_id',null)->latest()->get();
    }

    public function getCommentById(int $id) {
        return Comment::find($id);
    }

    public function getCommentReplies(int $id) {
        $comment = Comment::find($id);
        return $comment->replies()->where('parent_id',null)->all();
    }
}
