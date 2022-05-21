@extends('layouts.app',['username'=>$user->username])

@section('title','Profile')
@section('back_url','home')

@section('content')
    <div class="flex flex-col">
        <div class="flex flex-col justify-between">
            <h1 class="text-2xl m-2 ml-0">{{$user->username}}</h1>
            <span class="text-sm text-gray-600">Joined At {{explode(' ',$user->created_at)[0]}}</span>
        </div>
        @auth
            @if(\Illuminate\Support\Facades\Auth::id()!==$user->id)
                @if($user->followers->contains(\Illuminate\Support\Facades\Auth::user()))
                    <form action="{{route('unfollow',['id'=>$user->id])}}" method="post">
                        @csrf
                        <x-like-unlike-button value="Unfollow"/>
                    </form>
                @else
                    <form action="{{route('follow',['id'=>$user->id])}}" method="post">
                        @csrf
                        <x-like-unlike-button value="Follow"/>
                    </form>
                @endif
            @else
                @auth
                    @if($user->isPrivate)
                        <form method="post" action="{{route('makePublic',['username'=>$user->username])}}">
                            @csrf
                            <input type="submit" value="Make Public">
                        </form>
                    @else
                        <form method="post" action="{{route('makePrivate',['username'=>$user->username])}}">
                            @csrf
                            <input type="submit" value="Make Private">
                        </form>
                    @endif
                @endauth
            @endif
        @endauth
    </div>
    <nav class="flex flex-row justify-between m-2 ml-0">
        <x-profile-nav-link href="{{url($user->username)}}" isActive="true" value="Tweets {{count($user->posts)}}"/>
        <x-profile-nav-link href="{{route('followers',['username'=>$user->username])}}" value="Followers {{count($user->followers)}}"/>
        <x-profile-nav-link href="{{route('following',['username'=>$user->username])}}" value="Following {{count($user->followings)}}"/>
        <x-profile-nav-link href="{{route('likes',['username'=>$user->username])}}" value="Likes {{count($user->likes)}}" />
    </nav>
    @if($user->isPrivate && $user->id != \Illuminate\Support\Facades\Auth::id())
        <p>User is private</p>
    @else
        @foreach($posts as $post)
            <x-post :post="$post"/>
        @endforeach
    @endif
@endsection
