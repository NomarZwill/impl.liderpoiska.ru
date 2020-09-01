'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class ClinicContacts{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  
  init(){
    var galleryContainer  = new Swiper('.clinic_gallery', {
      slidesPerView: 1,
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
    });

    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      centeredSlides: true,
      initialSlide: 3,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }
    });

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      centeredSlides: true,
      initialSlide: 2,
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