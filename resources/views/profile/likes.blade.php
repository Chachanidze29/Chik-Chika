@extends('layouts.app',['username'=>$username])

@section('title',$username)
@section('back_url','/'.$username)

@section('content')
    <nav class="following-follower-nav">
        <a href="{{url($username)}}" class="hovereffect">Tweets</a>
        <a href="{{route('followers',['username'=>$username])}}" class="hovereffect">Followers</a>
        <a href="{{route('following',['username'=>$username])}}" class="hovereffect">Following</a>
        <a href="{{route('likes',['username'=>$username])}}" class="hovereffect active">Likes {{count($likes)}}</a>
    </nav>
    <div class="user-list">
        @foreach($likes as $post)
            <x-post :post="$post"/>
        @endforeach
    </div>
@endsection
