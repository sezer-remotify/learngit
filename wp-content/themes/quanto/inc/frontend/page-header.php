<?php
//Page Header
if ( ! function_exists( 'quanto_page_header' ) ) {
    function quanto_page_header() {
        if ( function_exists('rwmb_meta') ) {
            if( is_home() ){
                $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'page_for_posts' ));
            }else {
                $pheader = rwmb_meta('pheader_switch');
            }
            if( !$pheader && is_page() || is_404() || !$pheader && ( is_single() && get_post_type() != 'post' ) ){
                return;
            }
        }
        if( !quanto_get_option('pheader_switch') && !$pheader ) {
            return;
        }else{
            $bg     = '';
            $title  = '';
            $subtitle  = '';
            $pageheader_type  = '';
            $output = array();

            if ( is_page() || is_single() ) {
                $title = get_the_title();
            } elseif ( is_home() ) {
                $title = get_the_title(get_option('page_for_posts'));
            } elseif ( is_search() ) {
                $title = esc_html__('Search Results for: ', 'quanto') . get_search_query();
            } elseif ( is_archive() ) {
                
                $title = get_the_archive_title();
                
            }

            if (!function_exists('rwmb_meta')) {
                $bg = quanto_get_option( 'pheader_img' );
            } else {
                if( is_home() ) {
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'page_for_posts' ));
                }else{
                    $images = rwmb_meta('pheader_bg_image', "type=image");
                }
                if (!$images) {
                    $bg = quanto_get_option( 'pheader_img' );
                } else {
                    foreach ($images as $image) {
                        $bg = $image['full_url'];
                        break;
                    }
                }
            }

            if (!function_exists('rwmb_meta')) {
                $subtitle = quanto_get_option( 'pheader_subheader' );
            } else {
                if( is_home() ) {
                    $sub = rwmb_meta('pheader_sub', "type=textarea", get_option( 'page_for_posts' ));
                }else{
                    $sub = rwmb_meta('pheader_sub', "type=textarea");
                }
                if (!$sub) {
                    $subtitle = quanto_get_option( 'pheader_subheader' );
                } else {
                   $subtitle = $sub;
                }
            }

            if (!function_exists('rwmb_meta')) {
                $pageheader_style = quanto_get_option( 'type_subheader' );
            } else {
                if( is_home() ) {
                    $pheader_style = rwmb_meta('pheader_type', "type=select", get_option( 'page_for_posts' ));
                }else{
                    $pheader_style = rwmb_meta('pheader_type', "type=select");
                }
                if (!$pheader_style) {
                    $pageheader_style = quanto_get_option( 'pheader_type' );
                } else {
                   $pageheader_style = $pheader_style;
                }
            }

            if (function_exists('rwmb_meta')) {
                $btn1  = rwmb_meta('btext1', "type=text");
                $link1 = rwmb_meta('blink1', "type=text");
                $btn2  = rwmb_meta('btext2', "type=text");
                $link2 = rwmb_meta('blink2', "type=text");
            } 

            if ($title) {
                $output[] = sprintf('%s', $title);
            }
            ?>
            <?php if ( is_single() && get_post_type() == 'post' ){ ?>
            <div class="single-post-pageheader" style="background: url(<?php echo esc_url(quanto_get_option('bg_single_pheader')); ?>) center center no-repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- post pagecaption start -->
                            <div class="post-pagecaption">
                                <span class="meta cat-meta"><?php quanto_posted_in(); ?></span>
                                <h1 class="post-title text-white"><?php echo implode('', $output); ?></h1>
                            </div>
                            <div class="post-meta">
                                <p class="meta">
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php quanto_post_meta(); ?>
                                    <?php endwhile; ?>
                                </p>
                            </div>
                        </div>
                        <!-- post pagecaption close -->
                    </div>
                </div>
            </div>
            <?php }else{ ?>
            <?php if($pageheader_style=='style2'){ ?>
            <div class="pageheader-third-bg">
                <div class="pageheader-second-bg-overlay" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?>></div>
                 <div class="container">
                    <div class="row">
                       <div class="offset-xl-3 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-center">
                          <!-- pageheader second caption start -->
                          <div class="pageheader-third-caption">
                             <h1 class="text-white"><?php echo implode('', $output); ?></h1>
                             <?php if($subtitle!=''){ ?><p class="lead text-primary-light"><?php echo esc_attr($subtitle); ?></p><?php } ?>
                             <?php if($btn1!=''){ ?><a href="<?php echo esc_url($link1); ?>" class="btn btn-brand btn-rounded"><?php echo esc_attr($btn1); ?></a><?php } ?>
                             <?php if($btn2!=''){ ?><a href="<?php echo esc_url($link2); ?>" class="btn btn-outline-light btn-rounded text-white"><?php echo esc_attr($btn2); ?></a><?php } ?>
                          </div>
                          <!-- pageheader second caption close -->
                       </div>
                    </div>
                 </div>
              </div>
                <div class="page-breadcrumb-bg">
                 <div class="container">
                    <div class="row">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                          <!-- pagebreadcrumb start -->
                            <?php
                            if (function_exists('quanto_breadcrumbs') && quanto_get_option('breadcrumbs')):
                                echo quanto_breadcrumbs();
                            endif;
                            ?>
                                <!-- pagebreadcrumb close -->
                       </div>
                    </div>
                 </div>
              </div>
            <?php }else{ ?>
            <div class="pageheader-bg">
                <div class="pageheader-second-bg-overlay" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?>></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!--  pagecaption start  -->
                            <div class="page-caption">
                                <div class="page-caption-text bg-white rounded-top">
                                    <h1 class="page-caption-title"><?php echo implode('', $output); ?></h1>
                                    <?php if($subtitle!=''){ ?><p class="page-caption-para-text"><?php echo esc_attr($subtitle); ?> </p><?php } ?>
                                    <?php if($btn1!=''){ ?><a href="<?php echo esc_url($link1); ?>" class="btn btn-brand btn-rounded"><?php echo esc_attr($btn1); ?></a><?php } ?>
                                    <?php if($btn2!=''){ ?><a href="<?php echo esc_url($link2); ?>" class="btn btn-outline-light btn-rounded"><?php echo esc_attr($btn2); ?></a><?php } ?>
                                </div>
                                <!-- pagebreadcrumb start -->
                                <?php
                                if (function_exists('quanto_breadcrumbs') && quanto_get_option('breadcrumbs')):
                                    echo quanto_breadcrumbs();
                                endif;
                                ?>
                                <!-- pagebreadcrumb close -->
                            </div>
                            <!--  pagecaption close  -->
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
            <?php
        }
    }
}