'use strict';

export default class PageRating{

  constructor(){
    this.init();
  }

  
  init(){
    var isVoted = false;
    var newVote = null;

    // настройка закрашивания звёзд
    var currentRatingString = ($('.stars_wrapper').data('rating') * 26) + 'px';
    $('.stars_full').css('width', currentRatingString);

    $('.content_block.rating_container .star_label').on('click', function(e) {
      newVote = $(this).data('value');
      if (newVote !== null && !isVoted) {
        isVoted = true;
        // console.log($('[data-type="page_rating"]').data('serviceId'));

        var data = {
          'vote': newVote,
          'service_id': $('[data-type="page_rating"]').data('serviceId'),
        }

        $.ajax({
          type: 'get',
          url: '/dent/ajax-save-new-vote/',
          data: data,
          success: function(response) {
            response = $.parseJSON(response);
            // console.log(response);

            currentRatingString = (response.rating * 26) + 'px';
            $('.stars_full').css('width', currentRatingString);
            $('.votes_stars_value').html(`${response.votes} голосов, ${(response.rating).toFixed(1)} из 5`);
          },
          error: function(response) {

          }
        });
      }
    });


  }

}