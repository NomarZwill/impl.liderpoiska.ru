"use strict";

export default class YaMapContacts{
	constructor(){
    this.init();
	}

  init() {

    ymaps.ready(function(){
			var map = document.querySelector(".map");
      var myMap = new ymaps.Map(
        map, 
        {center: [55.76, 37.64], zoom: 25, controls: []},
        {suppressMapOpenBlock: true}
      );

      var zoomControl = new ymaps.control.ZoomControl({
        options: {
            size: "small",
            position: {
              top: 10,
              right: 10
            }
        }
      });

      var geolocationControl = new ymaps.control.GeolocationControl({
        options: {
          noPlacemark: true,
          position: {
            top: 10,
            left: 10
          }
        }
      });

      myMap.controls.add(zoomControl);
      myMap.controls.add(geolocationControl);

      var objectCoordinates = [$("#map").attr("data-mapDotX"), $("#map").attr("data-mapDotY")];
      // var myBalloonLayout = ymaps.templateLayoutFactory.createClass(
			// 	`<div class="balloon_layout _item_on_map">
      //     <div class="close"></div>
      //     $[[options.contentLayout]]
      //     <div class="close _mobile_button">Закрыть</div>
      // </div>`,
      //   {
      //     build: function() {
      //       this.constructor.superclass.build.call(this);
  
      //       this._$element = $('.balloon_layout', this.getParentElement());
  
      //       this._$element.find('.close').on('click', $.proxy(this.onCloseClick, this));
  
      //     },
  
      //     clear: function () {
      //       this._$element.find('.close').off('click');
  
      //       this.constructor.superclass.clear.call(this);
      //     },
  
      //     onCloseClick: function (e) {
      //       e.preventDefault();
  
      //       this.events.fire('userclose');
      //     },
  
      //     getShape: function () {
      //       if(!this._isElement(this._$element)) {
      //         return myBalloonLayout.superclass.getShape.call(this);
      //       }
  
      //       var position = this._$element.position();
  
      //       return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
      //         [position.left, position.top], [
      //           position.left + this._$element[0].offsetWidth,
      //           position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight
      //         ]
      //       ]));
      //     },
  
      //     _isElement: function (element) {
      //       return element && element[0] && element.find('.arrow')[0];
      //     }
      // });
      
      // var myBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
      //  `<div class="balloon_inner" data-id={{properties.id}}>

      //     <div class="balloon_inner_header">

      //       <h4>{{properties.organization}}</h4>

      //     </div>

      //     <div class="balloon_inner_body">

      //       <p>
      //         <span class="title">Адрес:</span><br>
      //         <span class="address_content">{{properties.address | raw}}</span><br>
      //       </p>

      //       <p>
      //         <span class="title">Телефоны:</span><br>
      //         <span class="phone_content">{{properties.phone | raw}}</span><br>
      //       </p>
            
      //       <p>
      //         <span class="title">Время работы:</span><br>
      //         <span class="work_hours_content">{{properties.workHours | raw}}</span>
      //       </p>
            
      //     </div>

      //     <div class="balloon_inner_footer">

      //       <button class="popup_button _button">Записаться на приём</button>
      //       <a class="_button _button_light" href="/contacts/{{properties.alias}}">О клинике</a>

      //     </div>

			// 	</div>`
      // );

      var objectManager = new ymaps.ObjectManager(
				{
					// geoObjectBalloonLayout: myBalloonLayout, 
					// geoObjectBalloonContentLayout: myBalloonContentLayout,
					// geoObjectHideIconOnBalloonOpen: false,
					// geoObjectBalloonOffset: [-172, -190],
          // geoObjectIconColor: "green",
          geoObjectIconLayout: 'default#image',
          geoObjectIconImageHref: '/img/map_location_pin.svg',
          geoObjectIconImageSize: [40, 50],
          // geoObjectBalloonPane: 'outerBalloon',
          // geoObjectBalloonShadowPane: 'outerBalloon',
          // geoObjectBalloonAutoPan: false,
				}
      );
      
      var serverData = null;
      var activeObjectID = null;
			var serverResponse = fetch("/api/maps/")
				.then(function(response) {
					if (response.ok) { 
            var json = response.json();
						return json;
					} else {
            alert("Ошибка HTTP: " + response.status);
					}
				})
				.then(function(json) {
          serverData = json['geoObjects'];
					
					objectManager.add(serverData);  
          objectManager.objects.setObjectOptions(1, {iconImageHref: '/img/map_location_pin_active.svg'});
          activeObjectID = 1;
          setActivePinInfo(activeObjectID);
          myMap.geoObjects.add(objectManager);
					// console.log(`objectManager: ${objectManager.getBounds()}`);
          myMap.setBounds(getLocationBounds('moscow'));
        });

      objectManager.objects.events.add('click', function (e) {

        objectManager.objects.setObjectOptions(
          activeObjectID,
          {iconImageHref: '/img/map_location_pin.svg'}
        );

        objectManager.objects.setObjectOptions(
          e.get('objectId'),
          {iconImageHref: '/img/map_location_pin_active.svg'}
        );

        activeObjectID = e.get('objectId');
        setActivePinInfo(activeObjectID);
        myMap.setCenter(objectManager.objects._objectsById[activeObjectID].geometry.coordinates);
        $('.map_popup_container').removeClass('_hidden');
        if ($('.city.moscow._active').length !== 0) {
          myMap.setBounds(getLocationBounds('moscow'));
        } else {
          myMap.setBounds(getLocationBounds('geneva'));
        }
      });
        
      $('.content_block.clinic_on_map_container .cities').on('click', function(e) {
        var $el = $(e.target);
        
        if ($el.hasClass('moscow')) {
          myMap.setBounds(getLocationBounds('moscow'));

          objectManager.objects.setObjectOptions(1, {iconImageHref: '/img/map_location_pin_active.svg'});

          objectManager.objects.setObjectOptions(
            activeObjectID,
            {iconImageHref: '/img/map_location_pin.svg'}
          );
  
          activeObjectID = 1;
          setActivePinInfo(activeObjectID);
          
        } else if ($el.hasClass('geneva')) {
          myMap.setBounds(getLocationBounds('geneva'));

          objectManager.objects.setObjectOptions(5, {iconImageHref: '/img/map_location_pin_active.svg'});

          objectManager.objects.setObjectOptions(
            activeObjectID,
            {iconImageHref: '/img/map_location_pin.svg'}
          );
  
          activeObjectID = 5;
          setActivePinInfo(activeObjectID);
        }

        $('.city').removeClass('_active');
        $el.addClass('_active');
      });

    });

    function getLocationBounds(location) {
      if (location == 'moscow') {
        return [[55.68898994531468, 37.53087438129808], [55.76962471773339, 37.64742815525393]];
      } else if (location == 'geneva') {
        return [[46.2051745744813,6.138661499999997], [46.2071745744813,6.140661499999997]];
      } else{
        console.log('getLocationBounds error');
      }
    };

    function setActivePinInfo(clinicID) {
      var $currentClinicInfo = $(`.clinic_info_wrapper[data-id="${clinicID}"]`);

      if (getScrollWidth() > 1440) {
        var $mapInfoPane = $('.side_pane_wrapper');
      } else {
        var $mapInfoPane = $('.map_popup_container');
      }

      $mapInfoPane.find('h3').html($currentClinicInfo.data('name'));
      $mapInfoPane.find('.address_content').html($currentClinicInfo.data('address'));
      $mapInfoPane.find('.phone_content').html($currentClinicInfo.data('phones'));
      $mapInfoPane.find('.work_hours_content').html($currentClinicInfo.data('work-hours'));
      $mapInfoPane.find('.button_container ._button_light').prop('href', `/contacts/${$currentClinicInfo.data('alias')}`);
    }

    function getScrollWidth() {
      return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
      );
    };
  }
}
