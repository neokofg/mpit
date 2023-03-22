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
    <h2>Регистрация</h2>
    <form action="{{route('auth.createUser')}}" method="POST">
        @csrf
        <input type="text" name="email" placeholder="email">
        <br>
        <input type="text" name="name" placeholder="name">
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <button>submit</button>
    </form>
</body>
</html>
