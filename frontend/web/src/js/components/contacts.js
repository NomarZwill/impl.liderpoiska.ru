'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class Contacts{

  constructor(){
    Swiper.use([Navigation, Pagination]);
    var self = this;
    this.swipers = [];
    
    $('.clinic_gallery').each(function(i, obj){
      var galleryContainer  = new Swiper(obj, {
        slidesPerView: 'auto',
        spaceBetween: 24,
        centeredSlides: true,
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

      self.swipers.push(galleryContainer);
    });

    $('.map_popup_container .close').on('click', function(e) {
      if (!$(this).closest('.map_popup_container').hasClass('_hidden')) {
        $(this).closest('.map_popup_container').addClass('_hidden');
      } else {
        $(this).closest('.map_popup_container').removeClass('_hidden');
      }
    });
  }
}
