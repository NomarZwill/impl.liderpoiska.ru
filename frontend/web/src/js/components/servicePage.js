'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class ServicePage{
  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  init(){
    
    if ($('.price_item_wrapper').length > 5) {
      $('.prices_wrapper .show_all').removeClass('_hidden');
      $('.prices_wrapper').addClass('_compact');
    }

    $('.prices_wrapper .read_more').on('click', function(e){
      $('.prices_wrapper .show_all').addClass('_hidden');
      $('.prices_wrapper').removeClass('_compact');
    });

    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
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