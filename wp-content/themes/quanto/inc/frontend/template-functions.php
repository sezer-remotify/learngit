<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Quanto
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function quanto_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Add a class if there is a custom header.
	if ( quanto_get_option('preload') != false ){
		$classes[] = 'royal_preloader';
	}

	return $classes;
}
add_filter( 'body_class', 'quanto_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function quanto_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'quanto_pingback_header' );

//Get layout post & page.
if ( ! function_exists( 'quanto_get_layout' ) ) :
	function quanto_get_layout() {
		// Get layout.
		if( is_page() && !is_home() && function_exists('rwmb_meta') ) {
			$page_layout = rwmb_meta('page_layout');
		}elseif( is_single() ){
			$page_layout = quanto_get_option( 'single_post_layout' );
		}else{
			$page_layout = quanto_get_option( 'blog_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'quanto_content_columns' ) ) :
	function quanto_content_columns() {

		$blog_content_width = array();

		// Check if layout is one column.
		if ( 'content-sidebar' === quanto_get_layout() ) {
			$blog_content_width[] = 'col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12';
		}elseif ('sidebar-content' === quanto_get_layout() ) {
			$blog_content_width[] = 'col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 order-last';
		}else{
			$blog_content_width[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
		}

		// return the $classes array
    	echo implode( ' ', $blog_content_width );
	}
endif;


if(function_exists('vc_add_param')){
	// Add new Param in row	

	// Add new Param in Column	
	vc_add_param('vc_column',array(
		  "type" => "dropdown",
		  "heading" => esc_html__('Pattern Column', 'quanto'),
		  "param_name" => "pattern",
		  "value" => array(   
							esc_html__('None', 'quanto') => 'none', 
							esc_html__('Pattern Left Bottom', 'quanto') => 'patternleft',
							esc_html__('Pattern Left Top', 'quanto') => 'patternlefttop', 
							esc_html__('Pattern Right Bottom', 'quanto') => 'patternright', 
							esc_html__('Pattern Right Top', 'quanto') => 'patternrighttop',  
							esc_html__('Pattern Left Bottom + Right Top', 'quanto') => 'patternleftright',
							esc_html__('Pattern Right Bottom + Left Top', 'quanto') => 'patternrightleft',
						  ),
		  "description" => esc_html__("Select Pattern , Default: None", 'quanto'),      
		) 
    );
	vc_add_param('vc_column',array(
		  "type" => "checkbox",
		  "heading" => esc_html__('z-index Big', 'quanto'),
		  "param_name" => "big_zindex",
		  "value" => '',
		  "description" => esc_html__("If checked, z-index big will used to on column", 'quanto'),      
		) 
    );
}

if(!function_exists('quanto_custom_frontend_scripts')){
    function quanto_custom_frontend_scripts(){
    ?>  
      <?php if ( quanto_get_option('preload') != false ){ ?>
        <script type="text/javascript">
            window.jQuery = window.$ = jQuery;  
            (function($) { "use strict";
            	//Preloader
				Royal_Preloader.config({
					mode           : 'logo',
					logo           : '<?php echo quanto_get_option('preload_logo'); ?>',
					logo_size      : [<?php echo quanto_get_option('preload_logo_width'); ?>, <?php echo quanto_get_option('preload_logo_height'); ?>],
					showProgress   : true,
					showPercentage : true,
			        text_colour: '<?php echo quanto_get_option('preload_text_color'); ?>',
                    background:  '<?php echo quanto_get_option('preload_bgcolor'); ?>'
				});
            })(jQuery);
        </script>
    <?php } ?>          
<?php        
    }
}
add_action('wp_footer', 'quanto_custom_frontend_scripts');