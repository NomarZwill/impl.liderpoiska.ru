'use strict';

export default class ReviewsPage{

  constructor(){
    this.init();
  }
  
  init(){
    var activeYear = $('[data-type="reviews_block"] .reviews_wrapper').data('activeYear');
    $('.years_wrapper').find(`[data-year=${activeYear}]`).addClass('_active');

    $('.years_wrapper').on('click', function(e){
      var $target = $(e.target);
      if ($target.closest('.year_item_wrapper._active').length === 0
        && $target.closest('.year_item_wrapper').length !== 0) {
        $('.year_item_wrapper._active').removeClass('_active');
        $target.closest('.year_item_wrapper').addClass('_active');

        var data = {
          'activeYear' : $target.closest('.year_item_wrapper').data('year')
        }
      
        $.ajax({
          type: 'get',
          url:'/other/ajax-reviews-single-year',
          data: data,
          success: function(response) {
            response = $.parseJSON(response);
            // console.log(response);
            $('.years_selector span').html(data.activeYear);
            $('.reviews_wrapper').html(response.listing);
            $('.reviews_wrapper')[0].dataset.activeYear = data.activeYear;
            normalizeReviewHeight();
          },
          error: function(response) {
          }
        });
      }

      if ($(this).hasClass('_active')) {
        $(this).removeClass('_active');
        $(this).siblings('.years_selector').removeClass('_active');
      }
    });

    $('.years_selector').on('click', function(e){
      if (!$(this).hasClass('_active')) {
        $(this).addClass('_active');
        $(this).siblings('.years_wrapper').addClass('_active');
      } else {
        $(this).removeClass('_active');
        $(this).siblings('.years_wrapper').removeClass('_active');
      }
    });

    $('.reviews_wrapper').on('click', function(e){
      var $target = $(e.target);
      if ($target.hasClass('more_reviews_button')) {
            console.log(this.dataset.activeYear);
            console.log($('.reviews_wrapper .review_item_wrapper').length);

        var data = {
          'activeYear' : this.dataset.activeYear,
          'previousReviewCount': $('.reviews_wrapper .review_item_wrapper').length
        }
      
        $.ajax({
          type: 'get',
          url:'/other/ajax-get-more-reviews',
          data: data,
          success: function(response) {
            response = $.parseJSON(response);
            console.log(response);
            $('.more_reviews_button').remove();
            $('.reviews_wrapper').append(response.listing);
            normalizeReviewHeight();
            if (response.isListEnd) {
              $('.more_reviews_button').remove();
            }
          },
          error: function(response) {
          }
        });
      }
    });

    var $reviews = $(".review_item_wrapper");

    function addCompactForm($review, $reviewText){
      $reviewText.addClass('_compact');
      $reviewText.find('.show_all').removeClass('_hidden');

      $review.find('.read_more').on('click', function(e){
        $reviewText.removeClass('_compact');
        $reviewText.find('.show_all').addClass('_hidden');
      });
    }

    function normalizeReviewHeight(){
      $reviews = $(".review_item_wrapper");
      
      $reviews.each(function(i){
        var $review = $($reviews[i]);
        var $reviewText = $review.find('.review_text');
        
        if ($reviewText.height() > 500){
          addCompactForm($review, $reviewText);
        }  
      });
    }

    normalizeReviewHeight();
  }
}