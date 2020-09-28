'use strict';

export default class Main{

  constructor(){
    this.init();
  }

  init(){

    $('body').on('click', function(e){
      if ($(e.target).hasClass('service_dropdown_menu_container')) {
        $('.service_dropdown_menu_wrapper').toggleClass('_active');
      } else if ($(e.target).parents('.service_dropdown_menu_container').length !== 0) {
        $('.service_dropdown_menu_wrapper').addClass('_active');
      } else {
        $('.service_dropdown_menu_wrapper').removeClass('_active');
      };
    });


    $('.category_wrapper').on('click', function(e){
      if ($(e.target).hasClass('category_item_wrapper') || $(e.target).parent('.category_item_wrapper').length !== 0) {
        $(e.target).closest('.category_item_wrapper').find('.listing_first_level.level_container').removeClass('_hidden');
      }
    });

  }
}