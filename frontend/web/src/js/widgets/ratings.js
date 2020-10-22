'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class Ratings{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  
  init(){
    var ratingsContainer  = new Swiper('.ratings_container', {
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

      on: {
        init: function () {
          // console.log('swiper initialized');
        },
      },

    });
  }

}