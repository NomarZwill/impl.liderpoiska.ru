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
      if (!$(e.target).hasClass('_active')) {
        openBlock($(e.target).closest('.listing_block').find('.open_block')[0]);
      }

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

    var $firstLevekBlocks = $('.listing_first_level');

    $firstLevekBlocks.each( function(i){
      if (isLongList($firstLevekBlocks[i])) {
        $($firstLevekBlocks[i]).addClass('_long');
      } else {
        $($firstLevekBlocks[i]).siblings('.collapse_wrapper').addClass('_hidden');
      }
    });

    $('.open_block').on('click', function(e){
      openBlock(e.target);
    });

    $('.close_block').on('click', function(e){
      $(e.target).toggleClass('_active');
      $(e.target).siblings('.open_block').toggleClass('_active');
      var $innerBlock = $(e.target).closest('.collapse_wrapper').siblings('.listing_first_level')
      $innerBlock.addClass('_long');
      $innerBlock.find('.listing_first_level_item.with_children p').removeClass('_active');
      $innerBlock.find('.listing_second_level').removeClass('_active');
      $innerBlock.find('.listing_second_level_item.with_children p').removeClass('_active');
      $innerBlock.find('.listing_third_level').removeClass('_active');
    });

    
    function openBlock(el){
      $(el).toggleClass('_active');
      $(el).siblings('.close_block').toggleClass('_active');
      $(el).closest('.collapse_wrapper').siblings('.listing_first_level').removeClass('_long');
    };

    function isLongList(el){
      if (el.offsetHeight > 116) {
        return true;
      } else {
        return false;
      }
    }
  }
}