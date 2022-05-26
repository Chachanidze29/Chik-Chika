<div>
    <div class="flex justify-between items-center">
        <div>
            <x-notification-button wire:click="all" active="{{$active === 'All'}}" value="All"/>
            <x-notification-button wire:click="unread" active="{{$active === 'Unread'}}" value="Unread"/>
        </div>
        <button wire:click="readAll" class="border-2 border-gray-400 p-2 hover:bg-gray-200">Mark All As Read</button>
    </div>
    @if(count($notifications) > 0)
        @foreach($notifications as $notification)
            <a href="{{route('notification',[
                    'username'=>$username,
                    'id'=>$notification->id
                ])}}">
                <object>
                    <div class="mt-3 p-5 bg-gray-100 {{$notification->read_at ? '' : 'bg-blue-100'}} text-2xl font-bold rounded hover:bg-gray-200 {{$notification->read_at ? '' : 'hover:bg-blue-200'}}">
                        @switch($notification->type)
                            @case('App\Notifications\Liked')
                            @case('App\Notifications\Tweeted')
                            <p>
                                {{$notification->data['username']}} {{$notification->data['text']}} Post
                            </p>
                            @break
                            @case('App\Notifications\Commented')
                            <p>
                                {{$notification->data['username']}} {{$notification->data['text1']}} Comment {{$notification->data['text2']}} Post
                            </p>
                            @break
                            @case('App\Notifications\Followed')
                            @case('App\Notifications\Unfollowed')
                            <p>
                                {{$notification->data['username']}} {{$notification->data['text']}}
                            </p>
                            @break
                        @endswitch
                    </div>
                </object>
            </a>
        @endforeach
    @else
        <p class="mt-3">No Notifications</p>
    @endif
</div>
