@extends('layouts.app',['username'=>$username])

@section('title',$username)
@section('back_url','/'.$username)

@section('content')
    <nav class="flex flex-row justify-between">
        <x-profile-nav-link href="{{url($username)}}" value="Tweets"/>
        <x-profile-nav-link href="{{route('followers',['username'=>$username])}}" value="Followers {{count($followers)}}" isActive="true"/>
        <x-profile-nav-link href="{{route('following',['username'=>$username])}}" value="Following" />
        <x-profile-nav-link href="{{route('likes',['username'=>$username])}}" value="Likes"/>
    </nav>
    <div class="flex flex-col">
        <h1 class="text-2xl font-bold m-2 ml-0">Followers:</h1>
        <ul>
        @foreach($followers as $follower)
            <li class="m-1 ml-0">
                <x-user-link href="{{url($follower->username)}}" value="{{$follower->username}}"/>
            </li>
        @endforeach
        </ul>
    </div>
@endsection
