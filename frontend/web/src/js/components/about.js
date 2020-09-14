'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class About{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  
  init(){
    $('.welcome_word_wrapper button').on('click', function(e) {
      $('.popup_filter_bg').addClass('_active');
      $('body').addClass('_popup_mode');
    });

    $('.popup_filter_bg .welcome_word_full_wrapper').find('.close_icon').on('click', function(e){
      $('.popup_filter_bg').removeClass('_active');
      $('body').removeClass('_popup_mode');
    });

    $('.popup_filter_bg .scroll_block').on('click', function(e){
      if (!$(e.target).hasClass('.welcome_word_full_wrapper') &&
          $(e.target).closest('.welcome_word_full_wrapper').length === 0) {
            $('.popup_filter_bg').removeClass('_active');
            $('body').removeClass('_popup_mode');
          }
    });

    var equipmentContainer = null;
    var scrollWidth = 0;
    var swiperInitWatch = function(e) {

      scrollWidth = Math.max(
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );

      if (scrollWidth < 768 && equipmentContainer === null) {
        equipmentContainer  = new Swiper('.equipment_container', {
          slidesPerView: 1,
          spaceBetween: 16,
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

        $('.revolver_navigation_wrapper').removeClass('_hidden');

      } else if (scrollWidth >= 768 && equipmentContainer !== null) {
        equipmentContainer.destroy();
        equipmentContainer = null;
        $('.revolver_navigation_wrapper').addClass('_hidden');
      }
    };

    window.addEventListener('resize', swiperInitWatch, { passive: true });
    swiperInitWatch();

    var instagramWrapper = new Swiper('.instagram_gallery', {
      spaceBetween: 24,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          slidesPerColumn: 1,    
        },

        768: {
          slidesPerView: 3,
          slidesPerColumn: 2,
          slidesPerColumnFill: 'row',
        },
        1440: {
          slidesPerView: 4,
          slidesPerColumn: 2,
          slidesPerColumnFill: 'row',
        },
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    instagramWrapper.on('resize', function(){
      this.update();
    });
  }
}