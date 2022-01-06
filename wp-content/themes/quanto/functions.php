<?php
/**
 * Quanto functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Quanto
 */

if( is_admin() ) {
    require get_template_directory() . '/inc/backend/nav-menus.php';
} else {
    require get_template_directory() . '/inc/backend/menu-walker.php'; 
}

if ( ! function_exists( 'quanto_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function quanto_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'quanto' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'quanto', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'quanto' ),
		) );

	    if( is_admin()  ) {
	      new quanto_Walker_Nav_Menu_Custom_Fields;
	    }
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'quote',
			'gallery',
			'audio',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style( array( 'css/editor-style.css', quanto_fonts_url() ) );
		
	}
endif;
add_action( 'after_setup_theme', 'quanto_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quanto_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'quanto_content_width', 640 );
}
add_action( 'after_setup_theme', 'quanto_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quanto_widgets_init() {
	/* Register the 'primary' sidebar. */
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'quanto' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Add widgets here.', 'quanto' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	/* Repeat register_sidebar() code for additional sidebars. */

	register_sidebar( array(
		'name'          => esc_html__( 'Footer First Widget Area', 'quanto' ),
		'id'            => 'footer-area-1',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'quanto' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Second Widget Area', 'quanto' ),
		'id'            => 'footer-area-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'quanto' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Third Widget Area', 'quanto' ),
		'id'            => 'footer-area-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'quanto' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Fourth Widget Area', 'quanto' ),
		'id'            => 'footer-area-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'quanto' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'quanto_widgets_init' );

/**
 * Register custom fonts.
 */
if ( ! function_exists( 'quanto_fonts_url' ) ) :
/**
 * Register Google fonts for Blessing.
 *
 * Create your own quanto_fonts_url() function to override in a child theme.
 *
 * @since Blessing 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function quanto_fonts_url() {
	$fonts_url = '';
	$font_families     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Roboto Slab, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'quanto' ) ) {
		$font_families[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
	}

	if ( $font_families ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Enqueue scripts and styles.
 */
function quanto_scripts() {
	$protocol = is_ssl() ? 'https' : 'http';

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'quanto-fonts', quanto_fonts_url(), array(), null );

	/** All frontend css files **/ 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.1.3', 'all');

	/** load fonts **/
    wp_enqueue_style( 'quanto-circular-font', get_template_directory_uri().'/fonts/circular-std/style.css');
    wp_enqueue_style( 'quanto-awesome-font', get_template_directory_uri().'/css/fontawesome/css/font-awesome.min.css');
    wp_enqueue_style( 'quanto-ionicons-font', get_template_directory_uri().'/fonts/ionicons-font/ionicons.css');
    wp_enqueue_style( 'quanto-flaticon-font', get_template_directory_uri().'/fonts/office-font/flaticon.css');
    wp_enqueue_style( 'quanto-icon-font', get_template_directory_uri().'/fonts/icon-font/font-styles.css');
    wp_enqueue_style( 'quanto-insurance-icon-font', get_template_directory_uri().'/icons/insurance/font/flaticon.css');
    wp_enqueue_style( 'quanto-development', get_template_directory_uri().'/icons/web-development/font/flaticon.css');
    wp_enqueue_style( 'quanto-digital', get_template_directory_uri().'/icons/digital-marketing/font/flaticon.css');

	/** Theme stylesheet. **/
    wp_enqueue_style( 'owl', get_template_directory_uri().'/css/owl.carousel.css');
    wp_enqueue_style( 'owl.theme.default', get_template_directory_uri().'/css/owl.theme.default.css');
    wp_enqueue_style( 'slick', get_template_directory_uri().'/css/slick.css');
    wp_enqueue_style( 'slick.theme', get_template_directory_uri().'/css/slick-theme.css');
    wp_enqueue_style( 'magnific', get_template_directory_uri().'/css/magnific-popup.css');
    wp_enqueue_style( 'data-table', get_template_directory_uri().'/css/data-table.min.css');

    if( quanto_get_option('preload') != false ){
		wp_enqueue_style( 'quanto-preload', get_template_directory_uri().'/css/royal-preload.css');
	}

	wp_enqueue_style( 'quanto-style', get_stylesheet_uri() );	
	if(quanto_get_option('theme_version')== 'dark'){
    wp_enqueue_style( 'quanto-dark', get_template_directory_uri().'/css/dark.css');
	}

	if( quanto_get_option('preload') != false ){
		wp_enqueue_script("quanto-royal-preloader", get_template_directory_uri()."/js/royal_preloader.min.js",array('jquery'), '1.0', false); 
	} 
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'popup-gallery', get_template_directory_uri() . '/js/popup-gallery.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'data-table', get_template_directory_uri() . '/js/data-table.min.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'dataTables.b4', get_template_directory_uri() . '/js/data-table-bootstrap4.min.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'quanto-main', get_template_directory_uri() . '/js/main-js.js', array( 'jquery' ), '20191404', true );
	wp_enqueue_script( 'to-top', get_template_directory_uri() . '/js/return-to-top.js', array( 'jquery' ), '20191404', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quanto_scripts' );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/frontend/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/frontend/template-functions.php';

/**
 * Custom breadcrumbs for this theme.
 */
require get_template_directory() . '/inc/frontend/breadcrumbs.php';

/**
 * Functions which add more to backend.
 */
require get_template_directory() . '/inc/backend/admin-functions.php';

/**
 * Color to backend.
 */
require get_template_directory() . '/inc/backend/color.php';

/**
 * Custom metabox for this theme.
 */
require get_template_directory() . '/inc/backend/meta-boxes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/customizer.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/backend/recent-post.php' ;

/**
 * page header.
 */
require get_template_directory() . '/inc/frontend/page-header.php';

/**
 * Register the required plugins for this theme.
 */
require get_template_directory() . '/inc/backend/plugin-requires.php';

/**
 * Customizer Menu.
 */
require_once get_template_directory() . '/inc/backend/wp_bootstrap_navwalker.php';

/**
 * Importer Demos.
 */
require_once get_template_directory() . '/inc/libs/importer.php';

/**
 * Custom shortcode plugin visual composer.
 */
require_once get_template_directory() . '/vc-shortcodes/shortcodes.php';
require_once get_template_directory() . '/vc-shortcodes/vc_shortcode.php';
