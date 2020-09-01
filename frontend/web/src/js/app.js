'use strict';

import $ from 'jquery';

import Main from './components/main';
import Index from './components/index';
import ServiceListing from './components/serviceListing';
import DoctorsListing from './components/doctorsListing';
import MedSpecialities from './components/medSpecialities';
import DoctorPage from './components/doctorPage';
import ServicePage from './components/servicePage';
import Contacts from './components/contacts';
import ClinicContacts from './components/clinicContacts';
import YaMapContacts from './components/yaMapContacts';
import MedSpecFilter from './widgets/medSpecFilter';
import FullReviewPopup from './widgets/fullReviewPopup';
import Faq from './widgets/faq';
import Ratings from './widgets/ratings';

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

			if ($('[data-page-type="contacts"]').length > 0) {
	    	var contacts = new Contacts();
			}

			if ($('[data-page-type="clinic_contacts"]').length > 0) {
	    	var clinicContacts = new ClinicContacts();
			}

			if ($('[data-spec-filter]').length > 0) {
	    	var medSpecFilter = new MedSpecFilter($('[data-spec-filter]'));
			}

			if ($('.content_block.doctor_reviews').length > 0) {
	    	var fullReviewPopup = new FullReviewPopup();
			}

			if ($('[data-type="faq"]').length > 0) {
	    	var faq = new Faq();
			}

			if ($('[data-type="ratings"]').length > 0) {
	    	var ratings = new Ratings();
			}

			if ($('.map').length > 0) {
				if(($('[data-page-type="contacts"]').length > 0)) {
					var map = new YaMapContacts();	
				}
			}
			
  	});
})($);