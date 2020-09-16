'use strict';

export default class ServiceListing{
  constructor(){
    this.init();
  }

  init(){
    var $listing_wrapper = $('.content_block.listing_wrapper');
    var $firstLevelItems = $('.listing_first_level_item');

    $firstLevelItems.each( function(i){
      if ($($firstLevelItems[i]).find('.listing_second_level_item').length > 0){
        $($firstLevelItems[i]).addClass('with_children');
      }
    });

    $('.listing_first_level_item.with_children > p').on('click', function(e){
      if (!$(e.target).hasClass('_active')) {
        $(this).siblings('.listing_second_level').find('.arrow._active').removeClass('_active');
        $(this).siblings('.listing_second_level').find('.listing_third_level._active').removeClass('_active');

      }

      if (!$(e.target).closest('.listing_block').find('.close_block').hasClass('_active')) {
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

    $('.listing_second_level_item.with_children > p').on('click', function(e){
      $(e.target).toggleClass('_active');
      $(this).siblings('.listing_third_level').toggleClass('_active');
    });

    
    var $firstLevelBlocks = $('.listing_block > .listing_first_level');
    
    
    $('.open_block').on('click', function(e){
      openBlock(e.target);
    });
    
    $('.close_block').on('click', function(e){
      $(e.target).toggleClass('_active');
      $(e.target).siblings('.open_block').toggleClass('_active');
      var $innerBlock = $(e.target).closest('.collapse_wrapper').siblings('.listing_first_level')
      // $innerBlock.addClass('_long');
      minimizeLongList($innerBlock);
      $innerBlock.find('.listing_first_level_item.with_children p').removeClass('_active');
      $innerBlock.find('.listing_second_level').removeClass('_active');
      $innerBlock.find('.listing_second_level_item.with_children p').removeClass('_active');
      $innerBlock.find('.listing_third_level').removeClass('_active');
    });
    
    
    function openBlock(el){
      $(el).toggleClass('_active');
      $(el).siblings('.close_block').toggleClass('_active');
      // $(el).closest('.collapse_wrapper').siblings('.listing_first_level').removeClass('_long');
      expandLongList($(el).closest('.collapse_wrapper').siblings('.listing_first_level'));
    };
    
    function isLongList(el){
      if (el.offsetHeight > 116) {
        return true;
      } else {
        return false;
      }
    };
    
    function minimizeLongList($el){
      
      if (getScrollWidth() < 768) {
        $el.find('.listing_first_level_item').each(function (i, el) {
          if (i > 2) {
            $(el).addClass('_hidden');
          }
        });
      }
    };
    
    function expandLongList($el){
      $el.find('.listing_first_level_item').removeClass('_hidden');
    };
    
    function normalizeLongList(){
      if (getScrollWidth() < 768 && !$listing_wrapper.hasClass('_is_mobile_view')) {
        $listing_wrapper.addClass('_is_mobile_view');
        $firstLevelBlocks.each( function(i){
          
          if (isLongList($firstLevelBlocks[i])) {
            minimizeLongList($($firstLevelBlocks[i]));
            $($firstLevelBlocks[i]).siblings('.collapse_wrapper').removeClass('_hidden');
          } else {
            $($firstLevelBlocks[i]).siblings('.collapse_wrapper').addClass('_hidden');
          }
        });
        
      } else if (getScrollWidth() >= 768 && $listing_wrapper.hasClass('_is_mobile_view')) {
        $listing_wrapper.removeClass('_is_mobile_view');
        $firstLevelBlocks.each( function(i){
          expandLongList($($firstLevelBlocks[i]));
          $($firstLevelBlocks[i]).siblings('.collapse_wrapper').addClass('_hidden');
          
        });
      };
    };
    
    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
        );
      };
      
      window.addEventListener('resize', normalizeLongList, { passive: true });
      normalizeLongList();
    }
  }