'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class About{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  
  init(){
    var equipmentContainer = null;
    var scrollWidth = 0;
    var swiperInitWatch = function(e) {

      scrollWidth = Math.max(
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );

      console.log('swiperInitWatch');
      console.log(equipmentContainer);
      console.log(scrollWidth);

      if (scrollWidth < 768 && equipmentContainer === null) {

        console.log('mobile');

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
        console.log('notMobile');

        equipmentContainer.destroy();
        equipmentContainer = null;
      }
    };

    window.addEventListener('resize', swiperInitWatch, { passive: true });
    swiperInitWatch();
  }
}