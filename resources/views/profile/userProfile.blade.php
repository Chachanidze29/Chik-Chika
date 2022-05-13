@extends('layouts.app',['username'=>\Illuminate\Support\Facades\Auth::user()->username])

@section('title','Profile')
@section('back_url','home')

@section('content')
    <div class="profile-header">
        <h1>{{$user->username}}</h1>
        @if(\Illuminate\Support\Facades\Auth::id()!==$user->id)
            @if($user->followers->contains(\Illuminate\Support\Facades\Auth::user()))
                <form action="{{route('unfollow',['id'=>$user->id])}}" method="post">
                    @csrf
                    <input type="submit" class="unfollowunlike" value="Unfollow"/>
                </form>
            @else
                <form action="{{route('follow',['id'=>$user->id])}}" method="post">
                    @csrf
                    <input type="submit" class="followlike" value="Follow"/>
                </form>
            @endif
        @endif
    </div>
    <nav class="following-follower-nav">
        <a href="{{url($user->username)}}" class="hovereffect active">Tweets {{count($user->posts)}}</a>
        <a href="{{route('followers',['username'=>$user->username])}}" class="hovereffect">Followers {{count($user->followers)}}</a>
        <a href="{{route('following',['username'=>$user->username])}}" class="hovereffect">Following {{count($user->followings)}}</a>
        <a href="{{route('likes',['username'=>$user->username])}}" class="hovereffect">Likes {{count($user->likes)}}</a>
    </nav>
    @foreach($posts as $post)
        <x-post :post="$post"/>
    @endforeach
@endsection
