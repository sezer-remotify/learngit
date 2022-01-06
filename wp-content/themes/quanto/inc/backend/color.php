<?php 

//Custom Style Frontend
if(!function_exists('quanto_color_scheme')){
    function quanto_color_scheme(){
        $color_scheme = '';

        //Main Color
        if( quanto_get_option('main_color') != '#3544ee' || quanto_get_option('second_color') != '#01d486' ){
            $color_scheme = 
            '
        /****Main Color: #3544ee****/

            /*Color*/
            .text-primary, .feature-block-v5 .feature-icon, .vc_tta-color-white.lender-custom .vc_tta-tabs-list li.vc_active a,
            .simple-card .nav-tabs .nav-link.active, .accrodion-second-regular .card-header .card-title a:hover

            { color: '.quanto_get_option('main_color').'!important; }

            a, .meta-cat a, .service-block-v1 .service-block-icon, .num-primary .process-number,
            .testimonial-carousel .owl-theme .owl-nav .owl-prev, .testimonial-carousel .owl-theme .owl-nav .owl-next,
            .service-block-v3 .service-block-icon, .slick-dots li.slick-active button:before, .accrodion-regular .accordion-title span,
            .feature-block-v1 .feature-icon, .testimonial-carousel-v2 .owl-theme .owl-nav .owl-prev,
            .testimonial-carousel-v2 .owl-theme .owl-nav .owl-next, .service-block-v5 .service-block-icon, 
            .tab-regular-justify .nav-tabs .nav-link.active, .feature-left .feature-icon, .feature-block-v6 .feature-icon,
            .testimonial-carousel-v3 .owl-theme .owl-nav .owl-prev, .testimonial-carousel-v3 .owl-theme .owl-nav .owl-next,
            .feature-block-v7 .feature-icon, .feature-block-v8 .feature-icon, .cta-block-icon, .primary .service-block-icon,
            .credit-card-balance-list .arrow li:before, .feature-block-v3 .feature-icon, .btn-outline-primary, .feature-block-v2 .feature-icon,
            .loan-features-tab ul li a:hover, .btn-primary-arrow-link, .lender-block .arrow li:before, .process-block-v4 .process-block-icon,
            .process-block-v5 .process-block-icon, .hc-category-page-block-content ul li a:hover, .hc-sidebar-widget-content ul li a:hover,
            .wpb-js-composer .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title>a:hover span, .pricing-total-price,
            .accrodion-regular .card-header a:hover, .blockquote-fancy::before, .cat-meta a, 
            .contact-info-icon, .pricing-block-v3.pricing-block-selected-2 .pricing-bottom-price, 
            .pricing-block-v4.pricing-block-selected .pricing-bottom-price, .pricing-block-v5.pricing-block-selected .pricing-bottom-price,
            .pricing-block-v3.pricing-block-selected-2 .pricing-bottom-price, .pricing-block-v4.pricing-block-selected .pricing-bottom-price,
            .pricing-block-v5.pricing-block-selected .pricing-bottom-price, .pricing-block-v3.pricing-block-selected-2 .pricing-bottom-price, 
            .pricing-block-v4.pricing-block-selected .pricing-bottom-price, .pricing-block-v5.pricing-block-selected .pricing-bottom-price,
            .pricing-block-v6 .pricing-bottom-price, .dropcap-v4 p:first-letter, .dropcap-v6 p:first-letter, .sidebar-nav-fixed ul li a.active,
            .sidebar-nav-fixed ul li a:hover, .plus-circle li:before, .tab-regular .nav-tabs .nav-link.active, .tab-vertical .nav-tabs .nav-link.active,
            .pills-regular .nav.nav-pills .nav-item .nav-link.active, .pills-vertical .nav.nav-pills .nav-link.active, 
            .tab-regular .nav-tabs .nav-link.active, .tab-regular-justify .nav-tabs .nav-link.active, .accrodion-regular .card-header a:hover,
            .accrodion-second-regular .card-title span, .custom-list .list-group-item:hover .custom-list-title, .top-header-social ul li a:hover

            { color: '.quanto_get_option('main_color').'; }

        	/*Background Color*/

            .meta-cat a:hover, .cta-v1.cta, #return-to-top, .btn-primary, .testimonial-carousel .owl-theme .owl-nav .owl-prev:hover,
            .testimonial-carousel .owl-theme .owl-nav .owl-next:hover, .cta-v2.cta, .testimonial-carousel-v2 .owl-theme .owl-nav .owl-next:hover,
            .testimonial-carousel-v2 .owl-theme .owl-nav .owl-prev:hover, .testimonial-carousel-v3 .owl-theme .owl-nav .owl-prev:hover, 
            .testimonial-carousel-v3 .owl-theme .owl-nav .owl-next:hover, .hero-shape-second, .btn-outline-primary:hover, .cta-curveshape,
            .btn-primary-link:after, hero-shape-fourth, .btn-primary-link:hover:after, .pageheader-second-bg, .cta-v3.cta, .pageheader-bg,
            .cta-v4.cta, .loan-features-tab ul li a:before, .slider-gallery .slick-prev, .slider-gallery .slick-next, .team-block-v3 .team-plus-icon,
            .hero-slide, .pageheader-third-bg, .pricing-block-v1.pricing-block-selected, .badge-primary, .tagcloud a:hover, 
            .categories-filter a:hover, .categories-filter a.active, .categories-filter a:hover, .categories-filter a.active, .cat-meta a:hover,
            .pricing-block-v3.pricing-block-selected-2 .btn, .pricing-block-v4.pricing-block-selected .btn, 
            .pricing-block-v5.pricing-block-selected .btn, .pricing-block-v3.pricing-block-selected-2 .btn, 
            .pricing-block-v4.pricing-block-selected .btn, .pricing-block-v5.pricing-block-selected .btn, .dropcap-v5 p:first-letter,
            .pattern-slide-second, .portfolio .filters ul li:after, .pageheader-second-bg.hero-slide, .hero-shape-fourth,
            .imghvr-shutter-out-vert:before, .hero-shape-one

            { background-color: '.quanto_get_option('main_color').'; }

            .imghvr-shutter-out-vert:before {opacity:0.4;}

            /* important */

			.bg-primary, .feature-block-v4 .feature-icon

            { background-color: '.quanto_get_option('main_color').'!important; }

			
            /*Border*/

            .btn-primary, .testimonial-carousel .owl-theme .owl-nav .owl-prev, .testimonial-carousel .owl-theme .owl-nav .owl-next,
            .testimonial-carousel-v2 .owl-theme .owl-nav .owl-prev, .testimonial-carousel-v2 .owl-theme .owl-nav .owl-next,
            .testimonial-carousel-v3 .owl-theme .owl-nav .owl-prev, .testimonial-carousel-v3 .owl-theme .owl-nav .owl-next, .btn-outline-primary,
            .team-block-v2.team-block:hover, .tagcloud a:hover, .categories-filter a:hover, .categories-filter a.active, 
            .categories-filter a:hover, .categories-filter a.active, .pricing-block-v3.pricing-block-selected-2 .btn, 
            .pricing-block-v4.pricing-block-selected .btn, .pricing-block-v5.pricing-block-selected .btn, 
            .pricing-block-v3.pricing-block-selected-2 .btn, .pricing-block-v4.pricing-block-selected .btn, 
            .pricing-block-v5.pricing-block-selected .btn, .dropcap-v5 p:first-letter, .dropcap-v6 p:first-letter

            { border-color: '.quanto_get_option('main_color').'; }

            .bb-primary-color

            { border-bottom-color: '.quanto_get_option('main_color').'!important; }

            .widget:before

            { border-top-color: '.quanto_get_option('main_color').'; }

            .blockquote-left-border

            { border-left-color: '.quanto_get_option('main_color').'; }

            .blockquote-right-border

            { border-right-color: '.quanto_get_option('main_color').'; }


		/****Second Color: #01d486****/
        
            /*Color*/

            .angle-right li:before, .btn-outline-brand, .tiny-footer ul li a:hover,
            .footer-widget .footer-second-widget ul li a:hover, .btn-outline-brand.focus, .btn-outline-brand:focus, 
            .pricing-feature-icon, .testimonial-block-v5 .testimonial-meta-name, .footer-widget ul li a:hover

            { color: '.quanto_get_option('second_color').'; }

		    /*Background Color*/

            .btn-brand, .slider .owl-theme .owl-nav .owl-prev:hover, .slider .owl-theme .owl-nav .owl-next:hover, .ins-product-carousel-v4 .owl-theme .owl-nav .owl-next:hover, .btn-outline-brand:hover,
            .ins-product-carousel-v4 .owl-theme .owl-nav .owl-prev:hover, .pricing-block-selected .btn-dark:hover, 
            .pricing-block-selected .btn-primary, .page-numbers.current, .page-numbers:hover,
            .page-item.active .page-link, .page-link:hover

            { background-color: '.quanto_get_option('second_color').'; }


            /* Border */

            .btn-brand, .btn-outline-brand, .pricing-block-selected .btn-dark:hover, 
            .pricing-block-selected .btn-primary, .page-item.active .page-link, .page-link:hover, 
            .page-numbers.current, .page-numbers:hover, .slider .owl-theme .owl-nav .owl-prev:hover,
            .slider .owl-theme .owl-nav .owl-next:hover, .ins-product-carousel-v4 .owl-theme .owl-nav .owl-next:hover,
            .ins-product-carousel-v4 .owl-theme .owl-nav .owl-prev:hover, .btn-outline-brand:hover, .btn-outline-brand.focus, .btn-outline-brand:focus

            { border-color: '.quanto_get_option('second_color').'; }

            .btn-outline-brand.focus, .btn-outline-brand:focus {background-color: transparent;}

            /*Border Color Important*/

            .border-brand

            { border-color: '.quanto_get_option('second_color').'; }

            .mfp-arrow-left:after, .mfp-arrow-left .mfp-a

            {border-right-color: '.quanto_get_option('second_color').';}

            .mfp-arrow-right:after, .mfp-arrow-right .mfp-a

            {border-left-color: '.quanto_get_option('second_color').';}



            /****Third Color: #ff5e3e****/

            .btn-outline-secondary

            {color: '.quanto_get_option('third_color').';}


            .btn-secondary, .btn-outline-secondary:hover, .btn-outline-secondary.focus, .btn-outline-secondary:focus, 
            .btn-outline-secondary:not(:disabled):not(.disabled).active, .btn-outline-secondary:not(:disabled):not(.disabled):active, 
            .show>.btn-outline-secondary.dropdown-toggle

            {background-color: '.quanto_get_option('third_color').';}


            .btn-secondary, .btn-outline-secondary, .btn-outline-secondary:hover, .btn-outline-secondary.focus, .btn-outline-secondary:focus,
            .btn-outline-secondary:not(:disabled):not(.disabled).active, .btn-outline-secondary:not(:disabled):not(.disabled):active, 
            .show>.btn-outline-secondary.dropdown-toggle

            {border-color: '.quanto_get_option('third_color').';}


            .spinner-secondary

            {border-top-color: '.quanto_get_option('third_color').';}

            .spinner-secondary

            {border-left-color: '.quanto_get_option('third_color').';}



            /*Primary Hover Color #2834bd */

            a:hover, .btn-primary-arrow-link:hover, .widget_categories ul li a:hover, .widget_archive ul li a:hover

            {color: '.quanto_get_option('main_color_hover').';}

            .btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .pricing-block-v3.pricing-block-selected-2 .btn:hover, 
            .pricing-block-v4.pricing-block-selected .btn:hover,.pricing-block-v5.pricing-block-selected .btn:hover, 
            .pricing-block-v3.pricing-block-selected-2 .btn:not(:disabled):not(.disabled).active, .cta-v4 .cta-icon,
            .pricing-block-v3.pricing-block-selected-2 .btn:not(:disabled):not(.disabled):active, 
            .show>.pricing-block-v3.pricing-block-selected-2 .btn.dropdown-toggle, #return-to-top:hover

            {background-color: '.quanto_get_option('main_color_hover').';}


            .btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .pricing-block-v3.pricing-block-selected-2 .btn:hover, 
            .pricing-block-v4.pricing-block-selected .btn:hover,.pricing-block-v5.pricing-block-selected .btn:hover ,
            .pricing-block-v3.pricing-block-selected-2 .btn:not(:disabled):not(.disabled).active, 
            .pricing-block-v3.pricing-block-selected-2 .btn:not(:disabled):not(.disabled):active, 
            .show>.pricing-block-v3.pricing-block-selected-2 .btn.dropdown-toggle

            {border-color: '.quanto_get_option('main_color_hover').';}


            /*Second Hover Color #08b072 */


            .btn-brand:hover, .btn-brand.focus, .btn-brand:focus, .pricing-block-selected .btn-primary:hover

            {background-color: '.quanto_get_option('second_color_hover').';}


            .btn-brand:hover, .btn-brand.focus, .btn-brand:focus, .pricing-block-selected .btn-primary:hover

            {border-color: '.quanto_get_option('second_color_hover').';}


            /*Third Hover Color #ea5132 */

            .text-secondary

            {color: '.quanto_get_option('third_color_hover').'!important;}


            .btn-secondary:hover, .btn-secondary.focus, .btn-secondary:focus, .btn-secondary:not(:disabled):not(.disabled).active, 
            .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle, .badge-secondary

            {background-color: '.quanto_get_option('third_color_hover').';}


            .btn-secondary:hover, .btn-secondary.focus, .btn-secondary:focus, .btn-secondary:not(:disabled):not(.disabled).active, 
            .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle

            {border-color: '.quanto_get_option('third_color_hover').';}


            .bb-secondary-color

            {border-bottom-color: '.quanto_get_option('third_color_hover').'!important;}


			';
        }

        if(! empty($color_scheme)){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}
    }
}
add_action('wp_head', 'quanto_color_scheme');