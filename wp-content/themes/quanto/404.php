<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Quanto
 */

wp_head();
?>
	<div class="error-section" style="background-image:url(<?php echo esc_url(quanto_get_option('bg_404_page')); ?>)">
        <div class="container">
            <div class="row justify-content-end">
                <div class="offset-xl-1 col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 ">
                    <!-- error block start -->
                    <div class="error-block">
                        <h1 class="error-title fontweight-bold m-b-40"><?php esc_html_e('404','quanto'); ?></h1>
                        <h1 class="error-sub-title fontweight-bold"><?php esc_html_e('Page Not Found','quanto'); ?></h1>
                        <p><?php esc_html_e('We are sorry, the page you requested could not be found.
                            Please go back to the homepage or contact us at','quanto'); ?></p>
                        <div class="m-t-10 m-b-20"><a href="<?php echo esc_url(quanto_get_option('404_mailto')); ?>"><?php echo esc_attr(quanto_get_option('404_mail')); ?></a></div>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-brand btn-rounded btn-lg "><?php esc_html_e('Back to Home','quanto'); ?></a>
                    </div>
                    <!-- error block close -->
                </div>
            </div>
        </div>
    </div>

<?php
wp_footer();
