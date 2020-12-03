"use strict";

export default class YaMapClinicContacts{
	constructor(){
    let self = this;
    var fired = false;

    window.addEventListener('click', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});
 
    window.addEventListener('scroll', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});

    window.addEventListener('mousemove', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});

    window.addEventListener('touchmove', () => {
        if (fired === false) {
            fired = true;
            load_other();
      }
    }, {passive: true});

    setTimeout(() => {
      if (fired === false) {
            fired = true;
            load_other();
      }
    }, 5000);

    function load_other() {
        self.init();
    }
	}

  script(url) {
    if (Array.isArray(url)) {
      let self = this;
      let prom = [];
      url.forEach(function (item) {
        prom.push(self.script(item));
      });
      return Promise.all(prom);
    }

    return new Promise(function (resolve, reject) {
      let r = false;
      let t = document.getElementsByTagName('script')[0];
      let s = document.createElement('script');

      s.type = 'text/javascript';
      s.src = url;
      s.async = true;
      s.onload = s.onreadystatechange = function () {
        if (!r && (!this.readyState || this.readyState === 'complete')) {
          r = true;
          resolve(this);
        }
      };
      s.onerror = s.onabort = reject;
      t.parentNode.insertBefore(s, t);
    });
  }

  init() {
    var clinicCoordinates = [
      $('.clinic_map').data('latitude'),
      $('.clinic_map').data('longitude')
    ];
    this.script('//api-maps.yandex.ru/2.1/?lang=ru_RU').then(() => {
      const ymaps = global.ymaps;
      ymaps.ready(function(){
  			var map = document.querySelector(".map");
        var myMap = new ymaps.Map(map, {
          center: clinicCoordinates,
          zoom: 17
        });

        var clinic = new ymaps.Placemark(clinicCoordinates, {
          balloonContent: $('.clinic_map').data('clinic-address')
        }, {
          iconLayout: 'default#image',
          iconImageHref: '/img/map_location_pin_active.svg',
          iconImageSize: [40, 50],
          iconImageOffset: [0, -25],
          hideIconOnBalloonOpen: false,
          balloonOffset: [20, 25]
        });

        myMap.geoObjects.add(clinic);
      });
    });
  }
}
