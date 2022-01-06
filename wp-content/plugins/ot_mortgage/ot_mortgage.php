<?php
/*
	Plugin Name: OT Mortgage
	Plugin URI: http://oceanthemes.net/
	Description: Declares a plugin that will create a custom post type displaying Mortgage.
	Version: 1.0
	Author: OceanThemes
	Author URI: http://oceanthemes.net/
	Text Domain: ot_mortgage
	Domain Path: /lang
	License: GPLv2 or later
*/

/* UPDATE 
  register_activation_hook is not called when a plugin is updated
  so we need to use the following function 
*/
function ot_mortgage_update() {
	load_plugin_textdomain('ot_mortgage', FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('plugins_loaded', 'ot_mortgage_update');

function ot_mortgage_type() {
	
	$servicelabels = array (	
		'name' => __('Mortgage','ot_mortgage'),
		'singular_name' => 'Mortgage',
		'add_new' => __('Add New','ot_mortgage'),
		'add_new_item' => __('Add New','ot_mortgage'),
		'edit_item' => __('Edit Mortgage','ot_mortgage'),
		'new_item' => __('Add New','ot_mortgage'),
		'all_items' => __('All Mortgage','ot_mortgage'),
		'view_item' => __('View Mortgage','ot_mortgage'),
		'search_item' => __('Search Mortgage','ot_mortgage'),
		'not_found' => __('No Mortgage found..','ot_mortgage'),
		'not_found_in_trash' => __('No Mortgage found in Trash.','ot_mortgage'),
		'menu_name' => 'Mortgage'
	);

	$args = array(
		'labels' => $servicelabels,
		'hierarchical' => false,
		'description' => __( 'Manages Mortgage' , 'ot_mortgage' ),
		'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => null,
		'menu_icon' => 'dashicons-performance',		
		'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
		'rewrite' => array( 'slug' => __( 'Mortgage', 'ot_mortgage' ) ),        
        'capability_type' => 'post',
		'supports' => array( 'title','editor','thumbnail','excerpt','comments','custom-fields'),
	);
		register_post_type ('ot_mortgage',$args);
	}
add_action ('init','ot_mortgage_type');

function ot_mortgage_taxonomy () {
	$taxonomylabels = array(
		'name' => __('Categories','ot_mortgage'),
		'singular_name' => __('Categories','ot_mortgage'),
		'search_items' => __('Search Category','ot_mortgage'),
		'all_items' => __('All Category','ot_mortgage'),
		'edit_item' => __('Edit Category','ot_mortgage'),
		'add_new_item' => __('Add New Category','ot_mortgage'),
		'menu_name' => __('Categories','ot_mortgage'),
	);

	$args = array(
		'labels' => $taxonomylabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => __( 'Categories', 'ot_mortgage' ) ),
	);
	
	register_taxonomy('ot_mortgage_cat','ot_mortgage',$args);
}
add_action ('init','ot_mortgage_taxonomy',0);

?>