'use strict';

import Swiper, { Navigation, Pagination, Thumbs } from 'swiper';


export default class DoctorPage{

  constructor(){
    Swiper.use([Navigation, Pagination, Thumbs]);
    this.init();
  }

  init(){
    var doctorWorkWrapper  = new Swiper('.doctor_work_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      // observer: true,
      // observeParents: true,
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

    var doctorVideo  = new Swiper('.doctor_video_wrapper', {
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
      },
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

    $('.popup_filter_bg .popup_lizcenz_wrapper .close_icon')
    .add('.popup_filter_bg .popup_lizcenz_wrapper .popup_close_button')
    .on('click', function(e){
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

    var $popupGalleries =  $('.popup_gallery_wrapper');
    var $currentPopupGallery = null;
    var $popupGalleryContainer = $('.popup_gallery_container');
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

    function setIDToGalleries(){
      $popupGalleries.each(function(i, obj){
        obj.dataset.galleryId = i + 1;
      });
    };

    setIDToGalleries();

    $('.doctor_work_example .doctor_work_image')
    .add('.doctor_work_example .inner_gallery_button')
    .on('click', function(e){
      var $currentGallery = $(this).closest('.doctor_work_item').find('.popup_gallery_wrapper');
      if ($(this).closest('.inner_gallery_wrapper').length === 0) {
        openInnerGallery($currentGallery);
      }
    });
    
    function openInnerGallery($currentGallery){
      $('body').addClass('_popup_mode');

      $currentPopupGallery = $currentGallery.clone(true);
      $popupGalleryContainer.find('.inner_gallery_wrapper').remove();
      $popupGalleryContainer.prepend($currentPopupGallery);
      $currentPopupGallery.addClass('_active');

      isZeroBeforeNeeded($currentPopupGallery.data('gallery-id'), $popupGalleryNavigation.find('.current_slide'));
      
      $('.popup_filter_bg').addClass('_active');
      $('.popup_filter_bg .popup_gallery_container').removeClass('_hidden');
      initActivePopupGallery();
    };

    function initActivePopupGallery(){
      popupSwiperThumbs = new Swiper($('.popup_gallery_wrapper._active .popup_gallery_thumbs')[0], {
        slidesPerView: 'auto',
        spaceBetween: 4,
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

      var currentID = $currentPopupGallery.data('gallery-id');

      if ($(e.target).hasClass('popup_button_next')) {

        if (currentID < $popupGalleries.length) {
          var $newPopupGallery = $($popupGalleries[currentID]);
          getNewGallery();
        };

      } else if ($(e.target).hasClass('popup_button_prev')) {

        if (currentID > 1) {
          var $newPopupGallery = $($popupGalleries[currentID - 2]);
          getNewGallery();
        };
      };

      function getNewGallery(){
        popupSwiperBig.destroy();
        popupSwiperThumbs.destroy();
        $currentPopupGallery.remove();
        $currentPopupGallery = $newPopupGallery.clone(true);
        $popupGalleryContainer.prepend($currentPopupGallery);
        $currentPopupGallery.addClass('_active');
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