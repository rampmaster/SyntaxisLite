var Miguel92 = {},
DoneProfile = localStorage.getItem('TourPefil');
(function($){
  	"use strict";
  	var $window = $(window),  
   $document = $(document);
   /* SCROLL */
   Miguel92.FadeInOutLogo = function () {
      // Le cambiamos las clases al menu
      if ($(window).scrollTop() > 265) $("nav").removeClass('navbar-pill').addClass('navbar-pill-off');
      else $("nav").removeClass('navbar-pill-off').addClass('navbar-pill');
   }
   /* LOAD */
   Miguel92.ReplaceImgBroken = function() {
      // Recorremos todas las imagenes de las web
      $('img').each(function() {
         var name_img = "imagen_no_disponible.webp";
         // Con esto identificamos que imagen esta rota
         if((typeof this.naturalWidth != "undefined" && this.naturalWidth == 0 ) || this.readyState == 'uninitialized' ) 
         // Acá reemplazaremos la imagen rota con la que querramos
         $(this).attr('src', global_data.img + 'images/' + name_img);  
      });
   }
   /* DOCUMENT READY */
   Miguel92.FeatherIcons = function() {
      // Constante de 2 opciones "clase" y "stroke"
      const $klass = 'featherIcons', $stroke_w = 1.5
      // le incorporamos a los SVG
      feather.replace({ 
         class: $klass, 
         'stroke-width': $stroke_w 
      });
   }
  	Miguel92.Tipsy = function() {
      // Buscamos el objeto o enlace
   	var $link = $('a[title]');
      // Le aplicamos los atributos necesarios
   	$link.tipsy({fade: true, html: true, gravity: $.fn.tipsy.autoNS});
   }
   Miguel92.LazyLoad = function() {
      // Buscamos las imagenes con ese atributo
   	var $images = $('img[data-src]');
      // Le aplicamos estas propiedades
   	$images.lazyload({effect: 'fadeIn', gravity: 1000});
      // y le reemplazamos la clase
      $images.removeClass('loading__lazyload').addClass('lazyload');
   }
	Miguel92.ScrollToTop = function () {  
	 	$('.subir').click(function(){ $('body, html').animate({scrollTop: '40px'}, 1000) });
  	}

   // Window load functions
   $window.on('load', function () {
      Miguel92.ReplaceImgBroken();
   });
   // Window scroll functions
   $window.on('scroll', function () {
      Miguel92.FadeInOutLogo();
   });
 	// Document ready functions
   $document.ready(function(){
      Miguel92.FeatherIcons(),
      Miguel92.Tipsy(),
      Miguel92.LazyLoad(),
      Miguel92.ScrollToTop();
	});

})(jQuery);