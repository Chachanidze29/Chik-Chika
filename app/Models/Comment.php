<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'commentable_id',
        'commentable_type'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likedBy() {
        return $this->belongsToMany(User::class,'likes','user_id','post_id')->withTimestamps();
    }

    public function replies() {
        return $this->hasMany(Comment::class,'parent_id');
    }
}
