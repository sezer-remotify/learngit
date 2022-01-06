 /* Multiple Carousel **/

jQuery(document).ready(function($) {
    'use strict';


 $('.owl-slider').owlCarousel({

         loop: true,
         margin: 5,
         autoplay: true,
         autoplayTimeout: 3000,
         nav: true,
         navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: 1
             }
         }
     });
     $('.owl-post').owlCarousel({

         loop: true,
         margin: 5,
         autoplay: true,
         autoplayTimeout: 3000,
         nav: true,
         navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: 1
             }
         }
     });


$('.owl-testimonial').each( function () {
        var $show = $(this).data('show');
        var $arr  = $(this).data('arrow');
        var $auto = $(this).data('auto');

        $(this).owlCarousel({
         loop: true,
         margin: 5,
         autoplay: $auto,
         autoplayTimeout: 3000,
         nav: $arr,
         navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: $show
             }
         }
        });
     });

$('.owl-testimonial-second').each( function () {
        var $show = $(this).data('show');
        var $arr  = $(this).data('arrow');
        var $auto = $(this).data('auto');
        $(this).owlCarousel({
         loop: true,

         margin: 30,
         autoplay: $auto,
         autoplayTimeout: 3000,
         nav: $arr,
         navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: $show
             }
         }
        });
    });

$('.owl-testimonial-third').each( function () {
        var $show = $(this).data('show');
        var $arr  = $(this).data('arrow');
        var $auto = $(this).data('auto');
        $(this).owlCarousel({
         loop: true,

         margin: 30,
         autoplay: $auto,
         autoplayTimeout: 3000,
         nav: $arr,
         navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 2
             },
             1000: {
                 items: 3
             },
             1400: {
                 items: $show
             }
         }
     });
     });


$('.owl-testimonial-fourth').each( function () {
        var $show = $(this).data('show');
        var $arr  = $(this).data('arrow');
        var $auto = $(this).data('auto');
        $(this).owlCarousel({
         loop: true,
         margin: 5,
         autoplay: true,
         autoplayTimeout: 3000,
         nav: true,
         navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: 1
             }
         }
     });
     });

$('.owl-insurance-product').each( function () {
        var $show = $(this).data('show');
        var $arr  = $(this).data('arrow');
        var $auto = $(this).data('auto');
        $(this).owlCarousel({
         loop: true,
         margin: 30,
         autoplay: $auto,
         autoplayTimeout: 3000,
         nav: $arr,
         navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: $show
             }
         }
     });
     });


}); // AND OF JQUERY