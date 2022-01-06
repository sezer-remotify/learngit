<?php
/*
	Plugin Name: OT Help Center
	Plugin URI: http://oceanthemes.net/
	Description: Declares a plugin that will create a custom post type displaying help center.
	Version: 1.0
	Author: OceanThemes
	Author URI: http://oceanthemes.net/
	Text Domain: ot-help_center
	Domain Path: /lang
	License: GPLv2 or later
*/

/* UPDATE 
  register_activation_hook is not called when a plugin is updated
  so we need to use the following function 
*/
function ot_help_center_update() {
	load_plugin_textdomain('ot-help_center', FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('plugins_loaded', 'ot_help_center_update');

add_action( 'init', 'register_ocean_help_center' );
function register_ocean_help_center() {
    /* In Permalink Settings page */	
	$slug = get_option( 'wpse30021_help_center_base' );
    if( ! $slug ) $slug = __( 'help_center', 'ot-help_center' );
	
    $labels = array( 
        'name' => __( 'Help Center', 'ot-help_center' ),
        'singular_name' => $slug, //In Permalink Settings page
		'menu_name' => __( 'Help Center', 'ot-help_center' ),
        'add_new' => __( 'Add New', 'ot-help_center' ),
        'add_new_item' => __( 'Add New Help Center', 'ot-help_center' ),
		'new_item' => __( 'New Help Center', 'ot-help_center' ),
        'edit_item' => __( 'Edit Help Center', 'ot-help_center' ),
		'view_item' => __( 'View Help Center', 'ot-help_center' ),
		'all_items' => __('All Help Center','ot-help_center'),        
        'search_items' => __( 'Search Help Center', 'ot-help_center' ),
		'parent_item_colon' => __( 'Parent Help Center:', 'ot-help_center' ),
        'not_found' => __( 'No help_center found..', 'ot-help_center' ),		
        'not_found_in_trash' => __( 'No help_center found in Trash.', 'ot-help_center' ),                
    );	

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __( 'List Help Center', 'ot-help_center' ),
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats', 'excerpt' ),
        'taxonomies' => array('categories','tags' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => null,
        'menu_icon' => 'dashicons-editor-help',
        'show_in_nav_menus' => true,
		'show_in_admin_bar'   => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => $slug ), //In Permalink Settings page
        'capability_type' => 'post'
    );
    register_post_type( 'ot_help_center', $args );
}

add_action( 'init', 'create_categories_help_hierarchical_taxonomy', 0 );
//create a custom taxonomy name it Skillss for your posts
function create_categories_help_hierarchical_taxonomy() {

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI
	$labels = array(
		'name' => __( 'Categories', 'ot-help_center' ),
		'singular_name' => __( 'Categories', 'ot-help_center' ),
		'search_items' =>  __( 'Search Categories','ot-help_center' ),
		'all_items' => __( 'All Categories','ot-help_center' ),
		'parent_item' => __( 'Parent Categories','ot-help_center' ),
		'parent_item_colon' => __( 'Parent Categories:','ot-help_center' ),
		'edit_item' => __( 'Edit Categories','ot-help_center' ), 
		'update_item' => __( 'Update Categories','ot-help_center' ),
		'add_new_item' => __( 'Add New Categories','ot-help_center' ),
		'new_item_name' => __( 'New Categories Name','ot-help_center' ),
		'menu_name' => __( 'Categories','ot-help_center' ),
	);     
	// Now register the taxonomy
	register_taxonomy('help_center_cat',array('ot_help_center'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => __( 'Categories', 'ot-help_center' ) ), //In Permalink Settings page
	));

}

add_action( 'init', 'create_tags_help_hierarchical_taxonomy', 0 );
//create a custom taxonomy name it Skillss for your posts
function create_tags_help_hierarchical_taxonomy() {
	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
		'name' => __( 'Tags', 'ot-help_center' ),
		'singular_name' => __( 'Tags', 'ot-help_center' ),
		'search_items' =>  __( 'Search Tags','ot-help_center' ),
		'all_items' => __( 'All Tags','ot-help_center' ),
		'parent_item' => __( 'Parent Tags','ot-help_center' ),
		'parent_item_colon' => __( 'Parent Tags:','ot-help_center' ),
		'edit_item' => __( 'Edit Tags','ot-help_center' ), 
		'update_item' => __( 'Update Tags','ot-help_center' ),
		'add_new_item' => __( 'Add New Tags','ot-help_center' ),
		'new_item_name' => __( 'New Tags Name','ot-help_center' ),
		'menu_name' => __( 'Tags','ot-help_center' ),
	);     
	// Now register the taxonomy
	register_taxonomy('help_center_tag',array('help_center'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => __( 'tags', 'ot-help_center' ) ), //In Permalink Settings page
	));
}

