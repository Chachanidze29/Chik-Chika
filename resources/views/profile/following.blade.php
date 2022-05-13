@extends('layouts.app',['username'=>$username])

@section('title',$username)
@section('back_url','/'.$username)

@section('content')
    <nav class="following-follower-nav">
        <a href="{{url($username)}}" class="hovereffect">Tweets</a>
        <a href="{{route('followers',['username'=>$username])}}" class="hovereffect">Followers</a>
        <a href="{{route('following',['username'=>$username])}}" class="hovereffect active">Following {{count($following)}}</a>
        <a href="{{route('likes',['username'=>$username])}}" class="hovereffect">Likes</a>
    </nav>
    <div class="user-list">
        @foreach($following as $f)
            <a class="userlink" href="{{url($f->username)}}">{{$f->username}}</a>
        @endforeach
    </div>
@endsection
