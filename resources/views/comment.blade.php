@extends('layouts.app')

@section('title','Comment')
@section('back_url','/home')

@section('content')
    @if($parent?->commentable_id != null)
        <x-comment :comment="$parent"/>
    @else
        <x-post :post="$parent"/>
    @endif

    <br/>

    <div class="flex flex-col bg-gray-200 rounded p-2">
        <object>
            <x-user-link href="{{url('/',[$comment->user->username])}}" value="{{$comment->user->username}}"/>
            <p class="text-lg m-2 ml-0">{{$comment->content}}</p>
        </object>
        <div class="flex items-center justify-center">
            @auth
                @if($comment->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
                    <form action="{{route('unlike',['id'=>$comment->id])}}" method="post">
                        @csrf
                        <x-like-unlike-button type="submit" value="Unlike {{count($comment->likedBy)}}"/>
                    </form>
                @else
                    <form action="{{route('like',['id'=>$comment->id])}}" method="post">
                        @csrf
                        <x-like-unlike-button type="submit" value="Like {{count($comment->likedBy)}}"/>
                    </form>
                @endif
            @endauth
        </div>
        @auth
            <form class="flex mt-4 pt-2 border-t-2 flex-row justify-between items-center" method="post" action="{{route('reply',['id'=>$comment->id])}}">
                @csrf
                <textarea placeholder="Reply..." class="basis-4/5 p-2" name="content"></textarea>
                <x-submit-button type="submit" value="Submit"/>
            </form>
        @endauth
    </div>
    <h1 class="m-2 ml-0 font-bold text-2xl">Replies:</h1>
    @foreach($replies as $reply)
        <x-comment :comment="$reply"/>
    @endforeach
@endsection
