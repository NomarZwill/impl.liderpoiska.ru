'use strict';

export default class fullReviewPopup{

  constructor(){
    this.init();
  }

  init(){
    var $reviews = $(".review_item_wrapper");

    $reviews.each(function(i){
      var $review = $($reviews[i]);
      if ($review.height() > 300){
        
        $review.find('.review_text').addClass('_compact');
        $('.review_text .show_all').removeClass('_hidden');

        $review.find('.read_more').on('click', function(e){
          var reviewText = $(this).closest('.show_all').siblings('p').html(); 
          var reviewSignature = $(this).closest('.review_text').siblings('p').html()

          $('.popup_filter_bg .main_text').html(reviewText);
          $('.popup_filter_bg .signature').html(reviewSignature);
          $('.popup_filter_bg').addClass('_active');
          $('.popup_filter_bg .review_item_wrapper').removeClass('_hidden');

          $('body').css('overflow', 'hidden');
        });
      }  
    });

    $('.popup_filter_bg .review_item_wrapper').find('.close_icon').on('click', function(e){
      $(this).closest('.review_item_wrapper').addClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').css('overflow', 'auto');
    });

    $('.popup_filter_bg .review_item_wrapper').find('.popup_close_button').on('click', function(e){
      $(this).closest('.review_item_wrapper').addClass('_hidden');
      $('.popup_filter_bg').removeClass('_active');
      $('body').css('overflow', 'auto');
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