@extends('layouts.app')

@section('title','Notifications')

@section('content')
    <div class="p-5 bg-gray-200 mb-5 text-2xl font-bold rounded">
        @switch($notification->type)
            @case('App\Notifications\Liked')
            @case('App\Notifications\Tweeted')
            @case('App\Notifications\Commented')
                <p>
                    <a class="border-b-2 border-gray-400" href="{{url('/'.$notification->data['username'])}}">{{$notification->data['username']}}</a>
                    {{$notification->data['text']}} <a class="border-b-2 border-gray-400" href="{{$notification->data['postRoute']}}">Post</a>
                </p>
                @break
            @case('App\Notifications\Followed')
            @case('App\Notifications\Unfollowed')
                <p>
                    <a class="border-b-2 border-gray-400" href="{{url('/'.$notification->data['username'])}}">{{$notification->data['username']}}</a>
                    {{$notification->data['text']}}
                </p>
                @break
        @endswitch
    </div>
@endsection
