@extends('layouts.app')

@section('title','Explore/'.ucfirst($category))

@section('content')
    @if(!count($posts))
        <p>No Posts</p>
    @else
        @foreach($posts as $post)
            <livewire:post :post="$post" />
        @endforeach
    @endif
@endsection
