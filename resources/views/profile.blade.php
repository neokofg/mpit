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
    <p>{{Auth::user()->name}}</p>
    <p>{{Auth::user()->email}}</p>
    <h2>История броней</h2>
    @foreach($bookings as $booking)
        <div style="border:1px solid black">
            <p>{{$booking->created_at}}</p>
            <p>{{$booking->date}}</p>
            <p>{{$booking->people}}</p>
            <p>{{$booking->tourbase->name}}</p>
        </div>
    @endforeach
</body>
</html>
