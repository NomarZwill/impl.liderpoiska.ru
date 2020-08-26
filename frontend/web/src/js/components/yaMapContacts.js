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
      var myBalloonLayout = ymaps.templateLayoutFactory.createClass(
				`<div class="balloon_layout _item_on_map">
          $[[options.contentLayout]]
      </div>`,
        {
          build: function() {
            this.constructor.superclass.build.call(this);
  
            this._$element = $('.balloon_layout', this.getParentElement());
  
            this._$element.find('.close').on('click', $.proxy(this.onCloseClick, this));
  
          },
  
          clear: function () {
            this._$element.find('.close').off('click');
  
            this.constructor.superclass.clear.call(this);
          },
  
          onCloseClick: function (e) {
            e.preventDefault();
  
            this.events.fire('userclose');
          },
  
          getShape: function () {
            if(!this._isElement(this._$element)) {
              return myBalloonLayout.superclass.getShape.call(this);
            }
  
            var position = this._$element.position();
  
            return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
              [position.left, position.top], [
                position.left + this._$element[0].offsetWidth,
                position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight
              ]
            ]));
          },
  
          _isElement: function (element) {
            return element && element[0] && element.find('.arrow')[0];
          }
      });
      
      var myBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
       `<div class="arrow"></div>
        <div class="balloon_inner">

          <div class="balloon_inner_header">

            <p>${$("#map").attr("data-name")}</p>

          </div>

          <div class="balloon_inner_body">

            <table>

              <tr>
                  <td class="room_attribute">Вместимость</td>
                  <td>${$("#map").attr("data-capacity")} чел.</td>
              </tr>

              <tr>
                  <td class="room_attribute">Стоимость</td>
                  <td>${$("#map").attr("data-price")} руб./чел.</td>
              </tr>

              <tr>
                  <td class="room_attribute">Вместимость на фуршет</td>
                  <td>${$("#map").attr("data-capacity-reception")} чел.</td>
              </tr>
              
              <tr>
                  <td class="room_attribute">Минимальная стоимость на банкет</td>
                  <td>${$("#map").attr("data-min-cost")} руб.</td>
              </tr>

            </table>

            <button class="_button view_item">Посмотреть площадку</button>

          </div>
					</div>`
      );

      var objectManager = new ymaps.ObjectManager(
				{
					geoObjectBalloonLayout: myBalloonLayout, 
					geoObjectBalloonContentLayout: myBalloonContentLayout,
					geoObjectHideIconOnBalloonOpen: false,
					geoObjectBalloonOffset: [-172, -190],
          // geoObjectIconColor: "green",
          geoObjectIconLayout: 'default#image',
          geoObjectIconImageHref: '/img/map_location_pin.svg',
          geoObjectIconImageSize: [40, 50],
				}
			);

        testData(objectCoordinates);

        objectManager.add(testData(objectCoordinates));  
					myMap.geoObjects.add(objectManager);
					myMap.setBounds(objectManager.getBounds());
      
    });
  }

}

function testData(coord){
  var json = {
    "type":"FeatureCollection",
    "features": [
      {
      "type":"Feature",
      "id":1,
      "geometry":{
        "type":"Point",
        "coordinates":[55.68898994531468, 37.53087438129808]
      },
      "properties":{
        "balloonContent":"",
        "organization":"",
        "address":"",
        "img":"",
        "clusterCaption":""
      }},
      {
        "type":"Feature",
        "id":2,
        "geometry":{
          "type":"Point",
          "coordinates":[55.76962471773339,37.64742815525393]
        },
        "properties":{
          "balloonContent":"",
          "organization":"",
          "address":"",
          "img":"",
          "clusterCaption":""
      }},
      {
        "type":"Feature",
        "id":3,
        "geometry":{
          "type":"Point",
          "coordinates":[55.73956406899468,37.63740699999995]
        },
        "properties":{
          "balloonContent":"",
          "organization":"",
          "address":"",
          "img":"",
          "clusterCaption":""
      }},
      {
        "type":"Feature",
        "id":4,
        "geometry":{
          "type":"Point",
          "coordinates":[55.76642535339749,37.64430649999999]
        },
        "properties":{
          "balloonContent":"",
          "organization":"",
          "address":"",
          "img":"",
          "clusterCaption":""
      }}]
  }

  return json;
}