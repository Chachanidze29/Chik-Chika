<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{config('app.name')}} / @yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    @livewireStyles
</head>
<body>
    <div id="root">
        @section('header')
            <header class="sticky z-50 top-0 bg-white bg-opacity-80 flex flex-row pt-0.5 justify-between">
                <div class="pl-5 basis-1/5 flex items-center justify-center">
                    <a href="{{route('home')}}">
                        <img src="{{url('/images/logo.png')}}" alt="Logo" class="w-10"/>
                    </a>
                </div>
                <h2 class="basis-1/2 text-2xl font-bold">@yield('title')</h2>
                <form action="{{route('search')}}" method="get" class="basis-1/4 flex flex-row items-center">
                    <input type="search" class="border-gray-400 border-2 rounded pt-2 basis-4/5 pb-2 pl-2 mr-2 w-20 outline-0" name="search" autocomplete="off" required placeholder="Search..." />
                    <x-submit class="basis-1/6" type="submit" value="Search"/>
                </form>
            </header>
        @show
        <main class="flex flex-row justify-between">
            @section('sidebar')
                <nav class="basis-1/5 flex justify-end">
                    <div class="fixed bg-gray-100 p-2 mt-2 flex flex-col items-end rounded-xl w-80 hover:bg-gray-200">
                        @auth
                                <x-link href="{{route('home')}}" text="Home"/>
                                <x-link href="{{route('notifications',['username'=>auth()->user()->username])}}" text="Notifications {{count(auth()->user()->unreadNotifications)}}"/>
                                <x-link href="{{url(auth()->user()->username)}}" text="Profile"/>
                                <x-link href="{{route('logout')}}" text="Logout"/>
                        @endauth
                        @guest
                                <x-link href="{{route('login')}}" text="Login"/>
                                <x-link href="{{route('signup')}}" text="SignUp"/>
                        @endguest
                    </div>
                </nav>
            @show
            <div class="basis-1/2 max-w-2xl">
                @yield('content')
            </div>
            <aside class="basis-1/4 relative flex flex-col justify-start items-start">
                <div class="fixed">
                    <div class="bg-gray-100 p-2 mt-2 rounded-xl flex flex-col items-start w-80 hover:bg-gray-200">
                        <h1 class="text-2xl font-bold">Categories:</h1>
                        @foreach($categories as $category)
                            <x-link href="{{route('explore',['category_name'=>$category->name])}}" text="{{ucfirst($category->name)}}" />
                        @endforeach
                    </div>
                    <div class="bg-gray-100 p-2 mt-2 rounded-xl hover:bg-gray-200">
                        <h1 class="text-2xl font-bold">Connect:</h1>
                        @foreach($usersToConnect as $user)
                            <div class="flex flex-row justify-between items-center">
                                <x-link href="{{url('/'.$user->username)}}" text="{{$user->username}}"/>
                                @auth
                                    <form action="{{route('follow',['id'=>$user->id])}}" method="post">
                                        @csrf
                                        <x-my-button value="Follow"/>
                                    </form>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </main>
    </div>
    @livewireScripts
</body>
</html>
