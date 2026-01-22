/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';
import 'bootstrap';

import $ from 'jquery';
import Popper from '@popperjs/core';

import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';



// Maintenant, vous pouvez utiliser jQuery et Popper.js
$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        placement: 'right',
        container: 'body'
    });
});


function initializeOwlCarousel(selector, responsiveConfig, navTextConfig) {
    $(selector).owlCarousel({
        pullDrag: true,
        center: false,
        dots: false,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        margin: 25,
        nav: true,
        navText: navTextConfig,
        responsiveClass: true,
        responsive: responsiveConfig
    });

    $(selector).trigger('refresh.owl.carousel');
}

// Utilisation avec des configurations responsive différentes et des textes de navigation personnalisés
$(function() {
    initializeOwlCarousel(".owl-carousel-1", {
        0: { items: 1, dots: true },
        500: { items: 2, dots: true },
        700: { items: 3, dots: true },
        1000: { items: 4, dots: true },
        1200: { items: 5, dots: true },
        1300: { items: 6, dots: true },
        1800: { items: 7, dots: true }
    }, [
        '<img src="../../uploads/images/chevron-down-white.svg" alt="Left">',
        '<img src="../../uploads/images/chevron-up-white.svg" alt="Right">'
    ]);

    initializeOwlCarousel(".owl-carousel-2", {
        0: { items: 1, dots: true },
        700: { items: 2, dots: false },
        1100: { items: 3, dots: true }
    }, [
        '<img src="../../uploads/images/axh1.png" alt="Left">',
        '<img src="../../uploads/images/axh1.png" alt="Right">'
    ]);
});

const typedTextSpan = document.querySelector(".typed-text");
const cursorSpan = document.querySelector(".cursor");

let textArray = [
  ["CROISSANCE"],
  ["BUSINESS"],
  ["NOTORIÉTÉ"]
];

if (window.location.pathname.includes("/en")) {
  textArray = [
    ["GROWTH."],
    ["BUSINESS."],
    ["AWARENESS."]
  ];
}

const typingDelay = 100;
const erasingDelay = 100;
const newTextDelay = 3000; // pause après le texte complet

let textArrayIndex = 0; // quel “mot/phrase”
let lineIndex = 0;      // quelle ligne dans la phrase (0, 1, 2...)
let charIndex = 0;      // quel caractère dans la ligne

function render() {
  const lines = textArray[textArrayIndex];
  const html = lines
    .map((line, i) => {
      if (i < lineIndex) return line;             
      if (i === lineIndex) return line.substring(0, charIndex); 
      return "";      
    })
    .filter(Boolean)
    .join("<br>");

  typedTextSpan.innerHTML = html;
}

function type() {
  const lines = textArray[textArrayIndex];
  const currentLine = lines[lineIndex];

  if (charIndex < currentLine.length) {
    charIndex++;
    render();
    setTimeout(type, typingDelay);
    return;
  }

  // ligne terminée -> passer à la suivante si elle existe
  if (lineIndex < lines.length - 1) {
    lineIndex++;
    charIndex = 0;
    setTimeout(type, typingDelay);
    return;
  }

  // tout est terminé -> pause puis effacement
  setTimeout(erase, newTextDelay);
}

function erase() {
  const lines = textArray[textArrayIndex];

  if (charIndex > 0) {
    charIndex--;
    render();
    setTimeout(erase, erasingDelay);
    return;
  }

  // ligne vide -> revenir à la ligne précédente si elle existe
  if (lineIndex > 0) {
    lineIndex--;
    charIndex = lines[lineIndex].length;
    render();
    setTimeout(erase, erasingDelay);
    return;
  }

  // tout est effacé -> phrase suivante
  textArrayIndex = (textArrayIndex + 1) % textArray.length;
  lineIndex = 0;
  charIndex = 0;

  setTimeout(type, typingDelay + 500);
}

document.addEventListener("DOMContentLoaded", () => {
  if (textArray.length) setTimeout(type, 300);
});


