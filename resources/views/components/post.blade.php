<a class="postwrapper" href="{{url('/post',[$post->id])}}">
    <object>
        <div class="post">
            <h2><a href="{{url('/',[$post->user->username])}}" class="userlink">{{$post->user->username}}</a></h2>
            <p class="post-content">{{$post->content}}</p>
            @if($post->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
                <form action="{{route('unlike',['id'=>$post->id])}}" method="post">
                    @csrf
                    <input class="unfollowunlike" type="submit" value="Unlike"/>
                </form>
            @else
                <form action="{{route('like',['id'=>$post->id])}}" method="post">
                    @csrf
                    <input class="followlike" type="submit" value="Like"/>
                </form>
            @endif
        </div>
    </object>
</a>
