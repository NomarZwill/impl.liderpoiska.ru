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
        // $('.service_dropdown_menu_wrapper').addClass('_active');
      } else if ( getScrollWidth() >= 768) {
        console.log("body");
        $('.service_dropdown_menu_wrapper').removeClass('_active');
        close_inner_active_blocks();
      };
    });

    $('.category_wrapper').on('click', function(e){
      if ($(e.target).hasClass('category_item_wrapper') || $(e.target).parent('.category_item_wrapper').length !== 0) {
        close_inner_active_blocks();
        $(e.target).closest('.category_item_wrapper').addClass('_active');
        $(e.target).closest('.category_item_wrapper').find('.listing_first_level.level_container').removeClass('_hidden');
        updateMobileMenu();
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
      }

      $(e.target).toggleClass('_active');
      $(this).siblings('.listing_second_level').toggleClass('_active');
      updateMobileMenu();
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
      updateMobileMenu();
    });

    function close_inner_active_blocks(){
      if (getScrollWidth() >= 768) {
        $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').removeClass('_active');
        $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').find('.listing_first_level.level_container').addClass('_hidden');
        $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').find('.arrow._active').removeClass('_active');
        $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').find('.level_wrapper._active').removeClass('_active');
      }
    };


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

    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );
    };

    var $mobileActiveBlockDisplayWrapper = $('[data-page-type="header_dropdown_menu"] .mobile_active_block_display_wrapper');

    function getMobileDisplayChildrenValue(){
      return $mobileActiveBlockDisplayWrapper.children().length;
    };

    function getMenuCurrentActiveBlock(){
      if ($('[data-page-type="header_dropdown_menu"] .listing_third_level._active').length !== 0) {
        return $('[data-page-type="header_dropdown_menu"] .listing_third_level._active');

      } else if ($('[data-page-type="header_dropdown_menu"] .listing_second_level._active').length !== 0) {
        return $('[data-page-type="header_dropdown_menu"] .listing_second_level._active');

      } else if ($('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').length !== 0) {
        return $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active .listing_first_level.level_container');
      } else {
        return null;
      }
    }

    function refreshActiveLevelInMobileMenu(){
      $mobileActiveBlockDisplayWrapper.children().each(function(i) {
        $(this).removeClass('_hidden');
        if ((i + 1) !== getMobileDisplayChildrenValue()) {
          $(this).addClass('_hidden');
        } else {
          $(this).find('._active').removeClass('_active');
        }
      });
    }

    function updateMobileMenu(){
      console.log('updateMobileMenu()');
      if (getScrollWidth() < 768) {
        var $menuCurrentActiveBlock = getMenuCurrentActiveBlock();
        
        if ($menuCurrentActiveBlock !== null) {
          $mobileActiveBlockDisplayWrapper.append($menuCurrentActiveBlock.clone(true, true));
          $mobileActiveBlockDisplayWrapper.addClass('_active');
          refreshActiveLevelInMobileMenu();
        } else {
          $mobileActiveBlockDisplayWrapper.empty();
          $mobileActiveBlockDisplayWrapper.removeClass('_active');
        }
      }
    };

    $('.back_button_wrapper button').on('click', function(e){
      
      switch(getMobileDisplayChildrenValue()) {
        case 0:
          $('.service_dropdown_menu_wrapper').removeClass('_active');
          break;
        case 1:
          $mobileActiveBlockDisplayWrapper.children('.listing_first_level').remove();
          refreshActiveLevelInMobileMenu();
          $('.category_item_wrapper .listing_first_level.level_container').addClass('_hidden');
          $('.category_item_wrapper').removeClass('_active');
          break;
        case 2:
          $mobileActiveBlockDisplayWrapper.children('.listing_second_level').remove();
          refreshActiveLevelInMobileMenu();
          break;
        case 3:
          $mobileActiveBlockDisplayWrapper.children('.listing_third_level').remove();
          refreshActiveLevelInMobileMenu();
          break;
        default:
          console.log('default');
      }
    });

  }
}