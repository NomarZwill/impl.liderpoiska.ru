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
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    var specialitiesWrapper  = new Swiper('.specialities_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
    });

    var lizcenzWrapper  = new Swiper('.lizcenz_wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

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
      spaceBetween: 24,
      observer: true,
      observeParents: true,
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

    var $popupGalleries =  $('.popup_gallery_wrapper');
    var popupSwipers = [];
    
    $popupGalleries.each(function(i){

      var thumbs = new Swiper($($popupGalleries[i]).find('.popup_gallery_thumbs'), {
        init: false,
        slidesPerView: 'auto',
        spaceBetween: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        // navigation: {
        //   nextEl: '.swiper-button-next',
        //   prevEl: '.swiper-button-prev'
        // },
        // pagination: {
        //   el: '.swiper-pagination',
        //   type: 'bullets',
        // }
  
      });

      var bigSlides = new Swiper($($popupGalleries[i]).find('.popup_gallery'), {
        init: false,
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

      popupSwipers.push(bigSlides, thumbs);
    });

    console.log(popupSwipers);

    $('.doctor_work_example .doctor_work_image').on('click', function(e){
      var currentID = $(this).data('gallery-id');
      openInnerGallery(currentID);
    });

    $('.doctor_work_example .inner_gallery_button').on('click', function(e){
      var currentID = $(this).closest('p').siblings('.doctor_work_image').data('gallery-id');
      openInnerGallery(currentID);
    });
    
    function openInnerGallery(id){
      $('body').css('overflow', 'hidden');
      var $currentPopupGallery = null;

      $popupGalleries.each(function(i){

        if ($($popupGalleries[i]).data('gallery-id') == id){
          $currentPopupGallery = $($popupGalleries[i]);
          $currentPopupGallery.addClass('_active');
        }
      });

      $('.popup_filter_bg').addClass('_active');

      popupSwipers[id * 2 - 1].init();
      popupSwipers[id * 2 - 2].init();

    };

    $('.popup_gallery_wrapper .close_icon').on('click', function(e){
      $(this).closest('.popup_gallery_wrapper').removeClass('_active');
      $(this).closest('.popup_filter_bg').removeClass('_active');
      $('body').css('overflow', 'auto');
    });

    $('.popup_gallery_wrapper .swiper-button-next._diagonal_navigation').on('click', function(e){
      var oldID = $(this).closest('.popup_gallery_wrapper').data('gallery-id');
      var newID = oldID + 1;

      console.log($(`[data-gallery-id=${newID}].popup_gallery_wrapper`).length );

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

    var $reviews = $(".review_item_wrapper");

    $reviews.each(function(i){
      var $review = $($reviews[i]);
      console.log($review.height());
      if ($review.height() > 300){
        
        $review.find('.review_text').addClass('_compact');
        $('.review_text .show_all').removeClass('_hidden');

        $review.find('.read_more').on('click', function(e){
          var reviewText = $(this).closest('.show_all').siblings('p').html(); 
          var reviewSignature = $(this).closest('.review_text').siblings('p').html()

          $('.popup_filter_bg .main_text').html(reviewText);
          $('.popup_filter_bg .signature').html(reviewSignature);
          $('.popup_filter_bg').addClass('_active');
          $('.popup_filter_bg .review_item_wrapper').removeClass('_hidden');

          $('body').css('overflow', 'hidden');
        });
      }  
    });

    $('.popup_filter_bg .review_item_wrapper').find('.close_icon').on('click', function(e){
      $(this).closest('.review_item_wrapper').addClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').css('overflow', 'auto');
    });

    $('.popup_filter_bg .review_item_wrapper').find('.popup_close_button').on('click', function(e){
      $(this).closest('.review_item_wrapper').addClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').css('overflow', 'auto');
    });

    if ($('.doctor_education_content').height() > 600){
      $('.doctor_education_content').addClass('_compact');
      $('.doctor_education_content .show_all').removeClass('_hidden');
      $('.content_block.doctor_education .read_more').on('click', function(e){
        $(this).closest('.doctor_education_content').removeClass('_compact');
      });
    }

  }
}