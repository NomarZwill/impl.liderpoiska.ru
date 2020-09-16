'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class InstagramGallery{

  constructor(){
  	Swiper.use([Navigation, Pagination]);
    this.init();
  }

  init(){
    var instagramWrapper = null;
    var $instagramNavigation = $('.instagram_gallery .revolver_navigation_wrapper');

    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );
    };

    function resizeInstagramBlock() {

      if (getScrollWidth() < 768 && instagramWrapper === null){
        instagramWrapper = new Swiper('.instagram_gallery', {
        slidesPerView: 1,
        slidesPerColumn: 1,  
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
        $instagramNavigation.removeClass('_hidden');

      } else if (getScrollWidth() >= 768 && instagramWrapper !== null) {
        instagramWrapper.destroy();
        instagramWrapper = null;
        $instagramNavigation.addClass('_hidden');
      }
    }

    window.addEventListener('resize', resizeInstagramBlock, { passive: true });
    resizeInstagramBlock();

    
  }
}