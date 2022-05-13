@extends('layouts.app',['username'=>\Illuminate\Support\Facades\Auth::user()->username])

@section('title','Post')
@section('back_url','/home')

@section('content')
    <x-post :post="$post"/>
@endsection
