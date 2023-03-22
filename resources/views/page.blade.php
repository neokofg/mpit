<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=be203022-19da-4b49-8bcb-5ca04a8cb7ea&lang=ru_RU" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    #map {
        width: 600px;
        height: 400px;
    }
    .disabled {
        color: gray;
        pointer-events: none;
    }
</style>
<body>
<div class="col-3 align-self-start">
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            @foreach($images as $key => $value)
                @if ($loop->first)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" class="active" aria-current="true" aria-label="Slide{{$key}}"></button>
                @else
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" aria-label="Slide{{$key}}"></button>
                @endif
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($images as $key => $value)
                @if($loop->first)
                    <div class="carousel-item active">
                        <img src="/images/{{$value['name']}}" height="400" class="d-block w-100 rounded">
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="/images/{{$value['name']}}" height="400" class="d-block w-100 rounded">
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
    <p>{{$tourbase->name}}</p>
    <p>{{$tourbase->description}}</p>
    <p>@isset($tourbase->rating){{$tourbase->rating}}@endisset</p>
    <div id="map"></div>
    <h2>Забронировать</h2>
    <form action="{{route('createNewBooking')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$tourbase->id}}">
        <input type="date" id="date-input" name="date">
        <br>
        <input type="number" name="peoples" placeholder="peoples">
        <br>
        <input type="tel" name="phone" id="phone" placeholder="+7 (___) ___-__-__">
        <br>
        <button>submit</button>
    </form>
    <h2>Брони</h2>
    @foreach($bookings as $booking)
        <p>Дата: {{$booking->date}}</p>
        <p>Количество людей: {{$booking->peoples}}</p>
        <p>Номер: {{$booking->phone}}</p>
    @endforeach
    <h2>Комментарии</h2>
    <p>Оставить комментарий:</p>
    <form action="{{route('createNewRating')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$tourbase->id}}">
        <textarea name="text" id="" cols="30" rows="10"></textarea>
        <div class="d-flex col-3 mt-3 text-center">
            <input name="rating" class="form-range col" id="range" type="range" min="1" max="5" step="1">
            <span class="col d-flex justify-content-center">
                <p class="text-dark" id="rangeValue">3</p>
                <span class="material-symbols-outlined" style="color:gold">star</span>
            </span>
        </div>
        <button>submit</button>
    </form>
    @foreach($ratings as $rating)
        <div style="border: 1px solid black">
            <p>{{$rating->user->name}}</p>
            <p>{{$rating->rating}}</p>
            <p>{{$rating->text}}</p>
        </div>
    @endforeach
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map("map", {
            center: [{{$tourbase->coords}}],
            zoom: 10,
        });
        var myPlacemark = new ymaps.Placemark(myMap.getCenter(), {}, {
            draggable: false
        });
        myMap.geoObjects.add(myPlacemark);
    }
    $(document).ready(function() {
        $('#phone').inputmask("+7 (999) 999-99-99");
    });
</script>
<script>
        const availableDates = @json($dates);

        // Находим элемент инпута типа дата
        const $dateInput = $('#date-input');

        // Добавляем обработчик события на изменение значения в инпуте
        $dateInput.on('change', () => {
            // Получаем выбранную дату из инпута
            const selectedDate = $dateInput.val();

            // Проверяем, есть ли выбранная дата в массиве доступных дат
            if (availableDates.includes(selectedDate)) {
                alert('Эта дата недоступна');
                // Очищаем значение инпута
                $dateInput.val('');
            }
        });
</script>
<script type="text/javascript">
    const range = document.getElementById('range');
    const rangeValue = document.getElementById('rangeValue');
    range.oninput = function(){
        rangeValue.innerHTML = range.value;
    }
</script>
</html>
