jQuery(document).ready(function($) {
    'use strict';

    /* menu js **/

    $('.navbar-nav > li').each(function(i, ojb) {
        $(this).addClass('nav-item');
    }); 

    $('.navbar-nav').find('li.menu-item-has-children').each(function(i, ojb) {
        $(this).addClass('dropdown');
    }); 

    $('.navbar-nav li.menu-item-has-children ul').find('li.menu-item-has-children').each(function(i, ojb) {
        $(this).addClass('dropdown-submenu');
    }); 

    $('.navbar-nav > li > a').each(function(i, ojb) {
        $(this).addClass('nav-link');
    }); 

    $('.navbar-nav li.menu-item-has-children > a').each(function(i, ojb) {
        $(this).addClass('dropdown-toggle');
    }); 

    $('.navbar-nav li.menu-item-has-children').find('ul').each(function(i, ojb) {
        $(this).addClass('dropdown-menu');
    }); 

    $('.navbar-nav li.menu-item-has-children ul').find('a').each(function(i, ojb) {
        $(this).addClass('dropdown-item');
    }); 

    $('.mega-sub-menu ul').each(function(i, ojb) {
        $(this).removeClass('dropdown-menu');
    }); 

    $('.navbar .navbar-nav li.menu-item-has-children > a').on('click', function(){
        $(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('show')) {
            element.removeClass('show');
            element.find('ul.dropdown-menu').slideUp(200);
        }
        else {
            element.addClass('show');
            element.children('ul.dropdown-menu').slideDown(200);
        }
    });

    if ($(".dropdown-menu a.dropdown-toggle").length) {

        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');

            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                $('.dropdown-submenu .show').removeClass("show");
            });

            return false;
        });

    }
    
    $(function() {
        $('.isotope').isotope({
            itemSelector: '.post-masonry',
            masonry: {}
        });

    });

    //TAB

    $( '.ot-tabs .vc_tta-tab' ).on( 'click', 'a', function( e ) {

        $( '.ot-tabs .vc_tta-tabs-list' ).find( '.vc_tta-tab' ).removeClass( 'vc_active' );
        $( this ).parent().addClass( 'vc_active' );
        var id = $( this ).attr( 'href' ).replace( '#', '' );
        $( '.ot-tabs .vc_tta-panels' ).find( '.vc_tta-panel' ).removeClass( 'vc_active').hide();
        $( '.ot-tabs .vc_tta-panels' ).find( '#' + id ).addClass( 'vc_active' ).show();

        return false;
    } );

    /* counter **/

    if ($(".counter").length) {

        $('.counter').each(function() {
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({
                countNum: $this.text()
            }).animate({
                    countNum: countTo
                },

                {

                    duration: 5000,
                    easing: 'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });


        });

    }

    /*--- accordion js (plus-minus) ----*/

    if ($('.collapse').length) {


        $('.collapse').on('shown.bs.collapse', function() {
            $(this).parent().find(".fa-plus-circle").removeClass("fa-plus-circle").addClass("fa-minus-circle");
        }).on('hidden.bs.collapse', function() {
            $(this).parent().find(".fa-minus-circle").removeClass("fa-minus-circle").addClass("fa-plus-circle");
        });

        $('.card-header a').click(function() {
            $('.card-header').removeClass('active');

            //If the panel was open and would be closed by this click, do not active it
            if (!$(this).closest('.card').find('.collapse').hasClass('in'))
                $(this).parents('.card-header').addClass('active');
        });



    }

    /* accordion (circle arrow) **/


    if ($('.collapse').length) {

        $('.collapse').on('shown.bs.collapse', function() {
            $(this).parent().find(".fa-chevron-circle-down").removeClass("fa-chevron-circle-down").addClass("fa-chevron-circle-up");
        }).on('hidden.bs.collapse', function() {
            $(this).parent().find(".fa-chevron-circle-up").removeClass("fa-chevron-circle-up").addClass("fa-chevron-circle-down");
        });

        $('.card-header a').click(function() {
            $('.card-header').removeClass('active');

            //If the panel was open and would be closed by this click, do not active it
            if (!$(this).closest('.card').find('.collapse').hasClass('in'))
                $(this).parents('.card-header').addClass('active');
        });



    }

    /* accordion js (arrow) **/


    if ($('.collapse').length) {


        $('.collapse').on('shown.bs.collapse', function() {
            $(this).parent().find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
        }).on('hidden.bs.collapse', function() {
            $(this).parent().find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
        });

        $('.card-header a').click(function() {
            $('.card-header').removeClass('active');

            //If the panel was open and would be closed by this click, do not active it
            if (!$(this).closest('.card').find('.collapse').hasClass('in'))
                $(this).parents('.card-header').addClass('active');
        });

    }


    /* accordion js (plus-minus-outline) **/


    if ($('.collapse').length) {


        $('.collapse').on('shown.bs.collapse', function() {
            $(this).parent().find(".ion-ios7-plus-outline").removeClass("ion-ios7-plus-outline").addClass("ion-ios7-minus-outline");
        }).on('hidden.bs.collapse', function() {
            $(this).parent().find(".ion-ios7-minus-outline").removeClass("ion-ios7-minus-outline").addClass("ion-ios7-plus-outline");
        });

        $('.card-header a').click(function() {
            $('.card-header').removeClass('active');

            //If the panel was open and would be closed by this click, do not active it
            if (!$(this).closest('.card').find('.collapse').hasClass('in'))
                $(this).parents('.card-header').addClass('active');
        });

    }


    /* tooltip **/

    if ($('[data-toggle="tooltip"]').length) {

        $('[data-toggle="tooltip"]').tooltip()

    }

    /* Popover  **/
    if ($('[data-toggle="popover"]').length) {


        $('[data-toggle="popover"]').popover({
            trigger: 'focus'
        })



    }


    /* calculator  **/

    if ($('.calculator-amortization').length) {

        $(".calculator-amortization").accrue({
            mode: "amortization"
        });





    }


    /* calculator-loan  **/

    if ($('.calculator-loan').length) {

        $(".calculator-loan").accrue();

    }




    /* event card  **/

    if ($('.event-card').length) {

        $('.event-card')
            // Remove links that don't actually link to anything

            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 90
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                };
                $('.event-card').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');


            });

    }





    /* datatable  **/

    if ($('#example').length) {

        $(document).ready(function() {
            $('#example').DataTable();
        });

    }


    /* header boxed **/

    if ($('.header-boxed').length) {

        $(window).scroll(function() {
            if ($(".header-boxed").offset().top > 200) {
                $(".header-boxed").addClass("header-boxed-collapse");
            } else {
                $(".header-boxed").removeClass("header-boxed-collapse");
            }
        });

    }



    /* Preview Carousel **/

    if ($('.preview-carousel').length) {

        $('.preview-carousel').slick({
            arrows: true,

            slidesToShow: 6,
            autoplay: true,
            autoplaySpeed: 1500,
            dots: true,
            arrows: false,

            responsive: [{
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                },

                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    }


    /* events second **/

    if ($('.section-heading a').length) {

        $('.section-heading a')
            // Remove links that don't actually link to anything

            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 0
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                };
                $('.section-heading a').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');



            });


    }

    /* video play btn **/

    if ($('.video-container a').length) {

        var playButton = document.querySelector('.video-container a');
        playButton.addEventListener('click', playVideo);

        function playVideo(e) {
            e.preventDefault();
            var videoContainer = this.parentNode;
            var videoUrl = this.href;
            var videoId = videoUrl.split('.com/')[1];
            var iframeUrl = void 0;

            if (videoUrl.includes('vimeo')) {
                // vimeo
                videoId = videoId.split('?')[0];
                iframeUrl = '//player.vimeo.com/video/' + videoId + '?autoplay=1';
            } else {
                // youtube
                videoId = videoId.split('v=')[1];
                iframeUrl = '//www.youtube.com/embed/' + videoId + '?autoplay=1';
            }

            videoContainer.innerHTML = '<iframe src="' + iframeUrl + '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
        }

    }



    /* loan features **/


    if ($('.loan-features-tab ul li a').length) {

        $('.loan-features-tab ul li a')
            // Remove links that don't actually link to anything

            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 10
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                };
                $('.loan-features-tab ul li a').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');



            });


    }




    /* loan features **/


    if ($('.sidebar-nav-fixed a').length) {

        $('.sidebar-nav-fixed a')
            // Remove links that don't actually link to anything

            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 90
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                };
                $('.sidebar-nav-fixed a').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');



            });


    }





    if ($('.header-transparent').length) {

        $(window).scroll(function() {
            if ($(".header-transparent").offset().top > 200) {
                $(".header-transparent").addClass("header-collapse");
            } else {
                $(".header-transparent").removeClass("header-collapse");
            }
        });







    }



    if ($('.filters ul li').length) {
        $('.filters ul li').click(function() {
            $('.filters ul li').removeClass('active');
            $(this).addClass('active');

            var data = $(this).attr('data-filter');
            $grid.isotope({
                filter: data
            })
        });

        var $grid = $(".grid").isotope({
            itemSelector: ".all",
            percentPosition: true,
            masonry: {
                columnWidth: ".all"
            }
        })


    }

    if ($('.categories-filter a').length) {
        $('.categories-filter a').click(function() {
            $('.categories-filter a').removeClass('active');
            $(this).addClass('active');

            var data = $(this).attr('data-filter');
            $post_design.isotope({
                filter: data
            })
        });

        var $post_design = $(".post-design").isotope({
            itemSelector: ".all-post",
            percentPosition: true,
            masonry: {
                columnWidth: ".all-post"
            }
        })


    }

    /* Preview Carousel **/

    if ($('.preview-carousel-second').length) {

    $('.preview-carousel-second').each( function () {
        var $show = $(this).data('show');
        var $arr  = $(this).data('arrow');
        var $auto = $(this).data('auto');
        var $dots = $(this).data('dots');

        $(this).slick({
            arrows: true,

            slidesToShow: $show,
            autoplay: $auto,
            autoplaySpeed: 1500,
            dots: $dots,
            arrows: $arr,

            responsive: [{
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                },

                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });
    }


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