<!doctype html>
<html lang="en">
<x-head></x-head>
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
        <label for="classification1">На реке</label>
        <input type="checkbox" name="classification[]" id="classification1" value="На реке">
        <br>
        <label for="classification2">Рыбалка</label>
        <input type="checkbox" name="classification[]" id="classification2" value="Рыбалка">
        <br>
        <label for="classification3">В горах</label>
        <input type="checkbox" name="classification[]" id="classification3" value="В горах">
        <br>
        <label for="classification4">Недалеко от города</label>
        <input type="checkbox" name="classification[]" id="classification4" value="Недалеко от города">
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
