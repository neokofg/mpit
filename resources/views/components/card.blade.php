<a class="card" href="{{route('page',$tourbase->id)}}">
    <div class="card__preview"><img srcset="img/content/card-pic-1@2x.jpg 2x" src="images/{{$tourbase->getFirstImage()}}" alt="Entire serviced classy moutain house">
    </div>
    <div class="card__body">
        <div class="card__line">
            <div class="card__title">{{$tourbase->name}}</div>
            <div class="card__price">
                <div class="card__actual">От 3500 ₽</div>
            </div>
        </div>
        <div class="card__options">
            <div class="card__option">
                <box-icon class="icon icon-modem" name='map'></box-icon>Местоположения
            </div>
        </div>
        <div class="card__foot">
            <div class="card__flex">
                <div class="travels__date">Март 22 - Март 25</div>
                <div class="card__rating">
                    @isset($tourbase->rating)
                    <svg class="icon icon-star">
                        <use xlink:href="#icon-star"></use>
                    </svg>
                    <div class="card__number">
                        {{$tourbase->rating}}
                    </div>
                    <div class="card__reviews">
                        ({{App\Models\Rating::where('tourbase_id', $tourbase->id)->count()}} Отзывов)
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</a>
