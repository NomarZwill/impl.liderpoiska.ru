'use strict';

import Swiper, { Navigation, Pagination, Thumbs } from 'swiper';


export default class OurWorks{

  constructor(){
    Swiper.use([Navigation, Pagination, Thumbs]);
    this.init();
  }

  init(){
    var doctorWorkWrapper  = new Swiper('.doctor_work_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      watchOverflow: true,
      navigation: {
        nextEl: '.doctor_work_wrapper .swiper-button-next',
        prevEl: '.doctor_work_wrapper .swiper-button-prev'
      },
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        clickable: true,
      }
    });

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      watchOverflow: true,
      navigation: {
        nextEl: '.reviews_wrapper .swiper-button-next',
        prevEl: '.reviews_wrapper .swiper-button-prev'
      },
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        clickable: true,
      }
    });

    $('.our_works_selector').on('click', function(e){
      var $itemList = $(this).siblings('.medical_specialties_wrapper');
      if (!$itemList.hasClass('_active')) {
        $itemList.addClass('_active');
      } else {
        $itemList.removeClass('_active');
      }
    });
  }
}