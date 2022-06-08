<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Misd\Linkify\Linkify;
use function PHPUnit\Framework\isNull;

class PostService
{
    public function __construct(protected Linkify $linkify){}

    public function getFeed(User $user) {
        $userIds = $user->followings()->pluck('id');
        $userIds[] = $user->id;
        return Post::whereIn('user_id', $userIds)->where('parent_id',null)->latest()->paginate(15);
    }

    public function getPostsByUserName(string $username) {
        return Post::whereHas('user',function ($q) use($username) {
            $q->where('username',$username);
        })->latest()->get();
    }

    public function createPost(string $content,int $userid,int $categoryId){
        return Post::create([
            'content' => $this->linkify->processUrls($content,array('attr'=>array('class'=>'link','target'=>'_blank'))),
            'user_id' => $userid,
            'category_id'=>$categoryId
        ]);
    }

    public function createComment(string $content,int $userid,int $parentId) {
        return Post::create([
            'content' => $this->linkify->processUrls($content,array('attr'=>array('class'=>'link','target'=>'_blank'))),
            'user_id' => $userid,
            'parent_id'=>$parentId
        ]);
    }

    public function getPostsByCategoryName(string $category_name) {
        return Post::whereHas('category',function ($q) use ($category_name) {
            $q->where('name',$category_name);
        })->whereHas('user',function ($q) {
            $q->where('isPrivate',false)->orWhere('user_id',Auth::id());
        })->latest()->get();
    }

    public function getPostById(?int $id) {
        return !$id ? null : Post::find($id);
    }

    public function getCommentsByPostId(int $id) {
        return Post::where('parent_id',$id)->get();
    }
}
