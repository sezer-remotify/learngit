<?php

//Admin Style
if ( ! function_exists( 'quanto_custom_wp_admin_style' ) ) :
    function quanto_custom_wp_admin_style() {
        wp_register_style( 'quanto_custom_wp_admin_css', get_template_directory_uri() . '/inc/backend/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'quanto_custom_wp_admin_css' );
        wp_enqueue_script( 'quanto-backend-js', get_template_directory_uri()."/inc/backend/js/admin-script.js", array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'quanto-backend-js' );
    }
    add_action( 'admin_enqueue_scripts', 'quanto_custom_wp_admin_style' );
endif;

//Typography Settings
if ( ! function_exists( 'quanto_typography_css' ) ) :
    /**
     * Get typography CSS base on settings
     *
     * @since 1.1.6
     */
    function quanto_typography_css() {
        $css        = '';
        $properties = array(
            'font-family'    => 'font-family',
            'font-size'      => 'font-size',
            'variant'        => 'font-weight',
            'line-height'    => 'line-height',
            'letter-spacing' => 'letter-spacing',
            'color'          => 'color',
            'text-transform' => 'text-transform',
        );

        $settings = array(
            'body_typo'          => 'body, p',
            'heading1_typo'      => 'h1',
            'heading2_typo'      => 'h2',
            'heading3_typo'      => 'h3',
            'heading4_typo'      => 'h4',
            'heading5_typo'      => 'h5',
            'heading6_typo'      => 'h6',
            'menu_typo'          => '.navbar-classic .navbar-nav .nav-item .nav-link, .dropdown-item',
        );

        foreach ( $settings as $setting => $selector ) {
            $typography = quanto_get_option( $setting );
            $default    = (array) quanto_get_option_default( $setting );
            $style      = '';

            foreach ( $properties as $key => $property ) {
                if ( isset( $typography[ $key ] ) && ! empty( $typography[ $key ] ) ) {
                    if ( isset( $default[ $key ] ) && strtoupper( $default[ $key ] ) == strtoupper( $typography[ $key ] ) ) {
                        continue;
                    }
                    $value = 'font-family' == $key ? '"' . rtrim( trim( $typography[ $key ] ), ',' ) . '"' : $typography[ $key ];
                    $value = 'variant' == $key ? str_replace( 'regular', '400', $value ) : $value;

                    if ( $value ) {
                        $style .= $property . ': ' . $value . ';';
                    }
                }
            }

            if ( ! empty( $style ) ) {
                $css .= $selector . '{' . $style . '}';
            }
        }

        $css .= quanto_get_heading_typography_css();

        return $css;
    }
endif;

/**
 * Returns CSS for the typography.
 *
 *
 * @param array $body_typo Color scheme body typography.
 *
 * @return string typography CSS.
 */
function quanto_get_heading_typography_css() {

    $headings   = array(
        'h1' => 'heading1_typo',
        'h2' => 'heading2_typo',
        'h3' => 'heading3_typo',
        'h4' => 'heading4_typo',
        'h5' => 'heading5_typo',
        'h6' => 'heading6_typo',
    );
    $inline_css = '';
    foreach ( $headings as $heading ) {
        $keys = array_keys( $headings, $heading );
        if ( $keys ) {
            $inline_css .= quanto_get_heading_font( $keys[0], $heading );
        }
    }

    return $inline_css;

}

/**
 * Returns CSS for the typography.
 *
 *
 * @param array $body_typo Color scheme body typography.
 *
 * @return string typography CSS.
 */
function quanto_get_heading_font( $key, $heading ) {

    $inline_css   = '';
    $heading_typo = quanto_get_option( $heading );

    if ( $heading_typo ) {
        if ( isset( $heading_typo['font-family'] ) && strtolower( $heading_typo['font-family'] ) !== 'poppins' ) {
            $typo       = rtrim( trim( $heading_typo['font-family'] ), ',' );
            $inline_css .= $key . '{font-family:' . $typo . ', Arial, sans-serif}';

            if ( isset( $heading_typo['variant'] ) ) {
                $inline_css .= $key . '.vc_custom_heading{font-weight:' . $heading_typo['variant'] . '}';
            }
        }
    }

    if ( empty( $inline_css ) ) {
        return;
    }

    return <<<CSS
    {$inline_css}
CSS;
}

//Custom Style Frontend
if(!function_exists('quanto_custom_frontend_style')){

    function quanto_custom_frontend_style(){
        $style_css 	= '';
        $style_css .= quanto_typography_css();

        if(! empty($style_css)){
            echo '<style type="text/css">'.$style_css.'</style>';
        }
    }
}
add_action('wp_head', 'quanto_custom_frontend_style');