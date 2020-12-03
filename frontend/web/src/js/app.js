'use strict';

import $ from 'jquery';

import Main from './components/main';
import SeoLoad from './components/seoLoad';
import Index from './components/index';
import ServiceListing from './components/serviceListing';
import DoctorsListing from './components/doctorsListing';
import MedSpecialities from './components/medSpecialities';
import DoctorPage from './components/doctorPage';
import ServicePage from './components/servicePage';
import Contacts from './components/contacts';
import ClinicContacts from './components/clinicContacts';
import YaMapContacts from './components/yaMapContacts';
import YaMapClinicContacts from './components/yaMapClinicContacts';
import About from './components/about';
import Partners from './components/partners';
import Prices from './components/prices';
import ReviewsPage from './components/reviewsPage';
import FaqPage from './components/faqPage';
import Licenses from './components/licenses';
import Form from './components/form';
import MedSpecFilter from './widgets/medSpecFilter';
import FullReviewPopup from './widgets/fullReviewPopup';
import Faq from './widgets/faq';
import Ratings from './widgets/ratings';
import PageRating from './widgets/pageRating';
import InstagramGallery from './widgets/instagramGallery';

window.$ = $;

(function($) {
  	$(function() {
			var main = new Main();
			var seoLoad = new SeoLoad();
			
			if ($('[data-page-type="index"]').length > 0) {
				var index = new Index();
				var fullReviewPopup = new FullReviewPopup(393, 232, 300);
			}

			if ($('[data-page-type="service_listing"]').length > 0) {
	    	var serviceListing = new ServiceListing($('[data-page-type="ServiceListing"]'));
			}

			if ($('[data-page-type="service_page"]').length > 0) {
				var servicePage = new ServicePage();
				var fullReviewPopup = new FullReviewPopup(116, 116, 116);
			}

			if ($('[data-page-type="specialists"]').length > 0) {
				var serviceListing = new DoctorsListing();
				var fullReviewPopup = new FullReviewPopup(116, 116, 116);
			}

			if ($('[data-page-type="speciality"]').length > 0) {
				var medSpecialities = new MedSpecialities();
				var fullReviewPopup = new FullReviewPopup(116, 116, 116);
			}

			if ($('[data-page-type="doctor_page"]').length > 0) {
				var doctorPage = new DoctorPage();
				var fullReviewPopup = new FullReviewPopup(116, 116, 116);
			}

			if ($('[data-page-type="contacts"]').length > 0) {
				var contacts = new Contacts();
				var fullReviewPopup = new FullReviewPopup(116, 116, 116);
			}

			if ($('[data-page-type="clinic_contacts"]').length > 0) {
				var clinicContacts = new ClinicContacts();
				var fullReviewPopup = new FullReviewPopup(116, 116, 116);
			}

			if ($('[data-page-type="about"]').length > 0) {
	    	var about = new About();
			}

			if ($('[data-page-type="partners"]').length > 0) {
	    	var partners = new Partners();
			}

			if ($('[data-page-type="prices"]').length > 0) {
	    	var prices = new Prices();
			}

			if ($('[data-page-type="reviews_page"]').length > 0) {
	    	var reviewsPage = new ReviewsPage();
			}

			if ($('[data-page-type="faq_page"]').length > 0) {
	    	var faqPage = new FaqPage();
			}

			if ($('[data-page-type="licenses"]').length > 0) {
	    	var licenses = new Licenses();
			}

			if ($('[data-spec-filter]').length > 0) {
	    	var medSpecFilter = new MedSpecFilter($('[data-spec-filter]'));
			}

			if ($('.content_block.doctor_reviews').length > 0) {
	    	// var fullReviewPopup = new FullReviewPopup(116, 116, 116);
			}

			if ($('[data-type="faq"]').length > 0) {
	    	var faq = new Faq();
			}

			if ($('[data-type="ratings"]').length > 0) {
	    	var ratings = new Ratings();
			}

			if ($('[data-type="page_rating"]').length > 0) {
	    	var pageRating = new PageRating();
			}

			if ($('[data-type="instagram_block"]').length > 0) {
	    	var instagramGallery = new InstagramGallery();
			}

			if ($('.map').length > 0) {

				if(($('[data-page-type="contacts"]').length > 0)) {
					var map = new YaMapContacts();
				}

				if(($('[data-page-type="clinic_contacts"]').length > 0)) {
					var clinicOnMap = new YaMapClinicContacts();	
				}
			}

			var form = [];

			$('form').each(function(){
	    	form.push(new Form($(this)))
			});
						
  	});
})($);