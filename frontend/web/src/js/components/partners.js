'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class Partners{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }
  
  init(){
    var partnersLogoContainer = null;
    var scrollWidth = 0;
    var $logoNavigation = $('.revolver_navigation_wrapper');
    var $moreGiftsButton = $('.partners_gifts_container button');
    var $giftItems = $('.partners_gifts_item');

    var switchMobileMode = function(e) {
      scrollWidth = Math.max(
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );

      if (scrollWidth < 768 && partnersLogoContainer === null) {
        partnersLogoContainer  = new Swiper('.partners_logo_container', {
          slidesPerView: 2,
          spaceBetween: 12,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
          // pagination: {
          //   el: '.swiper-pagination',
          //   type: 'bullets',
          // }
        });

        $logoNavigation.removeClass('_hidden');
        $moreGiftsButton.removeClass('_hidden');

        if ($giftItems.length > 5) {

          for (var i = 5; i < $giftItems.length; i++) {
            $($giftItems[i]).addClass('_hidden');
          }
        }

      } else if (scrollWidth >= 768 && partnersLogoContainer !== null) {
        partnersLogoContainer.destroy();
        partnersLogoContainer = null;
        $logoNavigation.addClass('_hidden');
        $moreGiftsButton.addClass('_hidden');

        if ($giftItems.length > 5) {

          for (var i = 5; i < $giftItems.length; i++) {
            $($giftItems[i]).removeClass('_hidden');
          }
        }
      }
    };

    window.addEventListener('resize', switchMobileMode, { passive: true });
    switchMobileMode();

    $moreGiftsButton.on('click', function(e) {

      if ($giftItems.length > 5) {

        for (var i = 5; i < $giftItems.length; i++) {
          $($giftItems[i]).removeClass('_hidden');
        }
      }
      $moreGiftsButton.addClass('_hidden');
    });
  }
}