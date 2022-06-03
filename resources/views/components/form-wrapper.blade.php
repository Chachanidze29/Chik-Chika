@props([
    'action'
])

<form method="post" action="{{$action}}" class="flex flex-col justify-center items-center w-full h-1/2 mt-0 mb-0 ml-auto mr-auto">{{$slot}}</form>
