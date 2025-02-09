// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';
import './styles/app.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

document.addEventListener('DOMContentLoaded', function() {
	let acceptButton = document.getElementById('accept-cookies');
	if (acceptButton) {
	    acceptButton.addEventListener('click', function() {
		   document.cookie = "cookie_consent=true; path=/; max-age=" + (60 * 60 * 24 * 365); // Expire dans 1 an
		   var cookieBanner = document.getElementById('cookie-banner');
		   if (cookieBanner) {
			  cookieBanner.style.display = 'none';
		   }
	    });
	}
 });
 
