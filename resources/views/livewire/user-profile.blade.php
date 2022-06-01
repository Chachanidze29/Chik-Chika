<div class="ml-3">
    <div class="flex flex-col justify-between">
        <h1 class="text-2xl m-2 ml-0">{{$user->username}}</h1>
        <span class="text-sm mb-2 text-gray-600">Joined At {{explode(' ',$user->created_at)[0]}}</span>
    </div>
    @auth
        @if(\Illuminate\Support\Facades\Auth::id()!==$user->id)
            @if($user->followers->contains(auth()->user()))
                <form action="{{route('unfollow',['id'=>$user->id])}}" method="post">
                    @csrf
                    <x-my-button :isRed="true" value="Unfollow"/>
                </form>
            @else
                <form action="{{route('follow',['id'=>$user->id])}}" method="post">
                    @csrf
                    <x-my-button value="Follow"/>
                </form>
            @endif
        @else
            @auth
                @if($user->isPrivate)
                    <form method="post" action="{{route('makePublic',['username'=>$user->username])}}">
                        @csrf
                        <x-my-button value="Public"/>
                    </form>
                @else
                    <form method="post" action="{{route('makePrivate',['username'=>$user->username])}}">
                        @csrf
                        <x-my-button :isRed="true" value="Private"/>
                    </form>
                @endif
            @endauth
        @endif
    @endauth
    <nav class="flex flex-row justify-between m-2 ml-0">
{{--        <button wire:click="followers">Followers</button>--}}
{{--        <button wire:click="followings">Followings</button>--}}
{{--        <button wire:click="likes">Likes</button>--}}
        <x-profile-link href="{{url($user->username)}}" isActive="true" value="Tweets {{count($user->comments)}}"/>
        <x-profile-link href="{{route('followers',['username'=>$user->username])}}" value="Followers {{count($user->followers)}}"/>
        <x-profile-link href="{{route('following',['username'=>$user->username])}}" value="Following {{count($user->followings)}}"/>
        <x-profile-link href="{{route('likes',['username'=>$user->username])}}" value="Likes {{count($user->likes)}}" />
    </nav>
    @if($user->isPrivate && $user->id != \Illuminate\Support\Facades\Auth::id() && !$user->followers->contains(auth()->id()))
        <p>User is private</p>
    @else
        @if(!empty($users))
            <ul class="m-5 ml-1">
                @foreach($users as $user)
                    <li>
                        <x-user-profile-link href="/{{$user->username}}" value="{{$user->username}}"/>
                    </li>
                @endforeach
            </ul>
        @elseif(!empty($posts))
            @foreach($posts as $post)
                <livewire:post :post="$post"/>
            @endforeach
        @endif
    @endif
</div>
