@extends('layouts.app')

@section('title','Tokens')

@section('content')
    <div>
        <x-form-wrapper action="{{route('token.store')}}">
            @csrf
            <x-custom-input type="text" name="name" placeholder="Token Name" />
            @error('name')
                <p class="text-center mt-2 mb-2 text-red-500">{{$message}}</p>
            @enderror
            <x-my-button value="Generate" />
        </x-form-wrapper>
        <div class="w-full">
            @foreach($tokens as $token)
                <div class="flex items-center m-2 p-2 bg-gray-100 hover:bg-gray-200 rounded justify-between">
                    <p>{{$token->name}}</p>
                    <form method="post" action="{{route('token.delete',['token'=>$token->id])}}">
                        @csrf
                        <x-my-button :isRed="true" value="Delete"/>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
