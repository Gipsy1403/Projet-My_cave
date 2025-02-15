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


// attend que le contenu de toute la page soit téléchargé pour que le rappel soit exécuté
document.addEventListener('DOMContentLoaded', function() {
	// récupère l'élément HTML avec l'identifiant
	let acceptButton = document.getElementById('accept-cookies');
	// vérifie s'il existe
	if (acceptButton) {
		// si oui, au moment du clic de l'utilisateur
	    acceptButton.addEventListener('click', function() {
		// un cookie est créé (pdt 1an) lorsque l'utilisateur l'accepte
		   document.cookie = "cookie_consent=true; path=/; max-age=" + (60 * 60 * 24 * 365); 
		//    récupère la bannière d'information des cookies
		   var cookieBanner = document.getElementById('cookie-banner');
		//    vérifie si l'élément existe dans le DOM
		   if (cookieBanner) {
			// si oui,l'élément disparait de l'écran
			  cookieBanner.style.display = 'none';
		   }
	    });
	}
 });
 
