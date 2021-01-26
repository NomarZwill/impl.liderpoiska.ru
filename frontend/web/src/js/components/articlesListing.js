'use strict';

export default class ArticlesListing{

  constructor(){
    this.init();
  }

  init(){

    var getMoreArticles = function(e){
      var $listingWrapper = $('.content_block.article_listing_container .listing_wrapper');
      var data = {
        'previousArticleCount': $listingWrapper.find('.article_listing_item').length
      }
    
      $.ajax({
        type: 'get',
        url:'/articles/ajax-get-more-articles',
        data: data,
        success: function(response) {
          response = $.parseJSON(response);
          // console.log(response);
          $listingWrapper.append(response.listing);
          $('.more_article_button').appendTo($listingWrapper);

          if (response.isListEnd) {
            $('.more_article_button').remove();
          }
        },
        error: function(response) {
        }
      });
    }

    $('.content_block.article_listing_container').on('click', function(e){
      var $target = $(e.target);
      
      if ($target.hasClass('more_article_button')) {
        getMoreArticles();
      }
    });

    getMoreArticles();
  }
}