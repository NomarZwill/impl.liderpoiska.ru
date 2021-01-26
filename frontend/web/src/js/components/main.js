'use strict';

import flatpickr from "flatpickr";
import { Russian } from "flatpickr/dist/l10n/ru.js";

export default class Main{

  constructor(){
    this.init();
  }

  init(){
    var $firstLevelItems = $('[data-page-type="header_dropdown_menu"] .listing_first_level_item');
    var $secondLevelItems = $('[data-page-type="header_dropdown_menu"] .listing_second_level_item');
    var $mobileActiveBlockDisplayWrapper = $('[data-page-type="header_dropdown_menu"] .mobile_active_block_display_wrapper');
    var $categoryWrapper = $('[data-page-type="header_dropdown_menu"] .category_wrapper');

    function openDropdownMenu() {
      $('body').addClass('_popup_mode');
      $('.header_navbar_wrapper').addClass('_active');
      $('.service_dropdown_menu_wrapper').addClass('_active');
      $('.burger_img').addClass('_active');

      if (getScrollWidth() >= 768) {
        $($('[data-page-type="header_dropdown_menu"] .category_item_wrapper')[0]).addClass('_active');
        $($('[data-page-type="header_dropdown_menu"] .category_item_wrapper')[0]).find('.listing_first_level.level_container').removeClass('_hidden');
      } else {
        $('[data-page-type="header_dropdown_menu"] .category_wrapper').append($('.mobile_mini_footer'));

      }
    }

    function closeDropdownMenu() {
      if ($('.popup_filter_bg._active').length === 0) {
        $('body').removeClass('_popup_mode');
      }
      $('.header_navbar_wrapper').removeClass('_active');
      $('.service_dropdown_menu_wrapper').removeClass('_active');
      $('.burger_img').removeClass('_active');
      $('.service_dropdown_menu_wrapper ._active').removeClass('_active');
      $('.service_dropdown_menu_wrapper .listing_first_level.level_container').addClass('_hidden');
      $('.service_dropdown_menu_wrapper .category_item_wrapper').removeClass('_hidden');
      $('.service_dropdown_menu_wrapper .category_item_wrapper').removeClass('_hidden');
      $('.about_dropdown_menu_background').addClass('_hidden');
      $('[data-page-type="header_dropdown_menu"] .mobile_active_block_display_wrapper').empty();

      if (getScrollWidth() < 768) {
        $('.header_navbar_wrapper').append($('.mobile_mini_footer'));
      }
    }

    function closeLayoutPopup(){
      console.log('closeLayoutPopup')
      $('.layout_popup').addClass('_hidden');

      if ($('.layout_popup .reception_form_wrapper').length !== 0) {
        $('.layout_popup .reception_form_wrapper')
        .appendTo('.reception_form_container');
        $('.reception_form_wrapper .current_select').html($('.reception_form_wrapper .current_select').data('default'));
        $('.reception_form_wrapper .clinic_item_input')[0].checked = true;
        $('.reception_form_wrapper form').removeClass('_hidden');
        $('.reception_form_wrapper .reception_form_successful_send').addClass('_hidden');

      } else if($('.layout_popup .review_form_wrapper').length !== 0) {
        $('.layout_popup .review_form_wrapper')
        .appendTo('.review_form_container');
        $('.review_form_wrapper form').removeClass('_hidden');
        $('.review_form_wrapper .review_form_successful_send').addClass('_hidden');

      }  else if ($('.layout_popup .recall_form_wrapper').length !== 0) {
        $('.layout_popup .recall_form_wrapper [data-success]').addClass('_hidden');
        $('.layout_popup .recall_form_wrapper form').removeClass('_hidden');
        $('.layout_popup .recall_form_wrapper')
        .appendTo('.popup_button_wrapper.recall_form_popup .recall_form_container');

      } else if ($('.popup_filter_bg').length !== 0) {
        $('.popup_filter_bg._active').removeClass('_active');
        $('.popup_filter_bg ._active').removeClass('_active');
        $('.popup_filter_bg .popup_gallery_container').addClass('_hidden');
        $('.popup_lizcenz_wrapper').addClass('_hidden');
      }

      $('.layout_popup .scroll_wrapper').empty();
      $('body').removeClass('_popup_mode');
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
        $('body').addClass('_popup_mode');
      }
    });

    $('body').on('click', function(e){
      if ($(e.target).closest('.header_navbar_wrapper').length === 0 
       && $(e.target).closest('.burger_wrapper').length === 0
       && $(e.target).closest('.popup_button_wrapper.recall_form_popup').length === 0
       && $(e.target).closest('.layout_popup .scroll_wrapper').length === 0
       && $(e.target).closest('.contacts_mob_icon').length === 0
       && $(e.target).closest('.reception_button').length === 0
       && $(e.target).closest('.review_item_wrapper .read_more').length === 0
       && $(e.target).closest('.doctor_work_wrapper').length === 0
       && $(e.target).closest('.popup_gallery_container').length === 0
       && $(e.target).closest('.lizcenz_wrapper').length === 0
       && $(e.target).closest('.popup_lizcenz_wrapper').length === 0
       && $(e.target).closest('.about_dropdown_menu_background').length === 0
       && $(e.target).closest('.welcome_word_button').length === 0
       && $(e.target).closest('.welcome_word_full_wrapper').length === 0
       && $(e.target).closest('.review_popup_button').length === 0) {
        closeDropdownMenu();
        closeLayoutPopup();
      }
    });

    function updateCategoryBlockHeight(){
      $('[data-page-type="header_dropdown_menu"] .listing_first_level.level_container').each(function(){
        if (!$(this).hasClass('_hidden')) {
          if (this.offsetHeight > $categoryWrapper[0].offsetHeight) {
            $categoryWrapper[0].style.cssText = 'height: ' + this.offsetHeight + 'px;';
          } else {
            $categoryWrapper[0].style.cssText = 'height: auto;';
          }
        }
      });
    }

    $('.category_wrapper').on('click', function(e){
      if ($(e.target).hasClass('category_item_wrapper') || $(e.target).parent('.category_item_wrapper').length !== 0) {
        close_inner_active_blocks();
        $(e.target).closest('.category_item_wrapper').addClass('_active');
        $(e.target).closest('.category_item_wrapper').find('.listing_first_level.level_container').removeClass('_hidden');
        updateMobileMenu();
        updateCategoryBlockHeight();
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
        updateCategoryBlockHeight();
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
      updateCategoryBlockHeight();
    });

    function close_inner_active_blocks(){
      if (getScrollWidth() >= 768) {
        $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').find('._active').removeClass('_active');
        $('[data-page-type="header_dropdown_menu"] .category_item_wrapper._active').removeClass('_active');
        $('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').find('.listing_first_level.level_container').addClass('_hidden');
      }
    };

    //------- popup recall form --------

    $('.popup_button_wrapper.recall_form_popup form .close_icon')
    .add('.popup_button_wrapper.recall_form_popup form .close_icon_mobile')
    .add('.reception_form_wrapper .close_icon')
    .add('.reception_form_wrapper .close_icon_mobile')
    .add('.review_form_wrapper .close_icon')
    .add('.review_form_wrapper .close_icon_mobile')
    .add('.recall_form_successful_send .close_icon')
    .add('.recall_form_successful_send .close_icon_mobile')
    .on('click', function(e){
      closeLayoutPopup();
    });

    $('.content_block.recall_wrapper .recall_form_successful_send .close_icon')
    .add('.content_block.recall_wrapper .recall_form_successful_send .close_icon_mobile') 
    .on('click', function(e){
      $(this).closest('.recall_form_successful_send').addClass('_hidden');
    });

    $('.recall_form_popup')
    .add('.contacts_mob_icon')
    .on('click', function(e){
      closeDropdownMenu();
      $('.popup_button_wrapper.recall_form_popup')
        .find('.recall_form_wrapper')
        .appendTo('.layout_popup .scroll_wrapper');
      $('.layout_popup').removeClass('_hidden');
      $('.layout_popup .recall_form_wrapper').removeClass('_hidden');
      $('body').addClass('_popup_mode');
    });

    //------- popup reception form -------
    $('.reception_button').on('click', function(e){
      closeDropdownMenu();
      $('.reception_form_container')
        .find('.reception_form_wrapper')
        .appendTo('.layout_popup .scroll_wrapper');
      $('.layout_popup').removeClass('_hidden');
      $('body').addClass('_popup_mode');
    });

    var calendarWrapper = document.querySelector('input[name="date"]');
    flatpickr(calendarWrapper, {
      "locale": Russian,
      dateFormat: "d.m.Y",
      disableMobile: "true",
    });

    var selectClinic = document.querySelector('.input_clinic_wrapper');
    var selectClinicCurrent = selectClinic.querySelector('.current_select');
    var selectClinicLabels = selectClinic.querySelectorAll('.clinic_item_label');

    // Toggle menu
    selectClinicCurrent.addEventListener('click', () => {
      if ('active' === selectClinic.getAttribute('data-state')) {
        selectClinic.setAttribute('data-state', '');
      } else {
        selectClinic.setAttribute('data-state', 'active');
      }
    });

    // Close when click to option
    for (var i = 0; i < selectClinicLabels.length; i++) {
      selectClinicLabels[i].addEventListener('click', (e) => {
        selectClinicCurrent.textContent = e.target.textContent;
        selectClinic.setAttribute('data-state', '');
      });
    }

    $('.reception_form_wrapper').on('click', function(e){
      if ($(e.target).closest('.input_clinic_wrapper').length === 0) {
        selectClinic.setAttribute('data-state', '');
      }
    });

    //------- popup review form -------

    $('.content_block.review_form_wrapper .review_form_successful_send._in_content_block .close_icon')
    .add('.content_block.review_form_wrapper .review_form_successful_send._in_content_block .close_icon_mobile') 
    .on('click', function(e){
      $(this).closest('.review_form_successful_send').addClass('_hidden');
    });

    $('.review_popup_button').on('click', function(e){
      closeDropdownMenu();
      $('.review_form_container')
        .find('.review_form_wrapper')
        .appendTo('.layout_popup .scroll_wrapper');
      $('.layout_popup').removeClass('_hidden');
      $('body').addClass('_popup_mode');
    });

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
          $('.header_navbar_wrapper').append($('.mobile_mini_footer'));
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

      if (getScrollWidth() < 768) {

        if ($('[data-page-type="header_dropdown_menu"] .category_wrapper .category_item_wrapper').hasClass('_active')) {
          closeDropdownMenu();
          openDropdownMenu();
        } else if (!$('.about_dropdown_menu_background').hasClass('_hidden')) {
          closeDropdownMenu();
        }

      } else if (getScrollWidth() >= 768 && getMobileDisplayChildrenValue() !== 0) {
        closeDropdownMenu();
        openDropdownMenu();
      }
    };

    window.addEventListener('resize', switchMobileMode, { passive: true });

    $('.navbar_item.about_dropdown_container').on('click', function(e){
      var $menu = $(this).find('.about_dropdown_menu_background');

      if (getScrollWidth() < 768
          && (
            $(e.target).hasClass('about_dropdown_container')
            || $(e.target).parent('.about_dropdown_container').length !== 0
            || $(e.target).closest('.about_back_button_wrapper').length !== 0
          ) 
        ){
        $('body').toggleClass('_popup_mode');
        $menu.toggleClass('_hidden');
      }
    });
  }
}