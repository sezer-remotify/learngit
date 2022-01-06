<?php
/**
 * Template Name: Template Blog Masonry
 */
get_header(); ?>

  <!-- content begin -->
<div class="content">
  <div class="container">
    <div class="row isotope">
      <?php 
        $args = array(    
          'paged' => $paged,
          'post_type' => 'post',
          'posts_per_page' => 9,
          );
        $wp_query = new WP_Query($args);
        while ($wp_query -> have_posts()): $wp_query -> the_post();  ?>
        <?php $format = get_post_format(); ?>
        <div class="col-md-4 post-masonry">
          <div class="post-block">
            <?php if($format=='audio'){ ?>
            <?php if( function_exists( 'rwmb_meta' ) ) { $link_audio = get_post_meta(get_the_ID(),'link_audio', true); ?>  
            <div class="post-audio">
              <iframe style="width:100%" src="<?php echo esc_url( $link_audio ); ?>"></iframe>      
            </div>
            <?php } ?>
            <?php } elseif($format=='video'){ ?>
            <?php if( function_exists( 'rwmb_meta' ) ) {  ?>
                <div class="embed-responsive embed-responsive-16by9 rounded-top">
                    <a href="<?php the_permalink(); ?>">
                        <?php if( function_exists( 'rwmb_meta' ) ) {
                        $link_video = get_post_meta(get_the_ID(),'link_video', true); ?>
                        <?php echo rwmb_meta( 'link_video', 'type=oembed' ); ?> 
                    <?php } ?>
                    </a>
                </div>
            <?php } ?>   
            <?php } elseif($format=='gallery'){ ?>
            <div class="post-carousel">
              <div class="owl-post owl-carousel owl-theme">
              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                  <?php $images = rwmb_meta( 'images', "type=image" ); ?>
                  <?php foreach ( $images as $image ) {  ?>
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
            <?php } elseif ($format=='image'){ ?>
              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                  <?php $images = rwmb_meta( 'image', "type=image" ); ?>
                  <?php foreach ( $images as $image ) {  ?>
                  <?php $img = $image['full_url']; ?>
                    <div class="post-img zoomimg">
                      <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="img-fluid"></a>
                    </div>
                  <?php } ?>
              <?php } ?>
            <?php } elseif ($format=='quote'){ ?>
              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
              <?php $quote = get_post_meta(get_the_ID(),'quote', true); ?>
              <?php $quote_author = get_post_meta(get_the_ID(),'quote_author', true); ?>
              <div class="post-content  rounded-top">
                <blockquote class="blockquote-fancy">
                    <?php echo esc_html($quote); ?>
                    <footer class="post-blockquote-author"><?php echo esc_html($quote_author); ?></footer>
                </blockquote>
                <div class="post-meta">
                    <div class="meta">
                        <?php quanto_post_meta(); ?>
                    </div>
                </div>
              </div>
              <?php } ?>
            <?php }else{ ?>
              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                  <div class="post-img zoomimg">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?></a>
                  </div>
              <?php } ?>
            <?php } ?>
            <?php if($format!='quote'){ ?>
            <div class="post-content">
                <div class="meta-cat"><?php quanto_posted_in(); ?></div>
                <h3 class="post-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?> </a></h3>
                <p><?php echo quanto_excerpt(10); ?></p>
                <div class="post-meta">
                    <div class="meta">
                        <?php quanto_post_meta(); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
          </div>
        </div>

      <?php endwhile;?> 
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <nav aria-label="Page navigation example">
          <?php quanto_posts_navigation(); ?>
        </nav>
      </div>
    </div>
  </div>
</div>
  <!-- content close -->

<?php get_footer(); ?>