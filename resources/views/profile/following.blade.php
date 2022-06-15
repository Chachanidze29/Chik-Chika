@extends('layouts.app',['username'=>$username])

@section('title',$username)
@section('back_url','/'.$username)

@section('content')
    <nav class="flex flex-row justify-between">
        <x-profile-link href="{{url($username)}}" value="Tweets"/>
        <x-profile-link href="{{route('followers',['username'=>$username])}}" value="Followers"/>
        <x-profile-link href="{{route('following',['username'=>$username])}}" value="Following {{count($following)}}" isActive="true" />
        <x-profile-link href="{{route('likes',['username'=>$username])}}" value="Likes"/>
    </nav>
    <div class="flex flex-col">
        <h1 class="text-2xl font-bold m-2 ml-0">Followings:</h1>
        <ul>
        @foreach($following as $f)
            <li class="m-1 ml-0 flex items-center justify-between">
                <x-user-profile-link href="{{url($f->username)}}" value="{{$f->username}}" />
                <form action="{{route('unfollow',['id'=>$f->id])}}" method="post">
                    @csrf
                    <x-my-button :isRed="true" value="Unfollow"/>
                </form>
            </li>
        @endforeach
        </ul>
    </div>
@endsection
