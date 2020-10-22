'use strict';

export default class FullReviewPopup{

  constructor(maxHeightDesc, maxHeightPad, maxHeightMob){
    this.init(maxHeightDesc, maxHeightPad, maxHeightMob);
  }

  init(maxHeightDesc, maxHeightPad, maxHeightMob){
    var $reviews = $(".review_item_wrapper");

    function normalizeReviewHeight(){
      $reviews.each(function(i){
        var $review = $($reviews[i]);
        var $reviewText = $review.find('.review_text');
        
        if (getScrollWidth() > 1440) {

          if ($reviewText.height() > maxHeightDesc){
            addCompactForm($review, $reviewText);
          }  
        } else if (getScrollWidth() >= 768) {

          if ($reviewText.height() > maxHeightPad){
            addCompactForm($review, $reviewText);
          }
        } else {

          if ($reviewText.height() > maxHeightMob){
            addCompactForm($review, $reviewText);
          }
        }
      });
    }

    function addCompactForm($review, $reviewText){
      $reviewText.addClass('_compact');
      $reviewText.find('.show_all').removeClass('_hidden');

      $review.find('.read_more').on('click', function(e){
        var reviewText = $reviewText.html(); 

        $('.popup_filter_bg .review_text').html(reviewText);
        $('.popup_filter_bg').addClass('_active');
        $('.popup_filter_bg .review_item_wrapper').removeClass('_hidden');

        $('body').addClass('_popup_mode');
        // console.log('fullReviewPopup');
      });
    }

    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );
    };

    window.addEventListener('resize', normalizeReviewHeight, { passive: true });
    normalizeReviewHeight();

    $('.popup_filter_bg .review_item_wrapper').find('.close_icon').on('click', function(e){
      $(this).closest('.review_item_wrapper').addClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').removeClass('_popup_mode');
    });

    $('.popup_filter_bg .scroll_block').on('click', function(e){
      if ($(e.target).hasClass('scroll_block')) {
        $(this).find('.review_item_wrapper').addClass('_hidden');
        $('.popup_filter_bg').removeClass('_active');
        $('.scroll_block > *').removeClass('_active');
        $('body').removeClass('_popup_mode');
      }
    });

    $('.popup_filter_bg .review_item_wrapper').find('.popup_close_button').on('click', function(e){
      $(this).closest('.review_item_wrapper').addClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').removeClass('_popup_mode');
    });

    if ($('.doctor_education_content').height() > 600){
      $('.doctor_education_content').addClass('_compact');
      $('.doctor_education_content .show_all').removeClass('_hidden');
      $('.content_block.doctor_education .read_more').on('click', function(e){
        $(this).closest('.doctor_education_content').removeClass('_compact');
      });
    }

  }
}