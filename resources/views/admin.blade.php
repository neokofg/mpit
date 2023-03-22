<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=be203022-19da-4b49-8bcb-5ca04a8cb7ea&lang=ru_RU" type="text/javascript"></script>
</head>
<style>
    #map {
        width: 600px;
        height: 400px;
    }
</style>
<body>
    <h2>Создать турбазу</h2>
    <form action="{{route('admin.createTourBase')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="name">
        <br>
        <input type="text" name="location" placeholder="location">
        <br>
        <textarea name="description" id="" cols="30" rows="10" placeholder="description"></textarea>
        <br>
        <input type="file" name="images[]" multiple>
        <br>
        <label for="coords">Координаты турбазы</label>
        <input type="text" name="coords" id="coords" value="62.03, 129.73">
        <div id="map"></div>
        <br>
        <button>submit</button>
    </form>
    <script>
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [62.03, 129.73],
                zoom: 10,
                suppressMapOpenBlock: true
            });

            // Добавляем слушателя клика на карту
            myMap.events.add('click', function (e) {
                var coords = e.get('coords');
                myPlacemark.geometry.setCoordinates(coords);
                // Устанавливаем координаты в инпуте
                $('#coords').val(coords);
            });

            var myPlacemark = new ymaps.Placemark(myMap.getCenter(), {}, {
                draggable: true
            });

            myMap.geoObjects.add(myPlacemark);

            // При перемещении метки обновляем координаты в инпуте
            myPlacemark.events.add('dragend', function () {
                var coords = myPlacemark.geometry.getCoordinates();
                $('#coords').val(coords);
                console.log(coords)
            });
        }
    </script>
</body>
</html>
