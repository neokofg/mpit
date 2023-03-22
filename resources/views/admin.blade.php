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
    <h2>Создать турбазу</h2>
    <form action="{{route('admin.createTourBase')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="name">
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
</body>
</html>
