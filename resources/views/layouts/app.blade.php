<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChikChika / @yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
    @livewireStyles
</head>
<body>
    <div id="root">
        @section('header')
            <header class="sticky top-0 bg-white flex flex-row pt-0.5 justify-between">
                <div class="pl-5 basis-1/5 flex">
                    <a href="{{route('home')}}">
                        <img src="{{url('/images/logo.png')}}" alt="Logo" class="w-10"/>
                    </a>
                </div>
                <h2 class="basis-1/2 text-2xl font-bold">@yield('title')</h2>
                <form action="{{route('search')}}" method="get" class="basis-1/4 flex flex-row items-center">
                    <input type="search" class="border-gray-400 border-2 rounded pt-2 basis-4/5 pb-2 pl-2 mr-2 w-20 outline-0" name="search" autocomplete="off" required placeholder="Search..." />
                    <x-submit-button class="basis-1/6" type="submit" value="Search"/>
                </form>
            </header>
        @show
        <main class="flex flex-row justify-between">
            @section('sidebar')
                <nav class="basis-1/5 content-end">
                    <div class="fixed">
                        @auth
                                <x-nav-link href="{{route('home')}}" text="Home"/>
                                <x-nav-link href="{{route('notifications',['username'=>\Illuminate\Support\Facades\Auth::user()->username])}}" text="Notifications {{count(\Illuminate\Support\Facades\Auth::user()->unreadNotifications)}}"/>
                                <x-nav-link href="{{url(\Illuminate\Support\Facades\Auth::user()->username)}}" text="Profile"/>
                                <x-nav-link href="{{route('logout')}}" text="Logout"/>
                        @endauth
                        @guest
                                <x-nav-link href="{{route('login')}}" text="Login"/>
                                <x-nav-link href="{{route('signup')}}" text="SignUp"/>
                        @endguest
                    </div>
                </nav>
            @show
            <div class="basis-1/2">
                @yield('content')
            </div>
            <aside class="basis-1/4">
                @auth

                @endauth
            </aside>
        </main>
    </div>
    @livewireScripts
</body>
</html>
