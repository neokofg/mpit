<header class="header js-header authorization">
    <div class="header__center center">
        <a class="header__logo" href="/"><img class="some-icon" src="img/logo-dark.svg" alt="Fleet"><img class="some-icon-dark" src="img/logo-light.svg" alt="Fleet"></a>
        <div class="header__wrapper js-header-wrapper">
            <div class="header__item header__item_dropdown js-header-item">
                <button class="header__head js-header-head">Travelers
                    <svg class="icon icon-arrow-down">
                        <use xlink:href="#icon-arrow-down"></use>
                    </svg>
                </button>
                <div class="header__body js-header-body">
                    <div class="header__menu">
                        <a class="header__link active" href="/">
                            <svg class="icon icon-comment">
                                <use xlink:href="#icon-comment"></use>
                            </svg>Stays</a>
                        <a class="header__link" href="flights.html">
                            <svg class="icon icon-email">
                                <use xlink:href="#icon-email"></use>
                            </svg>Flights</a>
                        <a class="header__link" href="things-to-do.html">
                            <svg class="icon icon-home">
                                <use xlink:href="#icon-home"></use>
                            </svg>Things to do</a>
                        <a class="header__link" href="cars.html">
                            <svg class="icon icon-email">
                                <use xlink:href="#icon-email"></use>
                            </svg>Cars</a>
                    </div>
                </div>
            </div>
            <a class="header__item" href=""></a>
            @if(Auth::check())
                <div class="header__item header__item_language js-header-item">
                    <a href="{{route("auth.logoutUser")}}">
                        <button class="header__head js-header-head">
                            <box-icon class="icon icon-globe" name='user'></box-icon>Выйти
                        </button>
                    </a>
                </div><a class="button button-stroke button-small header__button" href="{{route('profile')}}">Личный кабинет</a>
                <button class="header__burger js-header-burger"></button>
            @else
                <div class="header__item header__item_language js-header-item">
                    <a href="{{route("login")}}">
                        <button class="header__head js-header-head">
                            <box-icon class="icon icon-globe" name='user'></box-icon>Вход
                        </button>
                    </a>
                </div><a class="button button-stroke button-small header__button" href="{{route('register')}}">Регистрация</a>
                <button class="header__burger js-header-burger"></button>
            @endif
        </div>
</header>
