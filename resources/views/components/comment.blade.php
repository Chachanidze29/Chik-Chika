<div class="flex flex-col bg-gray-100 hover:bg-gray-200 mt-2">
    <a href="{{route('seeComment',['id'=>$comment->id])}}">
        <object>
            <div class="flex flex-col justify-center items-start p-2">
                <x-user-link href="{{url('/',$comment->user->username)}}" value="{{$comment->user->username}}"/>
                <p>{{$comment->content}}</p>
            </div>
        </object>
    </a>
    <div class="flex justify-around">
        @auth
            @if($comment->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
                <form action="{{route('unlike',['id'=>$comment->id])}}" method="post">
                    @csrf
                    <x-like-unlike-button value="Unlike" />
                </form>
            @else
                <form action="{{route('like',['id'=>$comment->id])}}" method="post">
                    @csrf
                    <x-like-unlike-button value="Like" />
                </form>
            @endif
        @endauth
    </div>
</div>
