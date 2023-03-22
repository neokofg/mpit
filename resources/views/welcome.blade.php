<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=be203022-19da-4b49-8bcb-5ca04a8cb7ea&lang=ru_RU" type="text/javascript"></script>
    @livewireStyles
</head>
<style>
    #map2 {
        width: 100%;
        height: 600px;
    }
</style>
<body>
    <h2>Поиск</h2>
    @livewire('search-tourbases')
    @if(Auth::check())
        <h2>Вы вошли!</h2>
        <a href="{{route('profile')}}">Личный кабинет</a>
        <a href="{{route('auth.logoutUser')}}">Выйти</a>
        @foreach($tourbases as $tourbase)
            <div style="border: 1px solid black">
                <p>{{$tourbase->name}}</p>
                <p>{{$tourbase->description}}</p>
                <p>@isset($tourbase->rating){{$tourbase->rating}}({{App\Models\Rating::where('tourbase_id', $tourbase->id)->count()}} Отзыва!)@endisset</p>
                <a href="{{route('page',$tourbase->id)}}">Перейти</a>
            </div>
        @endforeach
        <div id="map2"></div>
    @else
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
    <h2>Логин</h2>
    <form action="{{route('auth.loginUser')}}" method="POST">
        @csrf
        <input type="text" name="email" placeholder="email">
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <button>submit</button>
    </form>
    @endif
    <script>
        ymaps.ready(init);

        function init() {
            var myMap2 = new ymaps.Map("map2", {
                center: [62.03, 129.73],
                zoom: 10,
                suppressMapOpenBlock: true
            });
            @foreach($tourbases as $tourbase)
            var myPlacemark{{$tourbase->id}} = new ymaps.Placemark([{{$tourbase->coords}}], {
                hintContent: '{{$tourbase->name}}'
            }, {
                preset: 'islands#icon',
                iconColor: '#0095b6'
            });
            myMap2.geoObjects.add(myPlacemark{{$tourbase->id}});
            @endforeach
        }
    </script>
    @livewireScripts
</body>
</html>
