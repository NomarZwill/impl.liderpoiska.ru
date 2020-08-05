'use strict';

import $ from 'jquery';

import Main from './components/main';
import Index from './components/index';
import ServiceListing from './components/serviceListing';
import DoctorsListing from './components/doctorsListing';

window.$ = $;

(function($) {
  	$(function() {
			var main = new Main();
			
			if ($('[data-page-type="index"]').length > 0) {
				var index = new Index();
			}

			if ($('[data-page-type="service_listing"]').length > 0) {
	    	var serviceListing = new ServiceListing($('[data-page-type="ServiceListing"]'));
			}

			if ($('[data-page-type="specialists"]').length > 0) {
	    	var serviceListing = new DoctorsListing();
			}
			
  	});
})($);