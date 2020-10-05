'use strict';

export default class Main{

  constructor(){
    this.init();
  }

  init(){
    var $firstLevelItems = $('[data-page-type="header_dropdown_menu"] .listing_first_level_item');
    var $secondLevelItems = $('[data-page-type="header_dropdown_menu"] .listing_second_level_item');
    var $mobileActiveBlockDisplayWrapper = $('[data-page-type="header_dropdown_menu"] .mobile_active_block_display_wrapper');

    function openDropdownMenu() {
      $('.header_navbar_wrapper').addClass('_active');
      $('.service_dropdown_menu_wrapper').addClass('_active');
      $('.burger_img').addClass('_active');

      if (getScrollWidth >= 768) {
        $($('[data-page-type="header_dropdown_menu"] .category_item_wrapper')[0]).addClass('_active');
        $($('[data-page-type="header_dropdown_menu"] .category_item_wrapper')[0]).addClass('_active');
        $($('[data-page-type="header_dropdown_menu"] .category_item_wrapper')[0]).find('.listing_first_level.level_container').removeClass('_hidden');
      }
    }

    function closeDropdownMenu() {
      $('.header_navbar_wrapper').removeClass('_active');
      $('.service_dropdown_menu_wrapper').removeClass('_active');
      $('.burger_img').removeClass('_active');
      $('.service_dropdown_menu_wrapper ._active').removeClass('_active');
      $('.service_dropdown_menu_wrapper .listing_first_level.level_container').addClass('_hidden');
      $('.service_dropdown_menu_wrapper .category_item_wrapper').removeClass('_hidden');
      $('[data-page-type="header_dropdown_menu"] .mobile_active_block_display_wrapper').empty();
    }

    $('.service_dropdown_menu_container').on('click', function(e){
      if ($(e.target).hasClass('service_dropdown_menu_container')
      || $(e.target).is('.service_dropdown_menu_container > a')
      || $(e.target).closest('.close_dropdown_menu').length !== 0) {

        if ($('.service_dropdown_menu_wrapper').hasClass('_active')) {
          closeDropdownMenu();
        } else {
          openDropdownMenu();
        }
      }
    });

    $('.burger_img').on('click', function(e){
      if ($('.header_navbar_wrapper').hasClass('_active')) {
        closeDropdownMenu();
      } else {
        $('.header_navbar_wrapper').addClass('_active');
        $('.burger_img').addClass('_active');
      }
    });

    $('body').on('click', function(e){
      if ($(e.target).closest('.header_navbar_wrapper').length === 0 
       && $(e.target).closest('.burger_wrapper').length === 0) {
        console.log('body');
        closeDropdownMenu();
      }
    });

    $('.category_wrapper').on('click', function(e){
      if ($(e.target).hasClass('category_item_wrapper') || $(e.target).parent('.category_item_wrapper').length !== 0) {
        close_inner_active_blocks();
        $(e.target).closest('.category_item_wrapper').addClass('_active');
        $(e.target).closest('.category_item_wrapper').find('.listing_first_level.level_container').removeClass('_hidden');
        updateMobileMenu();
      }
    });

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
        $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').find('._active').removeClass('_active');
        $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').removeClass('_active');
        $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').find('.listing_first_level.level_container').addClass('_hidden');
      }
    };


    //------- for mobile --------

    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );
    };

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
      var $menuCurrentActiveBlock = getMenuCurrentActiveBlock();
      if (getScrollWidth() < 768){

        if ($menuCurrentActiveBlock !== null) {
          $mobileActiveBlockDisplayWrapper.append($menuCurrentActiveBlock.clone(true, true));
          $mobileActiveBlockDisplayWrapper.addClass('_active');
          refreshActiveLevelInMobileMenu();

          if (getMobileDisplayChildrenValue() !== 0) {
            $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').removeClass('_active');
            $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').addClass('_hidden');
          }

        } else if ($mobileActiveBlockDisplayWrapper.hasClass('_active')) {
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
          $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').removeClass('_hidden');
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
          console.log('close button error');
      }
    });

    var switchMobileMode = function(e) {

      if (getScrollWidth() < 768
       && $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').hasClass('_active')) {
        closeDropdownMenu();
        openDropdownMenu();

      } else if (getScrollWidth() >= 768 && getMobileDisplayChildrenValue() !== 0) {
        closeDropdownMenu();
        openDropdownMenu();
      }
    };

    window.addEventListener('resize', switchMobileMode, { passive: true });
  }
}