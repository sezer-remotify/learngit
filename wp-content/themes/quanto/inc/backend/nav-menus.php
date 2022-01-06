<?php
/**
 * Functions and Hooks for customize menu item
 *
 * @package quanto
 */

if( !defined( 'ABSPATH' ) ) {
	exit;
}

if( !class_exists( 'Walker_Nav_Menu_Edit' ) ) {
	require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
}

/**
 * Class to add new custom fields to menu item
 *
 * @link https://github.com/kucrut/wp-menu-item-custom-fields
 *
 * @since 1.0
 */
class quanto_Walker_Nav_Menu_Custom_Fields {
	/**
	 * Holds our custom fields
	 *
	 * @var    array
	 * @access protected
	 * @since  1.0.0
	 */
	protected $fields = array();

	/**
	 * Initialize
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'menu_walker' ) );
		add_filter( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		//add_filter( 'manage_nav-menus_columns', array( $this, 'columns' ), 99 );

		$this->fields = array(
			'mega_menu'       => esc_html__( 'Mega Menu', 'quanto' ),
			'mega_menu_width' => esc_html__( 'Mega Menu Width', 'quanto' ),
			'column'          => esc_html__( 'Column Width', 'quanto' ),
			'hide_text'       => esc_html__( 'Hide Text', 'quanto' ),
		);

		add_action( 'wp_ajax_quanto_mega_menu', array( $this, 'quanto_save_mega_menu' ) );
		add_action( 'wp_ajax_nopriv_quanto_mega_menu', array( $this, 'quanto_save_mega_menu' ) );

		add_action( 'wp_ajax_quanto_mega_fields', array( $this, 'quanto_mega_fields' ) );
		add_action( 'wp_ajax_nopriv_quanto__mega_fields', array( $this, 'quanto_mega_fields' ) );
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @since  1.0.0
	 * @param  string $hook
	 */
	public function enqueue_scripts( $hook ) {
		if( 'nav-menus.php' != $hook ) {
			return;
		}
		wp_enqueue_media();

		wp_enqueue_style( 'quanto-nav-menus', get_template_directory_uri() . '/css/nav-menus.css', array(), false );
		wp_enqueue_script( 'quanto-nav-menus', get_template_directory_uri() . '/js/nav-menus.js', array(), false );
		wp_localize_script( 'quanto-nav-menus', 'quanto', array(
			'nonce'    => wp_create_nonce( '_quanto_nonce' ),
			'megamenu' => esc_html__( 'Mega Menu', 'quanto' ),
			'savemenu' => esc_html__( 'Save Menu', 'quanto' )
		) );
	}

	/**
	 * Save custom field value
	 *
	 */
	public function quanto_save_mega_menu() {
		check_ajax_referer( '_quanto_nonce', 'lpnonce' );

		$menu_id = $_POST['menu_id'];

		foreach( $this->fields as $name => $label ) {
			$key = sprintf( 'menu-item-%s', $name );
			// Sanitize
			if( !empty($_POST[$name]) ) {
				$value = $_POST[$name];
			} else {
				$value = null;
			}
			// Update
			if( !is_null( $value ) ) {
				update_post_meta( $menu_id, $key, $value );
			} else {
				delete_post_meta( $menu_id, $key );
			}
		}

		echo wp_specialchars_decode($menu_id);

		die();
	}

