'use strict';

import Swiper, { Navigation, Pagination, Thumbs } from 'swiper';


export default class DoctorPage{

  constructor(){
    Swiper.use([Navigation, Pagination, Thumbs]);
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
      var lizcenzItem = $(this).data('fullImg');
      $('.popup_filter_bg .lizcenz_item_wrapper img').attr('src', lizcenzItem);
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
    var $currentPopupGallery = null;
    var $popupGalleryNavigation = $('.popup_gallery_container .diagonal_navigation');
    var popupSwiperBig = null;
    var popupSwiperThumbs = null;

    function isZeroBeforeNeeded(number, $element){
      if (number < 10) {
        $element.html('0' + number);
      } else {
        $element.html(number);
      }
    };

    isZeroBeforeNeeded($popupGalleries.length, $popupGalleryNavigation.find('.total_slides'));

    $('.doctor_work_example .doctor_work_image').on('click', function(e){
      var currentID = $(this).data('gallery-id');
      openInnerGallery(currentID);
    });
    
    function openInnerGallery(id){
      $('body').addClass('_popup_mode');
      $popupGalleries.removeClass('_active');
      $popupGalleries.each(function(i){

        if ($($popupGalleries[i]).data('gallery-id') == id){
          $currentPopupGallery = $($popupGalleries[i]);
          $currentPopupGallery.addClass('_active');
        }
      });

      isZeroBeforeNeeded(id, $popupGalleryNavigation.find('.current_slide'));
      
      $('.popup_filter_bg').addClass('_active');
      $('.popup_filter_bg .popup_gallery_container').removeClass('_hidden');
      initActivePopupGallery();
    };

    function initActivePopupGallery(){
      popupSwiperThumbs = new Swiper($('.popup_gallery_wrapper._active .popup_gallery_thumbs')[0], {
        slidesPerView: 'auto',
        spaceBetween: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
      });

      popupSwiperBig = new Swiper($('.popup_gallery_wrapper._active .popup_gallery')[0], {
        slidesPerView: 1,
        spaceBetween: 24,
        thumbs: {
          swiper: popupSwiperThumbs,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
      });
    }
    
    $('.popup_gallery_wrapper .close_icon')
    .add('.popup_filter_bg .popup_gallery_container .popup_close_button')
    .on('click', function(e){
      $(this).closest('.popup_filter_bg').removeClass('_active');
      $(this).closest('.popup_gallery_container').find('.popup_gallery_wrapper._active').removeClass('_active');
      $('.popup_filter_bg .popup_gallery_container').addClass('_hidden');
      $('body').removeClass('_popup_mode');
    });

    $popupGalleryNavigation.on('click', function(e){

      if ($(e.target).hasClass('swiper-button-next')) {
        var $newPopupGallery = $currentPopupGallery.next('.popup_gallery_wrapper');
        if ($newPopupGallery.length !== 0) {
          getNewGallery();
        };

      } else if ($(e.target).hasClass('swiper-button-prev')) {
        var $newPopupGallery = $currentPopupGallery.prev('.popup_gallery_wrapper');
        if ($newPopupGallery.length !== 0) {
          getNewGallery();
        };      
      };

      function getNewGallery(){
        $currentPopupGallery.removeClass('_active');
        popupSwiperBig.destroy();
        popupSwiperThumbs.destroy();
        $newPopupGallery.addClass('_active');
        $currentPopupGallery = $newPopupGallery;
        isZeroBeforeNeeded($currentPopupGallery.data('gallery-id'), $popupGalleryNavigation.find('.current_slide'));
        initActivePopupGallery();
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