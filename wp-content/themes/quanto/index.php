<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quanto
 */

get_header();
?>
<div class="content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area <?php quanto_content_columns(); ?>">
				<div class="row">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;
					?>
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<nav aria-label="Page navigation example">
							<?php quanto_posts_navigation(); ?>
						</nav>
					</div>

					<?php else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
				?>
				</div>
			</div><!-- #primary -->

			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>

<?php
get_footer();