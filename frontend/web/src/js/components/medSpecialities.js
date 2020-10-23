'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class MedSpecialities{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  init(){
    var doctorsWrapper = null;

    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );
    };

    var switchMobileMode = function(e) {

      if (getScrollWidth() < 768 && doctorsWrapper === null) {
        doctorsWrapper  = new Swiper('.doctors_wrapper', {
          slidesPerView: 'auto',
          spaceBetween: 12,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
          pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
            clickable: true,
          }
        });

      } else if (getScrollWidth() >= 768 && doctorsWrapper !== null) {
        doctorsWrapper.destroy();
        doctorsWrapper = null;
      }
    };

    window.addEventListener('resize', switchMobileMode, { passive: true });
    setTimeout(switchMobileMode, 1000);
    // switchMobileMode();

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        clickable: true,
      }
    });
  }
}