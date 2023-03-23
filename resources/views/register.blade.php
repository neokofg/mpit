<!doctype html>
<html lang="en">
<x-head></x-head>
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
