"use strict";

export default class YaMapClinicContacts{
	constructor(){
    this.init();
	}

  init() {
    var clinicCoordinates = [
      $('.clinic_map').data('latitude'),
      $('.clinic_map').data('longitude')
    ];

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
  }
}
