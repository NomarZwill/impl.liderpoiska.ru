'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class Licenses{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }
  
  init(){
    var licenses_wrapper  = new Swiper('.licenses_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },

      breakpoints: {
        1440: {
          spaceBetween: 24
        }
      },

      on: {
        resize: function(){
          licenses_wrapper.update();
        }
      } 
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }
    });


    // window.addEventListener('resize', switchMobileMode, { passive: true });
    // switchMobileMode();

  }
}