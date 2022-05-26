<div class="flex flex-col bg-gray-100 hover:bg-gray-200 p-2 mb-2">
    <a href="{{url('/post',[$post->id])}}">
        <object>
            <x-user-profile-link href="{{url('/',[$post->user->username])}}" value="{{$post->user->username}}"/>
            <p class="text-lg m-2 ml-0">{{$post->content}}</p>
        </object>
    </a>
    <div class="flex justify-around">
        @auth
            @if($post->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
                <form action="{{route('unlike',['id'=>$post->id])}}" method="post">
                    @csrf
                    <x-my-button :isRed="true" value="Unlike" />
                </form>
            @else
                <form action="{{route('like',['id'=>$post->id])}}" method="post">
                    @csrf
                    <x-my-button value="Like" />
                </form>
            @endif
        @endauth
        <a class="border-2 border-amber-400 hover:bg-amber-100 pl-2 pr-2" href="{{route('post',[$post->id])}}">Comments {{count($post->comments)}}</a>
    </div>
</div>
