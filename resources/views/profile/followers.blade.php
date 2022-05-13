@extends('layouts.app',['username'=>$username])

@section('title',$username)
@section('back_url','/'.$username)

@section('content')
    <nav class="following-follower-nav">
        <a href="{{url($username)}}" class="hovereffect">Tweets</a>
        <a href="{{route('followers',['username'=>$username])}}" class="hovereffect active">Followers {{count($followers)}}</a>
        <a href="{{route('following',['username'=>$username])}}" class="hovereffect">Following</a>
        <a href="{{route('likes',['username'=>$username])}}" class="hovereffect">Likes</a>
    </nav>
    <div class="user-list">
        @foreach($followers as $follower)
            <a class="userlink" href="{{url($follower->username)}}">{{$follower->username}}</a>
        @endforeach
    </div>
@endsection
