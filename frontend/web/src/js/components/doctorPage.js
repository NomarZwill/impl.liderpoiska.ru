'use strict';

import Swiper from 'swiper';

export default class DoctorPage{

  constructor(){
    this.init();
  }

  init(){
    var clinicsWrapper  = new Swiper('.clinics_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    var lizcenzWrapper  = new Swiper('.lizcenz_wrapper', {
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

    var doctorWorkWrapper  = new Swiper('.doctor_work_wrapper', {
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

    $('.doctor_work_image').on('click', function(e){
      $(this).siblings('.popup_gallery_wrapper').addClass('._active');
      
    });
  }

}