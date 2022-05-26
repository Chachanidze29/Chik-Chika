@extends('layouts.app')

@section('title',$username)
@section('back_url',redirect()->back()->getTargetUrl())

@section('content')
    @if(count($users)>0)
        <h1 class="text-2xl font-bold">Results:</h1>
        <ul class="m-5 ml-1">
        @foreach($users as $user)
            <li>
                <x-user-profile-link href="/{{$user->username}}" value="{{$user->username}}"/>
            </li>
        @endforeach
        </ul>
    @else
        <p>No Such Users Found</p>
    @endif
@endsection
