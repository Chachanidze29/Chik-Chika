@extends('layouts.app',['username'=>$username])

@section('title',$username)
@section('back_url','/'.$username)

@section('content')
    <nav class="flex flex-row justify-between">
        <x-profile-nav-link href="{{url($username)}}" value="Tweets"/>
        <x-profile-nav-link href="{{route('followers',['username'=>$username])}}" value="Followers"/>
        <x-profile-nav-link href="{{route('following',['username'=>$username])}}" value="Following {{count($following)}}" isActive="true" />
        <x-profile-nav-link href="{{route('likes',['username'=>$username])}}" value="Likes"/>
    </nav>
    <div class="user-list">
        @foreach($following as $f)
            <a class="userlink" href="{{url($f->username)}}">{{$f->username}}</a>
        @endforeach
    </div>
@endsection
