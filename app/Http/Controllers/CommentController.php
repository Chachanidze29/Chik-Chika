<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(int $id,Request $request) {
        $validated = $request->validate([
            'content'=>'required|max:140'
        ]);

        Comment::create(['content'=>$validated['content'],'user_id'=>Auth::id(),'post_id'=>$id]);
        return redirect()->back();
    }
}
