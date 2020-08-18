'use strict';

import $ from 'jquery';

import Main from './components/main';
import Index from './components/index';
import ServiceListing from './components/serviceListing';
import DoctorsListing from './components/doctorsListing';
import MedSpecFilter from './widgets/medSpecFilter';
import MedSpecialities from './components/medSpecialities';
import DoctorPage from './components/doctorPage';
import ServicePage from './components/servicePage';

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

			if ($('[data-page-type="service_page"]').length > 0) {
	    	var servicePage = new ServicePage();
			}

			if ($('[data-page-type="specialists"]').length > 0) {
	    	var serviceListing = new DoctorsListing();
			}

			if ($('[data-page-type="speciality"]').length > 0) {
	    	var medSpecialities = new MedSpecialities();
			}

			if ($('[data-page-type="doctor_page"]').length > 0) {
	    	var doctorPage = new DoctorPage();
			}

			if ($('[data-spec-filter]').length > 0) {
	    	var medSpecFilter = new MedSpecFilter($('[data-spec-filter]'));
			}
			
  	});
})($);