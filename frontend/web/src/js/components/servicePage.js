'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';
import YouTubePlayer from 'youtube-player';

export default class ServicePage{
  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
    let self = this;
    var fired = false;

    window.addEventListener('click', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});
 
    window.addEventListener('scroll', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});

    window.addEventListener('mousemove', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});

    window.addEventListener('touchmove', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});

    setTimeout(() => {
      if (fired === false) {
            fired = true;
            load_other();
      }
    }, 5000);

    function load_other() {
        self.youtube_run();
    }
  }

  youtube_run(){
    var player = [];
  
    $('.service_video_item_wrapper').each(function(i, obj) {
      var currentVideoId = $(obj).find('.servise_video').attr('id');
      player[i] = YouTubePlayer(currentVideoId, {
        videoId: currentVideoId,
        width: '496',
        height: '286',
      });
      $(obj).find('.play_button_wrapper .play_button').on('click', function() {
        player[i].playVideo();
        $(this).closest('.play_button_wrapper').addClass('_hidden');
      });
    });
  }

  init(){
    
    if ($('.service_price_wrapper').length > 5) {
      $('.prices_wrapper .show_all').removeClass('_hidden');
      $('.prices_wrapper').addClass('_compact');
    }

    $('.prices_wrapper .read_more').on('click', function(e){
      $('.prices_wrapper .show_all').addClass('_hidden');
      $('.prices_wrapper').removeClass('_compact');
    });

    $('.service_description .read_more').on('click', function(e){
      $('.service_description p').addClass('_active');
      $('.service_description .read_more').addClass('_hidden');
      $('html,body').animate({scrollTop:$('.service_description p').offset().top}, 400);
    });

    $('.subservice_wrapper .collapse_wrapper').on('click', function(e){

      if ($(e.target).hasClass('close_block')){
        $('.subservice_wrapper .close_block').addClass('_hidden');
        $('.subservice_wrapper .open_block').removeClass('_hidden');
        $('.subservice_wrapper .subservice_listing').addClass('_compact');
      } else if ($(e.target).hasClass('open_block')){
        $('.subservice_wrapper .close_block').removeClass('_hidden');
        $('.subservice_wrapper .open_block').addClass('_hidden');
        $('.subservice_wrapper .subservice_listing').removeClass('_compact');
      }
    });

    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      watchOverflow: true,
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

    var videoWrapper  = new Swiper('.service_video_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      watchOverflow: true,
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


    var photoGalleryWrapper  = new Swiper('.photo_gallery_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      watchOverflow: true,
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

    var photoWrapper  = new Swiper('.before_after_gallery_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      allowTouchMove: false,
      watchOverflow: true,
      slideClass: 'twenty-swiper-container',
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        clickable: true,
      },
      on: {
        init: function () {
          console.log('swiper initialized');
        },
      },
    });

    $(window).on("load", function() {
      $('[data-page-type="service_page"] .before_after_item_wrapper').each(function(i, obj) {
        let currentID = 'before_after_container' + (i + 1);
        $(obj).attr('id', currentID)
        $(('#' + currentID)).twentytwenty({
            before_label: '????',
            after_label: '??????????',
        });
        console.log('2020swiper');
      });
    });

    var reviewWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      watchOverflow: true,
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
  }
}