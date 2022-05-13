<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post">
        @csrf
        <input autocomplete="off" type="text" name="username" placeholder="Enter UserName"/>
        @error('username')
        <p style="color: red">{{$message}}</p>
        @enderror
        <input autocomplete="off" type="email" name="email" placeholder="Enter Email"/>
        @error('email')
        <p style="color: red">{{$message}}</p>
        @enderror
        <input autocomplete="off" type="password" name="password" placeholder="Enter Password"/>
        @error('password')
        <p style="color: red">{{$message}}</p>
        @enderror
        <input type="submit" value="Submit" />
        <p>Already have an account? <a href="{{route('login')}}">Log In</a></p>
    </form>
</body>
</html>
