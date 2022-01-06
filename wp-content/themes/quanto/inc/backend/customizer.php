<?php
/**
 * Theme customizer
 *
 * @package Quanto
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Quanto_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function quanto_get_option( $name ) {
	global $quanto_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'quanto', $name );
	} elseif ( ! empty( $quanto_customize ) ) {
		$value = $quanto_customize->get_option( $name );
	}

	return apply_filters( 'quanto_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function quanto_get_option_default( $name ) {
	global $quanto_customize;

	if ( empty( $quanto_customize ) ) {
		return false;
	}

	return $quanto_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function quanto_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'quanto_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function quanto_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'quanto',
	);

	$panels = array(
		'general'        => array(
			'priority'   => 5,
			'title'      => esc_html__( 'General', 'quanto' ),
		),        
        'header'         => array(
            'title'      => esc_html__( 'Header', 'quanto' ),
            'priority'   => 9,
            'capability' => 'edit_theme_options',
        ),
        'blog'           => array(
            'title'      => esc_html__( 'Blog', 'quanto' ),
            'priority'   => 10,
            'capability' => 'edit_theme_options',
        ),
        'footer'         => array(
            'title'      => esc_html__( 'Footer', 'quanto' ),
            'priority'   => 12,
            'capability' => 'edit_theme_options',
        ),
	);

	$sections = array(
        'preload_section'     => array(
            'title'       => esc_attr__( 'Preloader', 'quanto' ),
            'priority'    => 6,
            'capability'  => 'edit_theme_options',
        ),
        'main_header'           => array(
            'title'       => esc_html__( 'General', 'quanto' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'top_header'           => array(
            'title'       => esc_html__( 'Top Header', 'quanto' ),
            'description' => '',
            'priority'    => 16,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'logo_header'           => array(
            'title'       => esc_html__( 'Logo', 'quanto' ),
            'description' => '',
            'priority'    => 16,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'btn_header'           => array(
            'title'       => esc_html__( 'Button Header', 'quanto' ),
            'description' => '',
            'priority'    => 16,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'landing_header'           => array(
            'title'       => esc_html__( 'Header Landing', 'quanto' ),
            'description' => '',
            'priority'    => 18,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'header_styling'           => array(
            'title'       => esc_html__( 'Styling', 'quanto' ),
            'description' => '',
            'priority'    => 19,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'page_header'     => array(
            'title'       => esc_html__( 'Page Header', 'quanto' ),
            'description' => '',
            'priority'    => 9,
            'capability'  => 'edit_theme_options',
        ),
        'blog_page'           => array(
            'title'       => esc_html__( 'Blog Page', 'quanto' ),
            'description' => '',
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'panel'       => 'blog',
        ),
        'single_post'           => array(
            'title'       => esc_html__( 'Single Post', 'quanto' ),
            'description' => '',
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'panel'       => 'blog',
        ),
        'top_footer'           => array(
            'title'       => esc_html__( 'Call To Action', 'quanto' ),
            'description' => '',
            'priority'    => 20,
            'capability'  => 'edit_theme_options',
            'panel'       => 'footer',
        ),
        'main_footer'           => array(
            'title'       => esc_html__( 'Footer Content', 'quanto' ),
            'description' => '',
            'priority'    => 20,
            'capability'  => 'edit_theme_options',
            'panel'       => 'footer',
        ),
        'footer_styling'           => array(
            'title'       => esc_html__( 'Footer Styling', 'quanto' ),
            'description' => '',
            'priority'    => 21,
            'capability'  => 'edit_theme_options',
            'panel'       => 'footer',
        ),
        '404'           => array(
            'title'       => esc_html__( '404 Page', 'quanto' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
        'typography'           => array(
            'title'       => esc_html__( 'Typography', 'quanto' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
        'styling'           => array(
            'title'       => esc_html__( 'Styling', 'quanto' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
	);

	$fields = array(

        // Preloader Setting
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'quanto' ),
            'section'     => 'preload_section',
            'default'     => '1',
            'priority'    => 10,
        ),
        'preload_logo'    => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo Preload', 'quanto' ),
            'section'  => 'preload_section',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.png',
            'priority' => 11,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_width'     => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Width', 'quanto' ),
            'section'  => 'preload_section',
            'default'  => 132,
            'priority' => 12,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_height'    => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Height', 'quanto' ),
            'section'  => 'preload_section',
            'default'  => 34,
            'priority' => 13,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'quanto' ),
            'section'  => 'preload_section',
            'default'  => '#0a0f2b',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'quanto' ),
            'section'  => 'preload_section',
            'default'  => '#fff',
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Preload Font', 'quanto' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => 'Roboto',
                'variant'        => 'regular',
                'font-size'      => '13px',
                'line-height'    => '40px',
                'letter-spacing' => '2px',
                'subsets'        => array( 'latin-ext' ),                
                'text-transform' => 'none',
                'text-align'     => 'center'
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_logo .royal_preloader_percentage',
                ),
            ),
        ),

        // Main Header
        'header_layout'    => array(
            'type'        => 'select',
            'label'       => esc_attr__( 'Header Layout', 'quanto' ),
            'section'     => 'main_header',
            'default'     => 'header1',
            'priority'    => 1,
            'multiple'    => 1,
            'choices'     => array(
                'header1' => esc_attr__( 'Header Layout 1', 'quanto' ),
                'header2' => esc_attr__( 'Header Layout 2', 'quanto' ),
                'header3' => esc_attr__( 'Header Layout 3', 'quanto' ),
            ),
        ),
        'width_head'    => array(
            'type'        => 'select',
            'label'       => esc_attr__( 'Width header', 'quanto' ),
            'section'     => 'main_header',
            'priority'    => 1,
            'default'     => 'default',
            'choices'     => array(
                'default' => esc_attr__( 'Default', 'quanto' ),
                'full'    => esc_attr__( 'Fullwidth', 'quanto' ),
            ),
        ),
        'topbar_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Top Bar On/Off?', 'quanto' ),
            'section'     => 'main_header',
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
            'default'     => 1,
            'priority'    => 10,
        ),

        //Top Header
        'info_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Contact Info On/Off?', 'quanto' ),
            'section'     => 'top_header',
            'default'     => 1,
            'priority'    => 3,
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
        ),
        'left_content'     => array(
            'type'        => 'textarea',
            'label'       => esc_attr__( 'Left Content', 'quanto' ),
            'section'     => 'top_header',
            'default'     => '',
            'priority'    => 3,
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
        ),
        'header_contact_info'     => array(
            'type'     => 'repeater',
            'label'    => esc_html__( 'Contact Info', 'quanto' ),
            'section'  => 'top_header',
            'priority' => 4,
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
            'active_callback' => array(
                array(
                    'setting'  => 'info_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'row_label' => array(
                'type' => 'field',
                'value' => esc_attr__('Contact Info', 'quanto' ),
                'field' => 'info_name',
            ),
            'default'  => array(),
            'fields'   => array(
                'add_class' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Extra class name', 'quanto' ),
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'quanto' ),
                    'default'     => '',
                ),
                'info_icon' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Icon class name', 'quanto' ),
                    'description' => esc_html__( 'This will be the contact info icon: https://fontawesome.com/icons/ , ex: fas fa-phone', 'quanto' ),
                    'default'     => '',
                ),
                'info_content' => array(
                    'type'        => 'textarea',
                    'label'       => esc_html__( 'Contact info content', 'quanto' ),
                    'description' => esc_html__( 'This will be the contact info content', 'quanto' ),
                    'default'     => '',
                ),
            ),
        ),
        'head_info_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Socials Info On/Off?', 'quanto' ),
            'section'     => 'top_header',
            'default'     => 1,
            'priority'    => 4,
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
        ),
        'head_contact_info'     => array(
            'type'     => 'repeater',
            'label'    => esc_html__( 'Socials', 'quanto' ),
            'section'  => 'top_header',
            'priority' => 4,
            'active_callback' => array(
                array(
                    'setting'  => 'head_info_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'default'  => array(),
            'fields'   => array(
                'info_link' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Social Link', 'quanto' ),
                    'description' => esc_html__( 'This will be the contact info name', 'quanto' ),
                    'default'     => '',
                ),
                'info_icon' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Icon class name', 'quanto' ),
                    'description' => esc_html__( 'This will be the contact info icon: https://fontawesome.com/icons/ , ex: fa fa-phone', 'quanto' ),
                    'default'     => '',
                ),
            ),
        ),

        //Button Header
        'btext_head'     => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Button text', 'quanto' ),
            'section'     => 'btn_header',
            'default'     => '',
            'priority'    => 3,
        ),
        'blink_head'     => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Button Link', 'quanto' ),
            'section'     => 'btn_header',
            'default'     => '',
            'priority'    => 3,
        ),

        //Logo
        'logo'         => array(
            'type'     => 'image',
            'label'    => esc_attr__( 'Logo Image', 'quanto' ),
            'section'  => 'logo_header',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.png',
            'priority' => 3,
        ),
        'logo_width'     => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Width(px)', 'quanto' ),
            'section'  => 'logo_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.navbar-brand img',
                    'property' => 'width',
                    'units'	   => 'px'
                ),
            ),
        ),
        'logo_height'    => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Height(px)', 'quanto' ),
            'section'  => 'logo_header',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.navbar-brand img',
                    'property' => 'height',
                    'units'	   => 'px'
                ),
            ),
        ),
        'logo_position'  => array(
            'type'     => 'spacing',
            'label'    => esc_html__( 'Logo Margin', 'quanto' ),
            'section'  => 'logo_header',
            'priority' => 10,
            'default'  => array(
                'top'    => '0',
                'bottom' => '0',
                'left'   => '0',
                'right'  => '0',
            ),
            'output'    => array(
                array(
                    'element'  => '.navbar-brand img',
                    'property' => 'margin',
                ),
            ),
        ),

        //Header Landing
        'infoland_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Info On/Off?', 'quanto' ),
            'section'     => 'landing_header',
            'default'     => 1,
            'priority'    => 4,
            'description' => esc_html__( 'Use for template landing', 'quanto' ),
        ),
        'headerld_info'     => array(
            'type'     => 'repeater',
            'label'    => esc_html__( 'Info', 'quanto' ),
            'section'  => 'landing_header',
            'priority' => 4,
            'description' => esc_html__( 'Use for template landing', 'quanto' ),
            'active_callback' => array(
                array(
                    'setting'  => 'infoland_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'default'  => array(),
            'fields'   => array(
                'link' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link', 'quanto' ),
                    'default'     => '',
                ),
                'btn' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Text', 'quanto' ),
                    'default'     => '',
                ),
            ),
        ),
        'btext_land'     => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Button text', 'quanto' ),
            'section'     => 'landing_header',
            'default'     => '',
            'priority'    => 3,
            'description' => esc_html__( 'Use for template landing', 'quanto' ),
        ),
        'blink_land'     => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Button Link', 'quanto' ),
            'section'     => 'landing_header',
            'default'     => '',
            'priority'    => 3,
            'description' => esc_html__( 'Use for template landing', 'quanto' ),
        ),

        //Styling
        'bg_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Top Bar', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
            'output'    => array(
                array(
                    'element'  => '.top-header',
                    'property' => 'background'
                ),
            ),
        ),
        'color_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Text Top Bar', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
            'output'    => array(
                array(
                    'element'  => '.top-header, .top-header ul li a',
                    'property' => 'color'
                ),
            ),
        ),
        'bo_color_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Border Top Bar', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'description' => esc_html__( 'Use for header layout 1', 'quanto' ),
            'output'    => array(
                array(
                    'element'  => '.top-header',
                    'property' => 'border-top-color'
                ),
            ),
        ),
        'separator_1'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'bg_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Navigation', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.header-classic, .navbar-boxed, .header-transparent',
                    'property' => 'background'
                ),
            ),
        ),
        'color_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Link Menu', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.navbar-classic .navbar-nav .nav-item .nav-link, .navbar-boxed .navbar-nav .nav-link, .navbar-transparent .navbar-nav .nav-item .nav-link',
                    'property' => 'color'
                ),
            ),
        ),
        'color_hover_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Hover Link Menu', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.dropdown-item:focus, .dropdown-item:hover, .navbar-classic .navbar-nav .nav-item .nav-link:hover, .navbar-classic .navbar-nav .nav-item .nav-link:hover.dropdown-toggle::after, .dropdown-item:focus .dropdown-toggle::after, .dropdown-item:hover.dropdown-toggle::after',
                    'property' => 'color'
                ),
            ),
        ),
        'bo_botcolor_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Color Bottom Link Menu', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.navbar-classic .navbar-nav .nav-item .nav-link',
                    'property' => 'border-bottom-color'
                ),
            ),
        ),
        'separator_2'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'bg_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Dropdown Menu', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.dropdown-menu',
                    'property' => 'background'
                ),
            ),
        ),
        'color_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Link Dropdown Menu', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.dropdown-item',
                    'property' => 'color'
                ),
            ),
        ),
        'bo_color_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Dropdown Menu', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.dropdown-menu',
                    'property' => 'border-color'
                ),
            ),
        ),
        'separator_4'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'bg_menu_sticky'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Navigation Scroll', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'description' => esc_html__( 'Use for header layout 2+3', 'quanto' ),
            'output'    => array(
                array(
                    'element'  => '.header-boxed-collapse, .header-collapse, .header-boxed-collapse .navbar-boxed',
                    'property' => 'background'
                ),
            ),
        ),
        'color_menu_sticky'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Link Menu croll', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'description' => esc_html__( 'Use for header layout 2+3', 'quanto' ),
            'output'    => array(
                array(
                    'element'  => '.header-boxed-collapse .navbar-boxed .navbar-nav .nav-link, .header-collapse .navbar-transparent .navbar-nav .nav-item .nav-link',
                    'property' => 'color'
                ),
            ),
        ),
        'bobot_menu_sticky'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Color Bottom Navigation Scroll', 'quanto' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 10,
            'description' => esc_html__( 'Use for header layout 2+3', 'quanto' ),
            'output'    => array(
                array(
                    'element'  => '.header-boxed-collapse',
                    'property' => 'border-bottom-color'
                ),
            ),
        ),
        'separator_3'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'menu_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Font Style', 'quanto' ),
            'section'  => 'header_styling',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '400',
                'subsets'        => array( 'latin-ext' ),
                'font-size'      => '15px',
                'text-transform' => 'none',
            ),
        ),

        //Page Header
        'pheader_switch'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Page Header On/Off?', 'quanto' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'breadcrumbs'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Breadcrumbs On/Off?', 'quanto' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'pheader_img'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Image', 'quanto' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
        ),
        'pheader_subheader'     => array(
            'type'        => 'textarea',
            'label'       => esc_html__( 'Subtitle Subheader', 'quanto' ),
            'section'     => 'page_header',
            'default'     => '',
            'priority'    => 10,
        ),

        // Blog Page
        'blog_layout'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Blog Layout', 'quanto' ),
            'section'     => 'blog_page',
            'default'     => 'content-sidebar',
            'priority'    => 9,
            'description' => esc_html__( 'Select default sidebar for the blog page.', 'quanto' ),
            'choices'     => array(
                'content-sidebar' => esc_html__( 'Right Sidebar', 'quanto' ),
                'sidebar-content' => esc_html__( 'Left Sidebar', 'quanto' ),
                'full-content'    => esc_html__( 'Full Content', 'quanto' ),
            )
        ),
        // Single Post
        'single_post_layout'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Single Post Layout', 'quanto' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'description' => esc_html__( 'Select default sidebar for the single post page.', 'quanto' ),
            'choices'     => array(
                'content-sidebar' => esc_html__( 'Right Sidebar', 'quanto' ),
                'sidebar-content' => esc_html__( 'Left Sidebar', 'quanto' ),
                'full-content'    => esc_html__( 'Full Content', 'quanto' ),
            ),
        ),
        'bg_single_pheader'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Image Page Header', 'quanto' ),
            'section'  => 'single_post',
            'default'  => '',
            'priority' => 10,
        ),
        'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'quanto' ),
            'section'  => 'single_post',
            'default'  => array( 'date', 'author', 'cat' ),
            'choices'  => array(
                'cmt'     => esc_html__( 'Comment', 'quanto' ),
                'date'    => esc_html__( 'Date', 'quanto' ),
                'author'  => esc_html__( 'Author', 'quanto' ),
            ),
            'priority' => 10,
        ),
        'post_custom_field_1'          => array(
            'type'    => 'custom',
            'section' => 'single_post',
            'default' => '<hr/>',
        ),
        'author_block'       => array(
            'type'        => 'toggle',
            'section'     => 'single_post',
            'label'       => esc_html__( 'Author Block', 'quanto' ),
            'description' => esc_html__( 'Enable Author Block', 'quanto' ),
            'default'     => true,
        ),
        'btext_author' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Button Text On Author Block', 'quanto' ),
            'section'     => 'single_post',
            'default'     => '',
            'active_callback' => array(
                array(
                    'setting'  => 'author_block',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'post_related'       => array(
            'type'        => 'toggle',
            'section'     => 'single_post',
            'label'       => esc_html__( 'Related Posts', 'quanto' ),
            'description' => esc_html__( 'Enable related posts.', 'quanto' ),
            'default'     => true,
        ),
        'relate_title' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Title On Section Related Post', 'quanto' ),
            'section'     => 'single_post',
            'default'     => '',
            'active_callback' => array(
                array(
                    'setting'  => 'post_related',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'num_show_related' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Number Show Related Post', 'quanto' ),
            'section'     => 'single_post',
            'default'     => '2',
            'active_callback' => array(
                array(
                    'setting'  => 'post_related',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'cat_show'       => array(
            'type'        => 'toggle',
            'section'     => 'single_post',
            'label'       => esc_html__( 'Show Category On Relate Post', 'quanto' ),
            'description' => esc_html__( 'Enable show category.', 'quanto' ),
            'default'     => true,
            'active_callback' => array(
                array(
                    'setting'  => 'post_related',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

        //404 Page
        'bg_404_page'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Page', 'quanto' ),
            'section'  => '404',
            'default'  => '',
            'priority' => 3,
        ),
        '404_mail' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'E-mail Address', 'quanto' ),
            'section'     => '404',
            'default'     => '',
            'priority'    => 4,
        ),
        '404_mailto' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Link For Mail', 'quanto' ),
            'section'     => '404',
            'default'     => '',
            'priority'    => 4,
        ),

        // Footer Call To Action
        'footer_cta_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Call To Action On/Off?', 'quanto' ),
            'section'     => 'top_footer',
            'default'     => 1,
            'priority'    => 3,
        ),
        'tit_cta' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Title In Call To Action Section', 'quanto' ),
            'section'     => 'top_footer',
            'default'     => '',
            'priority'    => 4,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_cta_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'sub_cta' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Subtitle In Call To Action Section', 'quanto' ),
            'section'     => 'top_footer',
            'default'     => '',
            'priority'    => 5,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_cta_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'btext_cta' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Button Text In Call To Action Section', 'quanto' ),
            'section'     => 'top_footer',
            'default'     => '',
            'priority'    => 6,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_cta_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'blink_cta' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Button Link In Call To Action Section', 'quanto' ),
            'section'     => 'top_footer',
            'default'     => '',
            'priority'    => 7,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_cta_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'mail_cta' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Email Address In Call To Action Section', 'quanto' ),
            'section'     => 'top_footer',
            'default'     => '',
            'priority'    => 8,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_cta_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'link_mail_cta' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Link Send E-mail', 'quanto' ),
            'section'     => 'top_footer',
            'default'     => '',
            'priority'    => 9,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_cta_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        // Footer Content
        'footer_layout'    => array(
            'type'        => 'select',
            'label'       => esc_attr__( 'Footer Layout', 'quanto' ),
            'section'     => 'main_footer',
            'default'     => 'footer1',
            'priority'    => 1,
            'multiple'    => 1,
            'choices'     => array(
                'footer1' => esc_attr__( 'Footer Layout 1', 'quanto' ),
                'footer2' => esc_attr__( 'Footer Layout 2', 'quanto' ),
            ),
        ),
		'footer-select-pages'     => array(
			'type'        => 'dropdown-pages',
			'label'       => esc_html__( 'Footer page', 'quanto' ),
			'section'     => 'main_footer',
			'default'     => '',
			'priority'    => 1,
		),
        'footer_info_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Footer Contact Info On/Off?', 'quanto' ),
            'section'     => 'main_footer',
            'default'     => 1,
            'priority'    => 3,
        ),
        'footer_contact_info'     => array(
            'type'     => 'repeater',
            'label'    => esc_html__( 'Footer Contact Info', 'quanto' ),
            'section'  => 'main_footer',
            'priority' => 4,
            'active_callback' => array(
                array(
                    'setting'  => 'footer_info_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'default'  => array(),
            'fields'   => array(
                'info_link' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Social Link', 'quanto' ),
                    'description' => esc_html__( 'This will be the contact info name', 'quanto' ),
                    'default'     => '',
                ),
                'info_icon' => array(
                    'type'        => 'text',
                    'label'       => esc_html__( 'Icon class name', 'quanto' ),
                    'description' => esc_html__( 'This will be the contact info icon: https://fontawesome.com/icons/ , ex: fa fa-phone', 'quanto' ),
                    'default'     => '',
                ),
            ),
        ),
        'copyright'     => array(
            'type'        => 'editor',
            'label'       => esc_attr__( 'Copyright', 'quanto' ),
            'section'     => 'main_footer',
            'priority'    => 6,
        ),

        //Footer Styling
        'bg_footer'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Top Footer', 'quanto' ),
            'section'  => 'footer_styling',
            'priority' => 1,
            'output'    => array(
                array(
                    'element'  => '.footer, .footer-second, .footer-pattern-slide',
                    'property' => 'background',
                ),
            ),
        ),
        'color_footer' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Top Footer', 'quanto' ),
            'section'  => 'footer_styling',
            'priority' => 2,
            'output'    => array(
                array(
                    'element'  => '.footer, .footer-widget ul li a, .footer-second, .footer-widget .footer-second-widget ul li a',
                    'property' => 'color',
                ),
            ),
        ),
        'cta_separator'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'footer_styling',
            'default'     => '<hr>',
            'priority'    => 3,
        ),
        'bg_bfooter'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Bottom Footer', 'quanto' ),
            'section'  => 'footer_styling',
            'priority' => 4,
            'output'    => array(
                array(
                    'element'  => '.tiny-footer',
                    'property' => 'background',
                ),
            ),
        ),
        'color_bfooter' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Top Footer', 'quanto' ),
            'section'  => 'footer_styling',
            'priority' => 5,
            'output'    => array(
                array(
                    'element'  => '.tiny-footer, .tiny-footer ul li a, .footer-second .tiny-footer, .footer-second .tiny-footer ul li a',
                    'property' => 'color',
                ),
            ),
        ),

        // Typography
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body', 'quanto' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '400',
                'font-size'      => '15px',
                'line-height'    => '20px',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#808294',
                'text-transform' => 'none',
            ),
        ),
        'heading1_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'quanto' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '500',
                'font-size'      => '42px',
                'line-height'    => '54px',
                'letter-spacing' => '-1px',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#181825',
                'text-transform' => 'none',
            ),
        ),
        'heading2_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'quanto' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '500',
                'font-size'      => '34px',
                'line-height'    => '44px',
                'letter-spacing' => '-1px',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#181825',
                'text-transform' => 'none',
            ),
        ),
        'heading3_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'quanto' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '500',
                'font-size'      => '26px',
                'line-height'    => '30px',
                'letter-spacing' => '-1px',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#181825',
                'text-transform' => 'none',
            ),
        ),
        'heading4_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'quanto' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '500',
                'font-size'      => '20px',
                'line-height'    => '31px',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#181825',
                'text-transform' => 'none',
            ),
        ),
        'heading5_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'quanto' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '500',
                'font-size'      => '16px',
                'line-height'    => '21px',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#181825',
                'text-transform' => 'none',
            ),
        ),
        'heading6_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'quanto' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => 'Circular Std Book',
                'variant'        => '500',
                'font-size'      => '13px',
                'line-height'    => '21px',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),
                'color'          => '#181825',
                'text-transform' => 'none',
            ),
        ),

        //Styling
        'theme_version'           => array(
            'type'        => 'select',
            'label'       => esc_html__( 'Theme Version', 'quanto' ),
            'section'     => 'styling',
            'default'     => 'light',
            'priority'    => 1,
            'description' => esc_html__( 'Select theme version', 'quanto' ),
            'choices'     => array(
                'light' => esc_html__( 'Light Version', 'quanto' ),
                'dark' => esc_html__( 'Dark Version', 'quanto' ),
            ),
        ),
        'boxed_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Boxed Layout', 'quanto' ),
            'section'     => 'styling',
            'default'     => 1,
            'priority'    => 10,
        ),
        'separator_s1'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'color_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color Body', 'quanto' ),
            'section'  => 'styling',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body',
                    'property' => 'color',
                ),
            ),
        ),
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'quanto' ),
            'section'  => 'styling',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body',
                    'property' => 'background-color',
                ),
            ),
        ),
        'separator_s2'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'quanto' ),
            'section'  => 'styling',
            'default'  => '#3544ee',
            'priority' => 10,
        ),
        'second_color' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Second Color', 'quanto' ),
            'section'  => 'styling',
            'default'  => '#01d486',
            'priority' => 10,
        ),
        'third_color' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Third Color', 'quanto' ),
            'section'  => 'styling',
            'default'  => '#ff5e3e',
            'priority' => 10,
        ),
        'separator_s3'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'main_color_hover'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Hover Color', 'quanto' ),
            'section'  => 'styling',
            'default'  => '#2834bd',
            'priority' => 10,
        ),
        'second_color_hover'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Second Hover Color', 'quanto' ),
            'section'  => 'styling',
            'default'  => '#08b072',
            'priority' => 10,
        ),
        'third_color_hover'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Third Hover Color', 'quanto' ),
            'section'  => 'styling',
            'default'  => '#ea5132',
            'priority' => 10,
        ),
    );

	$settings['panels']   = apply_filters( 'quanto_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'quanto_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'quanto_customize_fields', $fields );

	return $settings;
}

$quanto_customize = new Quanto_Customize( quanto_customize_settings() );