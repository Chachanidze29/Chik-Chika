@extends('layouts.app',['username'=>\Illuminate\Support\Facades\Auth::user()->username])

@section('title','Search')
@section('back_url',redirect()->back()->getTargetUrl())

@section('content')
    @if(count($users)>0)
        @foreach($users as $user)
            <p><a href="/{{$user->username}}">{{$user->username}}</a></p>
        @endforeach
    @else
        <p>No Such Users Found</p>
    @endif
@endsection
