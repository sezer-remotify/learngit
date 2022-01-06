<?php
/**
 * The template for displaying all pages
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quanto
 */

get_header('landing');
?>

    <?php while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; ?>


<?php
get_footer();