<div>
    <form class="flex relative flex-row justify-between items-center mb-2" action="{{route('tweet')}}" method="post">
        @csrf
        <div class="relative basis-5/6">
            <textarea class="border-gray-400 rounded w-full border-2 p-2 pr-48" autocomplete="off"  id="text" name="content" placeholder="What's Going On">{{old('content')}}</textarea>
            <select name="category_name" class="absolute right-2 top-2 text-center p-2 pl-0 outline-0 bg-gray-200 hover:bg-gray-300 hover:cursor-pointer">
                <option disabled selected value> -- select an category -- </option>
                @foreach($categories as $category)
                    <option class="p-2" name="{{$category['name']}}">{{ucfirst($category['name'])}}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col items-center justify-between">
            @error('content')
            <p style="color: red">{{$message}}</p>
            @enderror
            @error('category_name')
            <p style="color: red">{{$message}}</p>
            @enderror
        </div>
        <x-submit type="submit" value="Submit"/>
    </form>
    @foreach($posts as $post)
        <livewire:post :post="$post"/>
    @endforeach
{{--    @if(count($posts) > 0 && count($posts) < auth()->user()->posts()->count())--}}
{{--        <button wire:click="loadMore" class="text-2xl border-b-2 border-b-gray-500 m-3 hover:border-blue-400 hover:text-blue-400">Load More</button>--}}
{{--    @endif--}}
</div>
