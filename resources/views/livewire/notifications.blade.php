<div>
    <div class="flex justify-between items-center">
        <div>
            <x-notification-link wire:click="setActiveAll" active="{{$active === 'All'}}" value="All"/>
            <x-notification-link wire:click="setActiveUnread" active="{{$active === 'Unread'}}" value="Unread"/>
        </div>
        <button wire:click="readAll" class="border-2 border-gray-400 p-2 hover:bg-gray-200">Mark All As Read</button>
    </div>
    @if(count($notifications) > 0)
        @foreach($notifications as $notification)
            <a href="{{route('notification',[
                    'username'=>$username,
                    'id'=>$notification['id']
                ])}}">
                <object>
                    <div class="mt-3 mb-3 p-5 bg-gray-100 {{$notification['read_at'] ? '' : 'bg-blue-100'}} text-2xl font-bold rounded hover:bg-gray-200 {{$notification['read_at'] ? '' : 'hover:bg-blue-200'}}">
                        @switch($notification['type'])
                            @case('App\Notifications\Liked')
                            @case('App\Notifications\Tweeted')
                            <p>
                                {{$notification['data']['username']}} {{$notification['data']['text']}} Post
                            </p>
                            @break
                            @case('App\Notifications\Commented')
                            <p>
                                {{$notification['data']['username']}} {{$notification['data']['text1']}} Comment {{$notification['data']['text2']}} Post
                            </p>
                            @break
                            @case('App\Notifications\Followed')
                            @case('App\Notifications\Unfollowed')
                            <p>
                                {{$notification['data']['username']}} {{$notification['data']['text']}}
                            </p>
                            @break
                        @endswitch
                    </div>
                </object>
            </a>
        @endforeach
        <div class="flex justify-center items-center">
            @if(count($notifications) > 0)
                @if($active === 'All' && count($notifications) < auth()->user()->notifications()->count() || $active === 'Unread' && count($notifications) < auth()->user()->unreadNotifications()->count())
                    <button wire:click="loadMore" class="text-2xl border-b-2 border-b-gray-500 m-3 hover:border-blue-400 hover:text-blue-400">Load More</button>
                @endif
            @endif
        </div>
    @else
        <p class="mt-3">No Notifications</p>
    @endif
</div>
