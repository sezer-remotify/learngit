<?php
/**
 * Register required, recommended plugins for theme
 *
 * @link http://tgmpluginactivation.com/configuration/
 *
 * @package Quanto
 */
require_once get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php';
function quanto_register_required_plugins() {
	$protocol = is_ssl() ? 'https' : 'http';
	$plugins = array(
		array(
			'name'               => esc_html__( 'Meta Box', 'quanto' ),
			'slug'               => 'meta-box',
			'required'           => true,
		),
		array(
			'name'               => esc_html__( 'Kirki', 'quanto' ),
			'slug'               => 'kirki',
			'required'           => true,
		),
        array(
            'name'               => esc_html__( 'Contact Form 7', 'quanto' ),
            'slug'               => 'contact-form-7',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__( 'Mailchimp for WordPress', 'quanto' ),
            'slug'               => 'mailchimp-for-wp',
            'required'           => false,
        ),
		array(
            'name'               => esc_html__( 'WPBakery Page Builder', 'quanto' ), // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/js_composer.zip'), // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '6.2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),		
        array(
            'name'               => esc_html__( 'OT Portfolio', 'quanto' ), // The plugin name.
            'slug'               => 'ot_portfolio', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_portfolio.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Bank Account', 'quanto' ), // The plugin name.
            'slug'               => 'ot_bank_account', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_bank_account.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Credit Card', 'quanto' ), // The plugin name.
            'slug'               => 'ot_creditcard', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_creditcard.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Gallery', 'quanto' ), // The plugin name.
            'slug'               => 'ot_gallery', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_gallery.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Help Center', 'quanto' ), // The plugin name.
            'slug'               => 'ot_help_center', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_help_center.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Lender', 'quanto' ), // The plugin name.
            'slug'               => 'ot_lender', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_lender.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Loan', 'quanto' ), // The plugin name.
            'slug'               => 'ot_loan', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_loan.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Mortgage', 'quanto' ), // The plugin name.
            'slug'               => 'ot_mortgage', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_mortgage.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name'               => esc_html__( 'OT Team', 'quanto' ), // The plugin name.
            'slug'               => 'ot_team', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/quanto/ot_team.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(            
            'name'               => esc_html__( 'OT One Click Demo Content', 'quanto' ), // The plugin name.
            'slug'               => 'soo-demo-importer', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/soo-demo-importer.zip'), // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
	);
	$config  = array(
		'domain'       => 'quanto',
		'default_path' => '',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'quanto' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'quanto' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'quanto' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'quanto' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'quanto' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'quanto' ),
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'quanto' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'quanto' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'quanto' ),
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'quanto' ),
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'quanto' ),
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'quanto' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'quanto' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'quanto' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'quanto' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'quanto' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'quanto' ),
			'nag_type'                        => 'updated',
		),
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'quanto_register_required_plugins' );
