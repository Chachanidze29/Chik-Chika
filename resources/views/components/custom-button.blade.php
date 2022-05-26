@props([
'isRed'=>false,
'value',
])

<button {{$attributes}} class="w-20 border-2 rounded {{$isRed === true ?  'border-red-400 text-red-400 hover:bg-red-100' : 'border-blue-400 text-blue-400 hover:bg-blue-100'}}  pt-1.4 pb-1.4 pr-1.7 pl-1.7 hover:cursor-pointer" type="submit">
{{$value}}
</button>
