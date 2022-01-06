<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Quanto
 */

if ( quanto_get_layout() === 'full-content' ) {
	return;
}

$sidebar = 'primary';

if ( ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside id="primary-sidebar" class="widget-area primary-sidebar col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
	 <div class="sidebar">
		<?php dynamic_sidebar( $sidebar ); ?>
	</div>
</aside><!-- #secondary -->
