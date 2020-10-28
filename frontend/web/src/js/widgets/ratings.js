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
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        clickable: true,
      }
    });

    // настройка закрашивания звёзд
    var currentRatingString = null;
    $('.ratings_container .stars').each(function(i, obj){
      currentRatingString = ($(obj).data('rating') * 20 - 1) + 'px';
      $(obj).css('width', currentRatingString);
    });

  }

}