	/**
	 * Print fields
	 *
	 * @return string Form fields
	 */
	public function quanto_mega_fields() {
		check_ajax_referer( '_quanto_nonce', 'lpnonce' );

		$menu_id = $_POST['menu_id'];
		$mega = get_post_meta( $menu_id, 'menu-item-mega_menu', true );
		$width = get_post_meta( $menu_id, 'menu-item-mega_menu_width', true );
		$column = get_post_meta( $menu_id, 'menu-item-column', true );
		$hide_text = get_post_meta( $menu_id, 'menu-item-hide_text', true );


		ob_start();
		?>

		<input type="hidden" id="edit-item-mega-menu-id" value="<?php echo esc_attr( $menu_id ) ?>"/>

		<div class="field-mega-menu">
			<label><?php echo wp_specialchars_decode($this->fields['mega_menu']) ?></label>
			<input type="checkbox" value="<?php echo esc_attr( $mega ); ?>"
				   id="edit-item-mega-menu" <?php checked( 1, $mega ) ?>/>
		</div>

		<div class="clear"></div>

		<div class="field-mega-menu field-mega-menu-hide-text field-not-mega-menu">
			<label><?php echo wp_specialchars_decode($this->fields['hide_text']) ?></label>
			<input type="checkbox" value="<?php echo esc_attr( $hide_text ); ?>"
				   id="edit-item-mega-menu-hide_text" <?php checked( 1, $hide_text ) ?>/>
		</div>

		<div class="field-mega-column field-mega-menu field-not-mega-menu">
			<label><?php echo wp_specialchars_decode($this->fields['column']) ?></label>
			<select id="edit-item-mega-menu-column">
				<option value="12" <?php selected( 12, $column ); ?>>1/1</option>
				<option value="6" <?php selected( 6, $column ); ?>>1/2</option>
				<option value="4" <?php selected( 4, $column ); ?>>1/3</option>
				<option value="3" <?php selected( 3, $column ); ?>>1/4</option>
				<option value="8" <?php selected( 8, $column ); ?>>2/3</option>
				<option value="9" <?php selected( 9, $column ); ?>>3/4</option>
			</select>
		</div>

		<div class="clear"></div>

		<div class="field-mega-menu-width field-mega-menu field-of-mega-menu">
			<label><?php echo wp_specialchars_decode($this->fields['mega_menu_width']) ?></label>
			<input type="text" id="edit-item-mega-menu-width" value="<?php echo esc_attr( $width ) ?>"
				   placeholder="100%"/>
		</div>

		<div class="clear"></div>

		<?php
		$output = ob_get_clean();

		wp_send_json_success( $output );

		die();
	}

	/**
	 * Add our fields to the screen options toggle
	 *
	 * @since 1.0.0
	 *
	 * @param array $columns Menu item columns
	 *
	 * @return array
	 */
	public function columns( $columns ) {
		$columns = array_merge( $columns, $this->fields );
		return $columns;
	}

	/**
	 * Replace default menu editor walker with theme's
	 *
	 * We don't actually replace the default walker. We're still using it and
	 * only injecting some HTMLs.
	 *
	 * @since   1.0.0
	 *
	 * @param   string $walker Walker class name
	 *
	 * @return  string Walker class name
	 */
	public function menu_walker( $walker ) {
		$walker = 'quanto_Walker_Nav_Menu_Edit';

		return $walker;
	}

}

/**
 * Menu item custom fields walker
 *
 * @link https://github.com/kucrut/wp-menu-item-custom-fields
 *
 * @since 1.0
 */
class quanto_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 1.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args Not used.
	 * @param int $id Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_output = '';
		parent::start_el( $item_output, $item, $depth, $args );

		$output .= preg_replace(
		// NOTE: Check this regex from time to time!
			'/(?=<p[^>]+class="[^"]*field-move)/',
			$this->get_fields( $item, $depth, $args ),
			$item_output
		);
	}

	/**
	 * Get custom fields
	 *
	 * @since 1.0.0
	 * @uses add_action() Calls 'menu_item_custom_fields' hook
	 *
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args Menu item args.
	 * @param int $id Nav menu ID.
	 *
	 * @return string Form fields
	 */
	protected function get_fields( $item, $depth, $args = array(), $id = 0 ) {
		ob_start();

		/**
		 * Get menu item custom fields from plugins/themes
		 *
		 * @since 1.0.0
		 *
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param array $args Menu item args.
		 * @param int $id Nav menu ID.
		 *
		 * @return string Custom fields
		 */
		do_action( 'wp_nav_menu_item_custom_fields', $id, $item, $depth, $args );

		return ob_get_clean();
	}
}
