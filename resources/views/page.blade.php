<!doctype html>
<html lang="en">
<x-head></x-head>
<style>
    #map {
        width: 600px;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        margin-top:4vh;
    }
    .disabled {
        color: gray;
        pointer-events: none;
    }
    .carousel {
        display: flex;
        overflow: hidden;
        width: 100%;
        height: 80vh;
        position: relative;
    }
    .carousel-inner {
        display: flex;
        width: 100%;
        height: 100%;
        transition: transform 0.5s;
    }
    .carousel-item {
        flex: 0 0 100%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }
    .carousel-control-prev, .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        background-color: rgba(255, 255, 255, 0.7);
        padding: 10px;
        border-radius: 50%;
    }
    .carousel-control-prev {
        left: 10px;
    }
    .carousel-control-next {
        right: 10px;
    }
</style>
{{--<body>--}}
{{--<div class="col-3 align-self-start">--}}
{{--    <div id="carouselExampleIndicators" class="carousel slide">--}}
{{--        <div class="carousel-indicators">--}}
{{--            @foreach($images as $key => $value)--}}
{{--                @if ($loop->first)--}}
{{--                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" class="active" aria-current="true" aria-label="Slide{{$key}}"></button>--}}
{{--                @else--}}
{{--                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" aria-label="Slide{{$key}}"></button>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="carousel-inner">--}}
{{--            @foreach($images as $key => $value)--}}
{{--                @if($loop->first)--}}
{{--                    <div class="carousel-item active">--}}
{{--                        <img src="/images/{{$value['name']}}" height="400" class="d-block w-100 rounded">--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img src="/images/{{$value['name']}}" height="400" class="d-block w-100 rounded">--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">--}}
{{--            <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--            <span class="visually-hidden">Previous</span>--}}
{{--        </button>--}}
{{--        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">--}}
{{--            <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--            <span class="visually-hidden">Next</span>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}
<script>
    var viewportmeta = document.querySelector('meta[name="viewport"]');
    if (viewportmeta) {
        if (screen.width < 375) {
            var newScale = screen.width / 375;
            viewportmeta.content = 'width=375, minimum-scale=' + newScale + ', maximum-scale=1.0, user-scalable=no, initial-scale=' + newScale + '';
        } else {
            viewportmeta.content = 'width=device-width, maximum-scale=1.0, initial-scale=1.0';
        }
    }
</script>

<body>

<script>
    console.log(localStorage.getItem('darkMode'));
    if (localStorage.getItem('darkMode') === "on") {
        document.body.classList.add("dark");
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('.js-theme input').checked = true;
        });
    }
</script>
<!-- outer-->
<div class="outer">
    <!-- outer content-->
    <div class="outer__inner">
        <div class="section-mb64 product">
            <div class="product__center center">
                <div class="control">
                    <a class="button-stroke button-small control__button" href="{{route("index")}}">
                        <svg class="icon icon-arrow-left">
                            <use xlink:href="#icon-arrow-left"></use>
                        </svg><span>На главную</span></a>
                </div>

                <div class="gallery">
                    <div id="carousel" class="carousel">
                        <div class="carousel-inner">
                            @foreach($images as $key => $value)
                                <div class="carousel-item" style="background-image: url('/images/{{$value['name']}}');"></div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button">
                            <span class="carousel-control-prev-icon" aria-hidden="true">◀</span>
                        </button>
                        <button class="carousel-control-next" type="button">
                            <span class="carousel-control-next-icon" aria-hidden="true">▶</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="section description">
            <div class="description__center center">
                <div class="description__wrapper">
                    <h4 class="description__title h4">{{$tourbase->name}}</h4>
                    <div class="description__parameters">
                        <div class="description__parameter">
                            <box-icon class="icon icon-home" name='map'></box-icon>Местоположения
                        </div>
                        <div id="map"></div>
                    </div>
                    <div class="description__content">
                        <p>{{$tourbase->description}}.</p>
                    </div>
                    <div class="description__full">
                        <div class="description__content description__content_hide">
                            <p>{{$tourbase->description}}.</p>
                        </div>
                    </div>
                </div>
                <form action="{{route('payment')}}" method="post">
                @csrf
                    <input type="hidden" name="tourbase_id" value="{{$tourbase->id}}">
                <div class="receipt">
                    <div class="receipt__head">
                        <div class="receipt__details">
                            <div class="receipt__cost">
                                <div class="receipt__actual">3500 ₽</div>
                                <div class="receipt__note">/В день</div>
                            </div>
                            <div class="receipt__rating">
                                <svg class="icon icon-star">
                                    <use xlink:href="#icon-star"></use>
                                </svg>
                                @isset($tourbase->rating)
                                <div class="receipt__number">{{$tourbase->rating}}</div>
                                <div class="receipt__reviews">({{App\Models\Rating::where('tourbase_id', $tourbase->id)->count()}} Отзывов)</div>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="receipt__description receipt__description_flex">
                        <div class="datepicker">
                            <div class="datepicker__item">
                                <input name="date" class="datepicker__input js-date-single" data-format="MMM DD, YYYY" data-single="data-single" data-container=".datepicker" type="text" placeholder="Дата бронирования" readonly="readonly">
                                <div class="datepicker__icon">
                                    <svg class="icon icon-calendar">
                                        <use xlink:href="#icon-calendar"></use>
                                    </svg>
                                </div>
                                <div class="datepicker__description">Задать дату</div>
                            </div>
                            <div class="date-picker-wrapper single-date  no-shortcuts  no-topbar no-gap single-month" style="display: none; top: 99.9896px; left: 0px; user-select: none;" unselectable="on">
                                <div class="month-wrapper">
                                    <table class="month1" cellspacing="0" border="0" cellpadding="0">
                                        <thead>
                                        <tr class="caption">
                                            <th> <span class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.207 7.793a1 1 0 0 1 0 1.414L11.414 12l2.793 2.793a1 1 0 0 1-1.414 1.414l-3.5-3.5a1 1 0 0 1 0-1.414l3.5-3.5a1 1 0 0 1 1.414 0z" fill="#777e91"></path></svg>                   </span>                                                        </th>
                                            <th colspan="5" class="month-name">
                                                <div class="month-element">март</div>
                                                <div class="month-element">2023</div>
                                            </th>
                                            <th><span class="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.793 7.793a1 1 0 0 0 0 1.414L12.586 12l-2.793 2.793a1 1 0 0 0 1.414 1.414l3.5-3.5a1 1 0 0 0 0-1.414l-3.5-3.5a1 1 0 0 0-1.414 0z" fill="#777e91"></path></svg></span>                                                        </th>
                                        </tr>
                                        <tr class="week-name">
                                            <th>вс</th>
                                            <th>пн</th>
                                            <th>вт</th>
                                            <th>ср</th>
                                            <th>чт</th>
                                            <th>пт</th>
                                            <th>сб</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div time="1677356804360" data-tooltip="" class="day lastMonth  valid ">26</div>
                                            </td>
                                            <td>
                                                <div time="1677443204360" data-tooltip="" class="day lastMonth  valid ">27</div>
                                            </td>
                                            <td>
                                                <div time="1677529604360" data-tooltip="" class="day lastMonth  valid ">28</div>
                                            </td>
                                            <td>
                                                <div time="1677616004360" data-tooltip="" class="day toMonth  valid ">1</div>
                                            </td>
                                            <td>
                                                <div time="1677702404360" data-tooltip="" class="day toMonth  valid ">2</div>
                                            </td>
                                            <td>
                                                <div time="1677788804360" data-tooltip="" class="day toMonth  valid ">3</div>
                                            </td>
                                            <td>
                                                <div time="1677875204360" data-tooltip="" class="day toMonth  valid ">4</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div time="1677961604360" data-tooltip="" class="day toMonth  valid ">5</div>
                                            </td>
                                            <td>
                                                <div time="1678048004360" data-tooltip="" class="day toMonth  valid ">6</div>
                                            </td>
                                            <td>
                                                <div time="1678134404360" data-tooltip="" class="day toMonth  valid ">7</div>
                                            </td>
                                            <td>
                                                <div time="1678220804360" data-tooltip="" class="day toMonth  valid ">8</div>
                                            </td>
                                            <td>
                                                <div time="1678307204360" data-tooltip="" class="day toMonth  valid ">9</div>
                                            </td>
                                            <td>
                                                <div time="1678393604360" data-tooltip="" class="day toMonth  valid ">10</div>
                                            </td>
                                            <td>
                                                <div time="1678480004360" data-tooltip="" class="day toMonth  valid ">11</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div time="1678566404360" data-tooltip="" class="day toMonth  valid ">12</div>
                                            </td>
                                            <td>
                                                <div time="1678652804360" data-tooltip="" class="day toMonth  valid ">13</div>
                                            </td>
                                            <td>
                                                <div time="1678739204360" data-tooltip="" class="day toMonth  valid ">14</div>
                                            </td>
                                            <td>
                                                <div time="1678825604360" data-tooltip="" class="day toMonth  valid ">15</div>
                                            </td>
                                            <td>
                                                <div time="1678912004360" data-tooltip="" class="day toMonth  valid ">16</div>
                                            </td>
                                            <td>
                                                <div time="1678998404360" data-tooltip="" class="day toMonth  valid ">17</div>
                                            </td>
                                            <td>
                                                <div time="1679084804360" data-tooltip="" class="day toMonth  valid ">18</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div time="1679171204360" data-tooltip="" class="day toMonth  valid ">19</div>
                                            </td>
                                            <td>
                                                <div time="1679257604360" data-tooltip="" class="day toMonth  valid ">20</div>
                                            </td>
                                            <td>
                                                <div time="1679344004360" data-tooltip="" class="day toMonth  valid ">21</div>
                                            </td>
                                            <td>
                                                <div time="1679430404360" data-tooltip="" class="day toMonth  valid ">22</div>
                                            </td>
                                            <td>
                                                <div time="1679516804360" data-tooltip="" class="day toMonth  valid real-today">23</div>
                                            </td>
                                            <td>
                                                <div time="1679603204360" data-tooltip="" class="day toMonth  valid ">24</div>
                                            </td>
                                            <td>
                                                <div time="1679689604360" data-tooltip="" class="day toMonth  valid ">25</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div time="1679776004360" data-tooltip="" class="day toMonth  valid ">26</div>
                                            </td>
                                            <td>
                                                <div time="1679862404360" data-tooltip="" class="day toMonth  valid ">27</div>
                                            </td>
                                            <td>
                                                <div time="1679948804360" data-tooltip="" class="day toMonth  valid ">28</div>
                                            </td>
                                            <td>
                                                <div time="1680035204360" data-tooltip="" class="day toMonth  valid ">29</div>
                                            </td>
                                            <td>
                                                <div time="1680121604360" data-tooltip="" class="day toMonth  valid ">30</div>
                                            </td>
                                            <td>
                                                <div time="1680208004360" data-tooltip="" class="day toMonth  valid ">31</div>
                                            </td>
                                            <td>
                                                <div time="1680294404360" data-tooltip="" class="day nextMonth  valid ">1</div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="dp-clearfix"></div>
                                    <div class="time">
                                        <div class="time1"></div>
                                    </div>
                                    <div class="dp-clearfix"></div>
                                </div>
                                <div class="footer"></div>
                                <div class="date-range-length-tip"></div>
                            </div>
                        </div>
                    </div>

                    <div class="receipt__setting">
                        <div class="receipt__wrap">
                            <div class="receipt__subtitle">Количество человек</div>
                            <div class="receipt__content">Выберите количество человек</div>
                        </div>
                        <div class="counter js-counter" data-min="0">
                            <button class="counter__button js-counter-button js-counter-minus disabled" type="button">
                                <svg class="icon icon-minus">
                                    <use xlink:href="#icon-minus"></use>
                                </svg>
                            </button>
                            <div class="counter__value js-counter-value">0</div>
                            <button class="counter__button js-counter-button js-counter-plus" type="button">
                                <svg class="icon icon-plus">
                                    <use xlink:href="#icon-plus"></use>
                                </svg>
                            </button>
                            <input name="peoples" class="js-counter-input js-counter-result js-counter-babies" type="hidden" value="0">
                        </div>
                    </div>
                    <input type="tel" name="phone" id="phone" placeholder="+7 (___) ___-__-__">
                    <div class="receipt__btns">
                        <button class="button receipt__button" style="width:100%">
                            <span>Забронировать</span>
                                <span>
                                    <svg class="icon icon-bag">
                                        <use xlink:href="#icon-bag"></use>
                                    </svg>
                                </span>
                        </button>
                    </div>

                </div>
                </form>
            </div>
        </div>
        <div class="section comments">
            <div class="comments__center center">
                <div class="comment">
                    <form action="{{route('createNewRating')}}" method="POST" class="comment__form">
                        @csrf
                        <input type="hidden" name="id" value="{{$tourbase->id}}">
                        <div class="comment__title">Добавить комментарий</div>
                        <div class="comment__head">
                            <div class="comment__text"></div>
                            <div class="rating js-rating" data-rating="4" data-read="false"></div>
                            <input name="rating" type="hidden" value="4">
                        </div>
                        <div class="comment__field">
                            <input class="comment__input" type="text" name="text" placeholder="Написать комментарий" required>
                            <button class="button-small comment__button"><span>Отправить!</span>
                                <svg class="icon icon-arrow-next">
                                    <use xlink:href="#icon-arrow-next"></use>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <div class="comment__head">
                        <div class="comment__title">3 комментарии</div>
                    </div>
                    <div class="comment__list">
                        @foreach($ratings as $rating)
                            <x-comment :rating='$rating' />
                        @endforeach
                    </div>
                    <div class="comment__btns">
                    </div>
                </div>
            </div>
        </div>

        <!-- scripts-->
        <x-scripts></x-scripts>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
        <script>
            const carousel = document.getElementById('carousel');
            const carouselInner = carousel.querySelector('.carousel-inner');
            const prevButton = carousel.querySelector('.carousel-control-prev');
            const nextButton = carousel.querySelector('.carousel-control-next');
            let currentSlide = 0;

            function moveToSlide(slideIndex) {
                currentSlide = slideIndex;
                carouselInner.style.transform = `translateX(-${slideIndex * 100}%)`;
            }

            prevButton.addEventListener('click', () => {
                if (currentSlide === 0) {
                    moveToSlide(carouselInner.children.length - 1);
                } else {
                    moveToSlide(currentSlide - 1);
                }
            });

            nextButton.addEventListener('click', () => {
                if (currentSlide === carouselInner.children.length - 1) {
                    moveToSlide(0);
                } else {
                    moveToSlide(currentSlide + 1);
                }
            });
        </script>
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
            document.addEventListener('DOMContentLoaded', function() {
                var input = document.querySelector('input[name="rating"]');

                // Найти элемент с классом jq-ry-rated-group
                var ratedGroup = document.querySelector('.jq-ry-rated-group');

                // Отслеживать изменения значения свойства width
                ratedGroup.addEventListener('click', function() {
                    var width = parseFloat(ratedGroup.style.width);

                    // Установить соответствующее значение атрибута value у инпута
                    if (width < 20) {
                        input.value = 1;
                    } else if (width >= 20 && width < 40) {
                        input.value = 2;
                    } else if (width >= 40 && width < 60) {
                        input.value = 3;
                    } else if (width >= 60 && width < 80) {
                        input.value = 4;
                    } else if (width >= 80) {
                        input.value = 5;
                    }
                });
            });
        </script>
        <!-- svg sprite-->
        <div style="display: none"><svg width="0" height="0">
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-arrow-down">
                    <path d="M10.805 6.362c-.26-.26-.682-.26-.943 0L8 8.224 6.138 6.362c-.26-.26-.682-.26-.943 0s-.26.682 0 .943l2.333 2.333c.26.26.682.26.943 0l2.333-2.333c.26-.26.26-.682 0-.943z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-arrow-bottom">
                    <path d="M15.039 3.961c-.653-.653-1.713-.653-2.366 0L8 8.634 3.327 3.961c-.653-.653-1.713-.653-2.366 0s-.653 1.713 0 2.366l5.856 5.856c.653.653 1.713.653 2.366 0l5.856-5.856c.653-.653.653-1.713 0-2.366z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-arrow-left">
                    <path d="M12.207.521a1.78 1.78 0 0 1 0 2.514L7.242 8l4.965 4.965a1.78 1.78 0 0 1 0 2.514 1.78 1.78 0 0 1-2.514 0L3.471 9.257a1.78 1.78 0 0 1 0-2.514L9.693.521a1.78 1.78 0 0 1 2.514 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-arrow-right">
                    <path d="M6.528 5.195c-.26.26-.26.682 0 .943L8.39 8 6.528 9.862c-.26.26-.26.682 0 .943s.682.26.943 0l2.333-2.333c.26-.26.26-.682 0-.943L7.471 5.195c-.26-.26-.682-.26-.943 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-email">
                    <path d="M13.334 2a2 2 0 0 1 1.995 1.851l.005.149v8a2 2 0 0 1-1.851 1.995l-.149.005H2.667a2 2 0 0 1-1.995-1.851L.667 12V4a2 2 0 0 1 1.851-1.995L2.667 2h10.667zm0 1.333H2.667C2.299 3.333 2 3.632 2 4v8c0 .368.298.667.667.667h10.667c.368 0 .667-.298.667-.667V4c0-.368-.298-.667-.667-.667zm-.821 1.573c.236.283.198.703-.085.939L9.281 8.468a2 2 0 0 1-2.561 0L3.574 5.845c-.283-.236-.321-.656-.085-.939s.656-.321.939-.085l3.146 2.622c.247.206.606.206.854 0l3.146-2.622c.283-.236.703-.197.939.085z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-comment">
                    <path d="M8 1.413c1.643 0 3.124.162 4.203.326 1.127.171 2.019.997 2.213 2.12a17.13 17.13 0 0 1 .25 2.887 17.13 17.13 0 0 1-.25 2.887c-.193 1.123-1.086 1.949-2.213 2.12a28.6 28.6 0 0 1-3.787.323l-4.077 2.409a.67.67 0 0 1-1.006-.574v-2.269c-.902-.3-1.584-1.045-1.75-2.009-.135-.783-.25-1.777-.25-2.887s.115-2.104.25-2.887c.193-1.123 1.086-1.949 2.213-2.12 1.08-.164 2.561-.326 4.203-.326zm0 1.333a27.01 27.01 0 0 0-4.003.311c-.596.091-1.01.506-1.099 1.028a15.8 15.8 0 0 0-.231 2.661 15.8 15.8 0 0 0 .231 2.661c.078.453.395.817.856.97l.913.303v2.063l3.375-1.994.353-.006a27.26 27.26 0 0 0 3.609-.308c.596-.091 1.01-.506 1.099-1.028.125-.724.231-1.641.231-2.661s-.106-1.937-.231-2.661c-.09-.522-.504-.938-1.099-1.028A27.01 27.01 0 0 0 8 2.746zm-.667 4.667c.368 0 .667.298.667.667s-.298.667-.667.667h0-2.667C4.298 8.746 4 8.448 4 8.08s.298-.667.667-.667h0zm4-2.667c.368 0 .667.298.667.667s-.298.667-.667.667h0-6.667C4.298 6.08 4 5.781 4 5.413s.298-.667.667-.667h0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-home">
                    <path d="M8.287 1.411c.09.02.177.053.278.102l.086.044.318.184.132.079 2.561 1.543 3.348 2.009c.316.189.418.599.229.915-.17.284-.519.396-.817.277l-.097-.048-.99-.594v6.751c-.001.619-.013.951-.145 1.211-.128.251-.332.455-.583.583-.233.119-.526.141-1.033.144H10v.001H6v-.001H4.428c-.508-.004-.8-.026-1.033-.144-.251-.128-.455-.332-.583-.583-.119-.233-.141-.526-.144-1.033l-.001-6.928-.99.594c-.316.189-.725.087-.915-.229-.17-.284-.105-.644.14-.852l.088-.063 3.344-2.006L6.899 1.82l.451-.263.084-.043c.101-.049.189-.082.279-.102.189-.042.385-.042.574 0zM8 2.721l-.006.003-2.973 1.784L4 5.123l.001 7.651.008.399.005.071.002.018.018.002a6.48 6.48 0 0 0 .469.013H6V10.61a2 2 0 0 1 3.995-.149l.005.149v2.666h1.498l.399-.008.071-.005.018-.002.002-.018c.011-.133.013-.311.014-.608V5.123l-1.025-.618-2.969-1.781L8 2.721zm0 7.223c-.368 0-.667.298-.667.667l-.001 2.666h1.333l.001-2.666c0-.368-.298-.667-.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-home-fill">
                    <path d="M13.333 12.534V5.978l.99.594c.316.189.725.087.915-.229s.087-.725-.229-.915L11.661 3.42 9.1 1.877h0l-.45-.263-.086-.044c-.101-.049-.188-.082-.278-.102-.189-.042-.385-.042-.574 0-.09.02-.178.053-.279.102l-.084.043-.451.263h0L4.334 3.422.99 5.429c-.316.189-.418.599-.229.915s.599.418.915.229l.99-.594v6.556c0 .747 0 1.12.145 1.405.128.251.332.455.583.583.285.145.659.145 1.405.145h1.2v-4a2 2 0 0 1 4 0v4h1.2c.747 0 1.12 0 1.405-.145.251-.128.455-.332.583-.583.145-.285.145-.659.145-1.405z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-globe">
                    <path d="M8 1.334a6.67 6.67 0 0 1 6.631 5.971l.003.029.033.667a6.67 6.67 0 0 1-13.3.667l-.033-.667c0-.225.011-.447.033-.667h0a6.67 6.67 0 0 1 6.634-6zm1.982 7.334H6.018c.077 1.396.391 2.599.817 3.451.532 1.065 1.021 1.216 1.164 1.216s.632-.151 1.164-1.216c.426-.852.74-2.055.817-3.451zm-5.299 0H2.708c.228 1.831 1.385 3.374 2.983 4.142-.556-1.068-.927-2.52-1.008-4.142zm8.609 0h-1.975c-.081 1.622-.452 3.074-1.009 4.142a5.34 5.34 0 0 0 2.984-4.143zm-7.6-5.476l-.143.071c-1.525.79-2.62 2.295-2.841 4.071h1.975c.08-1.623.452-3.074 1.008-4.143zM8 2.667c-.143 0-.632.151-1.164 1.216-.426.852-.74 2.055-.817 3.452h3.964c-.077-1.396-.391-2.6-.817-3.452-.501-1.002-.963-1.195-1.136-1.214L8 2.667h0zm2.308.524l.049.095c.53 1.059.882 2.473.96 4.048h1.975a5.34 5.34 0 0 0-2.984-4.143z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-bell">
                    <path d="M8.833 12.861c.368 0 .679.313.516.643-.072.146-.169.281-.289.398-.281.276-.663.431-1.061.431s-.779-.155-1.061-.431a1.47 1.47 0 0 1-.289-.398c-.163-.33.148-.643.516-.643h1.667zM8 1.667c2.982 0 5.4 2.382 5.4 5.321v4.106h.011a.59.59 0 0 1 .589.589.59.59 0 0 1-.589.589H2.589A.59.59 0 0 1 2 11.683a.59.59 0 0 1 .589-.589H2.6V6.988c0-2.939 2.418-5.321 5.4-5.321zm0 1.178c-2.32 0-4.2 1.855-4.2 4.142v4.106h8.4V6.988c0-2.288-1.88-4.142-4.2-4.142z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-flag">
                    <path d="M3.22 0c.368 0 .667.298.667.667v.666h7.768c1.097 0 1.707 1.239 1.089 2.103l-.077.098L10.553 6l2.113 2.466c.714.833.17 2.103-.888 2.196l-.124.005-7.768-.001v4.667c0 .368-.298.667-.667.667s-.667-.298-.667-.667V.667c0-.368.298-.667.667-.667zm8.434 2.667H3.886v6.667h7.768L8.797 6l2.857-3.333z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-building">
                    <path d="M7.333 1.333a2 2 0 0 1 2 2v3.333h3.333a2 2 0 0 1 1.995 1.851l.005.149v4a2 2 0 0 1-1.851 1.995l-.149.005H3.333a2 2 0 0 1-2-2V3.333a2 2 0 0 1 2-2h4zm0 1.333h-4c-.335 0-.612.247-.659.568l-.007.099v9.333c0 .335.247.612.568.659l.099.007H4v-.667c0-.335.247-.612.568-.659L4.666 12H6c.335 0 .612.247.659.568l.007.099v.667H8v-10c0-.368-.298-.667-.667-.667zM12.666 8H9.333v5.333h3.333c.368 0 .667-.298.667-.667v-4c0-.368-.298-.667-.667-.667zm-1.333 3.333c.368 0 .667.298.667.667s-.298.667-.667.667-.667-.298-.667-.667.298-.667.667-.667zm0-2c.368 0 .667.298.667.667s-.298.667-.667.667-.667-.298-.667-.667.298-.667.667-.667zM6 9.333c.368 0 .667.298.667.667s-.298.667-.667.667h0-1.333C4.298 10.666 4 10.368 4 10s.298-.667.667-.667h0zm0-2.667c.368 0 .667.298.667.667S6.368 8 6 8H4.666C4.298 8 4 7.701 4 7.333s.298-.667.667-.667H6zM6 4c.368 0 .667.298.667.667s-.298.667-.667.667H4.666c-.368 0-.667-.298-.667-.667S4.298 4 4.666 4H6z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-arrow-next">
                    <path d="M10.39 3.765c.464-.375 1.187-.349 1.615.057l3.692 3.5a.91.91 0 0 1 0 1.357l-3.692 3.5c-.428.406-1.151.431-1.615.057s-.493-1.007-.065-1.413L12.247 9H1.143C.512 9 0 8.552 0 8s.512-1 1.143-1h11.104l-1.922-1.822c-.428-.406-.399-1.038.065-1.413z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-arrow-prev">
                    <path d="M5.61 12.235c-.464.375-1.187.349-1.615-.057l-3.692-3.5a.91.91 0 0 1 0-1.357l3.692-3.5c.428-.406 1.151-.431 1.615-.057s.493 1.007.065 1.413L3.753 7h11.104C15.488 7 16 7.448 16 8s-.512 1-1.143 1H3.753l1.922 1.822c.428.406.399 1.038-.065 1.413z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-notification">
                    <path d="M8.833 12.861c.368 0 .679.313.516.643-.072.146-.169.281-.289.398-.281.276-.663.431-1.061.431s-.779-.155-1.061-.431a1.47 1.47 0 0 1-.289-.398c-.163-.33.148-.643.516-.643h1.667zM8 1.667c2.982 0 5.4 2.382 5.4 5.321v4.106h.011a.59.59 0 0 1 .589.589.59.59 0 0 1-.589.589H2.589A.59.59 0 0 1 2 11.683a.59.59 0 0 1 .589-.589H2.6V6.988c0-2.939 2.418-5.321 5.4-5.321zm0 1.178c-2.32 0-4.2 1.855-4.2 4.142v4.106h8.4V6.988c0-2.288-1.88-4.142-4.2-4.142z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-bulb">
                    <path d="M7.999 0c2.946 0 5.333 2.388 5.333 5.333 0 1.684-.781 3.186-2 4.164v1.17c0 .591-.256 1.122-.663 1.488L10.668 14a2 2 0 0 1-2 2H7.335a2 2 0 0 1-2-2v-1.841c-.41-.366-.668-.899-.668-1.492v-1.17c-1.219-.977-2-2.479-2-4.164C2.666 2.388 5.054 0 7.999 0zm1.335 12.667l-2.667-.001V14c0 .368.298.667.667.667h1.333c.368 0 .667-.298.667-.667v-1.333h0zM7.999 1.333a4 4 0 0 0-4 4A3.99 3.99 0 0 0 5.5 8.457l.499.4v1.81c0 .368.298.667.667.667h.668V7.609L6.196 6.471c-.26-.26-.26-.682 0-.943s.682-.26.943 0h0L8 6.39l.862-.862c.26-.26.682-.26.943 0s.26.682 0 .943h0L8.667 7.609v3.724h.666c.368 0 .667-.298.667-.667v-1.81l.499-.4a3.99 3.99 0 0 0 1.501-3.123 4 4 0 0 0-4-4z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-coin">
                    <path d="M8 1.334a6.67 6.67 0 0 1 6.667 6.667A6.67 6.67 0 0 1 8 14.667a6.67 6.67 0 0 1-6.667-6.667A6.67 6.67 0 0 1 8 1.334zm0 1.333c-2.946 0-5.333 2.388-5.333 5.333S5.054 13.334 8 13.334s5.333-2.388 5.333-5.333S10.945 2.667 8 2.667zm0 1.333c.368 0 .667.298.667.667a2 2 0 0 1 2 2c0 .368-.298.667-.667.667s-.667-.298-.667-.667-.298-.667-.667-.667H7.162c-.274 0-.496.222-.496.496 0 .213.137.403.339.47l2.411.804a1.83 1.83 0 0 1-.578 3.564h-.171c0 .368-.298.667-.667.667s-.667-.298-.667-.667a2 2 0 0 1-2-2c0-.368.298-.667.667-.667s.667.298.667.667.298.667.667.667h1.504c.274 0 .496-.222.496-.496 0-.213-.136-.403-.339-.47l-2.411-.804a1.83 1.83 0 0 1 .578-3.564h.171c0-.368.298-.667.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-star">
                    <path d="M9.69 1.529l1.442 2.838 3.238.457c1.517.214 2.211 2.086 1.041 3.192l-2.326 2.198.547 3.098c.28 1.587-1.404 2.653-2.73 1.977L8 13.809l-2.903 1.481c-1.328.678-3.011-.391-2.731-1.976l.547-3.098L.588 8.017C-.582 6.91.114 5.038 1.628 4.824l3.239-.457L6.31 1.529c.697-1.371 2.683-1.372 3.38 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-play">
                    <path d="M1.509 2.463c0-1.71 1.876-2.755 3.33-1.855l8.945 5.538c1.378.853 1.378 2.857 0 3.711l-8.945 5.538c-1.454.899-3.33-.147-3.33-1.856V2.463z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-modem">
                    <path d="M11.333 1.333c.368 0 .667.298.667.667h0v5.333h.667a2 2 0 0 1 1.995 1.851l.005.149V12a2 2 0 0 1-1.851 1.995l-.149.005-.007.099c-.048.321-.325.568-.659.568-.368 0-.667-.298-.667-.667h0-6.667c0 .368-.298.667-.667.667s-.667-.298-.667-.667h0a2 2 0 0 1-1.995-1.851L1.334 12V9.333a2 2 0 0 1 1.851-1.995l.149-.005H4V4.666C4 4.298 4.299 4 4.667 4s.667.298.667.667h0v2.667h5.333V2c0-.368.298-.667.667-.667zm1.334 7.333H3.334c-.368 0-.667.298-.667.667V12c0 .368.298.667.667.667h9.333c.368 0 .667-.298.667-.667V9.333c0-.368-.298-.667-.667-.667zM4.667 10c.368 0 .667.298.667.667s-.298.667-.667.667S4 11.035 4 10.666 4.299 10 4.667 10zm6.667 0c.368 0 .667.298.667.667s-.298.667-.667.667h0-4c-.368 0-.667-.298-.667-.667S6.965 10 7.333 10h0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-burger">
                    <path d="M10.001 2a4.67 4.67 0 0 1 4.667 4.667 1.99 1.99 0 0 1-.257.982c.555.355.923.977.923 1.685a2 2 0 0 1-.923 1.685c.164.289.257.624.257.981a2 2 0 0 1-2 2H3.334a2 2 0 0 1-2-2 1.99 1.99 0 0 1 .257-.981c-.556-.354-.925-.977-.925-1.686a2 2 0 0 1 .925-1.687c-.163-.289-.257-.624-.257-.98A4.67 4.67 0 0 1 6.001 2h4zm2.667 9.333H3.334c-.368 0-.667.299-.667.667 0 .335.247.612.568.659l.099.007h9.333c.368 0 .667-.299.667-.667s-.299-.667-.667-.667zm.665-2.667H2.666c-.368 0-.667.298-.667.667s.298.667.667.667h10.667c.368 0 .667-.298.667-.667s-.298-.667-.667-.667zm-3.332-5.333h-4c-1.841 0-3.333 1.492-3.333 3.333 0 .335.247.612.568.659l.099.007h9.333c.368 0 .667-.298.667-.667 0-1.841-1.492-3.333-3.333-3.333zM5.333 4.667c.368 0 .667.298.667.667S5.701 6 5.333 6s-.667-.298-.667-.667.298-.667.667-.667zm2.667 0c.368 0 .667.298.667.667S8.368 6 7.999 6s-.667-.298-.667-.667.298-.667.667-.667zm2.667 0c.368 0 .667.298.667.667S11.034 6 10.666 6s-.667-.298-.667-.667.298-.667.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-check">
                    <path d="M15.665 2.668c.446.446.446 1.17 0 1.616l-9.143 9.143c-.446.446-1.17.446-1.616 0L.335 8.855c-.446-.446-.446-1.17 0-1.616s1.17-.446 1.616 0l3.763 3.763 8.335-8.335c.446-.446 1.17-.446 1.616 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-share">
                    <path d="M10.702 6.063l1.279.098c.99.104 1.779.806 1.898 1.843.068.591.122 1.444.122 2.663l-.122 2.663c-.118 1.036-.906 1.739-1.896 1.843-.787.083-2.042.161-3.982.161s-3.195-.078-3.982-.161c-.99-.104-1.778-.807-1.896-1.843C2.054 12.739 2 11.886 2 10.667l.122-2.663c.119-1.037.908-1.739 1.897-1.843l1.279-.098c.368-.02.682.263.701.63s-.263.682-.63.701l-1.21.092c-.417.044-.671.3-.713.669-.06.529-.113 1.33-.113 2.511l.113 2.511c.042.369.295.625.711.669C4.887 13.924 6.093 14 8 14l3.842-.154c.416-.044.669-.299.711-.669.06-.529.113-1.33.113-2.511l-.113-2.511c-.042-.369-.296-.625-.713-.669l-1.21-.092c-.368-.02-.65-.334-.63-.701s.334-.65.701-.63zM8.471.862l2.333 2.333c.26.26.26.682 0 .943s-.682.26-.943 0L8.667 2.943v6.391c0 .368-.298.667-.667.667s-.667-.298-.667-.667V2.943L6.138 4.138c-.26.26-.682.26-.943 0s-.26-.682 0-.943L7.529.862c.26-.26.682-.26.943 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-more">
                    <path d="M3.333 6.667A1.34 1.34 0 0 1 4.667 8a1.34 1.34 0 0 1-1.333 1.333A1.34 1.34 0 0 1 2 8a1.34 1.34 0 0 1 1.333-1.333zm9.333 0A1.34 1.34 0 0 1 14 8a1.34 1.34 0 0 1-1.333 1.333A1.34 1.34 0 0 1 11.333 8a1.34 1.34 0 0 1 1.333-1.333zM8 6.667A1.34 1.34 0 0 1 9.333 8 1.34 1.34 0 0 1 8 9.334 1.34 1.34 0 0 1 6.667 8 1.34 1.34 0 0 1 8 6.667zM3.333 6.667A1.34 1.34 0 0 1 4.667 8a1.34 1.34 0 0 1-1.333 1.333A1.34 1.34 0 0 1 2 8a1.34 1.34 0 0 1 1.333-1.333zm9.333 0A1.34 1.34 0 0 1 14 8a1.34 1.34 0 0 1-1.333 1.333A1.34 1.34 0 0 1 11.333 8a1.34 1.34 0 0 1 1.333-1.333zM8 6.667A1.34 1.34 0 0 1 9.333 8 1.34 1.34 0 0 1 8 9.334 1.34 1.34 0 0 1 6.667 8 1.34 1.34 0 0 1 8 6.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-heart">
                    <path d="M11 2.112c2.393 0 4.333 1.94 4.333 4.333 0 4.245-4.647 6.59-6.542 7.37-.511.21-1.071.21-1.582 0-1.896-.78-6.543-3.124-6.543-7.37 0-2.393 1.94-4.333 4.333-4.333a4.32 4.32 0 0 1 3 1.206 4.32 4.32 0 0 1 3-1.206zm0 1.333c-.807 0-1.537.317-2.077.835l-.462.443c-.258.248-.665.248-.923 0l-.462-.443c-.54-.518-1.27-.835-2.077-.835a3 3 0 0 0-3 3c0 1.588.86 2.9 2.101 3.978s2.728 1.794 3.615 2.159a.73.73 0 0 0 .567 0c.888-.365 2.373-1.08 3.615-2.159S14 8.034 14 6.445a3 3 0 0 0-3-3z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-heart-fill">
                    <path d="M8 3.339a4.32 4.32 0 0 0-3-1.206c-2.393 0-4.333 1.94-4.333 4.333 0 4.246 4.647 6.59 6.543 7.37.511.21 1.071.21 1.582 0 1.896-.78 6.543-3.124 6.543-7.37 0-2.393-1.94-4.333-4.333-4.333a4.32 4.32 0 0 0-3 1.206z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-close">
                    <path d="M3.528 3.528c.26-.26.682-.26.943 0L8 7.057l3.529-3.529c.26-.26.682-.26.943 0s.26.682 0 .943L8.942 8l3.529 3.529c.26.26.26.682 0 .943s-.682.26-.943 0L8 8.942l-3.529 3.529c-.26.26-.682.26-.943 0s-.26-.682 0-.943L7.057 8 3.528 4.471c-.26-.26-.26-.682 0-.943z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-location">
                    <path d="M14.349 3.832L10.4 13.31c-.772 1.854-3.489 1.54-3.819-.44l-.493-2.956-2.956-.493c-1.981-.33-2.294-3.047-.44-3.819l9.478-3.949a1.67 1.67 0 0 1 2.18 2.179zm-1.667-.949L3.204 6.833a.67.67 0 0 0 .147 1.273l2.956.493c.562.094 1.002.534 1.096 1.096l.493 2.956a.67.67 0 0 0 1.273.147l3.949-9.478c.114-.275-.161-.55-.436-.436z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-image">
                    <path d="M8.001 1.334a28.06 28.06 0 0 1 3.639.246c1.464.193 2.588 1.317 2.782 2.782.133 1.007.246 2.266.246 3.639a28.05 28.05 0 0 1-.246 3.639c-.193 1.464-1.317 2.588-2.782 2.782-1.007.133-2.266.246-3.639.246s-2.632-.113-3.639-.246c-1.465-.193-2.588-1.317-2.782-2.782a28.06 28.06 0 0 1-.246-3.639 28.06 28.06 0 0 1 .246-3.639c.193-1.465 1.317-2.588 2.782-2.782a28.06 28.06 0 0 1 3.639-.246zm0 1.333c-1.301 0-2.501.107-3.464.235-.867.114-1.52.768-1.635 1.635-.127.963-.235 2.163-.235 3.464 0 1.055.071 2.043.165 2.892l1.086-1.087a2 2 0 0 1 2.828 0l.114.114c.26.26.682.26.943 0l1.448-1.448a2 2 0 0 1 2.828 0l1.196 1.196-.168 1.718-1.971-1.971c-.26-.26-.682-.26-.943 0l-1.448 1.448a2 2 0 0 1-2.828 0l-.114-.114c-.26-.26-.682-.26-.943 0l-1.605 1.606a1.88 1.88 0 0 0 1.28.745c.963.127 2.163.235 3.464.235a26.72 26.72 0 0 0 3.464-.235c.867-.114 1.52-.768 1.635-1.635.127-.963.235-2.163.235-3.464s-.107-2.501-.235-3.464c-.114-.867-.768-1.52-1.635-1.635-.963-.127-2.163-.235-3.464-.235zm-2.001 2c.736 0 1.333.597 1.333 1.333s-.597 1.333-1.333 1.333-1.333-.597-1.333-1.333.597-1.333 1.333-1.333z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-toilet-paper">
                    <path d="M11.333 1.333c.952 0 1.799.587 2.378 1.407.542.768.897 1.796.949 2.965l.006.295v6.667a2 2 0 0 1-1.851 1.995l-.149.005h-4a2 2 0 0 1-1.995-1.851l-.005-.149v-2h-2c-1.841 0-3.333-2.089-3.333-4.667s1.492-4.667 3.333-4.667h6.667zm0 1.333H6.999c.29.398.528.869.699 1.392l.027.084.035.117.033.118.039.156.02.085.024.116.077.478.012.114.015.164.006.088.007.126.001.038.001.024L8 6v3.333h0c.368 0 .667.298.667.667s-.298.667-.667.667v2c0 .335.247.612.568.659l.099.007h4c.335 0 .612-.247.659-.568l.007-.099v-2c-.368 0-.667-.298-.667-.667s.298-.667.667-.667h0V6c0-1.043-.299-1.906-.711-2.491-.421-.597-.908-.843-1.289-.843zm-.667 6.667c.368 0 .667.298.667.667s-.298.667-.667.667S10 10.368 10 10s.298-.667.667-.667zm-6-6.667c-.378 0-.846.212-1.272.808S2.666 4.957 2.666 6s.304 1.931.728 2.525.894.808 1.272.808.846-.212 1.272-.808.728-1.482.728-2.525a4.96 4.96 0 0 0-.202-1.42c-.126-.418-.304-.779-.51-1.07-.383-.542-.819-.795-1.182-.837l-.107-.006h0zm0 2c.368 0 .667.597.667 1.333s-.298 1.333-.667 1.333S4 6.736 4 6s.298-1.333.667-1.333z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-credit-card">
                    <path d="M15.334 12a2 2 0 0 1-1.851 1.995l-.149.005H2.667a2 2 0 0 1-1.995-1.851L.667 12V4a2 2 0 0 1 1.851-1.995L2.667 2h10.667a2 2 0 0 1 1.995 1.851l.005.149v8zM14 6.666H2V12c0 .368.298.667.667.667h10.667c.368 0 .667-.298.667-.667V6.666zM4.334 9.333a1 1 0 1 1 0 2 1 1 0 1 1 0-2zm3.333 0a1 1 0 1 1 0 2 1 1 0 1 1 0-2zm5.667-6H2.667C2.299 3.333 2 3.632 2 4v1.333h12V4c0-.368-.298-.667-.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-medical-case">
                    <path d="M9.333 1.333a2 2 0 0 1 2 2V4H12c1.416 0 2.574 1.104 2.661 2.498l.005.169V12c0 1.416-1.104 2.574-2.498 2.661l-.169.005H4c-1.416 0-2.574-1.104-2.661-2.498L1.333 12V6.666c0-1.416 1.104-2.574 2.498-2.661L4 4h.667 0v-.667a2 2 0 0 1 2-2h2.667zm2.667 4H4c-.736 0-1.333.597-1.333 1.333V12c0 .736.597 1.333 1.333 1.333h8c.736 0 1.333-.597 1.333-1.333V6.666c0-.736-.597-1.333-1.333-1.333zM8 6.666c.368 0 .667.298.667.667h0v1.333H10c.368 0 .667.298.667.667S10.368 10 10 10h0-1.333v1.333c0 .368-.298.667-.667.667s-.667-.298-.667-.667h0V10H6c-.368 0-.667-.298-.667-.667s.298-.667.667-.667h0 1.333V7.333c0-.368.298-.667.667-.667zm1.333-4H6.666c-.368 0-.667.298-.667.667V4h4 0v-.667c0-.368-.298-.667-.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-monitor">
                    <path d="M12 1.333c1.416 0 2.574 1.104 2.661 2.498l.005.169v5.333c0 1.416-1.104 2.574-2.498 2.661L12 12h-2v1.333h.667c.368 0 .667.298.667.667s-.298.667-.667.667H5.333c-.368 0-.667-.298-.667-.667s.298-.667.667-.667H6V12H4c-1.416 0-2.574-1.104-2.661-2.498l-.005-.169V4c0-1.416 1.104-2.574 2.498-2.661L4 1.333h8zM8.666 12H7.333v1.333h1.333V12zM12 2.666H4c-.736 0-1.333.597-1.333 1.333v5.333c0 .736.597 1.333 1.333 1.333h8c.736 0 1.333-.597 1.333-1.333V4c0-.736-.597-1.333-1.333-1.333zm-6 4c.368 0 .667.298.667.667S6.368 8 6 8h0-1.333C4.298 8 4 7.701 4 7.333s.298-.667.667-.667h0zM9.333 4c.368 0 .667.298.667.667s-.298.667-.667.667h0-4.667c-.368 0-.667-.298-.667-.667S4.298 4 4.666 4h0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-calendar">
                    <path d="M11.333 1.333c.335 0 .612.247.659.568L12 2l-.001.666h.667a2 2 0 0 1 1.995 1.851l.005.149v8a2 2 0 0 1-1.851 1.995l-.149.005H3.333a2 2 0 0 1-1.995-1.851l-.005-.149v-8a2 2 0 0 1 1.851-1.995l.149-.005h.666L4 2c0-.368.298-.667.667-.667.335 0 .612.247.659.568L5.333 2l-.001.666h5.334V2c0-.368.298-.667.667-.667zM12.666 4l-.667-.001.001.667c0 .368-.298.667-.667.667-.335 0-.612-.247-.659-.568l-.007-.099v-.667H5.332l.001.667c0 .368-.298.667-.667.667-.335 0-.612-.247-.659-.568L4 4.666l-.001-.667L3.333 4c-.368 0-.667.298-.667.667v8c0 .368.298.667.667.667h9.333c.368 0 .667-.298.667-.667v-8c0-.368-.298-.667-.667-.667zm-4 6.667c.368 0 .667.298.667.667 0 .335-.247.612-.568.659L8.666 12h-4C4.298 12 4 11.701 4 11.333c0-.335.247-.612.568-.659l.099-.007h4zM11.333 8c.368 0 .667.298.667.667 0 .335-.247.612-.568.659l-.099.007H6.666c-.368 0-.667-.298-.667-.667 0-.335.247-.612.568-.659L6.666 8h4.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-user">
                    <path d="M8 .668a4 4 0 0 1 4 4c0 1.296-.617 2.449-1.573 3.18 2.104.93 3.573 3.037 3.573 5.487v1.333c0 .368-.298.667-.667.667s-.667-.298-.667-.667v-1.333a4.67 4.67 0 0 0-4.645-4.667H8h0l-.021-.001-.193.006a4.67 4.67 0 0 0-4.453 4.662v1.333c0 .368-.298.667-.667.667S2 15.036 2 14.668v-1.333c0-2.45 1.468-4.557 3.573-5.489C4.617 7.117 4 5.964 4 4.668a4 4 0 0 1 4-4zm0 1.333c-1.473 0-2.667 1.194-2.667 2.667S6.527 7.335 8 7.335s2.667-1.194 2.667-2.667S9.473 2.001 8 2.001z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-plus">
                    <path d="M8.667 4.667C8.667 4.298 8.368 4 8 4s-.667.298-.667.667v2.667H4.667C4.298 7.333 4 7.632 4 8s.298.667.667.667h2.667v2.667c0 .368.298.667.667.667s.667-.298.667-.667V8.667h2.667c.368 0 .667-.298.667-.667s-.298-.667-.667-.667H8.667V4.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-minus">
                    <path d="M4 8c0-.368.298-.667.667-.667h6.667c.368 0 .667.298.667.667s-.298.667-.667.667H4.667C4.298 8.666 4 8.368 4 8z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-bag">
                    <path d="M8.5 1.334c1.613 0 2.958 1.145 3.266 2.666h.562a2.67 2.67 0 0 1 2.666 2.633l-.005.2-.333 5.333a2.67 2.67 0 0 1-2.494 2.495l-.168.005h-6.99c-1.352 0-2.479-1.008-2.645-2.333l-.016-.167-.333-5.333a2.67 2.67 0 0 1 2.462-2.825l.2-.008h.562C5.542 2.479 6.887 1.334 8.5 1.334zm3.828 3.999h-.496l.001.667a.67.67 0 0 1-.667.667c-.368 0-.666-.299-.666-.667l-.001-.667h-4L6.5 6c0 .368-.298.667-.667.667S5.167 6.368 5.167 6l-.001-.667h-.494c-.769 0-1.379.649-1.331 1.417l.333 5.333c.044.703.627 1.25 1.331 1.25h6.99c.704 0 1.287-.547 1.331-1.25l.333-5.333c.048-.768-.562-1.417-1.331-1.417zM8.5 2.667A2 2 0 0 0 6.614 4h3.772A2 2 0 0 0 8.5 2.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-star-outline">
                    <path d="M6.339 2.517c.616-1.475 2.706-1.475 3.322 0h0l1.017 2.437 2.639.211c1.598.128 2.245 2.123 1.025 3.164h0l-2.006 1.711.613 2.56c.373 1.556-1.319 2.789-2.686 1.957h0L8 13.179l-2.264 1.377c-1.367.832-3.059-.401-2.686-1.957h0l.613-2.56-2.006-1.711C.438 7.288 1.084 5.292 2.682 5.165h0l2.639-.211zm1.23.514L6.348 5.956c-.067.161-.219.271-.393.285l-3.166.253a.47.47 0 0 0-.266.82l2.41 2.056c.133.114.192.293.151.464l-.737 3.076a.47.47 0 0 0 .696.507l2.714-1.651c.149-.091.336-.091.485 0l2.714 1.651a.47.47 0 0 0 .696-.507l-.737-3.076c-.041-.171.017-.35.151-.464l2.41-2.056a.47.47 0 0 0-.266-.82l-3.166-.253c-.174-.014-.326-.124-.393-.285L8.43 3.031a.47.47 0 0 0-.861 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-instagram">
                    <path d="M10.666 1.333a4 4 0 0 1 3.995 3.8l.005.2v5.333a4 4 0 0 1-3.8 3.995l-.2.005H5.333a4 4 0 0 1-3.995-3.8l-.005-.2V5.333a4 4 0 0 1 3.8-3.995l.2-.005h5.333zm0 1.333H5.333c-1.473 0-2.667 1.194-2.667 2.667v5.333c0 1.473 1.194 2.667 2.667 2.667h5.333c1.473 0 2.667-1.194 2.667-2.667V5.333c0-1.473-1.194-2.667-2.667-2.667zm-2.666 2c1.841 0 3.333 1.492 3.333 3.333s-1.492 3.333-3.333 3.333S4.667 9.841 4.667 8 6.16 4.667 8.001 4.667zm0 1.333a2 2 0 1 0 0 4 2 2 0 1 0 0-4zm3.333-2c.368 0 .667.298.667.667s-.298.667-.667.667-.667-.298-.667-.667.298-.667.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-facebook">
                    <path d="M8 1.333A6.67 6.67 0 0 1 14.666 8 6.67 6.67 0 0 1 8 14.666 6.67 6.67 0 0 1 1.333 8 6.67 6.67 0 0 1 8 1.333zm0 1.333C5.054 2.666 2.666 5.054 2.666 8c0 2.485 1.699 4.573 3.999 5.165V9.333H6c-.368 0-.667-.298-.667-.667S5.631 8 6 8h0 .667V6.667a2 2 0 0 1 2-2h0 .667c.368 0 .667.298.667.667S9.701 6 9.333 6h0-.667C8.298 6 8 6.298 8 6.667h0V8h1.333c.368 0 .667.298.667.667s-.298.667-.667.667h0H8v4h0c2.946 0 5.333-2.388 5.333-5.333S10.945 2.666 8 2.666z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-twitter">
                    <path d="M10.334 2c.508 0 1.057.117 1.511.265.233.076.505.181.768.32h0l.993-.198c1.142-.228 2.048.957 1.527 1.999h0l-.751 1.503C14.893 10.281 11.23 14 6.667 14c-2.945 0-4.709-1.094-5.681-2.456-.679-.952.032-2.208 1.135-2.211l.151-.001a6.57 6.57 0 0 1-.754-1.324c-.578-1.36-.755-3.042-.111-4.462.457-1.007 1.757-1.065 2.371-.29.366.462 1.015.989 1.817 1.404.354.183.715.333 1.069.445.038-.249.096-.508.185-.766.191-.561.54-1.171 1.159-1.635C8.633 2.234 9.421 2 10.334 2zm0 1.333c-2.723 0-2.425 2.747-2.347 3.254.006.042-.025.08-.067.079-1.939-.034-4.167-1.294-5.187-2.581-.031-.039-.091-.033-.112.012-.892 1.968.364 5.117 2.575 5.86.054.018.065.09.016.119-.948.555-2.386.588-3.087.59-.053 0-.084.059-.054.103.689.965 2.02 1.898 4.596 1.898 3.992 0 6.988-3.32 6.337-6.978-.002-.014 0-.029.006-.042h0l.929-1.858c.025-.05-.018-.106-.073-.095h0l-1.498.3a.07.07 0 0 1-.061-.017c-.356-.325-1.324-.642-1.974-.642z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-pinterest">
                    <path d="M8 1.333A6.67 6.67 0 0 1 14.666 8 6.67 6.67 0 0 1 8 14.666 6.67 6.67 0 0 1 1.333 8 6.67 6.67 0 0 1 8 1.333zm0 1.333C5.054 2.666 2.666 5.054 2.666 8c0 2.151 1.274 4.005 3.109 4.849l.702-2.524.88-3.17c.099-.355.466-.562.821-.464s.562.466.464.821l-.702 2.526c.834.177 1.419.026 1.811-.233.495-.327.813-.914.893-1.61s-.091-1.428-.481-1.969c-.375-.522-.969-.892-1.831-.892-1.281 0-2.043.554-2.415 1.236-.387.71-.4 1.645.011 2.466.165.329.031.73-.298.894s-.73.031-.894-.298c-.589-1.179-.602-2.577.011-3.701C5.376 4.779 6.614 4 8.333 4c1.305 0 2.295.588 2.913 1.446.604.839.836 1.909.723 2.9s-.585 1.977-1.483 2.57c-.766.506-1.752.668-2.903.407l-.535 1.925c.309.056.627.085.951.085 2.946 0 5.333-2.388 5.333-5.333S10.945 2.666 8 2.666z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-smile">
                    <path d="M8 1.333A6.67 6.67 0 0 1 14.666 8 6.67 6.67 0 0 1 8 14.666 6.67 6.67 0 0 1 1.333 8 6.67 6.67 0 0 1 8 1.333zm0 1.333C5.054 2.666 2.666 5.054 2.666 8S5.054 13.333 8 13.333 13.333 10.945 13.333 8 10.945 2.666 8 2.666zm2.019 6.51c.087-.358.447-.578.805-.491s.578.447.491.805c-.175.724-.605 1.363-1.209 1.815S8.76 12 8 12s-1.503-.243-2.106-.695S4.86 10.214 4.685 9.49c-.087-.358.133-.718.491-.805s.718.133.805.491c.1.412.347.788.713 1.062A2.18 2.18 0 0 0 8 10.666a2.18 2.18 0 0 0 1.306-.428c.366-.274.613-.65.713-1.062zM6 5.333a1.27 1.27 0 0 1 .898.382 1.57 1.57 0 0 1 .425.832c.066.362-.175.709-.537.775s-.709-.175-.775-.537c-.003-.016-.007-.031-.011-.044-.004.013-.008.028-.011.044-.066.362-.413.603-.775.537s-.603-.413-.537-.775c.055-.306.196-.603.425-.832A1.27 1.27 0 0 1 6 5.333zm4 0a1.27 1.27 0 0 1 .898.382 1.57 1.57 0 0 1 .425.832c.066.362-.175.709-.537.775s-.709-.175-.775-.537c-.003-.016-.007-.031-.011-.044-.004.013-.008.028-.011.044-.066.362-.413.603-.775.537s-.603-.413-.537-.775a1.57 1.57 0 0 1 .425-.832A1.27 1.27 0 0 1 10 5.333z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-smile-fill">
                    <path d="M8,0 C12.41824,0 16,3.58172 16,8 C16,12.418312 12.41824,16 8,16 C3.58172,16 0,12.418312 0,8 C0,3.58172 3.58172,0 8,0 Z M10.42264,9.411832 C10.30312,9.905912 10.006,10.357432 9.56736,10.686472 C9.12784,11.016072 8.57536,11.199992 8.00016,11.199992 C7.42496,11.199992 6.87248,11.016072 6.43304,10.686472 C5.994408,10.357432 5.697288,9.905912 5.577744,9.411832 C5.473832,8.982392 5.041472,8.718552 4.61204,8.822472 C4.1826,8.926392 3.918712,9.358712 4.022624,9.788152 C4.232952,10.657352 4.748832,11.423272 5.473032,11.966472 C6.1964,12.508952 7.0876,12.799992 8.00016,12.799992 C8.9128,12.799992 9.804,12.508952 10.52736,11.966472 C11.25152,11.423272 11.76744,10.657352 11.97776,9.788152 C12.08168,9.358712 11.81776,8.926392 11.38832,8.822472 C10.95888,8.718552 10.52656,8.982392 10.42264,9.411832 Z M5.599864,4.8 C5.178392,4.8 4.80044,4.980792 4.522392,5.25884 C4.247976,5.533248 4.079296,5.890288 4.01272,6.257152 C3.933824,6.691912 4.22228,7.108232 4.657008,7.187112 C5.091736,7.266072 5.508112,6.977592 5.587008,6.542872 C5.590512,6.523512 5.594928,6.506072 5.599864,6.490472 C5.604792,6.506072 5.609208,6.523512 5.61272,6.542872 C5.691616,6.977592 6.107984,7.266072 6.54272,7.187112 C6.97744,7.108232 7.26592,6.691912 7.18704,6.257152 C7.1204,5.890288 6.95176,5.533248 6.67736,5.25884 C6.399288,4.980792 6.021328,4.8 5.599864,4.8 Z M10.39984,4.8 C9.9784,4.8 9.6004,4.980792 9.3224,5.25884 C9.048,5.533248 8.87928,5.890288 8.81272,6.257152 C8.73384,6.691912 9.02232,7.108232 9.45704,7.187112 C9.89176,7.266072 10.30808,6.977592 10.38704,6.542872 C10.39048,6.523512 10.39496,6.506072 10.39984,6.490472 C10.4048,6.506072 10.4092,6.523512 10.41272,6.542872 C10.4916,6.977592 10.908,7.266072 11.34272,7.187112 C11.77744,7.108232 12.06592,6.691912 11.98704,6.257152 C11.9204,5.890288 11.75176,5.533248 11.47736,5.25884 C11.19928,4.980792 10.82136,4.8 10.39984,4.8 Z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-edit">
                    <path d="M13.283 14c.368 0 .667.298.667.667s-.299.667-.667.667H2.617c-.368 0-.667-.298-.667-.667S2.248 14 2.617 14h10.667zM12.031 1.138l1.448 1.448a2 2 0 0 1 0 2.828l-6.862 6.862c-.25.25-.589.39-.943.39H3.283c-.736 0-1.333-.597-1.333-1.333V8.943c0-.354.14-.693.391-.943l6.862-6.862a2 2 0 0 1 2.828 0zM3.617 8.609l-.333.333v2.391h2.391L6.007 11l-2.391-2.39zm5-5L4.56 7.666l2.391 2.39L11.007 6 8.617 3.609zm1.529-1.529l-.586.586 2.39 2.391.586-.586c.26-.26.26-.682 0-.943l-1.448-1.448c-.26-.26-.682-.26-.943 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-hand-cart">
                    <path d="M13.51 2.881c.25-.271.672-.287.942-.038s.287.672.038.942h0l-1.588 1.721c-.121.131-.117.335.009.462h0l.894.894c.26.26.26.682 0 .943s-.682.26-.943 0h0l-.837-.837c-.134-.134-.352-.13-.481.01h0l-4.423 4.792a1.99 1.99 0 0 1 .212.898 2 2 0 1 1-4 0 1.99 1.99 0 0 1 .195-.862l-2-2c-.26-.26-.26-.682 0-.943s.682-.26.943 0l2 1.999a1.99 1.99 0 0 1 .862-.195c.294 0 .573.063.825.177zM5.333 12c-.368 0-.667.298-.667.667s.298.667.667.667.667-.298.667-.667S5.701 12 5.333 12zm2.748-9.919l1.172 1.172a2 2 0 0 1 0 2.828L6.747 8.586a2 2 0 0 1-2.828 0L2.747 7.414a2 2 0 0 1 0-2.828l2.505-2.505a2 2 0 0 1 2.828 0zm-1.886.943L3.69 5.528c-.26.26-.26.682 0 .943l1.172 1.172c.26.26.682.26.943 0l2.505-2.505c.26-.26.26-.682 0-.943L7.138 3.024c-.26-.26-.682-.26-.943 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-wallet">
                    <path d="M12.667 2c1.416 0 2.574 1.104 2.661 2.498l.005.169v6.667c0 1.416-1.104 2.574-2.498 2.661l-.169.005H3.334C1.918 14 .759 12.896.672 11.502l-.005-.169V4.667c0-1.416 1.104-2.574 2.498-2.661L3.334 2h9.333zm0 1.333H3.334C2.597 3.333 2 3.93 2 4.667v6.667c0 .736.597 1.333 1.333 1.333h9.333c.736 0 1.333-.597 1.333-1.333h-2c-1.841 0-3.333-1.492-3.333-3.333S10.159 4.667 12 4.667h2c0-.736-.597-1.333-1.333-1.333zM14 6h-2a2 2 0 0 0 0 4h2V6zm-2 1.333c.368 0 .667.298.667.667s-.298.667-.667.667-.667-.298-.667-.667.298-.667.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-receipt">
                    <path d="M14 1.333c.368 0 .667.298.667.667s-.298.667-.667.667h-.667v11.461c0 .248-.261.409-.482.298l-1.886-.943c-.188-.094-.409-.094-.596 0l-1.474.737a2 2 0 0 1-1.789 0l-1.474-.737c-.188-.094-.409-.094-.596 0l-1.886.943c-.222.111-.482-.05-.482-.298L2.666 2.666H2c-.368 0-.667-.298-.667-.667s.298-.667.667-.667h12zm-2.333 1.333H4.333C4.149 2.666 4 2.816 4 3v9.019c0 .225.237.372.439.271a2 2 0 0 1 1.789 0l1.474.737c.188.094.409.094.596 0l1.474-.737a2 2 0 0 1 1.789 0c.202.101.439-.046.439-.271V3c0-.184-.149-.333-.333-.333zM7.333 9.333c.368 0 .667.298.667.667s-.298.667-.667.667H6c-.368 0-.667-.298-.667-.667s.298-.667.667-.667h1.333zm2.667 0c.368 0 .667.298.667.667s-.298.667-.667.667-.667-.298-.667-.667.298-.667.667-.667zM7.333 6.666c.368 0 .667.298.667.667S7.701 8 7.333 8H6c-.368 0-.667-.298-.667-.667s.298-.667.667-.667h1.333zm2.667 0c.368 0 .667.298.667.667S10.368 8 10 8s-.667-.298-.667-.667.298-.667.667-.667zM7.333 4c.368 0 .667.298.667.667s-.298.667-.667.667h0H6c-.368 0-.667-.298-.667-.667S5.631 4 6 4h0zM10 4c.368 0 .667.298.667.667s-.298.667-.667.667-.667-.298-.667-.667S9.631 4 10 4z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-close-circle">
                    <path d="M8 1.334a6.67 6.67 0 0 1 6.667 6.667A6.67 6.67 0 0 1 8 14.667a6.67 6.67 0 0 1-6.667-6.667A6.67 6.67 0 0 1 8 1.334zm0 1.333c-2.946 0-5.333 2.388-5.333 5.333S5.054 13.334 8 13.334s5.333-2.388 5.333-5.333S10.945 2.667 8 2.667zm2.471 2.862c.26.26.26.682 0 .943L8.943 8.001l1.529 1.529c.26.26.26.682 0 .943s-.682.26-.943 0L8 8.943l-1.529 1.529c-.26.26-.682.26-.943 0s-.26-.682 0-.943l1.529-1.529-1.529-1.529c-.26-.26-.26-.682 0-.943s.682-.26.943 0L8 7.058l1.529-1.529c.26-.26.682-.26.943 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-close-circle-fill">
                    <path d="M8 1.333A6.67 6.67 0 0 1 14.666 8 6.67 6.67 0 0 1 8 14.666 6.67 6.67 0 0 1 1.333 8 6.67 6.67 0 0 1 8 1.333zm1.529 4.195L8 7.057 6.471 5.528c-.26-.26-.682-.26-.943 0s-.26.682 0 .943L7.057 8 5.528 9.528c-.26.26-.26.682 0 .943s.682.26.943 0L8 8.942l1.529 1.529c.26.26.682.26.943 0s.26-.682 0-.943L8.942 8l1.529-1.529c.26-.26.26-.682 0-.943s-.682-.26-.943 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-search">
                    <path d="M6.667 1.334c2.945 0 5.333 2.388 5.333 5.333a5.31 5.31 0 0 1-1.12 3.27l3.592 3.592c.26.26.26.682 0 .943s-.682.26-.943 0l-3.591-3.592a5.31 5.31 0 0 1-3.27 1.12c-2.946 0-5.333-2.388-5.333-5.333s2.388-5.333 5.333-5.333zm0 1.333a4 4 0 1 0 0 8 4 4 0 1 0 0-8z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-plus-circle">
                    <path d="M8 1.333A6.67 6.67 0 0 1 14.666 8 6.67 6.67 0 0 1 8 14.666 6.67 6.67 0 0 1 1.333 8 6.67 6.67 0 0 1 8 1.333zm0 1.333C5.054 2.666 2.666 5.054 2.666 8S5.054 13.333 8 13.333 13.333 10.945 13.333 8 10.945 2.666 8 2.666zM8 4c.368 0 .667.298.667.667v2.667h2.667c.368 0 .667.298.667.667s-.298.667-.667.667H8.666v2.667c0 .368-.298.667-.667.667s-.667-.298-.667-.667V8.666H4.666C4.298 8.666 4 8.368 4 8s.298-.667.667-.667h2.667V4.666C7.333 4.298 7.631 4 8 4z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-minus-circle">
                    <path d="M8 1.333A6.67 6.67 0 0 1 14.666 8 6.67 6.67 0 0 1 8 14.666 6.67 6.67 0 0 1 1.333 8 6.67 6.67 0 0 1 8 1.333zm0 1.333C5.054 2.666 2.666 5.054 2.666 8S5.054 13.333 8 13.333 13.333 10.945 13.333 8 10.945 2.666 8 2.666zm3.333 4.667c.368 0 .667.298.667.667s-.298.667-.667.667h0-6.667C4.298 8.666 4 8.368 4 8s.298-.667.667-.667h0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-upload-file">
                    <path d="M10.229.667c.707 0 1.386.281 1.886.781l1.105 1.105c.5.5.781 1.178.781 1.886v8.229c0 1.473-1.194 2.667-2.667 2.667H4.667C3.194 15.334 2 14.14 2 12.667V3.334C2 1.861 3.194.667 4.667.667h5.562zM9.333 2H4.667c-.693 0-1.263.529-1.327 1.205l-.006.128v9.333c0 .693.529 1.263 1.205 1.327l.128.006h6.667c.693 0 1.263-.529 1.327-1.205l.006-.128V5.334h-1.333a2 2 0 0 1-1.995-1.851l-.005-.149V2zM7.745 6.051c.242-.1.53-.052.727.145h0l2 2c.26.26.26.682 0 .943s-.682.26-.943 0h0l-.862-.862v3.057c0 .368-.298.667-.667.667s-.667-.298-.667-.667h0V8.276l-.862.862c-.26.26-.682.26-.943 0s-.26-.682 0-.943h0l2-2c.064-.064.138-.112.216-.145zm2.922-3.977v1.259c0 .368.298.667.667.667h1.259c-.065-.188-.173-.361-.317-.505l-1.105-1.105c-.144-.144-.317-.251-.505-.317z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-pencil">
                    <path d="M12.885 2.219l.895.895c1.041 1.041 1.041 2.73 0 3.771l-6.565 6.565c-.359.359-.812.608-1.307.718l-2.174.483a2 2 0 0 1-2.386-2.386l.483-2.174c.11-.495.359-.948.718-1.307l6.565-6.565c1.041-1.041 2.73-1.041 3.771 0zM3.471 9.748c-.168.176-.286.395-.338.633l-.483 2.174c-.106.476.319.901.795.795l2.174-.483c.238-.053.457-.17.633-.338L3.471 9.748zm4.666-4.667L4.414 8.805l2.781 2.781 3.724-3.724-2.781-2.781zm3.805-1.919c-.521-.521-1.365-.521-1.886 0h0l-.976.976 2.781 2.781.976-.976c.521-.521.521-1.365 0-1.886h0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-route">
                    <path d="M10.334 1.335a3 3 0 0 1 3 3v4.333c0 .368-.298.667-.667.667s-.667-.298-.667-.667V4.335c0-.92-.746-1.667-1.667-1.667s-1.667.746-1.667 1.667v7.333a3 3 0 1 1-6 0v-5c0-.368.298-.667.667-.667s.667.298.667.667v5c0 .92.746 1.667 1.667 1.667s1.667-.746 1.667-1.667V4.335a3 3 0 0 1 3-3zm2.333 9.331a2 2 0 1 1 0 4 2 2 0 1 1 0-4zm0 1.333c-.368 0-.667.298-.667.667s.298.667.667.667.667-.298.667-.667-.298-.667-.667-.667zM3.91 1.653l1.173 2.01a.67.67 0 0 1-.576 1.003H2.162a.67.67 0 0 1-.576-1.003l1.173-2.01a.67.67 0 0 1 1.152 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-tick">
                    <path d="M11.862 4.862c.26-.26.682-.26.943 0 .24.24.259.618.055.88l-.055.063-5.333 5.333c-.24.24-.618.259-.88.055l-.063-.055-2.667-2.667c-.26-.26-.26-.682 0-.943.24-.24.618-.259.88-.055l.063.055L7 9.723l4.862-4.861z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-lock">
                    <path d="M7.999.668c1.841 0 3.333 1.492 3.333 3.333l-.001 2.113.023.003a2.92 2.92 0 0 1 2.571 2.703L14 10.667l-.074 1.847a2.92 2.92 0 0 1-2.747 2.719l-3.179.1a50.36 50.36 0 0 1-3.179-.1 2.92 2.92 0 0 1-2.747-2.719L2 10.667l.074-1.847a2.92 2.92 0 0 1 2.592-2.705V4.001C4.666 2.16 6.158.668 7.999.668zM8 7.333l-3.094.098c-.816.052-1.443.674-1.502 1.484l-.071 1.751.071 1.751c.059.81.686 1.432 1.502 1.484L8 14l3.094-.098c.816-.052 1.443-.674 1.502-1.484l.071-1.751-.071-1.751c-.059-.81-.686-1.432-1.502-1.484L8 7.333zm-.001 1.335c.736 0 1.333.597 1.333 1.333 0 .494-.268.924-.667 1.155h0v.845c0 .368-.298.667-.667.667s-.667-.299-.667-.667h0v-.845c-.399-.231-.667-.662-.667-1.155 0-.736.597-1.333 1.333-1.333zm0-6.667a2 2 0 0 0-2 2L5.998 6.04 8 6l2.001.04-.002-2.038a2 2 0 0 0-2-2z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-marker">
                    <path d="M8 .667a6 6 0 0 1 6 6c0 3.661-3.217 6.786-4.94 8.197-.625.512-1.496.512-2.121 0C5.217 13.453 2 10.328 2 6.667a6 6 0 0 1 6-6zM8 2a4.67 4.67 0 0 0-4.667 4.667c0 1.442.638 2.867 1.572 4.163.927 1.286 2.066 2.337 2.879 3.003.133.109.298.109.431 0 .813-.665 1.952-1.716 2.879-3.003.934-1.296 1.572-2.721 1.572-4.163A4.67 4.67 0 0 0 8 2zm0 2c1.473 0 2.667 1.194 2.667 2.667S9.473 9.334 8 9.334 5.333 8.14 5.333 6.667 6.527 4 8 4zm0 1.333c-.736 0-1.333.597-1.333 1.333S7.264 8 8 8s1.333-.597 1.333-1.333S8.736 5.334 8 5.334z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-car">
                    <path d="M11.039 2c.42 0 .829.132 1.169.377.292.21.521.495.663.823l.064.167.912 2.737c.44.185.761.599.812 1.093l.007.136v3.333a1.33 1.33 0 0 1-.693 1.162l.016.064h0l.01.066v1.375c0 .177-.07.346-.195.471-.1.1-.229.165-.366.187l-.105.008h-.667c-.177 0-.346-.07-.471-.195-.1-.1-.165-.229-.187-.366L12 13.333V12H4v1.333c0 .177-.07.346-.195.471-.1.1-.229.165-.366.187L3.333 14h-.667c-.177 0-.346-.07-.471-.195-.1-.1-.165-.229-.187-.366L2 13.333v-1.375c0-.046.017-.086.026-.13-.37-.205-.635-.576-.684-1.014l-.008-.148V7.333c0-.263.078-.519.224-.738.116-.175.272-.319.454-.422l.141-.069.912-2.737c.132-.398.387-.745.727-.99.292-.21.634-.337.99-.369L4.96 2h6.079zm2.294 5.333H2.666v3.333h10.668l-.001-3.333zm-9 .667a1 1 0 1 1 0 2 1 1 0 1 1 0-2zm7.333 0a1 1 0 1 1 0 2 1 1 0 1 1 0-2zm-.628-4.667H4.96c-.14 0-.276.044-.39.126-.085.061-.154.142-.202.234l-.041.096L3.591 6h8.817l-.737-2.211c-.091-.273-.345-.456-.633-.456z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-circle-and-square">
                    <path d="M13.334 5.334c.736 0 1.333.597 1.333 1.333v6.667c0 .736-.597 1.333-1.333 1.333H6.667c-.736 0-1.333-.597-1.333-1.333v-.998a.35.35 0 0 1 .371-.343l.296.007a6 6 0 0 0 6-6l-.007-.296a.35.35 0 0 1 .343-.371h.998zm-7.333-4a4.67 4.67 0 0 1 4.667 4.667 4.67 4.67 0 0 1-4.667 4.667 4.67 4.67 0 0 1-4.667-4.667 4.67 4.67 0 0 1 4.667-4.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-pen">
                    <path d="M14.11 9.444c.491.491.491 1.287 0 1.778l-2.889 2.889c-.491.491-1.287.491-1.778 0a.63.63 0 0 1 0-.889l3.778-3.778a.63.63 0 0 1 .889 0zM3.027 1.584l.067.001 5.43.776a4 4 0 0 1 3.059 2.268h0l1.22 2.615c.118.254.066.555-.133.753h0L7.997 12.67c-.198.198-.499.251-.753.133h0l-2.615-1.22a4 4 0 0 1-2.268-3.059h0l-.776-5.43c-.034-.237.243-.323.412-.153h0l3.912 3.912c.084.084.114.207.1.325-.006.051-.009.104-.009.157 0 .736.597 1.333 1.333 1.333s1.333-.597 1.333-1.333S8.07 6 7.333 6a1.35 1.35 0 0 0-.157.009.39.39 0 0 1-.325-.1h0L2.94 1.997c-.169-.169-.084-.446.153-.412z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-lightning">
                    <path d="M2.764 8.943L9.002.307a.67.67 0 0 1 1.198.5L9.334 6h3.363a.67.67 0 0 1 .54 1.057L7 15.694a.67.67 0 0 1-1.198-.5L6.668 10H3.305a.67.67 0 0 1-.54-1.057z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-stopwatch">
                    <path d="M7.333 3.334a6 6 0 1 1 0 12 6 6 0 1 1 0-12zm0 1.333a4.67 4.67 0 0 0-4.667 4.667A4.67 4.67 0 0 0 7.333 14 4.67 4.67 0 0 0 12 9.334a4.67 4.67 0 0 0-4.667-4.667zm0 1.333c.368 0 .667.298.667.667v2.667c0 .368-.298.667-.667.667s-.667-.298-.667-.667V6.667c0-.368.298-.667.667-.667zm4.862-3.138c.26-.26.682-.26.943 0h0l.667.667c.26.26.26.682 0 .943s-.682.26-.943 0h0l-.667-.667c-.26-.26-.26-.682 0-.943zM8.666.667c.368 0 .667.298.667.667S9.035 2 8.666 2h0H6c-.368 0-.667-.298-.667-.667S5.631.667 6 .667h0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-clock">
                    <path d="M8 1.334a6.67 6.67 0 0 1 6.667 6.667A6.67 6.67 0 0 1 8 14.667a6.67 6.67 0 0 1-6.667-6.667A6.67 6.67 0 0 1 8 1.334zm0 1.333c-2.946 0-5.333 2.388-5.333 5.333S5.054 13.334 8 13.334s5.333-2.388 5.333-5.333S10.945 2.667 8 2.667zM8 4c.368 0 .667.298.667.667v3.057l1.471 1.471c.26.26.26.682 0 .943s-.682.26-.943 0L7.528 8.471c-.125-.125-.195-.295-.195-.471V4.667C7.333 4.299 7.631 4 8 4z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-candlesticks">
                    <path d="M8 4.667c.368 0 .667.298.667.667h0l.001 1.448a2 2 0 0 1 1.326 1.736l.005.149v2a2 2 0 0 1-1.332 1.886l-.001.781c0 .368-.298.667-.667.667s-.667-.298-.667-.667h0v-.781a2 2 0 0 1-1.327-1.737L6 10.667v-2a2 2 0 0 1 1.333-1.886V5.333c0-.368.298-.667.667-.667zM2.667 2c.368 0 .667.298.667.667h0v.781a2 2 0 0 1 1.327 1.737l.005.149v1.333a2 2 0 0 1-1.333 1.886V12c0 .368-.298.667-.667.667S2 12.368 2 12h0V8.553A2 2 0 0 1 .672 6.816l-.005-.149V5.333A2 2 0 0 1 2 3.447v-.781C2 2.298 2.299 2 2.667 2zm10.667 0c.368 0 .667.298.667.667h0v.781a2 2 0 0 1 1.327 1.737l.005.149v3.333a2 2 0 0 1-1.333 1.886V12c0 .368-.298.667-.667.667s-.667-.298-.667-.667h0v-1.447a2 2 0 0 1-1.327-1.737l-.005-.149V5.333a2 2 0 0 1 1.333-1.886v-.781c0-.368.298-.667.667-.667zM8 8c-.368 0-.667.298-.667.667v2c0 .368.298.667.667.667s.667-.298.667-.667v-2C8.667 8.298 8.369 8 8 8zm5.333-3.333c-.368 0-.667.298-.667.667v3.333c0 .368.298.667.667.667S14 9.035 14 8.667V5.333c0-.368-.298-.667-.667-.667zm-10.667 0c-.368 0-.667.298-.667.667v1.333c0 .368.298.667.667.667s.667-.298.667-.667V5.333c0-.368-.298-.667-.667-.667z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-glass">
                    <path d="M11.16 0a2 2 0 0 1 2 2.015l-.007.151-1 12a2 2 0 0 1-1.838 1.828L10.16 16H5.84a2 2 0 0 1-1.974-1.68l-.019-.154-1-12A2 2 0 0 1 4.689.006L4.84 0h6.319zm0 1.333H4.84c-.39 0-.697.333-.664.722l1 12c.029.346.318.611.664.611h4.319c.347 0 .636-.266.664-.611l.616-7.398c-1.741-.057-2.714-.38-3.651-.692h0l-.011-.004c-.883-.294-1.733-.578-3.328-.623h0l-.111-1.336a11.38 11.38 0 0 1 3.873.698h0l.011.004c.883.294 1.734.578 3.329.623h-.001l.274-3.272c.032-.389-.274-.722-.664-.722zm-1.826 10c.368 0 .667.298.667.667s-.298.667-.667.667-.667-.298-.667-.667.298-.667.667-.667zM6.666 8c.368 0 .667.298.667.667s-.298.667-.667.667S6 9.035 6 8.667 6.298 8 6.666 8z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-at">
                    <path d="M2.666 8c0-2.946 2.388-5.333 5.333-5.333S13.333 5.054 13.333 8c0 .163-.003.734-.174 1.248-.084.253-.195.445-.323.567-.112.107-.26.185-.503.185-.269 0-.399-.074-.487-.164-.111-.113-.229-.33-.321-.734-.188-.826-.192-2.067-.192-3.769 0-.368-.298-.667-.667-.667S10 4.965 10 5.333a3.32 3.32 0 0 0-2-.666C6.159 4.666 4.666 6.159 4.666 8S6.159 11.333 8 11.333c.996 0 1.89-.437 2.5-1.129a2.19 2.19 0 0 0 .393.564c.38.389.876.565 1.44.565.591 0 1.068-.214 1.424-.554.341-.326.543-.738.667-1.11.243-.728.243-1.482.243-1.663V8A6.67 6.67 0 0 0 8 1.333 6.67 6.67 0 0 0 1.333 8 6.67 6.67 0 0 0 8 14.666a6.64 6.64 0 0 0 2.963-.693c.33-.164.464-.564.3-.894s-.564-.464-.894-.3a5.31 5.31 0 0 1-2.37.554c-2.946 0-5.333-2.388-5.333-5.333zM10 8a2 2 0 1 1-4 0 2 2 0 1 1 4 0z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-pizza-slice">
                    <path d="M9.667 2.376l.086.143 4.375 7.954c.715 1.299.422 2.889-.972 3.395-1.167.424-2.85.798-5.155.798s-3.988-.374-5.155-.798c-1.34-.487-1.663-1.975-1.05-3.244l.078-.151 4.375-7.954c.733-1.332 2.605-1.38 3.419-.143zm3.304 8.761l-.283.138C11.824 11.659 10.39 12 8 12s-3.824-.34-4.687-.724l-.283-.138c-.205.385-.232.752-.169 1.002.056.219.181.381.44.475 1.014.368 2.541.718 4.7.718s3.686-.349 4.7-.718c.259-.094.384-.256.44-.475.063-.25.036-.618-.169-1.002zM7.472 3.076l-.056.086-3.744 6.808.182.088c.637.283 1.869.609 4.146.609s3.509-.326 4.146-.609l.096-.045h0l.086-.043-3.744-6.807a.67.67 0 0 0-1.112-.086zM6.667 8c.368 0 .667.299.667.667s-.298.667-.667.667S6 9.034 6 8.666 6.298 8 6.667 8zm2.598-3.602l.644 1.171c-.246.17-.43.42-.518.709-.103.338-.067.704.1 1.016s.45.545.789.648c.3.091.621.073.908-.048l.644 1.171c-.603.293-1.296.348-1.939.153-.677-.205-1.244-.671-1.577-1.295s-.405-1.354-.199-2.031c.189-.623.599-1.153 1.149-1.493z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-google">
                    <path d="M14.899 6.789H8.536v2.728h3.607c-.577 1.818-2.001 2.424-3.636 2.424a3.94 3.94 0 0 1-3.23-1.677A3.94 3.94 0 0 1 4.8 6.655a3.94 3.94 0 0 1 2.683-2.459 3.94 3.94 0 0 1 3.553.789l1.982-1.887c-.798-.735-1.764-1.264-2.812-1.542s-2.15-.295-3.207-.05-2.039.743-2.859 1.453-1.455 1.609-1.85 2.62-.536 2.103-.412 3.181.508 2.109 1.121 3.005 1.435 1.628 2.395 2.134 2.029.77 3.114.769c3.676 0 7-2.424 6.392-7.879z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-apple">
                    <path d="M7.56 4.975c-.331-.148-.687-.308-1.282-.308C4.056 4.668 3.5 6.89 3.5 9.112s1.667 5 2.778 5c.651 0 1.111-.191 1.492-.349.27-.112.5-.207.73-.207s.46.095.73.207c.381.158.841.349 1.492.349.793 0 1.869-1.415 2.42-3.034.056-.163-.058-.331-.224-.376-.945-.255-1.641-1.119-1.641-2.145 0-.968.619-1.792 1.484-2.097.164-.058.265-.238.188-.393-.416-.839-1.112-1.399-2.227-1.399-.595 0-.952.16-1.282.308-.286.128-.553.248-.94.248s-.654-.12-.94-.248zm.94-1.002c0-1.151.933-2.083 2.083-2.083.077 0 .139.062.139.139 0 1.151-.933 2.083-2.083 2.083-.077 0-.139-.062-.139-.139z"></path>
                </symbol>
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="icon-eye">
                    <path d="M8 2.667c3.351 0 5.649 2.106 6.895 3.671.784.985.784 2.34 0 3.325-1.246 1.565-3.544 3.671-6.895 3.671S2.35 11.228 1.105 9.663c-.784-.985-.784-2.34 0-3.325C2.35 4.773 4.649 2.667 8 2.667zM8 4c-2.75 0-4.706 1.728-5.852 3.168a1.31 1.31 0 0 0 0 1.665C3.294 10.272 5.249 12 8 12s4.706-1.728 5.851-3.168a1.31 1.31 0 0 0 0-1.665C12.706 5.729 10.75 4 8 4zm0 1.333c1.473 0 2.667 1.194 2.667 2.667S9.473 10.667 8 10.667 5.333 9.473 5.333 8 6.527 5.334 8 5.334zm0 1.333l-.056.001A1 1 0 0 1 7 8a1 1 0 0 1-.332-.057L6.667 8c0 .736.597 1.333 1.333 1.333S9.333 8.737 9.333 8 8.736 6.667 8 6.667z"></path>
                </symbol>
            </svg>
        </div>
</body>
</html>
