@extends('layouts.app',['username'=>\Illuminate\Support\Facades\Auth::user()->username])

@section('title','Notifications')

@section('content')
    @if(count($notifications) > 0)
        @foreach($notifications as $notification)
            @switch($notification->type)
                @case('App\Notifications\Liked')
                @case('App\Notifications\Tweeted')
                    <p><a href="{{url('/'.$notification->data['username'])}}">{{$notification->data['username']}}</a>
                        {{$notification->data['text']}} <a href="{{$notification->data['postRoute']}}">Post</a>
                    </p>
                    @break
                @case('App\Notifications\Followed')
                @case('App\Notifications\Unfollowed')
                    <p><a href="{{url('/'.$notification->data['username'])}}">{{$notification->data['username']}}</a>
                        {{$notification->data['text']}}
                    </p>
                    @break
            @endswitch
        @endforeach
    @else
        <p>No Notifications</p>
    @endif
@endsection
