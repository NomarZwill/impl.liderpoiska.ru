'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class Index{

  constructor(){
  	Swiper.use([Navigation, Pagination]);
    this.init();
  }

  init(){
    var dealsContainer  = new Swiper('.deals_wrapper', {
      slidesPerView: "auto",
      spaceBetween: 24,
      // watchOverflow: true,
      slidesPerGroup: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });


    var clinicDescriptionGalleryContainer  = new Swiper('.clinic_description_gallery', {
      slidesPerView: 1,
      // spaceBetween: 24,
      watchOverflow: true,
      slidesPerGroup: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
      slidesPerView: "auto",
      spaceBetween: 24,
      watchOverflow: true,
      slidesPerGroup: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 1,
      spaceBetween: 4,
      watchOverflow: true,
      slidesPerGroup: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    var clinicsWrapper  = new Swiper('.moscow_clinics', {
      slidesPerView: "auto",
      spaceBetween: 24,
      // watchOverflow: true,
      slidesPerGroup: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      
      // pagination: {
      //   el: '.swiper-pagination',
      //   type: 'bullets',
      // }

    });

    clinicsWrapper.on('resize', function(){
      this.update();
    });

    // var $images = $('[data-bg-image]');
    // $images.each(i => {
    //   $($images[i]).css('background', `url(${$($images[i]).attr('data-bg-image')})`);
    // });

    // var $diagonalNavTotal = $('.total_slides');
    
    // $diagonalNavTotal.each(i => {
    //   // console.log(i);
    //   var $gallery = $($diagonalNavTotal[i]).closest('.swiper_container');
    //   var totalSlides = $gallery.find('.swiper-slide').length;
    //   if (totalSlides > 9) {
    //     $($diagonalNavTotal[i]).text(totalSlides);
    //   } else {
    //     $($diagonalNavTotal[i]).text('0' + totalSlides);
    //   }
    // });

    // $('.swiper-button-next._diagonal_navigation').on('click', e => {
    //   var currentSlideNumber = $(e.target).siblings('.current_slide').html();
    //   // console.log(currentSlideNumber);

    //   if (currentSlideNumber > 8) {
    //     $(e.target).siblings('.current_slide').html(+currentSlideNumber + 1);
        
    //   } else {
    //     $(e.target).siblings('.current_slide').html('0' + (+currentSlideNumber + 1));
    //   }
    // });

    $('.clinic_description_wrapper .read_more').on('click', function (e) {
      $(this).siblings('p').addClass('_active');
      $(this).addClass('_hidden');
    })

    $($('.moscow_clinics .clinic_card_wrapper')[0]).addClass('_active');
    $('.clinic_info .clinic_name').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('title'));
    $('.clinic_info .clinic_on_map').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('map'));
    $('.clinic_info .address_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('address'));
    $('.clinic_info .phone_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('phone'));
    $('.clinic_info .work_hours_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-hours'));


    $('.clinics_cotnainer .cities').on('click', function (e) {
      var $target = $(e.target);

      if ($target.hasClass('city')) {
        $('.city').removeClass('_active');
        $target.addClass('_active');
      }

      if ($target.hasClass('moscow')) {
        $('.moscow_clinics').removeClass('_hidden');
        $('.geneva_clinics').addClass('_hidden');

        $('.clinic_card_wrapper').removeClass('_active');
        $($('.moscow_clinics .clinic_card_wrapper')[0]).addClass('_active');
        $('.clinic_info .clinic_name').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('title'));
        $('.clinic_info .clinic_on_map').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('map'));
        $('.clinic_info .address_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('address'));
        $('.clinic_info .phone_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('phone'));
        $('.clinic_info .work_hours_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-hours'));    

      } else if ($target.hasClass('geneva')){
        $('.geneva_clinics').removeClass('_hidden');
        $('.moscow_clinics').addClass('_hidden');

        $('.clinic_card_wrapper').removeClass('_active');
        $($('.geneva_clinics .clinic_card_wrapper')[0]).addClass('_active');
        $('.clinic_info .clinic_name').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('title'));
        $('.clinic_info .clinic_on_map').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('map'));
        $('.clinic_info .address_content').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('address'));
        $('.clinic_info .phone_content').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('phone'));
        $('.clinic_info .work_hours_content').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('opening-hours'));
    
      }
    });

    $('.clinics_cotnainer .clinics_wrapper').on('click', function (e) {
      var $target = $(e.target).closest('.clinic_card_wrapper');
      // console.log($target.hasClass('clinic_card_wrapper'));

      if ($target.length !== 0){
        $('.clinic_card_wrapper').removeClass('_active');
        $target.addClass('_active');
  
        $('.clinic_info .clinic_name').html($target.data('title'));
        $('.clinic_info .clinic_on_map').html($target.data('map'));
        $('.clinic_info .address_content').html($target.data('address'));
        $('.clinic_info .phone_content').html($target.data('phone'));
        $('.clinic_info .work_hours_content').html($target.data('opening-hours'));
      }
    });
  }
}