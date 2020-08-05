'use strict';

import Swiper from 'swiper';

export default class DoctorsListing{

  constructor(){
    this.init();
  }

  init(){
    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
      slidesPerView: 4,
      slidesPerColumn: 5,
      spaceBetween: 24,
      watchOverflow: true,
      slidesPerGroup: 4,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    var clinicsWrapper  = new Swiper('.moscow_clinics', {
      slidesPerView: "auto",
      spaceBetween: 24,
      // watchOverflow: true,
      slidesPerGroup: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    $('.clinics_cotnainer .cities').on('click', function (e) {
      var $target = $(e.target);

      if ($target.hasClass('city')) {
        $('.city').removeClass('_active');
        $target.addClass('_active');
      }

      if ($target.hasClass('moscow')) {
        $('.moscow_clinics').removeClass('_hidden');
        $('.geneva_clinics').addClass('_hidden');

      } else if ($target.hasClass('geneva')){
        $('.geneva_clinics').removeClass('_hidden');
        $('.moscow_clinics').addClass('_hidden');
      }
    });
  }

}