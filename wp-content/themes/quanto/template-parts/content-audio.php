<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="post-block">
        <!-- post classic block -->
        <?php if( function_exists( 'rwmb_meta' ) ) { ?>
        <div class="post-img zoomimg">
            <a href="<?php the_permalink(); ?>">
                    <?php $link_audio = get_post_meta(get_the_ID(),'link_audio', true); ?>
                    <?php if($link_audio){ ?>  
                        <iframe style="width:100%;border:none;" height="150" scrolling="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
                    <?php } ?>
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