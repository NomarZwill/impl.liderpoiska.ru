'use strict';

import Swiper from 'swiper';

export default class Main{

  constructor(){
    this.init();
  }

  init(){
    var dealsContainer  = new Swiper('.deals_wrapper', {
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

    var clinicDescriptionGalleryContainer  = new Swiper('.clinic_description_gallery', {
      slidesPerView: 1,
      // spaceBetween: 24,
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

    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
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

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 1,
      // spaceBetween: 24,
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

    var $images = $('[data-bg-image]');
    $images.each(i => {
      // console.log(i);
      $($images[i]).css('background', `url(${$($images[i]).attr('data-bg-image')})`);
    });

    // var $diagonalNavTotal = $('.total_slides');
    
    // $diagonalNavTotal.each(i => {
    //   // console.log(i);
    //   var $gallery = $($diagonalNavTotal[i]).closest('.swiper_container');
    //   var totalSlides = $gallery.find('.swiper-slide').length;
    //   if (totalSlides > 9) {
    //     $($diagonalNavTotal[i]).text(totalSlides);
    //   } else {
    //     $($diagonalNavTotal[i]).text('0' + totalSlides);
    //   }
    // });

    // $('.swiper-button-next._diagonal_navigation').on('click', e => {
    //   var currentSlideNumber = $(e.target).siblings('.current_slide').html();
    //   // console.log(currentSlideNumber);

    //   if (currentSlideNumber > 8) {
    //     $(e.target).siblings('.current_slide').html(+currentSlideNumber + 1);
        
    //   } else {
    //     $(e.target).siblings('.current_slide').html('0' + (+currentSlideNumber + 1));
    //   }
    // });
  }
}