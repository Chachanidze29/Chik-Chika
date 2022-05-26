@extends('layouts.app',['username'=>$username])

@section('title',$username)
@section('back_url','/'.$username)

@section('content')
    <nav class="flex flex-row justify-between">
        <x-profile-nav-link href="{{url($username)}}" value="Tweets"/>
        <x-profile-nav-link href="{{route('followers',['username'=>$username])}}" value="Followers"/>
        <x-profile-nav-link href="{{route('following',['username'=>$username])}}" value="Following" />
        <x-profile-nav-link href="{{route('likes',['username'=>$username])}}" isActive="true" value="Likes {{count($likes)}}"/>
    </nav>
    <div class="user-list">
        @foreach($likes as $post)
            <livewire:post :post="$post"/>
        @endforeach
    </div>
@endsection