/**
 * Load template file for help center single
 *
 * @since  1.0.0
 *
 * @param  string $template
 *
 * @return string
 */
add_filter( 'template_help_include', 'include_template_help_function', 1 ); 
function include_template_help_function( $template_path ) {
    if ( get_post_type() == 'ot_help_center' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-help_center.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path(__FILE__) . 'template/single-help_center.php';
            }
        }
    }
    return $template_path;
}

// Add to admin_init function
add_filter('manage_edit-help_center_columns', 'add_new_help_center_columns');
function add_new_help_center_columns($help_center_columns) { 
	$new_columns['cb'] = '<input type="checkbox" />'; 	
	$new_columns['featured_image'] = 'Featured Image';
    $new_columns['title'] = _x('Title', 'ot-help_center');
    $new_columns['author'] = _x('Author', 'ot-help_center');
    $new_columns['taxonomy-help_center_cat'] = _x('Categories', 'ot-help_center');
	$new_columns['taxonomy-help_center_tag'] = _x('Tags', 'ot-help_center');
	$new_columns['comments'] = '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>';
    $new_columns['date'] = _x('Date', 'ot-help_center');

    return $new_columns;
}

// Add to admin_init function
add_action('manage_help_center_posts_custom_column', 'manage_help_center_columns', 10, 2);
function manage_help_center_columns($column, $post_id) {
    global $post;
    switch ($column) {
        case 'taxonomy-help_center_cat':
            $terms = get_the_terms($post_id, 'taxonomy-help_center_cat');
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s&post_type=ot_help_center">%s</a>', esc_url(add_query_arg(array(
                        'post_type' => $post->post_type,
                        'taxonomy-help_center_cat' => $term->slug
                    ), 'edit.php')), esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'taxonomy-help_center_cat', 'display')));
                }
                echo join(', ', $out);
            } else {
                _e('No Help Center Category', 'ot-help_center');
            }
            break;
        case 'taxonomy-help_center_tag':
            $terms = get_the_terms($post_id, 'taxonomy-help_center');
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $term) {
                    $out[] = sprintf('<a href="%s&post_type=ot_help_center">%s</a>', esc_url(add_query_arg(array(
                        'post_type' => $post->post_type,
                        'taxonomy-help_center_tag' => $term->slug
                    ), 'edit.php')), esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'taxonomy-help_center_tag', 'display')));
                }
                echo join(', ', $out);
            } else {
                _e('No Help Center Tag', 'ot-help_center');
            }
            break;    
        default:
            break;
    } // end switch
}

/**
 * get featured image function
 */
function help_center_featured_image($post_ID) {
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);
	if ($post_thumbnail_id) {
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
		return $post_thumbnail_img[0];
	}
}
/**
 * show featured image in column
 */
function help_center_columns_content($column_name, $post_ID) {
	if ($column_name == 'featured_image') {
		$post_featured_image = help_center_featured_image($post_ID);
		if ($post_featured_image) {
			echo '<img src="' . $post_featured_image . '" />';
		}
	}
}
add_action('manage_help_center_posts_custom_column', 'help_center_columns_content', 10, 2);

/**
 * Easy change slug cutom post type name in url to the permalink settings page.
 */
add_action( 'load-options-permalink.php', 'wpse30021_help_center_load_permalinks' );
function wpse30021_help_center_load_permalinks()
{
	if( isset( $_POST['wpse30021_help_center_base'] ) )
	{
		update_option( 'wpse30021_help_center_base', sanitize_title_with_dashes( $_POST['wpse30021_help_center_base'] ) );
	}
	
	// Add a settings field to the permalink page
	add_settings_field( 'wpse30021_help_center_base', __( 'OT Help Center base', 'ot-help_center' ), 'wpse30021_help_center_field_callback', 'permalink', 'optional' );	
}
function wpse30021_help_center_field_callback()
{
	$value = get_option( 'wpse30021_help_center_base' );	
	echo '<input type="text" value="' . esc_attr( $value ) . '" name="wpse30021_help_center_base" id="wpse30021_help_center_base" class="regular-text" />';
}

?>