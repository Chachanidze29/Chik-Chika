@extends('layouts.app',['username'=>\Illuminate\Support\Facades\Auth::user()->username])

@section('title','Home')

@section('content')
    <form onclick="document.getElementById('text').focus()" class="flex flex-row justify-between items-center mb-2" action="{{route('tweet')}}" method="post">
        @csrf
        <textarea class="border-gray-400 rounded basis-5/6 border-2 p-2" autocomplete="off"  id="text" name="content" placeholder="What's Going On"></textarea>
        @error('content')
        <p style="color: red">{{$message}}</p>
        @enderror
        <x-submit-button type="submit" value="Submit"/>
    </form>
    @foreach($posts as $post)
        <x-post :post="$post"/>
    @endforeach
@endsection
