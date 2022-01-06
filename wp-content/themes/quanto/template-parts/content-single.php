<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Industro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>
    <?php if(get_the_tag_list()) { ?>
        <?php  echo get_the_tag_list('<div class="tagcloud">','','</div>'); ?>
    <?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
