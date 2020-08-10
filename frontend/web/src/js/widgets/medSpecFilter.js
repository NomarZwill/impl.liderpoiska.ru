'use strict';

export default class MedSpecFilter{

  constructor($container){
    this.$container = $container;
    this.init();
  }

  init(){
    var self = this;

    self.$container.on('click', function(e){
      var $button = $(e.target).closest('.medical_speciality');
      var specID = $button.data('id');
      if ($button.length > 0) {
        $(this).find('.medical_speciality').removeClass('_active');
        $button.addClass('_active');

        var data = {
          'spec_id' : specID
        }

        $.ajax({
          type: 'get',
          url: '/specialists/ajax-med-spec-filter/',
          data: data,
          success: function(response) {
            response = $.parseJSON(response);
            console.log(response);
            self.$container.siblings('.doctors_wrapper').html(response.listing);
            self.isTooManyCard();
          },
          error: function(response) {

          }
        });
      }
    });

    var $buttonMore = self.$container.siblings('.more_doctors');

    $buttonMore.on('click', function(e){
      var specID = $(this).siblings('.medical_specialties_wrapper').find('.medical_speciality._active').data('id');
      var currentCardCount = $(this).siblings('.doctors_wrapper').find('.doctor_item_wrapper').length;
      var data = {
        'spec_id' : specID,
        'currentCardCount' : currentCardCount
      }

      $.ajax({
        type: 'get',
        url: '/specialists/ajax-more-card/',
        data: data,
        success: function(response) {
          response = $.parseJSON(response);
          console.log(response.isListEnd);
          console.log(response.doctors);
          self.$container.siblings('.doctors_wrapper').append(response.listing);
          if (response.isListEnd) {
            $buttonMore.addClass('_hidden');
          }
        },
        error: function(response) {

        }
      });
    });
    
  }

  isTooManyCard(){
    if (this.$container.siblings('.doctors_wrapper').find('.doctor_item_wrapper').length < 20) {
      this.$container.closest('.content_block.doctors_container').find('.more_doctors').addClass('_hidden');
    } else {
      this.$container.closest('.content_block.doctors_container').find('.more_doctors').removeClass('_hidden');
    }
  }

}