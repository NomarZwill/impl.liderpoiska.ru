'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class Prices{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
    var self = this;
    this.swipers = [];
    
    $('.banners_container').each(function(i, obj){
      var bannersContainer = new Swiper(obj, {
        slidesPerView: 1,
        spaceBetween: 24,
        watchOverflow: true,
        centeredSlides: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination',
          dynamicBullets: true,
          clickable: true,
        }
      });

      self.swipers.push(bannersContainer);
    });
  }
  
  init(){

    (function(){
      var slidingMenu = document.querySelector('.content_block.menu_container');
      var menuWrapper = null;
      var P = 32;

      window.addEventListener('scroll', Ascroll, false);
      document.body.addEventListener('scroll', Ascroll, false);

      function Ascroll() {
        if (getScrollWidth() > 1440) {

          if (menuWrapper == null) {
            var Sa = getComputedStyle(slidingMenu, '');
            var s = '';

            for (var i = 0; i < Sa.length; i++) {

              if (Sa[i].indexOf('overflow') == 0
                || Sa[i].indexOf('padding') == 0
                || Sa[i].indexOf('border') == 0
                || Sa[i].indexOf('outline') == 0
                || Sa[i].indexOf('box-shadow') == 0
                || Sa[i].indexOf('background') == 0
              ){
                s += Sa[i] + ': ' +Sa.getPropertyValue(Sa[i]) + '; '
              }
            }

            menuWrapper = document.createElement('div');
            menuWrapper.style.cssText = s + ' box-sizing: border-box; width: ' + slidingMenu.offsetWidth + 'px;';
            slidingMenu.insertBefore(menuWrapper, slidingMenu.firstChild);
            var l = slidingMenu.childNodes.length;

            for (var i = 1; i < l; i++) {
              menuWrapper.appendChild(slidingMenu.childNodes[1]);
            }

            slidingMenu.style.height = menuWrapper.getBoundingClientRect().height + 'px';
            slidingMenu.style.padding = '0';
            slidingMenu.style.border = '0';
            slidingMenu.style.background = 'none';
          }

          var Ra = slidingMenu.getBoundingClientRect();
          var R = Math.round(Ra.top + menuWrapper.getBoundingClientRect().height - document.querySelector('.content_block.service_block_container._last_block').getBoundingClientRect().bottom);

          if ((Ra.top - P) <= 0) {
            if ((Ra.top - P) <= R) {
              menuWrapper.className = 'stop';
              menuWrapper.style.top = - R +'px';
            } else {
              menuWrapper.className = 'sticky';
              menuWrapper.style.top = P + 'px';
            }
          } else {
            menuWrapper.className = '';
            menuWrapper.style.top = '';
          }

          window.addEventListener('resize', function() {
            slidingMenu.children[0].style.width = getComputedStyle(slidingMenu, '').width
          }, false);
        } else {
          slidingMenu.style.height = 'auto';
        }
      }
    })();

    var $sections = $('.content_block.service_block_container');
    var $navBar = $('.content_block.menu_container'); 
    var navBarHeight = 200; 
    
    $(window).on('scroll', function () {
      var currentPosition = $(this).scrollTop();
      // $navBar = $('.content_block.menu_container');
      // navBarHeight = $navBar.outerHeight();
      
      $sections.each(function() {
        var top = $(this).offset().top - navBarHeight;
        var bottom = top + $(this).outerHeight();
        
        if (currentPosition >= top && currentPosition <= bottom) {
          $navBar.find('a').removeClass('_active');
          $navBar.find('a[href="#' + $(this).find('a').attr('name') + '"]').addClass('_active');
        }
      });
    });

    $navBar.find('a').on('click', function () {
      $navBar.find('a').removeClass('_active');
      $(this).find('a').addClass('_active');
    });

    $('.collapse_wrapper').on('click', function(e) {
      var $currentTarget = $(e.target)

      if ($currentTarget.hasClass('open_block')) {
        $currentTarget.closest('.content_block.service_block_container').find('.service_block_wrapper').addClass('_active');
        $currentTarget.addClass('_hidden');
        $currentTarget.siblings('.close_block').removeClass('_hidden');
      } else if ($currentTarget.hasClass('close_block')) {
        $currentTarget.closest('.content_block.service_block_container').find('.service_block_wrapper').removeClass('_active');
        $currentTarget.addClass('_hidden');
        $currentTarget.siblings('.open_block').removeClass('_hidden');
      }
    });

    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );
    };
  }
}