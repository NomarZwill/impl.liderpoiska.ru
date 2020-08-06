'use strict';

export default class MedSpecFilter{

  constructor($container){
    this.$container = $container;
    this.init();
  }

  init(){

    var self = this;

    this.$container.on('click', function(e){
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
            self.$container.siblings('.doctors_wrapper').html(response.listing);

            self.isTooManyCard();
          },
          error: function(response) {

          }
        });
      }
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