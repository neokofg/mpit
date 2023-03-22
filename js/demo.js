"use strict";

// live section
$('.live__button').on('click', function () {
  $('.live__button').hide();
  $('.live__item').show();
}); // nav

$('.nav__link').on('click', function (e) {
  e.preventDefault();
  $('.nav__link').removeClass('active');
  $(this).addClass('active');
}); // messages

$('.messages__item').on('click', function (e) {
  e.preventDefault();
  $('.messages__item').removeClass('active');
  $(this).addClass('active');
  $('.messages__wrapper').addClass('show');
  $('.messages__back').removeClass('show');
});
$('.messages__back').on('click', function (e) {
  $('.messages__wrapper').removeClass('show');
}); // login

$('.subscription__btn').on('click', function () {
  $('.login__item:first-child').hide();
  $('.login__item:nth-child(2)').show();
});
$('.login__link').on('click', function (e) {
  e.preventDefault();
  $('.login__item:first-child').hide();
  $('.login__item:nth-child(2)').show();
});
$('.login__item:nth-child(2) .login__button').on("click", function () {
  $.magnificPopup.close();
  $('.header').removeClass('authorization');
});
$('.login__password').on('click', function (e) {
  e.preventDefault();
  $('.login__item:nth-child(2)').hide();
  $('.login__item:nth-child(3)').show();
});
$('.login__item:nth-child(3) .login__button').on("click", function () {
  $('.login__item:nth-child(3)').hide();
  $('.login__item:nth-child(4)').show();
});
$('.header__btns .header__button:nth-child(2)').on("click", function () {
  $('.header').addClass('authorization');
}); // panel flights

$('.panel__button').on('click', function () {
  $('.panel__button').removeClass('active');
  $(this).addClass('active');
}); // show filters for mobile

$('.flights__sorting .flights__button').on('click', function () {
  $(this).toggleClass('active');
  $('.flights__filters').toggleClass('show');
}); // filters reset

$('.flights__reset').on('click', function () {
  $('.js-slider')[0].noUiSlider.reset();
  $('.js-range-slider').each(function () {
    $(this)[0].noUiSlider.reset();
  });
  $('.flights__variants .checkbox .checkbox__input').each(function () {
    $(this).prop('checked', false).removeAttr('checked');
  });
}); // full content description

$('.description__button').on('click', function () {
  $(this).hide();
  $('.description__content').show();
});
$('.receipt__btns .receipt__button:first-child').on('click', function () {
  $(this).toggleClass('active');
});