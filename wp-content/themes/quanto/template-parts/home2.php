<?php
/**
 * The header for our theme
 * Template Name: Home 2
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Quanto
 */

?>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if(quanto_get_option('boxed_switch')!=false){ ?><div class="boxed-layout-wrapper"><?php } ?>


    <?php get_template_part('template-parts/headers/header-2'); ?>

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