'use strict';

export default class Faq{

  constructor(){
    this.init();
  }

  init(){
    var $firstBlock = $($('[data-type="faq"] .arrow')[0]);
    $firstBlock.addClass('_close');
    $firstBlock.closest('.faq_item_wrapper').find('.item_answer').removeClass('_collapse');

   $('[data-type="faq"] .arrow').each(function(){
    $(this).on('click', function(e){
      var $answerBlock = $(this).closest('.faq_item_wrapper').find('.item_answer');

      if (!$answerBlock.hasClass('_collapse')) {
        $(this).removeClass('_close');
        $answerBlock.addClass('_collapse');
      } else {
        $(this).addClass('_close');
        $answerBlock.removeClass('_collapse');
      }
    });
   });

  }
}