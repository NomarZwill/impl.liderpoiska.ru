'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';


export default class DoctorPage{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    this.init();
  }

  init(){
    var clinicsWrapper  = new Swiper('.clinics_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
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

    var specialitiesWrapper  = new Swiper('.specialities_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
    });

    var lizcenzWrapper  = new Swiper('.lizcenz_wrapper', {
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

    $('.content_block.doctor_lizcenz .lizcenz_item').on('click', function(e) {
      var lizcenzItem = $(this).html();
      $('.popup_filter_bg .lizcenz_item_wrapper').html(lizcenzItem);
      $('.popup_filter_bg').addClass('_active');
      $('.popup_filter_bg .popup_lizcenz_wrapper').removeClass('_hidden');

      $('body').addClass('_popup_mode');
    });

    $('.popup_filter_bg .popup_lizcenz_wrapper').find('.close_icon').on('click', function(e){
      $(this).closest('.popup_lizcenz_wrapper').addClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').removeClass('_popup_mode');
    });

    if ($('.doctor_education_content').height() > 600){
      $('.doctor_education_content').addClass('_compact');
      $('.doctor_education_content .show_all').removeClass('_hidden');
      $('.content_block.doctor_education .read_more').on('click', function(e){
        $(this).closest('.doctor_education_content').removeClass('_compact');
      });
    }

    var doctorWorkWrapper  = new Swiper('.doctor_work_wrapper', {
      slidesPerView: 'auto',
      initialSlide: 3,
      spaceBetween: 24,
      observer: true,
      observeParents: true,
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

    var $popupGalleries =  $('.popup_gallery_wrapper');
    var popupSwipers = [];

    $('.doctor_work_example .doctor_work_image').on('click', function(e){
      var currentID = $(this).data('gallery-id');
      openInnerGallery(currentID);
    });

    $('.doctor_work_example .inner_gallery_button').on('click', function(e){
      var currentID = $(this).closest('p').siblings('.doctor_work_image').data('gallery-id');
      openInnerGallery(currentID);
    });
    
    function openInnerGallery(id){
      $('body').addClass('_popup_mode');
      var $currentPopupGallery = null;

      $popupGalleries.each(function(i){

        if ($($popupGalleries[i]).data('gallery-id') == id){
          $currentPopupGallery = $($popupGalleries[i]);
          $currentPopupGallery.addClass('_active');
        }
      });

      $('.popup_filter_bg').addClass('_active');
      var thumbs = new Swiper($currentPopupGallery.find('.popup_gallery_thumbs'), {
        // init: false,
        slidesPerView: 'auto',
        spaceBetween: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        on: {
          init: function(){
            console.log('swiper');
          }

        }
        // navigation: {
        //   nextEl: '.swiper-button-next',
        //   prevEl: '.swiper-button-prev'
        // },
        // pagination: {
        //   el: '.swiper-pagination',
        //   type: 'bullets',
        // }
      });

      var bigSlides = new Swiper($currentPopupGallery.find('.popup_gallery'), {
        // init: false,
        slidesPerView: 1,
        spaceBetween: 24,
        thumbs: {
          swiper: thumbs,
          slideThumbActiveClass: 'swiper-slide-thumb-active',
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

      popupSwipers.push({bigSlides, thumbs});
      console.log(popupSwipers);

      // popupSwipers[id * 2 - 1].init();
      // popupSwipers[id * 2 - 2].init();

    };

    $('.popup_gallery_wrapper .close_icon').on('click', function(e){
      $(this).closest('.popup_gallery_wrapper').removeClass('_active');
      $(this).closest('.popup_filter_bg').removeClass('_active');
      $('body').removeClass('_popup_mode');
    });

    $('.popup_filter_bg .popup_gallery_wrapper').find('.popup_close_button').on('click', function(e){
      $(this).closest('.popup_gallery_wrapper').removeClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').removeClass('_popup_mode');
    });

    $('.popup_gallery_wrapper .swiper-button-next._diagonal_navigation').on('click', function(e){
      var oldID = $(this).closest('.popup_gallery_wrapper').data('gallery-id');
      var newID = oldID + 1;

      if( $(`[data-gallery-id=${newID}].popup_gallery_wrapper`).length > 0){

        $(this).closest('.popup_gallery_wrapper').removeClass('_active');
        $(this).closest('.popup_gallery_wrapper').siblings(`[data-gallery-id=${newID}]`).addClass('_active');
  
        popupSwipers[newID * 2 - 1].init();
        popupSwipers[newID * 2 - 2].init();
      }

    });

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
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