// Changement de couleur du logo au défilement
window.addEventListener('scroll', function () {
    // Récupérer la position actuelle du défilement
    var scrollPosition = window.scrollY;

    // Récupérer la hauteur de la fenêtre de visualisation
    var viewportHeight = window.innerHeight;

    // Vérifier si la position actuelle du défilement est supérieure à 108% de la hauteur de la fenêtre de visualisation
    if ((scrollPosition > viewportHeight * 0.15) && (scrollPosition < viewportHeight * 0.94)) {

        document.querySelector('.logo_nav').style.backgroundColor = '#FFFFFF';
        document.querySelector('.logo_nav').style.boxShadow = 'rgba(149, 157, 165, 0.2) 0px 8px 24px';
        document.querySelector('.logo_nav .logo').style.filter = 'invert(100%)';

    } else if (scrollPosition > viewportHeight * 0.95) {

        // Changer l'image du logo en blanc
        document.querySelector('.logo_nav').style.backgroundColor = '#FFFFFF';
        document.querySelector('.logo_nav').style.boxShadow = 'rgba(149, 157, 165, 0.2) 0px 8px 24px';
        document.querySelector('.logo_nav .logo').style.filter = 'invert(100%)';

    } else {

        // Réinitialiser l'image du logo à son état original
        document.querySelector('.logo_nav').style.backgroundColor = 'transparent';
        document.querySelector('.logo_nav').style.boxShadow = 'none';
        document.querySelector('.logo_nav .logo').style.filter = '';
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(() => {
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show();
    }, 5000); // 5000 milliseconds = 5 seconds
});


// Concerne la page /croissance
// console.log(document.querySelector('.text-show'));
// function checkScreenSize() {

//     if (window.matchMedia('(max-width: 991px)').matches) {
//         // L'écran a une largeur inférieure à...
//         const div = document.querySelector('.text-show');
//         div.innerHTML = `<h2 class="texte-intro black">Ce n’est pas l’argent qui compte, mais la façon de le dépenser.</h2>
//         <p class="texte-intro black mt-1">Oubliez les sommes investies pour vous concentrer sur la croissance récoltée.</p>
//         <p class="texte-intro-p black mt-2">L’avantage, avec nos actions, c’est que vous pourrez toujours les juger sur la performance. Établir de manière transparente le coût d’un clic, d’un lead, d’une vente.</p>`;
//     } else {
//         // L'écran a une largeur supérieure à...
//         const div = document.querySelector('.text-show');
//         div.innerHTML = '';
//     }
// }

// window.addEventListener('DOMContentLoaded', checkScreenSize);
// window.addEventListener('resize', checkScreenSize);

// // FORMULAIRE
// // Récupérer le formulaire
// var form = document.getElementById('contact_form');

// if(form) {
//     // Ajouter un écouteur d'événements pour la soumission du formulaire
//     form.addEventListener('submit', function (event) {
    
//         // Vérifier que le captcha a été validé
//         if (grecaptcha.getResponse() === '') {
//             event.preventDefault();
//             alert('Veuillez valider le captcha.');
//             return;
//         }
    
//         // Si le captcha a été validé, continuer avec la soumission du formulaire...
    
//         // Empêcher le comportement de soumission par défaut
//         event.preventDefault();
    
//         // Envoyer le formulaire au serveur
//         var formData = new FormData(form);
    
//         // Récupérer la réponse du captcha
//         var captchaResponse = grecaptcha.getResponse();
    
//         // Ajouter la réponse du captcha à FormData
//         formData.append('g-recaptcha-response', captchaResponse);
    
//         var request = new XMLHttpRequest();
//         request.open('POST', form.action);
    
//         // Lorsque la requête est terminée
//         request.onload = function () {
    
//             // console.log(request);
    
//             if (request.status === 200) {
//                 // Afficher le pop-up de succès uniquement si la requête a réussi
//                 var successModal = new bootstrap.Modal(document.getElementById('successModal'));
//                 successModal.show();
    
//                 // Réinitialiser le formulaire (facultatif)
//                 form.reset();
//             } else {
//                 // Gérer les erreurs ou afficher un message d'erreur
//                 alert('Une erreur s\'est produite lors de l\'enregistrement des données.');
//             }
//         };
    
//         // Envoyer la requête avec les données du formulaire
//         request.send(formData);
//     });
// }


// COOKIES
// import 'cookieconsent/build/cookieconsent.min.css';
// import cookieconsent from 'cookieconsent';

// window.addEventListener("load", function () {
//     window.cookieconsent.initialise({
//         "palette": {
//             "popup": {
//                 "background": "#000"
//             },
//             "button": {
//                 "background": "#f1d600"
//             }
//         },
//         "position": "bottom-right",
//         "content": {
//             "message": "Ce site utilise des cookies pour vous garantir la meilleure expérience sur notre site.",
//             "dismiss": "Compris !",
//             "link": "En savoir plus"
//         }
//     });
// });
