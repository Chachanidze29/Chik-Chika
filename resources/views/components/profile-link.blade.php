@props([
'isActive'=>false,
'href',
'value'
])

<a class="p-2 pl-0 {{$isActive === 'true' ? 'border-b-2 border-blue-400' : ''}}" href={{$href}}>{{$value}}</a>
