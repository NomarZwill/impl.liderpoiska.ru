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
      slidesPerGroup: 1,
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


    var clinicDescriptionGalleryContainer  = new Swiper('.clinic_description_gallery', {
      slidesPerView: 1,
      // spaceBetween: 24,
      watchOverflow: true,
      slidesPerGroup: 1,
      on : {
        init: function() {
          if (this.slides.length < 10) {
            this.$el.find('.total_slides').html('0' + this.slides.length);
          } else {
            this.$el.find('.total_slides').html(this.slides.length);
          }
        },

        slideChange: function() {
          if (this.activeIndex < 9) {
            this.$el.find('.current_slide').html('0' + (this.activeIndex + 1));
          } else {
            this.$el.find('.current_slide').html(this.activeIndex + 1);
          }
        }
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
    });

    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
      slidesPerView: "auto",
      spaceBetween: 24,
      watchOverflow: true,
      slidesPerGroup: 1,
      preloadImages: false,
      lazy: true,
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

    var reviewsWrapper  = new Swiper('.reviews_wrapper', {
      slidesPerView: 1,
      spaceBetween: 4,
      watchOverflow: true,
      slidesPerGroup: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      on : {
        init: function() {
          if (this.slides.length < 10) {
            this.$el.find('.total_slides').html('0' + this.slides.length);
          } else {
            this.$el.find('.total_slides').html(this.slides.length);
          }
        },

        slideChange: function() {
          if (this.activeIndex < 9) {
            this.$el.find('.current_slide').html('0' + (this.activeIndex + 1));
          } else {
            this.$el.find('.current_slide').html(this.activeIndex + 1);
          }
        }
      },
    });

    var clinicsWrapper  = new Swiper('.moscow_clinics', {
      slidesPerView: "auto",
      spaceBetween: 24,
      slidesPerGroup: 1,
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

    clinicsWrapper.on('resize', function(){
      this.update();
    });

    $('.clinic_description_wrapper .read_more').on('click', function (e) {
      $(this).siblings('p').addClass('_active');
      $(this).addClass('_hidden');
    })

    $($('.moscow_clinics .clinic_card_wrapper')[0]).addClass('_active');
    $('.clinic_info .clinic_name').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('title'));
    let mapPromise = new Promise((resolve, reject) => {
      setTimeout(() => {
        // переведёт промис в состояние fulfilled с результатом "result"
        $('.clinic_info .clinic_on_map').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('map'));
      }, 3000);
    });    
    $('.clinic_info .address_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('address'));
    $('.clinic_info .phone_content').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('phone'));
    $('.clinic_info .work_hours_content._weekdays').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-weekdays'));
    $('.clinic_info .work_hours_content._sat').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-sat'));
    $('.clinic_info .work_hours_content._sun').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-sun'));
    updateClinicRating($($('.moscow_clinics .clinic_card_wrapper')[0]));
    
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
        $('.clinic_info .work_hours_content._weekdays').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-weekdays'));
        $('.clinic_info .work_hours_content._sat').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-sat'));
        $('.clinic_info .work_hours_content._sun').html($($('.moscow_clinics .clinic_card_wrapper')[0]).data('opening-sun'));   
        updateClinicRating($($('.moscow_clinics .clinic_card_wrapper')[0]));

      } else if ($target.hasClass('geneva')){
        $('.geneva_clinics').removeClass('_hidden');
        $('.moscow_clinics').addClass('_hidden');

        $('.clinic_card_wrapper').removeClass('_active');
        $($('.geneva_clinics .clinic_card_wrapper')[0]).addClass('_active');
        $('.clinic_info .clinic_name').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('title'));
        $('.clinic_info .clinic_on_map').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('map'));
        $('.clinic_info .address_content').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('address'));
        $('.clinic_info .phone_content').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('phone'));
        $('.clinic_info .work_hours_content._weekdays').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('opening-weekdays'));
        $('.clinic_info .work_hours_content._sat').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('opening-sat'));
        $('.clinic_info .work_hours_content._sun').html($($('.geneva_clinics .clinic_card_wrapper')[0]).data('opening-sun'));
        updateClinicRating($($('.geneva_clinics .clinic_card_wrapper')[0]));
      }
    });

    var $activeClinicRatingWrapper = $('.clinic_info .clinic_ratings_wrapper');

    function updateClinicRating($target) {
      var data = {
        'clinic_id': $target.data('id'),
      }

      $.ajax({
        type: 'get',
        url: '/ajax-clinic-rating/',
        data: data,
        success: function(response) {
          response = $.parseJSON(response);
          // console.log(response.rating);
          $activeClinicRatingWrapper.html(response.rating);
          var ratingsContainer  = new Swiper('.ratings_container', {
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
      
          // настройка закрашивания звёзд
          var currentRatingString = null;
          $('.ratings_container .stars').each(function(i, obj){
            currentRatingString = ($(obj).data('rating') * 20 - 1) + 'px';
            $(obj).css('width', currentRatingString);
          });
        },
        error: function(response) {

        }
      });
    }

    $('.clinics_cotnainer .clinics_wrapper').on('click', function (e) {
      var $target = $(e.target).closest('.clinic_card_wrapper');

      if ($target.length !== 0){
        $('.clinic_card_wrapper').removeClass('_active');
        $target.addClass('_active');
  
        $('.clinic_info .clinic_name').html($target.data('title'));
        $('.clinic_info .clinic_on_map').html($target.data('map'));
        $('.clinic_info .address_content').html($target.data('address'));
        $('.clinic_info .phone_content').html($target.data('phone'));
        $('.clinic_info .work_hours_content._weekdays').html($target.data('opening-weekdays'));
        $('.clinic_info .work_hours_content._sat').html($target.data('opening-sat'));
        $('.clinic_info .work_hours_content._sun').html($target.data('opening-sun'));

        updateClinicRating($target);
      }
    });
  }
}