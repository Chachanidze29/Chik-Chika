@extends('layouts.app',['username'=>\Illuminate\Support\Facades\Auth::user()->username])

@section('title','Home')

@section('content')
    <form onclick="document.getElementById('text').focus()" class="tweetform" action="{{route('tweet')}}" method="post">
        @csrf
        <textarea autocomplete="off" id="text" name="content" placeholder="What's Going On"></textarea>
        @error('content')
        <p style="color: red">{{$message}}</p>
        @enderror
        <input id="submit" type="submit" />
    </form>
    @foreach($posts as $post)
        <x-post :post="$post"/>
    @endforeach
@endsection
