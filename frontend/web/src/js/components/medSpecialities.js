'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class MedSpecialities{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  init(){

    if (document.documentElement.clientWidth <= 768){

      var doctorsWrapper  = new Swiper('.doctors_wrapper', {
        slidesPerView: 'auto',
        spaceBetween: 12,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        // pagination: {
        //   el: '.swiper-pagination',
        //   type: 'bullets',
        // }
  
      });
    }

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });
  }
}