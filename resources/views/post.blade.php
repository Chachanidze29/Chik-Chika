@extends('layouts.app')

@section('title','Post')
@section('back_url','/home')

@section('content')
    <div class="flex flex-col bg-gray-100 rounded p-2">
            <object>
                <x-user-link href="{{url('/',[$post->user->username])}}" value="{{$post->user->username}}"/>
                <p class="text-lg m-2 ml-0">{{$post->content}}</p>
            </object>
        <div class="flex items-center justify-center">
            @auth
                @if($post->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
                    <form action="{{route('unlike',['id'=>$post->id])}}" method="post">
                        @csrf
                        <x-like-unlike-button type="submit" value="Unlike {{count($post->likedBy)}}"/>
                    </form>
                @else
                    <form action="{{route('like',['id'=>$post->id])}}" method="post">
                        @csrf
                        <x-like-unlike-button type="submit" value="Like {{count($post->likedBy)}}"/>
                    </form>
                @endif
            @endauth
        </div>
        @auth
            <form class="flex mt-4 pt-2 border-t-2 flex-row justify-between items-center" method="post" action="{{route('comment',['id'=>$post->id])}}">
                @csrf
                <textarea placeholder="Reply..." class="basis-4/5 p-2" name="content"></textarea>
                <x-submit-button type="submit" value="Submit"/>
            </form>
        @endauth
    </div>
    @foreach($comments as $comment)
        <x-comment :comment="$comment"/>
    @endforeach
@endsection
