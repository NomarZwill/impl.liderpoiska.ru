'use strict';

export default class Faq{

  constructor(){
    this.init();
  }

  init(){
    var $firstBlock = $($('[data-type="faq"] .arrow')[0]);
    $firstBlock.addClass('_close');
    $firstBlock.closest('.faq_item_wrapper').find('.item_answer').removeClass('_collapse');

    function setFaqInteractive(){
      var $answerBlock = $(this).closest('.faq_item_wrapper').find('.item_answer');
      var $arrow = $(this).find('.arrow');

      if (!$answerBlock.hasClass('_collapse')) {
        $arrow.removeClass('_close');
        $answerBlock.addClass('_collapse');
      } else {
        $arrow.addClass('_close');
        $answerBlock.removeClass('_collapse');
      }
    }

   $('[data-type="faq"] .item_question').each(function(){
    $(this).on('click', setFaqInteractive);
   });

  }
}