<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quanto
 */

get_header(); ?>

<div class="content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area <?php quanto_content_columns(); ?>">
				<div class="row">

				<?php if ( have_posts() ) : ?>

					<?php
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

				<?php	else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>

				</div><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>
<?php
get_footer();

