'use strict';

export default class Prices{

  constructor(){
    this.init();
  }
  
  init(){

    (function(){
      var slidingMenu = document.querySelector('.content_block.menu_container');
      var menuWrapper = null;
      var P = 32;

      window.addEventListener('scroll', Ascroll, false);
      document.body.addEventListener('scroll', Ascroll, false);

      function Ascroll() {
        if (menuWrapper == null) {
          var Sa = getComputedStyle(slidingMenu, '');
          var s = '';

          for (var i = 0; i < Sa.length; i++) {

            if (Sa[i].indexOf('overflow') == 0
              || Sa[i].indexOf('padding') == 0
              || Sa[i].indexOf('border') == 0
              || Sa[i].indexOf('outline') == 0
              || Sa[i].indexOf('box-shadow') == 0
              || Sa[i].indexOf('background') == 0
            ){
              s += Sa[i] + ': ' +Sa.getPropertyValue(Sa[i]) + '; '
            }
          }

          menuWrapper = document.createElement('div');
          menuWrapper.style.cssText = s + ' box-sizing: border-box; width: ' + slidingMenu.offsetWidth + 'px;';
          slidingMenu.insertBefore(menuWrapper, slidingMenu.firstChild);
          var l = slidingMenu.childNodes.length;

          for (var i = 1; i < l; i++) {
            menuWrapper.appendChild(slidingMenu.childNodes[1]);
          }

          slidingMenu.style.height = menuWrapper.getBoundingClientRect().height + 'px';
          slidingMenu.style.padding = '0';
          slidingMenu.style.border = '0';
          slidingMenu.style.background = 'none';
        }

        var Ra = slidingMenu.getBoundingClientRect();
        var R = Math.round(Ra.top + menuWrapper.getBoundingClientRect().height - document.querySelector('.content_block.service_block_container._last_block').getBoundingClientRect().bottom);

        if ((Ra.top - P) <= 0) {
          if ((Ra.top - P) <= R) {
            menuWrapper.className = 'stop';
            menuWrapper.style.top = - R +'px';
          } else {
            menuWrapper.className = 'sticky';
            menuWrapper.style.top = P + 'px';
          }
        } else {
          menuWrapper.className = '';
          menuWrapper.style.top = '';
        }

        window.addEventListener('resize', function() {
          slidingMenu.children[0].style.width = getComputedStyle(slidingMenu, '').width
        }, false);
      }
    })();

    $('.collapse_wrapper').on('click', function(e) {
      var $currentTarget = $(e.target)

      if ($currentTarget.hasClass('open_block')) {
        $currentTarget.closest('.content_block.service_block_container').find('.service_block_wrapper').addClass('_active');
        $currentTarget.addClass('_hidden');
        $currentTarget.siblings('.close_block').removeClass('_hidden');
      } else if ($currentTarget.hasClass('close_block')) {
        $currentTarget.closest('.content_block.service_block_container').find('.service_block_wrapper').removeClass('_active');
        $currentTarget.addClass('_hidden');
        $currentTarget.siblings('.open_block').removeClass('_hidden');
      }
    });
  }
}