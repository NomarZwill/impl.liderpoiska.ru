'use strict';

export default class ServiceListing{
  constructor(){
    this.init();
  }

  init(){
    var $firstLevelItems = $('.listing_first_level_item');

    $firstLevelItems.each( function(i){
      if ($($firstLevelItems[i]).find('.listing_second_level_item').length > 0){
        $($firstLevelItems[i]).addClass('with_children');
      }
    });

    $('.listing_first_level_item.with_children p').on('click', function(e){
      $(e.target).toggleClass('_active');
      $(this).siblings('.listing_second_level').toggleClass('_active');
    });

    var $secondLevelItems = $('.listing_second_level_item');

    $secondLevelItems.each( function(i){
      if ($($secondLevelItems[i]).find('.listing_third_level_item').length > 0){
        $($secondLevelItems[i]).addClass('with_children');
      }
    });

    $('.listing_second_level_item.with_children p').on('click', function(e){
      $(e.target).toggleClass('_active');
      $(this).siblings('.listing_third_level').toggleClass('_active');
    });
  }
}