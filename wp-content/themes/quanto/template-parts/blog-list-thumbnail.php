<?php
/**
 * Template Name: Template Blog List Thumbnail
 */
get_header(); ?>

  <!-- content begin -->
<div class="content">
  <div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="categories-filter">
                <a data-filter="*" class="active"><?php esc_html_e('All','quanto'); ?></a>
                <?php
                $categories = get_terms('category');
                foreach( (array)$categories as $categorie){
                    $cat_name = $categorie->name;
                    $cat_slug = $categorie->slug;
                    ?>
                    <a data-filter=".<?php echo esc_attr( $cat_slug ); ?>" class=""><?php echo esc_html( $cat_name ); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row post-design">
      <?php 
      $i=0;
        $args = array(    
          'paged' => $paged,
          'post_type' => 'post',
          'posts_per_page' => 10,
          );
        $wp_query = new WP_Query($args);
        while ($wp_query -> have_posts()): $wp_query -> the_post(); $i++; 

                $cates = get_the_terms(get_the_ID(),'category');
                $cate_name ='';
                $cate_slug = '';
                foreach((array)$cates as $cate){
                    if(count($cates)>0){
                        $cate_slug .= $cate->slug .' ';
                    }
                }
          ?>
        <?php $format = get_post_format(); ?>
        <?php if($i==1){ ?>
        <div class="all-post col-md-12 <?php echo esc_attr($cate_slug); ?>">
          <div class="post-fullwidth">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 pr-xl-0 pr-lg-0">
                  <div class="post-img zoomimg rounded-left">
                      <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="img-fluid"></a>
                  </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 pl-xl-0 pr-lg-0">
                  <div class="post-content rounded-right">
                      <div class="meta-cat"><?php quanto_posted_in(); ?></div>
                      <h2 class="post-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h2>
                      <p><?php echo quanto_excerpt(15); ?></p>
                      <div class="post-meta">
                          <div class="meta">
                              <?php quanto_post_meta(); ?>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="row post-design">
        <?php }else{ ?>
        <div class="all-post col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 <?php echo esc_attr($cate_slug); ?>">
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
        <?php } ?>

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