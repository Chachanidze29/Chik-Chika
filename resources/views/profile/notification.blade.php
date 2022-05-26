@extends('layouts.app')

@section('title','Notifications')

@section('content')
    <livewire:notification :username="$username" :notificationId="$id"/>
@endsection
