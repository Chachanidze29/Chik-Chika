@extends('layouts.app',['username'=>\Illuminate\Support\Facades\Auth::user()->username])

@section('title','Post')
@section('back_url','/home')

@section('content')
    <div class="post">
            <object>
                <h2><a href="{{url('/',[$post->user->username])}}" class="userlink">{{$post->user->username}}</a></h2>
                <p class="post-content">{{$post->content}}</p>
            </object>
        <div class="post-footer">
            @if($post->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
                <form action="{{route('unlike',['id'=>$post->id])}}" method="post">
                    @csrf
                    <input class="unfollowunlike" type="submit" value="Unlike {{count($post->likedBy)}}"/>
                </form>
            @else
                <form action="{{route('like',['id'=>$post->id])}}" method="post">
                    @csrf
                    <input class="followlike" type="submit" value="Like {{count($post->likedBy)}}"/>
                </form>
            @endif
        </div>
    </div>
    <form method="post" action="{{route('comment',['id'=>$post->id])}}">
        @csrf
        <input type="text" name="content"/>
        <input type="submit"/>
    </form>
    @foreach($comments as $comment)
        <p>{{$comment->user->username}}</p>
        <p>{{$comment->content}}</p>
    @endforeach
@endsection
