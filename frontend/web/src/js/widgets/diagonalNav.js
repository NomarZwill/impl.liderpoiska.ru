'use strict';

export function updateCurrentSlideDiagonalNavigation($swiperContainer) {
  console.log('updateCurrentSlideDiagonalNavigation');
  var currentSlide = null;
  $swiperContainer.find('.swiper-slide').each(function(i, el) {
      if ($(el).hasClass('swiper-slide-active')) {
        currentSlide = i + 1;
        if (currentSlide < 10) {
          currentSlide = '0' + currentSlide;
        }

        $swiperContainer
        .find('.diagonal_navigation .current_slide')
        .html(currentSlide);
      }
    });
}