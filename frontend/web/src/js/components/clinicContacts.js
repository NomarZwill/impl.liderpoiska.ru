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
      on : {
        init: function() {
          console.log(this.slides.length);
          if (this.slides.length < 10) {
            this.$el.find('.total_slides').html('0' + this.slides.length);
          } else {
            this.$el.find('.total_slides').html(this.slides.length);
          }
        },

        slideChange: function() {
          if (this.activeIndex < 9) {
            this.$el.find('.current_slide').html('0' + (this.activeIndex + 1));
          } else {
            this.$el.find('.current_slide').html(this.activeIndex + 1);
          }
        }
      },
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
      // centeredSlides: true,
      // initialSlide: 3,
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
      // centeredSlides: true,
      // initialSlide: 2,
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