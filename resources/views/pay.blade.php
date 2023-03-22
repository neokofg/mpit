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
    <form action="{{route('payment')}}" method="post">
        @csrf
        <input type="hidden" name="tourbase_id" value="{{$tourbase_id}}">
        <input type="date" id="date-input" name="date">
        <br>
        <input type="number" name="peoples" placeholder="peoples">
        <br>
        <input type="tel" name="phone" id="phone" placeholder="+7 (___) ___-__-__">
        <br>
        <input type="submit" value="Оплатить">
    </form>
</body>
</html>
