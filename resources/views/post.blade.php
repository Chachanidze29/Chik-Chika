@extends('layouts.app')
@if($parent)
    @section('title','Comment')
@else
    @section('title','Post')
@endif
@section('back_url','/home')

@section('content')
    @if($parent)
        <livewire:post :post="$parent"/>
    @endif

    <div class="flex flex-col bg-gray-200 rounded p-2">
            <object>
                <x-user-profile-link href="{{url('/',[$post->user->username])}}" value="{{$post->user->username}}"/>
                <p class="text-lg m-2 ml-0">{!! $post->content !!}</p>
            </object>
        <div class="flex items-center justify-center">
            @auth
                @if($post->likedBy->contains(auth()->id()))
                    <form action="{{route('unlike',['id'=>$post->id])}}" method="post">
                        @csrf
                        <x-my-button :isRed="true" value="Unlike {{count($post->likedBy)}}"/>
                    </form>
{{--                    <button wire:click="like">Like</button>--}}
                @else
                    <form action="{{route('like',['id'=>$post->id])}}" method="post">
                        @csrf
                        <x-my-button value="Like {{count($post->likedBy)}}"/>
                    </form>
{{--                    <button wire:click="unlike">Unlike</button>--}}
                @endif
            @endauth
        </div>
        @auth
            <form class="flex mt-4 pt-2 border-t-2 flex-row justify-between items-center" method="post" action="{{route('comment',['id'=>$post->id])}}">
                @csrf
                <div class="flex flex-col items-stretch basis-4/5 justify-between">
                    <textarea placeholder="Reply..." class="basis-4/5 p-2" name="content"></textarea>
                    @error('content')
                    <p class="m-2 ml-0 text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <x-submit type="submit" value="Submit"/>
            </form>
        @endauth
    </div>
    <h1 class="m-2 ml-0 text-2xl font-bold">Comments:</h1>
    @foreach($comments as $comment)
        <livewire:post :post="$comment"/>
    @endforeach
@endsection
