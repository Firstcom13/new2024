"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/css/app.scss":
/*!*****************************!*\
  !*** ./assets/css/app.scss ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
/* harmony import */ var core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_timers_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.array.filter.js */ "./node_modules/core-js/modules/es.array.filter.js");
/* harmony import */ var core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../css/app.scss */ "./assets/css/app.scss");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var owl_carousel_dist_assets_owl_carousel_css__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! owl.carousel/dist/assets/owl.carousel.css */ "./node_modules/owl.carousel/dist/assets/owl.carousel.css");
/* harmony import */ var owl_carousel__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! owl.carousel */ "./node_modules/owl.carousel/dist/owl.carousel.js");
/* harmony import */ var owl_carousel__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(owl_carousel__WEBPACK_IMPORTED_MODULE_7__);



/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)







// Maintenant, vous pouvez utiliser jQuery et Popper.js
jquery__WEBPACK_IMPORTED_MODULE_5___default()(function () {
  jquery__WEBPACK_IMPORTED_MODULE_5___default()('[data-toggle="tooltip"]').tooltip({
    placement: 'right',
    container: 'body'
  });
});
function initializeOwlCarousel(selector, responsiveConfig, navTextConfig) {
  jquery__WEBPACK_IMPORTED_MODULE_5___default()(selector).owlCarousel({
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
  jquery__WEBPACK_IMPORTED_MODULE_5___default()(selector).trigger('refresh.owl.carousel');
}

// Utilisation avec des configurations responsive différentes et des textes de navigation personnalisés
jquery__WEBPACK_IMPORTED_MODULE_5___default()(function () {
  initializeOwlCarousel(".owl-carousel-1", {
    0: {
      items: 1,
      dots: true
    },
    500: {
      items: 2,
      dots: true
    },
    700: {
      items: 3,
      dots: true
    },
    1000: {
      items: 4,
      dots: true
    },
    1200: {
      items: 5,
      dots: true
    },
    1300: {
      items: 6,
      dots: true
    },
    1800: {
      items: 7,
      dots: true
    }
  }, ['<img src="../../uploads/images/chevron-down-white.svg" alt="Left">', '<img src="../../uploads/images/chevron-up-white.svg" alt="Right">']);
  initializeOwlCarousel(".owl-carousel-2", {
    0: {
      items: 1,
      dots: true
    },
    700: {
      items: 2,
      dots: false
    },
    1100: {
      items: 3,
      dots: true
    }
  }, ['<img src="../../uploads/images/axh1.png" alt="Left">', '<img src="../../uploads/images/axh1.png" alt="Right">']);
});
var typedTextSpan = document.querySelector(".typed-text");
var cursorSpan = document.querySelector(".cursor");
var textArray = ["CROISSANCE", "BUSINESS", "NOTORIÉTÉ"];
var typingDelay = 100;
var erasingDelay = 100;
var newTextDelay = 3000; // Delay between current and next text
var textArrayIndex = 0;
var charIndex = 0;
function type() {
  if (charIndex < textArray[textArrayIndex].length) {
    typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
    charIndex++;
    setTimeout(type, typingDelay);
  } else {
    setTimeout(erase, newTextDelay);
  }
}
function erase() {
  if (charIndex > 0) {
    typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex - 1);
    charIndex--;
    setTimeout(erase, erasingDelay);
  } else {
    textArrayIndex++;
    if (textArrayIndex >= textArray.length) textArrayIndex = 0;
    setTimeout(type, typingDelay + 1100);
  }
}
document.addEventListener("DOMContentLoaded", function () {
  // On DOM Load initiate the effect
  if (textArray.length) setTimeout(type, 300);
});

// Changement de couleur du logo au défilement
window.addEventListener('scroll', function () {
  // Récupérer la position actuelle du défilement
  var scrollPosition = window.scrollY;

  // Récupérer la hauteur de la fenêtre de visualisation
  var viewportHeight = window.innerHeight;

  // Vérifier si la position actuelle du défilement est supérieure à 108% de la hauteur de la fenêtre de visualisation
  if (scrollPosition > viewportHeight * 0.15 && scrollPosition < viewportHeight * 0.94) {
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
document.addEventListener('DOMContentLoaded', function (event) {
  setTimeout(function () {
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), {});
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

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_bootstrap_dist_js_bootstrap_esm_js-node_modules_core-js_modules_es_array-f1e482"], () => (__webpack_exec__("./assets/js/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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LEVBQUU7RUFDL0Q7QUFDSixDQUFDLENBQUM7QUFFRnpCLFFBQVEsQ0FBQ2dCLGdCQUFnQixDQUFDLGtCQUFrQixFQUFFLFVBQUNVLEtBQUssRUFBSztFQUNyRGIsVUFBVSxDQUFDLFlBQU07SUFDYixJQUFJYyxPQUFPLEdBQUcsSUFBSUMsU0FBUyxDQUFDQyxLQUFLLENBQUM3QixRQUFRLENBQUM4QixjQUFjLENBQUMsU0FBUyxDQUFDLEVBQUUsQ0FBQyxDQUFDLENBQUM7SUFDekVILE9BQU8sQ0FBQ0ksSUFBSSxDQUFDLENBQUM7RUFDbEIsQ0FBQyxFQUFFLElBQUksQ0FBQyxDQUFDLENBQUM7QUFDZCxDQUFDLENBQUM7O0FBR0Y7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUdBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5zY3NzPzc4NzQiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCIvKlxyXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXHJcbiAqXHJcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcclxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cclxuICovXHJcblxyXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXHJcbmltcG9ydCAnLi4vY3NzL2FwcC5zY3NzJztcclxuaW1wb3J0ICdib290c3RyYXAnO1xyXG5cclxuaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcclxuaW1wb3J0IFBvcHBlciBmcm9tICdAcG9wcGVyanMvY29yZSc7XHJcblxyXG5pbXBvcnQgJ293bC5jYXJvdXNlbC9kaXN0L2Fzc2V0cy9vd2wuY2Fyb3VzZWwuY3NzJztcclxuaW1wb3J0ICdvd2wuY2Fyb3VzZWwnO1xyXG5cclxuXHJcblxyXG4vLyBNYWludGVuYW50LCB2b3VzIHBvdXZleiB1dGlsaXNlciBqUXVlcnkgZXQgUG9wcGVyLmpzXHJcbiQoZnVuY3Rpb24gKCkge1xyXG4gICAgJCgnW2RhdGEtdG9nZ2xlPVwidG9vbHRpcFwiXScpLnRvb2x0aXAoe1xyXG4gICAgICAgIHBsYWNlbWVudDogJ3JpZ2h0JyxcclxuICAgICAgICBjb250YWluZXI6ICdib2R5J1xyXG4gICAgfSk7XHJcbn0pO1xyXG5cclxuXHJcbmZ1bmN0aW9uIGluaXRpYWxpemVPd2xDYXJvdXNlbChzZWxlY3RvciwgcmVzcG9uc2l2ZUNvbmZpZywgbmF2VGV4dENvbmZpZykge1xyXG4gICAgJChzZWxlY3Rvcikub3dsQ2Fyb3VzZWwoe1xyXG4gICAgICAgIHB1bGxEcmFnOiB0cnVlLFxyXG4gICAgICAgIGNlbnRlcjogZmFsc2UsXHJcbiAgICAgICAgZG90czogZmFsc2UsXHJcbiAgICAgICAgbG9vcDogdHJ1ZSxcclxuICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICBhdXRvcGxheVRpbWVvdXQ6IDQwMDAsXHJcbiAgICAgICAgYXV0b3BsYXlIb3ZlclBhdXNlOiB0cnVlLFxyXG4gICAgICAgIG1hcmdpbjogMjUsXHJcbiAgICAgICAgbmF2OiB0cnVlLFxyXG4gICAgICAgIG5hdlRleHQ6IG5hdlRleHRDb25maWcsXHJcbiAgICAgICAgcmVzcG9uc2l2ZUNsYXNzOiB0cnVlLFxyXG4gICAgICAgIHJlc3BvbnNpdmU6IHJlc3BvbnNpdmVDb25maWdcclxuICAgIH0pO1xyXG5cclxuICAgICQoc2VsZWN0b3IpLnRyaWdnZXIoJ3JlZnJlc2gub3dsLmNhcm91c2VsJyk7XHJcbn1cclxuXHJcbi8vIFV0aWxpc2F0aW9uIGF2ZWMgZGVzIGNvbmZpZ3VyYXRpb25zIHJlc3BvbnNpdmUgZGlmZsOpcmVudGVzIGV0IGRlcyB0ZXh0ZXMgZGUgbmF2aWdhdGlvbiBwZXJzb25uYWxpc8Opc1xyXG4kKGZ1bmN0aW9uKCkge1xyXG4gICAgaW5pdGlhbGl6ZU93bENhcm91c2VsKFwiLm93bC1jYXJvdXNlbC0xXCIsIHtcclxuICAgICAgICAwOiB7IGl0ZW1zOiAxLCBkb3RzOiB0cnVlIH0sXHJcbiAgICAgICAgNTAwOiB7IGl0ZW1zOiAyLCBkb3RzOiB0cnVlIH0sXHJcbiAgICAgICAgNzAwOiB7IGl0ZW1zOiAzLCBkb3RzOiB0cnVlIH0sXHJcbiAgICAgICAgMTAwMDogeyBpdGVtczogNCwgZG90czogdHJ1ZSB9LFxyXG4gICAgICAgIDEyMDA6IHsgaXRlbXM6IDUsIGRvdHM6IHRydWUgfSxcclxuICAgICAgICAxMzAwOiB7IGl0ZW1zOiA2LCBkb3RzOiB0cnVlIH0sXHJcbiAgICAgICAgMTgwMDogeyBpdGVtczogNywgZG90czogdHJ1ZSB9XHJcbiAgICB9LCBbXHJcbiAgICAgICAgJzxpbWcgc3JjPVwiLi4vLi4vdXBsb2Fkcy9pbWFnZXMvY2hldnJvbi1kb3duLXdoaXRlLnN2Z1wiIGFsdD1cIkxlZnRcIj4nLFxyXG4gICAgICAgICc8aW1nIHNyYz1cIi4uLy4uL3VwbG9hZHMvaW1hZ2VzL2NoZXZyb24tdXAtd2hpdGUuc3ZnXCIgYWx0PVwiUmlnaHRcIj4nXHJcbiAgICBdKTtcclxuXHJcbiAgICBpbml0aWFsaXplT3dsQ2Fyb3VzZWwoXCIub3dsLWNhcm91c2VsLTJcIiwge1xyXG4gICAgICAgIDA6IHsgaXRlbXM6IDEsIGRvdHM6IHRydWUgfSxcclxuICAgICAgICA3MDA6IHsgaXRlbXM6IDIsIGRvdHM6IGZhbHNlIH0sXHJcbiAgICAgICAgMTEwMDogeyBpdGVtczogMywgZG90czogdHJ1ZSB9XHJcbiAgICB9LCBbXHJcbiAgICAgICAgJzxpbWcgc3JjPVwiLi4vLi4vdXBsb2Fkcy9pbWFnZXMvYXhoMS5wbmdcIiBhbHQ9XCJMZWZ0XCI+JyxcclxuICAgICAgICAnPGltZyBzcmM9XCIuLi8uLi91cGxvYWRzL2ltYWdlcy9heGgxLnBuZ1wiIGFsdD1cIlJpZ2h0XCI+J1xyXG4gICAgXSk7XHJcbn0pO1xyXG5cclxuICBcclxuXHJcbmNvbnN0IHR5cGVkVGV4dFNwYW4gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiLnR5cGVkLXRleHRcIik7XHJcbmNvbnN0IGN1cnNvclNwYW4gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiLmN1cnNvclwiKTtcclxuXHJcbmNvbnN0IHRleHRBcnJheSA9IFtcIkNST0lTU0FOQ0VcIiwgXCJCVVNJTkVTU1wiLCBcIk5PVE9SScOJVMOJXCJdO1xyXG5jb25zdCB0eXBpbmdEZWxheSA9IDEwMDtcclxuY29uc3QgZXJhc2luZ0RlbGF5ID0gMTAwO1xyXG5jb25zdCBuZXdUZXh0RGVsYXkgPSAzMDAwOyAvLyBEZWxheSBiZXR3ZWVuIGN1cnJlbnQgYW5kIG5leHQgdGV4dFxyXG5sZXQgdGV4dEFycmF5SW5kZXggPSAwO1xyXG5sZXQgY2hhckluZGV4ID0gMDtcclxuXHJcbmZ1bmN0aW9uIHR5cGUoKSB7XHJcbiAgICBpZiAoY2hhckluZGV4IDwgdGV4dEFycmF5W3RleHRBcnJheUluZGV4XS5sZW5ndGgpIHtcclxuICAgICAgICB0eXBlZFRleHRTcGFuLnRleHRDb250ZW50ICs9IHRleHRBcnJheVt0ZXh0QXJyYXlJbmRleF0uY2hhckF0KGNoYXJJbmRleCk7XHJcbiAgICAgICAgY2hhckluZGV4Kys7XHJcbiAgICAgICAgc2V0VGltZW91dCh0eXBlLCB0eXBpbmdEZWxheSk7XHJcbiAgICB9IGVsc2Uge1xyXG4gICAgICAgIHNldFRpbWVvdXQoZXJhc2UsIG5ld1RleHREZWxheSk7XHJcbiAgICB9XHJcbn1cclxuXHJcbmZ1bmN0aW9uIGVyYXNlKCkge1xyXG4gICAgaWYgKGNoYXJJbmRleCA+IDApIHtcclxuICAgICAgICB0eXBlZFRleHRTcGFuLnRleHRDb250ZW50ID0gdGV4dEFycmF5W3RleHRBcnJheUluZGV4XS5zdWJzdHJpbmcoMCwgY2hhckluZGV4IC0gMSk7XHJcbiAgICAgICAgY2hhckluZGV4LS07XHJcbiAgICAgICAgc2V0VGltZW91dChlcmFzZSwgZXJhc2luZ0RlbGF5KTtcclxuICAgIH0gZWxzZSB7XHJcbiAgICAgICAgdGV4dEFycmF5SW5kZXgrKztcclxuICAgICAgICBpZiAodGV4dEFycmF5SW5kZXggPj0gdGV4dEFycmF5Lmxlbmd0aCkgdGV4dEFycmF5SW5kZXggPSAwO1xyXG4gICAgICAgIHNldFRpbWVvdXQodHlwZSwgdHlwaW5nRGVsYXkgKyAxMTAwKTtcclxuICAgIH1cclxufVxyXG5cclxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihcIkRPTUNvbnRlbnRMb2FkZWRcIiwgZnVuY3Rpb24gKCkgeyAvLyBPbiBET00gTG9hZCBpbml0aWF0ZSB0aGUgZWZmZWN0XHJcbiAgICBpZiAodGV4dEFycmF5Lmxlbmd0aCkgc2V0VGltZW91dCh0eXBlLCAzMDApO1xyXG59KTtcclxuXHJcblxyXG4vLyBDaGFuZ2VtZW50IGRlIGNvdWxldXIgZHUgbG9nbyBhdSBkw6lmaWxlbWVudFxyXG53aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignc2Nyb2xsJywgZnVuY3Rpb24gKCkge1xyXG4gICAgLy8gUsOpY3Vww6lyZXIgbGEgcG9zaXRpb24gYWN0dWVsbGUgZHUgZMOpZmlsZW1lbnRcclxuICAgIHZhciBzY3JvbGxQb3NpdGlvbiA9IHdpbmRvdy5zY3JvbGxZO1xyXG5cclxuICAgIC8vIFLDqWN1cMOpcmVyIGxhIGhhdXRldXIgZGUgbGEgZmVuw6p0cmUgZGUgdmlzdWFsaXNhdGlvblxyXG4gICAgdmFyIHZpZXdwb3J0SGVpZ2h0ID0gd2luZG93LmlubmVySGVpZ2h0O1xyXG5cclxuICAgIC8vIFbDqXJpZmllciBzaSBsYSBwb3NpdGlvbiBhY3R1ZWxsZSBkdSBkw6lmaWxlbWVudCBlc3Qgc3Vww6lyaWV1cmUgw6AgMTA4JSBkZSBsYSBoYXV0ZXVyIGRlIGxhIGZlbsOqdHJlIGRlIHZpc3VhbGlzYXRpb25cclxuICAgIGlmICgoc2Nyb2xsUG9zaXRpb24gPiB2aWV3cG9ydEhlaWdodCAqIDAuMTUpICYmIChzY3JvbGxQb3NpdGlvbiA8IHZpZXdwb3J0SGVpZ2h0ICogMC45NCkpIHtcclxuXHJcbiAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmxvZ29fbmF2Jykuc3R5bGUuYmFja2dyb3VuZENvbG9yID0gJyNGRkZGRkYnO1xyXG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5sb2dvX25hdicpLnN0eWxlLmJveFNoYWRvdyA9ICdyZ2JhKDE0OSwgMTU3LCAxNjUsIDAuMikgMHB4IDhweCAyNHB4JztcclxuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubG9nb19uYXYgLmxvZ28nKS5zdHlsZS5maWx0ZXIgPSAnaW52ZXJ0KDEwMCUpJztcclxuXHJcbiAgICB9IGVsc2UgaWYgKHNjcm9sbFBvc2l0aW9uID4gdmlld3BvcnRIZWlnaHQgKiAwLjk1KSB7XHJcblxyXG4gICAgICAgIC8vIENoYW5nZXIgbCdpbWFnZSBkdSBsb2dvIGVuIGJsYW5jXHJcbiAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmxvZ29fbmF2Jykuc3R5bGUuYmFja2dyb3VuZENvbG9yID0gJyNGRkZGRkYnO1xyXG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5sb2dvX25hdicpLnN0eWxlLmJveFNoYWRvdyA9ICdyZ2JhKDE0OSwgMTU3LCAxNjUsIDAuMikgMHB4IDhweCAyNHB4JztcclxuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubG9nb19uYXYgLmxvZ28nKS5zdHlsZS5maWx0ZXIgPSAnaW52ZXJ0KDEwMCUpJztcclxuXHJcbiAgICB9IGVsc2Uge1xyXG5cclxuICAgICAgICAvLyBSw6lpbml0aWFsaXNlciBsJ2ltYWdlIGR1IGxvZ28gw6Agc29uIMOpdGF0IG9yaWdpbmFsXHJcbiAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmxvZ29fbmF2Jykuc3R5bGUuYmFja2dyb3VuZENvbG9yID0gJ3RyYW5zcGFyZW50JztcclxuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubG9nb19uYXYnKS5zdHlsZS5ib3hTaGFkb3cgPSAnbm9uZSc7XHJcbiAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmxvZ29fbmF2IC5sb2dvJykuc3R5bGUuZmlsdGVyID0gJyc7XHJcbiAgICB9XHJcbn0pO1xyXG5cclxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsIChldmVudCkgPT4ge1xyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgdmFyIG15TW9kYWwgPSBuZXcgYm9vdHN0cmFwLk1vZGFsKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdteU1vZGFsJyksIHt9KVxyXG4gICAgICAgIG15TW9kYWwuc2hvdygpO1xyXG4gICAgfSwgNTAwMCk7IC8vIDUwMDAgbWlsbGlzZWNvbmRzID0gNSBzZWNvbmRzXHJcbn0pO1xyXG5cclxuXHJcbi8vIENvbmNlcm5lIGxhIHBhZ2UgL2Nyb2lzc2FuY2VcclxuLy8gY29uc29sZS5sb2coZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnRleHQtc2hvdycpKTtcclxuLy8gZnVuY3Rpb24gY2hlY2tTY3JlZW5TaXplKCkge1xyXG5cclxuLy8gICAgIGlmICh3aW5kb3cubWF0Y2hNZWRpYSgnKG1heC13aWR0aDogOTkxcHgpJykubWF0Y2hlcykge1xyXG4vLyAgICAgICAgIC8vIEwnw6ljcmFuIGEgdW5lIGxhcmdldXIgaW5mw6lyaWV1cmUgw6AuLi5cclxuLy8gICAgICAgICBjb25zdCBkaXYgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcudGV4dC1zaG93Jyk7XHJcbi8vICAgICAgICAgZGl2LmlubmVySFRNTCA9IGA8aDIgY2xhc3M9XCJ0ZXh0ZS1pbnRybyBibGFja1wiPkNlIG7igJllc3QgcGFzIGzigJlhcmdlbnQgcXVpIGNvbXB0ZSwgbWFpcyBsYSBmYcOnb24gZGUgbGUgZMOpcGVuc2VyLjwvaDI+XHJcbi8vICAgICAgICAgPHAgY2xhc3M9XCJ0ZXh0ZS1pbnRybyBibGFjayBtdC0xXCI+T3VibGlleiBsZXMgc29tbWVzIGludmVzdGllcyBwb3VyIHZvdXMgY29uY2VudHJlciBzdXIgbGEgY3JvaXNzYW5jZSByw6ljb2x0w6llLjwvcD5cclxuLy8gICAgICAgICA8cCBjbGFzcz1cInRleHRlLWludHJvLXAgYmxhY2sgbXQtMlwiPkzigJlhdmFudGFnZSwgYXZlYyBub3MgYWN0aW9ucywgY+KAmWVzdCBxdWUgdm91cyBwb3VycmV6IHRvdWpvdXJzIGxlcyBqdWdlciBzdXIgbGEgcGVyZm9ybWFuY2UuIMOJdGFibGlyIGRlIG1hbmnDqHJlIHRyYW5zcGFyZW50ZSBsZSBjb8O7dCBk4oCZdW4gY2xpYywgZOKAmXVuIGxlYWQsIGTigJl1bmUgdmVudGUuPC9wPmA7XHJcbi8vICAgICB9IGVsc2Uge1xyXG4vLyAgICAgICAgIC8vIEwnw6ljcmFuIGEgdW5lIGxhcmdldXIgc3Vww6lyaWV1cmUgw6AuLi5cclxuLy8gICAgICAgICBjb25zdCBkaXYgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcudGV4dC1zaG93Jyk7XHJcbi8vICAgICAgICAgZGl2LmlubmVySFRNTCA9ICcnO1xyXG4vLyAgICAgfVxyXG4vLyB9XHJcblxyXG4vLyB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsIGNoZWNrU2NyZWVuU2l6ZSk7XHJcbi8vIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdyZXNpemUnLCBjaGVja1NjcmVlblNpemUpO1xyXG5cclxuLy8gLy8gRk9STVVMQUlSRVxyXG4vLyAvLyBSw6ljdXDDqXJlciBsZSBmb3JtdWxhaXJlXHJcbi8vIHZhciBmb3JtID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvbnRhY3RfZm9ybScpO1xyXG5cclxuLy8gaWYoZm9ybSkge1xyXG4vLyAgICAgLy8gQWpvdXRlciB1biDDqWNvdXRldXIgZCfDqXbDqW5lbWVudHMgcG91ciBsYSBzb3VtaXNzaW9uIGR1IGZvcm11bGFpcmVcclxuLy8gICAgIGZvcm0uYWRkRXZlbnRMaXN0ZW5lcignc3VibWl0JywgZnVuY3Rpb24gKGV2ZW50KSB7XHJcbiAgICBcclxuLy8gICAgICAgICAvLyBWw6lyaWZpZXIgcXVlIGxlIGNhcHRjaGEgYSDDqXTDqSB2YWxpZMOpXHJcbi8vICAgICAgICAgaWYgKGdyZWNhcHRjaGEuZ2V0UmVzcG9uc2UoKSA9PT0gJycpIHtcclxuLy8gICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcclxuLy8gICAgICAgICAgICAgYWxlcnQoJ1ZldWlsbGV6IHZhbGlkZXIgbGUgY2FwdGNoYS4nKTtcclxuLy8gICAgICAgICAgICAgcmV0dXJuO1xyXG4vLyAgICAgICAgIH1cclxuICAgIFxyXG4vLyAgICAgICAgIC8vIFNpIGxlIGNhcHRjaGEgYSDDqXTDqSB2YWxpZMOpLCBjb250aW51ZXIgYXZlYyBsYSBzb3VtaXNzaW9uIGR1IGZvcm11bGFpcmUuLi5cclxuICAgIFxyXG4vLyAgICAgICAgIC8vIEVtcMOqY2hlciBsZSBjb21wb3J0ZW1lbnQgZGUgc291bWlzc2lvbiBwYXIgZMOpZmF1dFxyXG4vLyAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICBcclxuLy8gICAgICAgICAvLyBFbnZveWVyIGxlIGZvcm11bGFpcmUgYXUgc2VydmV1clxyXG4vLyAgICAgICAgIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YShmb3JtKTtcclxuICAgIFxyXG4vLyAgICAgICAgIC8vIFLDqWN1cMOpcmVyIGxhIHLDqXBvbnNlIGR1IGNhcHRjaGFcclxuLy8gICAgICAgICB2YXIgY2FwdGNoYVJlc3BvbnNlID0gZ3JlY2FwdGNoYS5nZXRSZXNwb25zZSgpO1xyXG4gICAgXHJcbi8vICAgICAgICAgLy8gQWpvdXRlciBsYSByw6lwb25zZSBkdSBjYXB0Y2hhIMOgIEZvcm1EYXRhXHJcbi8vICAgICAgICAgZm9ybURhdGEuYXBwZW5kKCdnLXJlY2FwdGNoYS1yZXNwb25zZScsIGNhcHRjaGFSZXNwb25zZSk7XHJcbiAgICBcclxuLy8gICAgICAgICB2YXIgcmVxdWVzdCA9IG5ldyBYTUxIdHRwUmVxdWVzdCgpO1xyXG4vLyAgICAgICAgIHJlcXVlc3Qub3BlbignUE9TVCcsIGZvcm0uYWN0aW9uKTtcclxuICAgIFxyXG4vLyAgICAgICAgIC8vIExvcnNxdWUgbGEgcmVxdcOqdGUgZXN0IHRlcm1pbsOpZVxyXG4vLyAgICAgICAgIHJlcXVlc3Qub25sb2FkID0gZnVuY3Rpb24gKCkge1xyXG4gICAgXHJcbi8vICAgICAgICAgICAgIC8vIGNvbnNvbGUubG9nKHJlcXVlc3QpO1xyXG4gICAgXHJcbi8vICAgICAgICAgICAgIGlmIChyZXF1ZXN0LnN0YXR1cyA9PT0gMjAwKSB7XHJcbi8vICAgICAgICAgICAgICAgICAvLyBBZmZpY2hlciBsZSBwb3AtdXAgZGUgc3VjY8OocyB1bmlxdWVtZW50IHNpIGxhIHJlcXXDqnRlIGEgcsOpdXNzaVxyXG4vLyAgICAgICAgICAgICAgICAgdmFyIHN1Y2Nlc3NNb2RhbCA9IG5ldyBib290c3RyYXAuTW9kYWwoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3N1Y2Nlc3NNb2RhbCcpKTtcclxuLy8gICAgICAgICAgICAgICAgIHN1Y2Nlc3NNb2RhbC5zaG93KCk7XHJcbiAgICBcclxuLy8gICAgICAgICAgICAgICAgIC8vIFLDqWluaXRpYWxpc2VyIGxlIGZvcm11bGFpcmUgKGZhY3VsdGF0aWYpXHJcbi8vICAgICAgICAgICAgICAgICBmb3JtLnJlc2V0KCk7XHJcbi8vICAgICAgICAgICAgIH0gZWxzZSB7XHJcbi8vICAgICAgICAgICAgICAgICAvLyBHw6lyZXIgbGVzIGVycmV1cnMgb3UgYWZmaWNoZXIgdW4gbWVzc2FnZSBkJ2VycmV1clxyXG4vLyAgICAgICAgICAgICAgICAgYWxlcnQoJ1VuZSBlcnJldXIgc1xcJ2VzdCBwcm9kdWl0ZSBsb3JzIGRlIGxcXCdlbnJlZ2lzdHJlbWVudCBkZXMgZG9ubsOpZXMuJyk7XHJcbi8vICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICB9O1xyXG4gICAgXHJcbi8vICAgICAgICAgLy8gRW52b3llciBsYSByZXF1w6p0ZSBhdmVjIGxlcyBkb25uw6llcyBkdSBmb3JtdWxhaXJlXHJcbi8vICAgICAgICAgcmVxdWVzdC5zZW5kKGZvcm1EYXRhKTtcclxuLy8gICAgIH0pO1xyXG4vLyB9XHJcblxyXG5cclxuLy8gQ09PS0lFU1xyXG4vLyBpbXBvcnQgJ2Nvb2tpZWNvbnNlbnQvYnVpbGQvY29va2llY29uc2VudC5taW4uY3NzJztcclxuLy8gaW1wb3J0IGNvb2tpZWNvbnNlbnQgZnJvbSAnY29va2llY29uc2VudCc7XHJcblxyXG4vLyB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcihcImxvYWRcIiwgZnVuY3Rpb24gKCkge1xyXG4vLyAgICAgd2luZG93LmNvb2tpZWNvbnNlbnQuaW5pdGlhbGlzZSh7XHJcbi8vICAgICAgICAgXCJwYWxldHRlXCI6IHtcclxuLy8gICAgICAgICAgICAgXCJwb3B1cFwiOiB7XHJcbi8vICAgICAgICAgICAgICAgICBcImJhY2tncm91bmRcIjogXCIjMDAwXCJcclxuLy8gICAgICAgICAgICAgfSxcclxuLy8gICAgICAgICAgICAgXCJidXR0b25cIjoge1xyXG4vLyAgICAgICAgICAgICAgICAgXCJiYWNrZ3JvdW5kXCI6IFwiI2YxZDYwMFwiXHJcbi8vICAgICAgICAgICAgIH1cclxuLy8gICAgICAgICB9LFxyXG4vLyAgICAgICAgIFwicG9zaXRpb25cIjogXCJib3R0b20tcmlnaHRcIixcclxuLy8gICAgICAgICBcImNvbnRlbnRcIjoge1xyXG4vLyAgICAgICAgICAgICBcIm1lc3NhZ2VcIjogXCJDZSBzaXRlIHV0aWxpc2UgZGVzIGNvb2tpZXMgcG91ciB2b3VzIGdhcmFudGlyIGxhIG1laWxsZXVyZSBleHDDqXJpZW5jZSBzdXIgbm90cmUgc2l0ZS5cIixcclxuLy8gICAgICAgICAgICAgXCJkaXNtaXNzXCI6IFwiQ29tcHJpcyAhXCIsXHJcbi8vICAgICAgICAgICAgIFwibGlua1wiOiBcIkVuIHNhdm9pciBwbHVzXCJcclxuLy8gICAgICAgICB9XHJcbi8vICAgICB9KTtcclxuLy8gfSk7Il0sIm5hbWVzIjpbIiQiLCJQb3BwZXIiLCJ0b29sdGlwIiwicGxhY2VtZW50IiwiY29udGFpbmVyIiwiaW5pdGlhbGl6ZU93bENhcm91c2VsIiwic2VsZWN0b3IiLCJyZXNwb25zaXZlQ29uZmlnIiwibmF2VGV4dENvbmZpZyIsIm93bENhcm91c2VsIiwicHVsbERyYWciLCJjZW50ZXIiLCJkb3RzIiwibG9vcCIsImF1dG9wbGF5IiwiYXV0b3BsYXlUaW1lb3V0IiwiYXV0b3BsYXlIb3ZlclBhdXNlIiwibWFyZ2luIiwibmF2IiwibmF2VGV4dCIsInJlc3BvbnNpdmVDbGFzcyIsInJlc3BvbnNpdmUiLCJ0cmlnZ2VyIiwiaXRlbXMiLCJ0eXBlZFRleHRTcGFuIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwiY3Vyc29yU3BhbiIsInRleHRBcnJheSIsInR5cGluZ0RlbGF5IiwiZXJhc2luZ0RlbGF5IiwibmV3VGV4dERlbGF5IiwidGV4dEFycmF5SW5kZXgiLCJjaGFySW5kZXgiLCJ0eXBlIiwibGVuZ3RoIiwidGV4dENvbnRlbnQiLCJjaGFyQXQiLCJzZXRUaW1lb3V0IiwiZXJhc2UiLCJzdWJzdHJpbmciLCJhZGRFdmVudExpc3RlbmVyIiwid2luZG93Iiwic2Nyb2xsUG9zaXRpb24iLCJzY3JvbGxZIiwidmlld3BvcnRIZWlnaHQiLCJpbm5lckhlaWdodCIsInN0eWxlIiwiYmFja2dyb3VuZENvbG9yIiwiYm94U2hhZG93IiwiZmlsdGVyIiwiZXZlbnQiLCJteU1vZGFsIiwiYm9vdHN0cmFwIiwiTW9kYWwiLCJnZXRFbGVtZW50QnlJZCIsInNob3ciXSwic291cmNlUm9vdCI6IiJ9