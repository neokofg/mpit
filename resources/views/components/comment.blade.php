<div class="comment__item">
    <div class="comment__avatar"><img src="{{asset('img/content/avatar-1.jpg')}}" alt="Avatar"></div>
    <div class="comment__details">
        <div class="comment__top">
            <div class="comment__author">{{$rating->user->name}}</div>
            <div class="rating js-rating" data-rating="{{$rating->rating}}" data-read="true"></div>
        </div>
        <div class="comment__content">{{$rating->text}}</div>
    </div>
</div>
