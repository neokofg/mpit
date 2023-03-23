<!doctype html>
<html lang="en">
<x-head></x-head>
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
