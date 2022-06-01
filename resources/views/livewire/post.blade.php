<div class="flex flex-col justify-between bg-gray-100 hover:bg-gray-200 p-2 mb-2">
    <a href="{{url('/post',[$post->id])}}">
        <object>
            <x-user-profile-link href="{{url('/',[$post->user->username])}}" value="{{$post->user->username}}"/>
            <p class="text-lg m-2 ml-0 break-words">{!! $post->content !!}</p>
        </object>
    </a>
    <div class="flex flex-row items-center justify-around">
        @auth
            @if($post->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
                <form action="{{route('unlike',['id'=>$post->id])}}" method="post">
                    @csrf
                    <x-my-button :isRed="true" value="Unlike {{count($post->likedBy)}}" />
                </form>
            @else
                <form action="{{route('like',['id'=>$post->id])}}" method="post">
                    @csrf
                    <x-my-button value="Like {{count($post->likedBy)}}" />
                </form>
            @endif
        @endauth
        <a class="border-2 border-amber-400 hover:bg-amber-100 pl-2 pr-2" href="{{route('post',[$post->id])}}">Comments {{count($post->comments)}}</a>
    </div>
</div>
