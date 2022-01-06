<?php
/**
 * Template Name: Home 6
 */
?>
<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Quanto
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if(quanto_get_option('boxed_switch')!=false){ ?><div class="boxed-layout-wrapper"><?php } ?>


<div class="header-transparent">
    <!-- navigation start -->
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-transparent">
            <?php 
                $logo = quanto_get_option( 'logo' ) ? quanto_get_option( 'logo' ) : get_template_directory_uri().'/images/logo-white.png'; 
            ?>
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img src="<?php echo esc_url($logo); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-transparent" aria-controls="navbar-transparent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar top-bar mt-0"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-transparent">
                <?php
                    $primary = array(
                        'theme_location'  => 'primary',
                        'menu'            => '',
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'menu_id'         => 'primary-menu',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                        'walker'          => new quanto_Walker_Mega_Menu(),
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-3">%3$s</ul>',
                        'depth'           => 0,
                    );
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( $primary );
                    }
                ?>
                <?php if(quanto_get_option('btext_head')!=''){ ?><a href="<?php echo esc_url(quanto_get_option('blink_head')); ?>" class="btn btn-brand btn-rounded btn-sm"><?php echo esc_attr(quanto_get_option('btext_head')); ?></a><?php } ?>
            </div>
        </nav>
    </div>
</div>

<?php quanto_page_header(); ?>

    <?php if( quanto_get_layout() == 'full-content' ) :

        while ( have_posts() ) : the_post();

        the_content();

    endwhile; else : ?>

    <div class="container">
        <div class="row">
        <div id="primary" class="content-area <?php quanto_content_columns(); ?>">
            <main id="main" class="site-main">

            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php get_sidebar(); ?>
        </div>
    </div>

    <?php endif; ?>


<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Quanto
 */

?>  
<?php get_template_part('template-parts/footers/footer-2'); ?>
<?php if(quanto_get_option('boxed_switch')!=false){ ?></div><?php } ?>
<a href="javascript:" id="return-to-top" class="returntotop"><i class="fa fa-angle-up"></i></a>
    <!-- /.tiny-footer-section -->

<?php wp_footer(); ?>

</body>
</html>
