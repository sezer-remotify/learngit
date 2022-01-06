<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Quanto
 */

get_header();
?>
<div class="content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area <?php quanto_content_columns(); ?>">
                <div class="">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- post single start -->
                            <div class="post-content-single ">
								<?php
				                while ( have_posts() ) :
				                    the_post();

				                    get_template_part( 'template-parts/content-single', get_post_type() );

				                    //the_post_navigation();

				                endwhile; // End of the loop.
				                ?>
							</div>
						</div>
						<!-- author-block -->
						<?php if(quanto_get_option('author_block')!=false){ ?>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- post auhtor start -->
                            <div class="post-author-block">
                                <div class="author-img"><?php echo get_avatar($comment,$size='116',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=180', array('class' => 'rounded-circle' ) ); ?></div>
                                <div class="author-box">
                                    <div class="author-content">
                                        <h3 class="author-title"><?php the_author(); ?></h3>
                                        <p class="mb10"><?php the_author_meta('description'); ?></p>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="btn btn-brand btn-rounded"><?php echo esc_attr(quanto_get_option('btext_author')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- post author close -->
                        <!-- related-post-block -->
                        <?php if(quanto_get_option('post_related')==true){ ?>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-40">
                            <div class="related-post-block">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h3><?php echo esc_attr(quanto_get_option('relate_title')); ?></h3>
                                    </div>
                                    <!-- related post start  -->
		              				<?php
		    						$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => ''.esc_attr(quanto_get_option('num_show_related')).'', 'post__not_in' => array($post->ID) ) );
		    						if( $related ) foreach( $related as $post ) 
		    						{
		    						setup_postdata($post); ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="related-post">
                                            <div class="related-img zoomimg">
                                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?></a>
                                            </div>
                                            <h4 class="realted-title"><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a></h4>
                                            <?php if(quanto_get_option('cat_show')==true){ ?>
                                            <?php if(has_category()) { ?>
                                        	<p class="related-post-meta"><span><?php esc_html_e('in','quanto'); ?> <span class="related-category">"<?php the_category(' , ', ' '); ?>"</span></span></p>
                                        	<?php } } ?>
                                        </div>
                                    </div>
		    						<?php }
		    						wp_reset_postdata(); ?>
                                    <!-- related-post close -->
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- /.related-post-block -->

						<?php if ( comments_open() || get_comments_number() ) : ?>
					            <?php comments_template(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>
<?php
get_footer();
