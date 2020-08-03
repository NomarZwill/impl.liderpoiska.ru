'use strict';

import $ from 'jquery';

import Main from './components/main';
import ServiceListing from './components/serviceListing';

window.$ = $;

(function($) {
  	$(function() {
  		var main = new Main();

			if ($('[data-page-type="service_listing"]').length > 0) {
	    	var serviceListing = new ServiceListing($('[data-page-type="ServiceListing"]'));
			}
			
  	});
})($);