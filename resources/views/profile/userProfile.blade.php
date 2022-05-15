@extends('layouts.app',['username'=>$user->username])

@section('title','Profile')
@section('back_url','home')

@section('content')
    <div class="profile-header">
        <h1>{{$user->username}}</h1>
        @auth
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
    <nav class="following-follower-nav">
        <a href="{{url($user->username)}}" class="hovereffect active">Tweets {{count($user->posts)}}</a>
        <a href="{{route('followers',['username'=>$user->username])}}" class="hovereffect">Followers {{count($user->followers)}}</a>
        <a href="{{route('following',['username'=>$user->username])}}" class="hovereffect">Following {{count($user->followings)}}</a>
        <a href="{{route('likes',['username'=>$user->username])}}" class="hovereffect">Likes {{count($user->likes)}}</a>
    </nav>
    @if($user->isPrivate && $user->id != \Illuminate\Support\Facades\Auth::id())
        <p>User is private</p>
    @else
        @foreach($posts as $post)
            <x-post :post="$post"/>
        @endforeach
    @endif
@endsection
