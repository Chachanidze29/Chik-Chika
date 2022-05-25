@extends('layouts.app')

@section('title','Notifications')

@section('content')
    <a class="border-b-2 mr-2 border-gray-200 hover:border-gray-400 text-2xl" href="{{route('notifications',['username'=>\Illuminate\Support\Facades\Auth::user()->username])}}">All</a>
    @if(count($notifications) > 0)
        <a class="border-b-2 border-gray-200 hover:border-gray-400 text-2xl" href="{{route('unreadNotifications',['username'=>\Illuminate\Support\Facades\Auth::user()->username])}}">Unread</a>
        @foreach($notifications as $notification)
            <a href="{{route('notification',[
                'username'=>\Illuminate\Support\Facades\Auth::user()->username,
                'id'=>$notification->id
                ])}}">
                <object>
                    <div class="mt-3 p-5 bg-gray-100 {{$notification->read_at ? '' : 'bg-blue-100'}} text-2xl font-bold rounded hover:bg-gray-200 {{$notification->read_at ? '' : 'hover:bg-blue-200'}}">
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
                </object>
            </a>
        @endforeach
    @else
        <p class="mt-3">No Notifications</p>
    @endif
@endsection
