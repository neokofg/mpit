<!doctype html>
<html lang="en">
<x-head></x-head>
<body>
    <h2>Логин</h2>
    <form action="{{route('auth.loginUser')}}" method="POST">
        @csrf
        <input type="text" name="email" placeholder="email">
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <button>submit</button>
    </form>
</body>
</html>
