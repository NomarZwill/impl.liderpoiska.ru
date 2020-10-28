'use strict';

import Swiper, { Navigation, Pagination } from 'swiper';

export default class FaqPage{

  constructor(){
  	Swiper.use([Navigation, Pagination]);
    this.init();
  }

  init(){
    var doctorsWrapper  = new Swiper('.doctors_wrapper', {
      slidesPerView: "auto",
      spaceBetween: 24,
      watchOverflow: true,
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

    function setFaqInteractive(){
      var $answerBlock = $(this).closest('.faq_item_wrapper').find('.item_answer');

      if (!$answerBlock.hasClass('_collapse')) {
        $(this).removeClass('_close');
        $answerBlock.addClass('_collapse');
      } else {
        $(this).addClass('_close');
        $answerBlock.removeClass('_collapse');
      }
    }

    $('.content_block.faq_container').on('click', function(e){
      var $target = $(e.target);
      if ($target.hasClass('more_faq_button')) {
          // console.log($('.content_block.faq_container .faq_item_wrapper').length);

        var data = {
          'previousFaqCount': $('.content_block.faq_container .faq_item_wrapper').length
        }
      
        $.ajax({
          type: 'get',
          url:'/other/ajax-get-more-faq',
          data: data,
          success: function(response) {
            response = $.parseJSON(response);
            // console.log(response);
            $('.content_block.faq_container').append(response.listing);
            $('.more_faq_button').appendTo($('.content_block.faq_container'));
            var $allFaqArrow = $('[data-type="faq"] .arrow');
            $allFaqArrow.each(function(i, item){
              if ($allFaqArrow.length - i < 6) {
                $(item).on('click', setFaqInteractive);
              }
            });
            if (response.isListEnd) {
              $('.more_faq_button').remove();
            }
          },
          error: function(response) {
          }
        });
      }
    });

    $('[data-page-type="faq_form"] .close_icon_mobile').on('click', function(e) {
      $(this).closest('.faq_form_successful_send').addClass('_hidden');
    });
  }
}