<div class="flex flex-col items-center justify-between">
    <h1>Hey <a href="{{url('/'.$data['username'])}}">{{$data['username']}}</a></h1>
    <p>You followed {{$data['followings']}} Users Last Week</p>
    <p>You was followed by {{$data['followers']}} Users Last Week</p>
</div>
