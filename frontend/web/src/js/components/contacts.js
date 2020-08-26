'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class Contacts{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  
  init(){

    var galleryContainer  = new Swiper('.clinic_gallery', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      centeredSlides: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

      on: {
        init: function () {
          console.log('swiper initialized');
        },
      },

    });
  }
}