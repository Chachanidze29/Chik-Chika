@extends('layouts.app')

@section('title','Token')

@section('content')
    <x-link href="{{route('token.show')}}" text="Tokens"/>
    <div class="flex flex-col items-center break-words m-2 p-4 bg-gray-200 text-xl justify-between">
        <p class="font-bold">Name</p>
        <p class="basis-2/5">{{$tokenName}}</p>
        <p class="font-bold">Token</p>
        <p class="basis-3/5">{{$token}}</p>
    </div>
@endsection
