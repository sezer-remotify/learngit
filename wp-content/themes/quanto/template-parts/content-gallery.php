<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="post-block">
        <!-- post classic block -->
        <?php if( function_exists( 'rwmb_meta' ) ) { ?>
        <div class="post-carousel">
            <div class="owl-post owl-carousel owl-theme">
                  <?php $images = rwmb_meta( 'images', "type=image" ); ?>
                  <?php if($images){ ?>                  
                      <?php foreach ( $images as $image ) { ?>
                        <?php $img = $image['full_url']; ?>
                        <div class="item">
                            <div class="post-img zoomimg">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($img); ?>" class="img-fluid" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
                            </div> 
                        </div>
                      <?php } ?>                                     
                  <?php } ?>
            </div>
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