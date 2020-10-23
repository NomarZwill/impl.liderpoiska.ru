'use strict';

export default class MedSpecFilter{

  constructor($container){
    this.$container = $container;
    this.init();
  }

  init(){
    var self = this;

    // self.$container.on('click', function(e){
    //   var $button = $(e.target).closest('.medical_speciality');
    //   var specID = $button.data('id');
    //   if ($button.length > 0) {
    //     $(this).find('.medical_speciality').removeClass('_active');
    //     $button.addClass('_active');
        
    //     var data = {
    //       'spec_id' : specID
    //     }

    //     $.ajax({
    //       type: 'get',
    //       url: '/specialists/ajax-med-spec-filter/',
    //       data: data,
    //       success: function(response) {
    //         response = $.parseJSON(response);
    //         console.log(response);
    //         self.$container.siblings('.doctors_wrapper').html(response.listing);
    //         self.isTooManyCard();
    //       },
    //       error: function(response) {

    //       }
    //     });
    //   }
    // });

    var $buttonMore = self.$container.siblings('.more_doctors');
    var specID = self.$container.find('.medical_speciality._active').data('id');
    var currentCardCount = null;
    var data = null;
    var pageYPos = null;

    var getMoreCard = function(){
      currentCardCount = $(this).siblings('.doctors_wrapper').find('.doctor_item_wrapper').length;
      data = {
        'spec_id': specID,
        'currentCardCount': currentCardCount,
        'cardLimit': self.getLoadingCardLimit()
      }

      // console.log(specID);
      // console.log(currentCardCount);
      // console.log(self.getLoadingCardLimit());

      $.ajax({
        type: 'get',
        url: '/specialists/ajax-more-card',
        data: data,
        success: function(response) {
          response = $.parseJSON(response);
          pageYPos = window.pageYOffset;
          if (specID === 0) {
            self.$container.siblings('.doctors_wrapper').append(response.listing);
          } else {
            self.$container.siblings('.doctors_wrapper').find('.swiper-wrapper').append(response.listing);
          }
          window.scrollTo(0, pageYPos);
          // console.log(response.isListEnd);
          if (response.isListEnd) {
            $buttonMore.addClass('_hidden');
          } else {
            $('.doctors_wrapper .doctor_item_wrapper').last().remove();
          }
        },
        error: function(response) {

        }
      });
    }

    $buttonMore.on('click', getMoreCard);

    getMoreCard();
  }


  isTooManyCard(){
    if (this.$container.siblings('.doctors_wrapper').find('.doctor_item_wrapper').length < 20) {
      this.$container.closest('.content_block.doctors_container').find('.more_doctors').addClass('_hidden');
    } else {
      this.$container.closest('.content_block.doctors_container').find('.more_doctors').removeClass('_hidden');
    }
  }

  getLoadingCardLimit(){
    var screenWidth = Math.max(
      document.body.scrollWidth, document.documentElement.scrollWidth,
      document.body.offsetWidth, document.documentElement.offsetWidth,
      document.body.clientWidth, document.documentElement.clientWidth
    );

    if ($('.doctors_wrapper .swiper-wrapper').length === 0) {

      if (screenWidth > 1440) {
        return 21;
      } else if (screenWidth >= 768) {
        return 13;
      } else {
        return 5;
      }
    } else {

      if (screenWidth > 1440) {
        return 9;
      } else if (screenWidth >= 768) {
        return 7;
      } else {
        return 1000; // изменить, если вдруг импл станет совсем огромным.
      }
    }
  }

}