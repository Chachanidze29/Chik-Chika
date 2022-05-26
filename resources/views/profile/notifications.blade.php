@extends('layouts.app')

@section('title','Notifications')

@section('content')
    <livewire:notifications :username="$username"/>
@endsection
