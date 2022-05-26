@extends('layouts.app',['username'=>$username])

@section('title','Profile')
@section('back_url','home')

@section('content')
    <livewire:user-profile :username="$username" />
@endsection
