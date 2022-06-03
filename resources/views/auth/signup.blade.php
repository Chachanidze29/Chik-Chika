<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>{{env('APP_NAME')}}</title>
</head>
<body>
    <x-form-wrapper action="{{route('signup.create')}}">
        @csrf
        <x-custom-input type="text" name="username" value="{{old('username')}}" placeholder="Enter UserName"/>
        @error('username')
        <p style="color: red">{{$message}}</p>
        @enderror
        <x-custom-input type="email" name="email" value="{{old('email')}}" placeholder="Enter Email"/>
        @error('email')
        <p style="color: red">{{$message}}</p>
        @enderror
        <x-custom-input type="password" name="password" placeholder="Enter Password"/>
        @error('password')
        <p style="color: red">{{$message}}</p>
        @enderror
        <x-submit type="submit" value="Submit" />
        <p>Already have an account? <a href="{{route('login')}}" class="font-bold border-b-2 hover:border-gray-400">Log In</a></p>
    </x-form-wrapper>
</body>
</html>
