<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>Document</title>
</head>
<body>
    <x-form-wrapper>
        @csrf
        <x-form-input type="text" name="email" placeholder="Enter Email"/>
        @error('email')
        <p style="color: red">{{$message}}</p>
        @enderror
        <x-form-input type="password" name="password" placeholder="Enter Password" />
        @error('password')
        <p style="color: red">{{$message}}</p>
        @enderror
        <x-submit-button type="submit" value="Submit" />
        <p>Don't have an account? <a href="{{route('signup')}}" class="font-bold border-b-2 hover:border-gray-400">Sign Up</a></p>
    </x-form-wrapper>
</body>
</html>
