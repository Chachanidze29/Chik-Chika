<div class="post">
    <a class="postwrapper" href="{{url('/post',[$post->id])}}">
        <object>
                <h2><a href="{{url('/',[$post->user->username])}}" class="userlink">{{$post->user->username}}</a></h2>
                <p class="post-content">{{$post->content}}</p>
        </object>
    </a>
    <div class="post-footer">
        @if($post->likedBy->contains(\Illuminate\Support\Facades\Auth::id()))
            <form action="{{route('unlike',['id'=>$post->id])}}" method="post">
                @csrf
                <input class="unfollowunlike" type="submit" value="Unlike {{count($post->likedBy)}}"/>
            </form>
        @else
            <form action="{{route('like',['id'=>$post->id])}}" method="post">
                @csrf
                <input class="followlike" type="submit" value="Like {{count($post->likedBy)}}"/>
            </form>
        @endif
        <a href="{{url('/post',[$post->id])}}">Comments {{count($post->comments)}}</a>
    </div>
</div>

