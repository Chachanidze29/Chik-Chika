<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'parent_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Post::class,'parent_id','id');
    }

    public function likedBy() {
        return $this->belongsToMany(User::class,'likes','user_id','post_id')->withTimestamps();
    }
}
