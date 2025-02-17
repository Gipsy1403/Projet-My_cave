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


// cookies
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


//  bouton scroll vers le haut de page

// sélection du bouton
const btnScroll=document.querySelector(".btn_scroll");
btnScroll.addEventListener("click",()=>{
// défilement de la page (top = jusqu'en haut, left = reste en position horizontal, smooth = fluidité de l'action)
      window.scrollTo({
            top:0,
            left: 0,
            behavior:"smooth",
      })
})
// lorsque l'utilisateur scroll, la fonction est détectée
window.onscroll=function(){
      toggleScrollTopButton();
};
function toggleScrollTopButton(){
	// selectionne la barre de navigation
      let navbar=document.querySelector("nav");
	//  sélectionne le bouton à nouveau
      let scrollTopButton=document.querySelector(".btn_scroll");
	//  Si la position de défilement est inférieure à la hauteur de la barre de navigation
      if(window.scrollY<navbar.offsetHeight){
		// bouton caché
            scrollTopButton.style.display="none";
      }else{
		// sinon est affiché
            scrollTopButton.style.display="block";
      }
}
 
