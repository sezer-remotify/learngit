<?php
/**
 * Template Name: Home 4
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


<div class="header-classic">
    <!-- top header start -->
    <?php if ( quanto_get_option('topbar_switch') != false ){ ?>
    <div class="top-header">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 d-none d-xl-block d-lg-block d-md-block order-1">
                    <p><?php echo esc_attr(quanto_get_option('left_content')); ?></p>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 order-12">
                    <div class="d-flex justify-content-end">
                        <?php if ( quanto_get_option('info_switch') != false ){ ?>
                        <div class="">
                            <ul class="list-unstyled">
                                <?php $contact_infos = quanto_get_option( 'header_contact_info', array() ); ?>
                                <?php foreach ( $contact_infos as $contact_info ) { ?>
                                    <li class="<?php echo esc_attr($contact_info['add_class']); ?>">
                                        <i class="<?php echo esc_attr($contact_info['info_icon']); ?>"></i><?php echo wp_specialchars_decode($contact_info['info_content']); ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                        <?php if ( quanto_get_option('head_info_switch') != false ){ ?>
                        <div class="top-header-social">
                            <ul class="list-unstyled">
                                <?php $hcontact_infos = quanto_get_option( 'head_contact_info', array() ); ?>
                                <?php foreach ( $hcontact_infos as $hcontact_info ) { ?>
                                    <li><a href="<?php echo esc_attr($hcontact_info['info_link']); ?>"><i class="<?php echo esc_attr($hcontact_info['info_icon']); ?>"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- top header close -->

    <!-- navigation start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <nav class="navbar navbar-expand-lg navbar-light navbar-classic navbar-bank">
                    <?php 
                        $logo = quanto_get_option( 'logo' ) ? quanto_get_option( 'logo' ) : get_template_directory_uri().'/images/logo.png'; 
                    ?>
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img src="<?php echo esc_url($logo); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-classic" aria-controls="navbar-classic" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar top-bar mt-0"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-classic">
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
                                'items_wrap'      => '<ul class="navbar-nav mt-2 mt-lg-0 mr-xl-3 ml-xl-5">%3$s</ul>',
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
get_footer();