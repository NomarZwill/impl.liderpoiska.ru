'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class ServicePage{
  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
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

    if ($('.subservice_listing_item').length > 5) {
      $('.prices_wrapper .show_all').removeClass('_hidden');
      $('.prices_wrapper').addClass('_compact');
    }

    $('.prices_wrapper .read_more').on('click', function(e){
      $('.prices_wrapper .show_all').addClass('_hidden');
      $('.prices_wrapper').removeClass('_compact');
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
      slideClass: 'twentytwenty-wrapper',
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

    var reviewWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
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