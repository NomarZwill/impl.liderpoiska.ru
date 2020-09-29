'use strict';

export default class Main{

  constructor(){
    this.init();
  }

  init(){

    $('body').on('click', function(e){
      if ($(e.target).hasClass('service_dropdown_menu_container')) {
        $('.service_dropdown_menu_wrapper').toggleClass('_active');
      } else if ($(e.target).closest('.close_dropdown_menu').length !== 0) {
        $('.service_dropdown_menu_wrapper').removeClass('_active');
        close_inner_active_blocks();
      } else if ($(e.target).parents('.service_dropdown_menu_container').length !== 0) {
        $('.service_dropdown_menu_wrapper').addClass('_active');
      } else {
        $('.service_dropdown_menu_wrapper').removeClass('_active');
        close_inner_active_blocks();
      };
    });

    $('.category_wrapper').on('click', function(e){
      if ($(e.target).hasClass('category_item_wrapper') || $(e.target).parent('.category_item_wrapper').length !== 0) {
        close_inner_active_blocks();
        $(e.target).closest('.category_item_wrapper').addClass('_active');
        $(e.target).closest('.category_item_wrapper').find('.listing_first_level.level_container').removeClass('_hidden');
      }
    });

    var $firstLevelItems = $('[data-page-type="header_dropdown_menu"] .listing_first_level_item');

    $firstLevelItems.each( function(i){
      if ($($firstLevelItems[i]).find('.listing_second_level_item').length > 0){
        $($firstLevelItems[i]).addClass('with_children');
      }
    });

    $('[data-page-type="header_dropdown_menu"] .listing_first_level_item.with_children > p').on('click', function(e){
      if (!$(e.target).hasClass('_active')) {
        $(this).siblings('.listing_second_level').find('.arrow._active').removeClass('_active');
        $(this).siblings('.listing_second_level').find('.listing_third_level._active').removeClass('_active');
      } else {
        $(e.target).closest('.listing_block').find('.collapse_wrapper._short_list').addClass('_hidden');
      }

      if (!$(e.target).closest('.listing_block').find('.close_block').hasClass('_active')) {
        openBlock($(e.target).closest('.listing_block').find('.open_block')[0]);
      }

      $(e.target).toggleClass('_active');
      $(this).siblings('.listing_second_level').toggleClass('_active');

      if ($(e.target).closest('.listing_block').find('.collapse_wrapper._short_list').length !== 0
        && $(e.target).closest('.listing_block').find('.arrow._active').length === 0) {
        $(e.target).closest('.listing_block').find('.close_block').removeClass('_active');
        $(e.target).closest('.listing_block').find('.open_block').addClass('_active');
      }
    });

    var $secondLevelItems = $('[data-page-type="header_dropdown_menu"] .listing_second_level_item');

    $secondLevelItems.each( function(i){
      if ($($secondLevelItems[i]).find('.listing_third_level_item').length > 0){
        $($secondLevelItems[i]).addClass('with_children');
      }
    });

    $('[data-page-type="header_dropdown_menu"] .listing_second_level_item.with_children > p').on('click', function(e){
      $(e.target).toggleClass('_active');
      $(this).siblings('.listing_third_level').toggleClass('_active');
    });

    function openBlock(el){
      $(el).closest('.collapse_wrapper').removeClass('_hidden');
      $(el).toggleClass('_active');
      $(el).siblings('.close_block').toggleClass('_active');
    };

    function close_inner_active_blocks(){
      $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').removeClass('_active');
      $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').find('.listing_first_level.level_container').addClass('_hidden');
      $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').find('.arrow._active').removeClass('_active');
      $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').find('.level_wrapper._active').removeClass('_active');
    }


    //------- for mobile --------

    $('.burger_img').on('click', function(e){
      if (!$(this).hasClass('_active')) {
        $(this).addClass('_active');
        $('.header_navbar_wrapper').addClass('_active');
      } else {
        $(this).removeClass('_active');
        $('.header_navbar_wrapper').removeClass('_active');
      }
    });
  }
}