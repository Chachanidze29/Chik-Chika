@php
    $res = explode('/',url()->current());
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChikChika / @yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="root">
        @section('header')
            <header>
                <div class="logo-wrapper">
                    <a href="{{route('home')}}">
                        <img src="{{url('/images/logo.png')}}" alt="Logo" class="hovereffect"/>
                    </a>
                </div>
                @if(end($res) !== 'home')
                    <h2 class="sub-title goback">
                        @auth
                            <a href="@yield('back_url')">
                                <img src="{{url('/images/arrow.png')}}" alt="arrow"/>
                            </a>
                        @endauth
                        <span>@yield('title')</span>
                    </h2>
                @else
                    <h2 class="sub-title">@yield('title')</h2>
                @endif
                <form action="{{route('search')}}" method="get">
                    <input type="search" name="search" />
                    <input autocomplete="off" required type="submit" value="Search" placeholder="Search..."/>
                </form>
            </header>
        @show
        <main>
            @section('sidebar')
                <nav>
                    @auth
                        <a href="{{route('home')}}" class="navlink hovereffect with-image">
                            <img src="{{url('/images/home.png')}}" alt="home logo">
                            <span>Home</span>
                        </a>
                        <a href="{{url('/',\Illuminate\Support\Facades\Auth::user()->username)}}" class="navlink hovereffect with-image">
                            <img src="{{url('/images/profile.png')}}" alt="profile logo">
                            <span>Profile</span>
                        </a>
                        <a href="{{route('logout')}}" class="navlink hovereffect with-image">
                            <img src="{{url('/images/logout.png')}}" alt="logout logo">
                            <span>Log Out</span>
                        </a>
                    @endauth
                </nav>
            @show
            <div class="container">
                @yield('content')
            </div>
            <aside>

            </aside>
        </main>
    </div>
</body>
</html>
