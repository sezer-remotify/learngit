<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="post-block">
        <!-- post classic block -->
        <?php if( function_exists( 'rwmb_meta' ) ) { ?>
        <div class="embed-responsive embed-responsive-16by9 rounded-top">
            <a href="<?php the_permalink(); ?>">
		            <?php echo rwmb_meta( 'link_video', 'type=oembed' ); // if you want get url: $url = get_post_meta( get_the_ID(), '_cmb_link_video', true ); echo $url; ?> 
            </a>
        </div>
        <?php } ?>
        <div class="post-content post-content-innerspace">
            <div class="meta-cat">
                <?php quanto_posted_in(); ?>
            </div>
            <h2 class="post-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
            <!-- postmeta start -->
            <div class="post-meta">
                <div class="meta">
                    <?php quanto_post_meta(); ?>
                </div>
                <!-- postmeta close -->
            </div>
        </div>
    </div>
    <!-- /.post classic block -->
</div>