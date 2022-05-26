@props([
'placeholder',
'type',
'name'
])

<input type="{{$type}}" autocomplete="off" placeholder="{{$placeholder}}" name="{{$name}}" class="p-2 mb-3 outline-0 border-2 rounded border-gray-300 text-2xl" />
