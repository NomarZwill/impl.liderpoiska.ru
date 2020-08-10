'use strict';

import Swiper from 'swiper';

export default class DoctorsListing{

  constructor(){
    this.init();
  }

  init(){
    var clinicsWrapper  = new Swiper('.moscow_clinics', {
      slidesPerView: "auto",
      spaceBetween: 24,
      watchOverflow: true,
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

    $('.read_more').on('click', function (e) {
      $(this).siblings('p').addClass('_active');
      $(this).addClass('_hidden');
    });

    $('.medical_specialties_selector').on('click', function(e){
      var $itemList = $(this).siblings('.medical_specialties_wrapper');
      if (!$itemList.hasClass('_active')) {
        $itemList.addClass('_active');
      } else {
        $itemList.removeClass('_active');
      }
    });
  }

}