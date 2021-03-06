'use strict';

import Swiper, { Navigation, Pagination, Thumbs } from 'swiper';


export default class TwoLevelGallery{

  constructor(){
    Swiper.use([Navigation, Pagination, Thumbs]);
    this.init();
  }

  init(){
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

    function declOfNum(number, titles) {  
      var cases = [2, 0, 1, 1, 1, 2];  
      return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
    }
  
    function setTotalSlidesOverThumbs(){
      $popupGalleries.each(function(i, obj){
        var itemCount = $(obj).find('.popup_gallery .swiper-slide.doctor_work_item._popup').length;
        var itemString = itemCount + ' ' + declOfNum(itemCount, ['фотография', 'фотографии', 'фотографий']);
        $(obj).closest('.doctor_work_item').find('.inner_gallery_button').html(itemString);
      });
    }

    setTotalSlidesOverThumbs();

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
  }
}