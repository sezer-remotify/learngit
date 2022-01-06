<?php

// Button (quanto)
add_shortcode('otbutton', 'otbutton_func');
function otbutton_func($atts, $content = null){
    extract(shortcode_atts(array(
        'btn_text'  =>  '',
        'btn_link'  =>  '#',
        'style'     =>  'btn-primary',
        'type'      =>  'btn-rounded',
        'size'      =>  '',
        'icon'      =>  '',
        'outline'   =>  '',
        'align'     =>  '',
        'color'     =>  '',
        'bg_color'  =>  '',
        'bo_color'  =>  '',
        'iclass'    =>  '',
    ), $atts));
    if($outline!=''){
    $class     = 'btn ' .esc_attr($size).' '. esc_attr($outline).' '. esc_attr($type).' '.esc_attr($iclass);
    }else{
    $class     = 'btn ' .esc_attr($size).' '. esc_attr($style).' '. esc_attr($type).' '.esc_attr($iclass);
    }
    $color1    = (!empty($color) ? 'color:'.$color.';' : '');
    $bg_color1 = (!empty($bg_color) ? 'background-color:'.$bg_color.';' : '');
    $bo_color1 = (!empty($bo_color) ? 'border-color:'.$bo_color.';' : '');
    ob_start(); ?>

    <?php if($align!=''){ ?><div class="<?php echo esc_attr($align); ?>"><?php } ?>
        <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url($btn_link); ?>" style="<?php echo esc_attr($bg_color1);echo esc_attr($bo_color1);echo esc_attr($color1); ?>"><?php echo wp_specialchars_decode($btn_text); ?><?php if($icon!=''){ ?><i class="<?php echo esc_attr($icon) ?>"></i><?php } ?></a>
    <?php if($align!=''){ ?></div><?php } ?>

    <?php
    return ob_get_clean();
}

// Subheader (quanto watting)
add_shortcode('ot_subheader', 'ot_subheader_func');
function ot_subheader_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'        =>  '',
        'stitle'       =>  '',
        'image'        =>  '',
        'bgimage'      =>  '',
        'rating'       =>  '',
        'review'       =>  '',
        'link'         =>  '',
        'pattern'      =>  '',
        'review_text'  =>  '',
        'iclass'       =>  '',
        'style'        =>  'style1',
    ), $atts));
    $img = wp_get_attachment_image_src($image,'full'); $img = $img[0];
    $bg = wp_get_attachment_image_src($bgimage,'full'); $bg = $bg[0];
    $url = vc_build_link($link);
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="pageheader-second-bg <?php echo esc_attr($iclass); ?>">
        <div class="pageheader-second-bg-overlay" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?>></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="pageheader-second-caption">
                        <?php if($title!=''){ ?><h1 class="text-white hero-slide-title"><?php echo esc_attr($title); ?></h1><?php } ?>
                        <?php if($stitle!=''){ ?><p class="lead text-white"><?php echo esc_attr($stitle); ?></p><?php } ?>
                        <?php echo wpb_js_remove_wpautop($content, true); ?>
                        <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                        echo '<a class="btn btn-brand btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                        } ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="pageheader-second-img">
                        <?php if($img!=''){ ?><img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid"><?php } ?>
                        <?php if($rating==true){ ?>
                        <div class="pageheader-rating">
                            <div class="rating mb-3">
                            <?php if($review=='1star'){ ?>
                            <i class="fa fa-fw fa-star"></i>
                            <?php } elseif($review=='half'){ ?>
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($review=='1s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($review=='2star'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } elseif($review=='2s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($review=='3star'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } elseif($review=='3s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($review=='4star'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } elseif($review=='4s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } else{ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } ?>
                                <span class="text-white fontweight-bold"><?php echo esc_attr($review_text); ?></span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($pattern=='pattern1'){ ?>
    <div class="pattern-bottom">
        <div class="pattern-slide"></div>
    </div>
    <?php }elseif($pattern=='pattern2'){ ?>
    <div class="pattern-bottom">
        <div class="pattern-slide-second"></div>
    </div>
    <?php } }elseif($style=='style2'){ ?>
    <div class="hero-shape-one <?php echo esc_attr($iclass); ?>" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?> >
        <div class="hero-shape-one-caption">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="hero-shape-one-caption-text">
                            <h1 class="text-white hero-shape-one-caption-title"><?php echo esc_attr($title); ?></h1>
                            <p><?php echo esc_attr($stitle); ?> </p>
                            <?php echo wpb_js_remove_wpautop($content, true); ?>
                            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-brand btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                            } ?>
                        </div>
                    </div>
                    <?php if($img!=''){ ?>
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                        <div class="hero-shape-one-caption-img">
                            <img src="<?php echo esc_url($img); ?>" alt="">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }elseif($style=='style3'){ ?>
    <div class="hero-shape-second <?php echo esc_attr($iclass); ?>" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?>>
        <div class="hero-shape-second-caption">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                        <!-- hero slide caption start  -->
                        <div class="hero-shape-second-caption-text">
                            <h1 class="text-white hero-shape-second-caption-title"><?php echo esc_attr($title); ?></h1>
                            <p><?php echo esc_attr($stitle); ?></p>
                            <?php echo wpb_js_remove_wpautop($content, true); ?>
                            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-brand btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                            } ?>
                        </div>
                    </div>
                    <?php if($img!=''){ ?>
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="hero-shape-second-caption-img">
                            <img src="<?php echo esc_url($img); ?>" alt="">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }elseif($style=='style4'){ ?>
    <div class="hero-shape-third <?php echo esc_attr($iclass); ?>" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?>>
        <div class="hero-shape-third-caption">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                        <div class="hero-shape-third-caption-text">
                            <h1 class=" hero-shape-third-caption-title"><?php echo esc_attr($title); ?></h1>
                            <h3 class=""><?php echo esc_attr($stitle); ?></h3>
                            <?php echo wpb_js_remove_wpautop($content, true); ?>
                            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-brand btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                            } ?>
                        </div>
                    </div>
                    <?php if($img!=''){ ?>
                    <div class="offset-xl-2 col-xl-4 col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="hero-shape-third-caption-img">
                            <img src="<?php echo esc_url($img); ?>" alt="">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="hero-shape-fourth <?php echo esc_attr($iclass); ?>" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?>>
        <div class="hero-shape-fourth-caption">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="hero-shape-fourth-caption-text">
                            <h1 class="text-white hero-shape-fourth-caption-title"><?php echo esc_attr($title); ?> </h1>
                            <p><?php echo esc_attr($stitle); ?> </p>
                            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-brand btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                            } ?>
                        </div>
                    </div>
                    <?php if($img!=''){ ?>
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                        <div class="hero-shape-fourth-caption-img">
                            <img src="<?php echo esc_url($img); ?>" alt="">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Home Slider (quanto)
add_shortcode('homelide', 'homelide_func');
function homelide_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'slide'      =>  '',
        'iclass'      =>  '',
    ), $atts));
    $slider = (array) vc_param_group_parse_atts( $slide );
    ob_start(); ?>

    <div class="slider <?php echo esc_attr($iclass); ?>">
        <div class="owl-carousel owl-slider owl-theme">
        <?php foreach ( $slider as $hslider ) :
            $hslider['photo'] = isset($hslider['photo']) ? $hslider['photo'] : '';
            $img = wp_get_attachment_image_src($hslider['photo'],'full'); $img = $img[0];
            $hslider['title'] = isset($hslider['title']) ? $hslider['title'] : '';
            $hslider['stitle'] = isset($hslider['stitle']) ? $hslider['stitle'] : '';
            $hslider['btext'] = isset($hslider['btext']) ? $hslider['btext'] : '';
            $hslider['link'] = isset($hslider['link']) ? $hslider['link'] : '';
            $coloff = isset($hslider['colof']) ? $hslider['colof'] : '';
            $coloff = ' ';
            if( $hslider['colof'] == 1 ){
                $coloff = 'offset-lg-1 ';
            }elseif($hslider['colof'] == 2){
                $coloff = 'offset-lg-2 ';
            }elseif($hslider['colof'] == 3){
                $coloff = 'offset-lg-3 ';
            }elseif($hslider['colof'] == 4){
                $coloff = 'offset-lg-4 ';
            }elseif($hslider['colof'] == 5){
                $coloff = 'offset-lg-5 ';
            }elseif($hslider['colof'] == 6){
                $coloff = 'offset-lg-6 ';
            }else{
                $coloff = '';
            }

        ?>
            <div class="item">
                <div class="slider-img">
                    <img src="<?php echo esc_url($img); ?>" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="<?php echo esc_attr($coloff); ?>col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <!-- slider caption start -->
                            <div class="slider-captions">
                                <h1 class="slider-title"><?php echo wp_specialchars_decode($hslider['title']); ?> </h1>
                                <p class="slider-text d-none d-xl-block "><?php echo wp_specialchars_decode($hslider['stitle']); ?>
                                </p>
                                <a href="<?php echo esc_url($hslider['link']); ?>" class="btn btn-brand btn-rounded btn-lg"><?php echo esc_attr($hslider['btext']); ?> </a>
                            </div>
                            <!-- slider caption close -->
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Slick Slider (quanto)
add_shortcode('slicklide', 'slicklide_func');
function slicklide_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'slide'      =>  '',
        'auto'       =>  '',
        'arrow'      =>  'true',
        'slide2'     =>  '',
        'iclass'     =>  '',
        'style'      =>  'style1',
    ), $atts));
    $slider = (array) vc_param_group_parse_atts( $slide );
    $slider2 = (array) vc_param_group_parse_atts( $slide2 );
    $auto1 = (!empty($auto) ? esc_attr($auto) : 'true');
    ob_start(); ?>

<?php if($iclass!=''){ ?><div class="<?php echo esc_attr($iclass); ?>"><?php } ?>
    <?php if($style=='style1'){ ?>
    <div class="slider-gallery">
        <?php 
            $i=0;
            foreach ( $slider as $hslider ) :
            $hslider['photo'] = isset($hslider['photo']) ? $hslider['photo'] : '';
            $img = wp_get_attachment_image_src($hslider['photo'],'full'); $img = $img[0];
            $i++;
            ?>
            <div class="item">
                <img src="<?php echo esc_url($img); ?>" alt="" draggable="false">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="slider-gallery-nav">
        <?php foreach ( $slider as $hslider ) :
            $hslider['navtext'] = isset($hslider['navtext']) ? $hslider['navtext'] : '';
        ?>
            <div class="item">
                <?php echo esc_attr($hslider['navtext']); ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php if($iclass!=''){ ?></div><?php } ?>
    <script type="text/javascript">
    (function($) {
        $(document).ready(function(){
        if ($('.slider-gallery, .slider-gallery-nav').length) {

            $('.slider-gallery').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: <?php echo esc_attr($arrow); ?>,
                fade: true,
                asNavFor: '.slider-gallery-nav',
                autoplay: <?php echo esc_attr($auto1); ?>
            });

            $('.slider-gallery-nav').slick({
                slidesToShow: <?php echo esc_attr($i); ?>,
                slidesToScroll: <?php echo esc_attr($i); ?>,
                asNavFor: '.slider-gallery',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                useTransform: false


            });

    }
        });
    })(jQuery);
    </script>
    <?php }else{ ?>
    <div class="slider-for">
        <?php
            $i=0; foreach ( $slider2 as $hslider2 ) :
            $hslider2['photo'] = isset($hslider2['photo']) ? $hslider2['photo'] : '';
            $img = wp_get_attachment_image_src($hslider2['photo'],'full'); $img = $img[0];
            $title = isset($hslider2['title']) ? $hslider2['title'] : '';
            $stitle = isset($hslider2['stitle']) ? $hslider2['stitle'] : '';
            $url = vc_build_link($hslider2['link']);
            $i++;
        ?>
            <div class="item">
                <img src="<?php echo esc_url($img); ?>" alt="" draggable="false" />
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <!-- slider caption start -->
                            <div class="slider-captions">
                                <h1 class="slider-title"><?php echo htmlspecialchars_decode($title); ?></h1>
                                <p class="slider-text d-none d-xl-block"><?php echo htmlspecialchars_decode($stitle); ?></p>
                                <?php if ( strlen( $hslider2['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                                    echo '<a class="btn btn-brand btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container">
        <div class="slider-nav">
            <?php foreach ( $slider2 as $hslider2 ) :
                $hslider2['photo'] = isset($hslider2['photo']) ? $hslider2['photo'] : '';
                $img = wp_get_attachment_image_src($hslider2['photo'],'full'); $img = $img[0];
            ?>
            <div class="item">
                <img src="<?php echo esc_url($img); ?>" alt="" draggable="false" />
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script type="text/javascript">
    (function($) {
        $(document).ready(function(){
        
        if ($('.slider-for, .slider-nav').length) {

            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: <?php echo esc_attr($arrow); ?>,
                fade: true,
                asNavFor: '.slider-nav',
                autoplay: <?php echo esc_attr($auto1); ?>
            });

            $('.slider-nav').slick({
                slidesToShow: <?php echo esc_attr($i); ?>,
                slidesToScroll: <?php echo esc_attr($i); ?>,
                asNavFor: '.slider-for',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                useTransform: false


            });

        }
        });
    })(jQuery);
    </script>
    <?php } ?>
    <?php
    return ob_get_clean();
}

// Search Section (quanto)
add_shortcode('searchsec','searchsec_func');
function searchsec_func($atts, $content = null){
    extract(shortcode_atts(array(
        'photo'       =>  '',
        'title'       =>  '',
        'btn'         =>  '',
        'placeholder' =>  '',
        'iclass'      =>  '',
    ), $atts));
    $img     = wp_get_attachment_image_src($photo,'full');
    $img     = $img[0];
    ob_start(); ?>
    <div class="hero-slide <?php echo esc_attr($iclass); ?>">
    <div class="pageheader-second-bg-overlay" <?php if($img!=''){ ?>style="background-image: url(<?php echo esc_url($img); ?>);"<?php } ?>></div>
     <div class="container">
        <div class="row">
           <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="helpcenter-search-section">
                 <h1 class="text-white"><?php echo esc_attr($title); ?> </h1>
                 <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="input-group mb-3">
                       <input type="search" name="s" class="form-control" placeholder="<?php echo esc_attr($placeholder); ?>" value="<?php echo get_search_query(); ?>">
                       <div class="input-group-append">
                          <button class="btn btn-brand" type="submit"><?php echo esc_attr($btn); ?></button>
                       </div>
                    </div>
                 </form>
              </div>
           </div>
        </div>
     </div>
  </div>
    <?php
    return ob_get_clean();
}

// Counter (quanto)
add_shortcode('counter','counter_func');
function counter_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon'       =>  '',
        'title'      =>  '',
        'after'      =>  '',
        'color'      =>  '',
        'bg_color'   =>  '',
        'number'     =>  '',
        'start'      =>  '',
        'desc'       =>  '',
        'iclass'     =>  '',
        'style'      =>  'style1',
    ), $atts));
    $color1    = (!empty($color) ? 'color:'.$color.';' : '');
    $bg_color1 = (!empty($bg_color) ? 'background-color:'.$bg_color.';' : '');
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="counter-v1 counter-block <?php echo esc_attr($iclass); ?>">
        <?php if($icon!=''){ ?>
        <div class="counter-block-icon">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <?php } ?>
        <div class="counter-block-content">
            <?php if($number!=''){ ?><div class="counter counter-block-title" data-count="<?php echo esc_attr($number); ?>"><?php echo esc_attr($start); ?></div><?php } ?>
            <?php if($title){ ?><h3 class="text-white counter-block-title"><?php echo esc_attr($title); ?></h3><?php } ?>
            <?php if($desc!=''){ ?><p class="counter-block-text"><?php echo esc_attr($desc); ?></p><?php } ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="counter-v2 counter-block <?php echo esc_attr($iclass); ?>">
        <div class="counter-block-content">
            <div class="counter counter-block-title text-white" data-count="<?php echo esc_attr($number); ?>"><?php echo esc_attr($start); ?></div>
            <?php if($after!=''){ ?><span class="plus-sign"><?php echo esc_attr($after); ?></span><?php } ?>
            <p class="counter-block-text text-white"><?php echo esc_attr($title); ?></p>
        </div>
    </div>
    <?php }elseif($style=='style3'){ ?>
    <div class="counter-v5 counter-block <?php echo esc_attr($iclass); ?>">
        <div class="counter-block-content">
            <div class="counter counter-block-title" data-count="<?php echo esc_attr($number); ?>"><?php echo esc_attr($start); ?></div>
            <?php if($after!=''){ ?><span class="plus-sign"><?php echo esc_attr($after); ?></span><?php } ?>
            <p class="counter-block-text"><?php echo esc_attr($title); ?> </p>
        </div>
    </div>
    <?php }elseif($style=='style4'){ ?>
    <div class="counter-v3 counter-block <?php echo esc_attr($iclass); ?>">
        <div class="counter-block-content">
            <div class="counter" data-count="<?php echo esc_attr($number); ?>"><?php echo esc_attr($start); ?></div>
            <p class="counter-block-text"><?php echo esc_attr($title); ?></p>
        </div>
    </div>
    <?php }elseif($style=='style5'){ ?>
    <div class="counter-v4 counter-block <?php echo esc_attr($iclass); ?>">
        <div class="counter-block-content">
            <div class="counter-block-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
            <div class="counter" data-count="<?php echo esc_attr($number); ?>"><?php echo esc_attr($start); ?></div>
            <p class="counter-block-text"><?php echo esc_attr($title); ?> </p>
        </div>
    </div>
    <?php }elseif($style=='style6'){ ?>
    <div class="counter-v3 counter-block <?php echo esc_attr($iclass); ?>">
        <div class="counter-block-content">
            <div class="counter text-white" data-count="<?php echo esc_attr($number); ?>"><?php echo esc_attr($start); ?></div>
            <p class="counter-block-text"><?php echo esc_attr($title); ?></p>
        </div>
    </div>
    <?php }else{ ?>
    <div class="counter-v7 counter-block <?php echo esc_attr($iclass); ?>" style="<?php echo esc_attr($bg_color1);echo esc_attr($color1); ?>">
        <div class="counter-block-content">
            <div class="counter counter-block-number" style="<?php echo esc_attr($color1); ?>" data-count="<?php echo esc_attr($number); ?>"><?php echo esc_attr($start); ?></div>
            <?php if($after!=''){ ?><span class="plus-sign" style="<?php echo esc_attr($color1); ?>"><?php echo esc_attr($after); ?></span><?php } ?>
            <p class="counter-block-text "><?php echo esc_attr($title); ?></p>
        </div>
    </div>
    <?php } ?>
    <?php
    return ob_get_clean();
}

// Pricing Table (quanto)
add_shortcode('pricing','pricing_func');
function pricing_func($atts, $content = null){
    extract(shortcode_atts(array(
        'stitle'    =>  '',
        'title'     =>  '',
        'price'     =>  '',
        'image'     =>  '',
        'rate'      =>  '',
        'currency'  =>  '',
        'per'       =>  '',
        'plabel'    =>  '',
        'link'      =>  '',
        'iclass'    =>  '',
        'style'     =>  'style1',
    ), $atts));
    $url    = vc_build_link( $link );
    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
    ob_start(); ?>
    <?php if($style == 'style1'){ ?>
    <div class="pricing-block-v1 pricing-block <?php echo esc_attr($iclass); ?>">
        <div class="pricing-head">
            <h3 class="pricing-head-title"><?php echo esc_attr($title); ?></h3>
            <p class="pricing-head-text"><?php echo esc_attr($stitle); ?></p>
            <p class="pricing-head-price"><?php echo esc_attr($price); ?></p>
        </div>
        <div class="pricing-content">
            <div class="pricing-content-list ">
                <?php echo wpb_js_remove_wpautop($content, true); ?>
            </div>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-dark btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
        <div class="pricing-block-v2 pricing-block <?php echo esc_attr($iclass); ?>">
            <div class="pricing-head">
                <h3 class="pricing-head-title"><?php echo esc_attr($title); ?></h3>
                <p class="pricing-head-text"><?php echo esc_attr($stitle); ?></p>
                <p class="pricing-head-price"><?php echo esc_attr($price); ?></p>
                <p class="pricing-head-text"><?php echo esc_attr($rate); ?></p>
            </div>
            <div class="pricing-content">
                <div class="pricing-content-list ">
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                </div>
                <div class="text-center">
                <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-primary btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
                </div>
            </div>
        </div>
    <?php }elseif($style=='style3'){ ?>
        <div class="list-group pricing-list-section <?php echo esc_attr($iclass); ?>">
            <a href="javascript:void" class="list-group-item list-group-item-action">
                <div class="pricing-block-v7 pricing-block">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                            <div class="pricing-head ">
                                <h4 class="pricing-head-title"><?php echo esc_attr($title); ?></h4>
                                <p class="pricing-head-text"><?php echo esc_attr($stitle); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="pricing-head">
                                <p class="mb-0"><?php echo esc_attr($plabel); ?></p>
                                <p><span class="pricing-top-price"><?php echo esc_attr($price); ?></span> <?php echo esc_attr($per); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php }elseif($style=='style4'){ ?>
    <div class="pricing-block-v3 pricing-block <?php echo esc_attr($iclass); ?>">
        <div class="pricing-content">
            <div class="pricing-head">
                <h3 class="pricing-head-title"><?php echo esc_attr($title); ?></h3>
            </div>
            <div class="pricing-content-list ">
                <?php echo wpb_js_remove_wpautop($content, true); ?>
            </div>
            <?php if($price!=''){ ?><p class="pricing-bottom-price"><?php echo esc_attr($price); ?><sub><?php echo esc_attr($per); ?></sub></p><?php } ?>
        </div>
        <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
        echo '<a class="btn btn-dark btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
        } ?>
    </div>
    <?php }elseif($style=='style5'){ ?>
    <div class="pricing-block-v4 pricing-block border-right <?php echo esc_attr($iclass); ?>">
        <?php if($img!=''){ ?><div class="pricing-icon"><img src="<?php echo esc_url($img); ?>" alt=""></div><?php } ?>
        <div class="pricing-content">
            <div class="pricing-head">
                <h3 class="pricing-head-title"><?php echo esc_attr($title); ?></h3>
            </div>
            <div class="pricing-content-list ">
                <?php echo wpb_js_remove_wpautop($content, true); ?>
            </div>
            <?php if($price!=''){ ?><p class="pricing-bottom-price"><?php echo esc_attr($price); ?></p><?php } ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
            echo '<a class="btn btn-dark btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php }elseif($style=='style6'){ ?>
    <div class="pricing-block-v5 pricing-block <?php echo esc_attr($iclass); ?>">
        <div class="pricing-content">
            <?php if($img!=''){ ?><div class="pricing-icon"><img src="<?php echo esc_url($img); ?>" alt=""></div><?php } ?>
            <div class="pricing-head">
                <h3 class="pricing-head-title"><?php echo esc_attr($title); ?></h3>
                <?php if($stitle){ ?><p class="pricing-head-text"><?php echo esc_attr($stitle); ?></p><?php } ?>
            </div>
            <p class="pricing-bottom-price"><?php echo esc_attr($price); ?></p>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
            echo '<a class="btn btn-dark btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
        <div class="pricing-content-list ">
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>
    <?php }elseif($style=='style7'){ ?>
    <div class="pricing-block-v6 pricing-block <?php echo esc_attr($iclass); ?>">
        <div class="pricing-head">
            <h3 class="pricing-head-title"><?php echo esc_attr($title); ?></h3>
            <?php if($stitle){ ?><p class="pricing-head-text"><?php echo esc_attr($stitle); ?></p><?php } ?>
        </div>
        <div class="pricing-content">
            <?php echo wpb_js_remove_wpautop($content, true); ?>
            <p class="pricing-bottom-price"><sup><?php echo esc_attr($currency); ?></sup><?php echo esc_attr($price); ?><small class="pricing-month-text"><?php echo esc_attr($per); ?></small></p>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
            echo '<a class="btn btn-dark btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

//Table Basic (quanto)
add_shortcode('basictable', 'basictable_func');
function basictable_func( $atts, $content ) {
  $atts = shortcode_atts(array(
   'titles'         => '',
   'class_name'     => '',
  ), $atts );

  $output = array();
  if( $atts['titles'] ) {
   $titles = explode( "|", $atts['titles'] );
   $column = '';

   if( $titles ) {
    foreach ( $titles as $title ) {
     $column .= sprintf( '<th class="%s">%s</th>', '', $title );
    }
   }
   $output[] = sprintf( '<thead><tr>%s</tr></thead>',  $column );
  }

  if( $content ) {
   $content = explode( "\n", $content );

   if( $content ) {
    $output[] = '<tbody>';
    foreach ( $content as $row ) {
     $row = explode( "|", $row );
     $column = '';
     $i = 0;

     if( $row ) {
      foreach ( $row as $label ) {
       $data = '';
       if( $label ) {    
         $column .= sprintf( '<td class="%s">%s</td>', $data, $label );
       }
       $i++;
      }
     }
     $output[] = sprintf( '<tr>%s</tr>',  $column );
    }
    $output[] = '</tbody>';
   }
  }
  return sprintf( 
    '
      <div class="table-responsive">
        <table class="table %s">%s</table>
      </div>
    ',
  esc_attr( $atts['class_name'] ),
  implode( '', $output )
  );
}

//Data Table (quanto)
add_shortcode('datatable', 'datatable_func');
function datatable_func( $atts, $content ) {
  $atts = shortcode_atts(array(
   'titles'         => '',
   'ftitles'        => '',
   'class_name'     => '',
  ), $atts );

  $output = array();
  if( $atts['titles'] ) {
   $titles = explode( "|", $atts['titles'] );
   $column = '';

   if( $titles ) {
    foreach ( $titles as $title ) {
     $column .= sprintf( '<th class="%s">%s</th>', '', $title );
    }
   }
   $output[] = sprintf( '<thead><tr>%s</tr></thead>',  $column );
  }

  if( $content ) {
   $content = explode( "\n", $content );

   if( $content ) {
    $output[] = '<tbody>';
    foreach ( $content as $row ) {
     $row = explode( "|", $row );
     $column = '';
     $i = 0;

     if( $row ) {
      foreach ( $row as $label ) {
       $data = '';
       if( $label ) {    
         $column .= sprintf( '<td class="%s">%s</td>', $data, $label );
       }
       $i++;
      }
     }
     $output[] = sprintf( '<tr>%s</tr>',  $column );
    }
    $output[] = '</tbody>';
   }
  }
  if( $atts['ftitles'] ) {
   $ftitles = explode( "|", $atts['ftitles'] );
   $column = '';

   if( $ftitles ) {
    foreach ( $ftitles as $ftitle ) {
     $column .= sprintf( '<th class="%s">%s</th>', '', $ftitle );
    }
   }
   $output[] = sprintf( '<tfoot><tr>%s</tr></tfoot>',  $column );
  }
  return sprintf( 
    ' 
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered %s">%s</table>
    </div>
    ',
  esc_attr( $atts['class_name'] ),
  implode( '', $output )
  );
}

// Feature Box (quanto)
add_shortcode('feature','feature_func');
function feature_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'      =>  '',
        'image'      =>  '',
        'icon'       =>  '',
        'color'      =>  '',
        'bg_color'   =>  '',
        'iconfl'     =>  '',
        'style'      =>  'style1',
        'link'       =>  '',
        'arrow'      =>  '',
        'btnst'      =>  'btn-primary-arrow-link',
        'pattern'    =>  '',
        'iclass'     =>  '',
    ), $atts));
    $url = vc_build_link($link);
    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
    $color1    = (!empty($color) ? 'color:'.$color.';' : '');
    $bg_color1 = (!empty($bg_color) ? 'background-color:'.$bg_color.';' : '');
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="feature-block-v4 feature-block <?php echo esc_attr($iclass); ?>">
        <?php if($icon!=''){ ?><div class="feature-icon icon-circle"><i class="<?php echo esc_attr($icon); ?>"></i></div><?php } ?>
        <div class="feature-content">
            <h4 class="feature-title"><?php echo esc_attr($title); ?></h4>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="cta-block <?php echo esc_attr($iclass); ?> <?php echo esc_attr($pattern); ?>">
        <div class="cta-block-content">
            <?php if($iconfl!=''){ ?>
            <div class="cta-block-icon icon-circle">
                <i class="<?php echo esc_attr($iconfl); ?>"></i>
            </div>
            <?php } ?>
            <h4 class="cta-block-title"><?php echo esc_attr($title); ?></h4>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
            <?php if($arrow=='yes'){ ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class=" ' .esc_attr($btnst). ' " href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'<i class="fa fa-arrow-right"></i></a>';
            } ?>
            <?php }else{ ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class=" ' .esc_attr($btnst). ' " href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
            <?php } ?>
        </div>
    </div>
    <?php }elseif($style=='style3'){ ?>
    <div class="feature-block-v2 feature-block d-flex justify-content-between <?php echo esc_attr($iclass); ?>">
        <?php if($icon!=''){ ?>
        <div class="icon-circle feature-icon">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <?php } ?>
        <div class="feature-content">
            <h5 class="feature-title"><?php echo esc_attr($title); ?></h5>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>    
    <?php }elseif($style=='style4'){ ?>
    <div class="hc-support-block <?php echo esc_attr($iclass); ?>">
      <?php if($img!=''){ ?><div class="hc-support-block-icon"><img src="<?php echo esc_url($img); ?>" alt=""></div><?php } ?>
        <div class="hc-support-block-content">
          <h3><?php echo esc_attr($title); ?></h3>
          <?php echo wpb_js_remove_wpautop($content, true); ?>
          <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
          } ?>
        </div>
    </div>
    <?php }elseif($style=='style5'){ ?>
    <div class="feature-block-v3 feature-block border-bottom-4 <?php echo esc_attr($iclass); ?>">
        <div class="feature-content">
            <?php if($icon!=''){ ?>
            <div class="feature-icon icon-circle">
                <i class="fa-fw <?php echo esc_attr($icon); ?>"></i>
            </div>
            <?php } ?>
            <h4 class="feature-title"><?php echo esc_attr($title); ?></h4>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>
    <?php }elseif($style=='style6'){ ?>
    <div class=" feature-block-v5 feature-block <?php echo esc_attr($iclass); ?>">
        <?php if($icon!=''){ ?><div class="feature-icon icon-circle"><i class="<?php echo esc_attr($icon); ?>"></i></div><?php } ?>
        <div class="feature-content">
            <h4 class="feature-title"><?php echo esc_attr($title); ?></h4>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>
    <?php }elseif($style=='style7'){ ?>
    <div class="feature-block-v1 feature-block">
        <div class="feature-content">
            <?php if($iconfl!=''){ ?>
            <div class="feature-icon icon-circle" style="<?php echo esc_attr($bg_color1);echo esc_attr($color1); ?>">
                <i class="<?php echo esc_attr($iconfl); ?>"></i>
            </div>
            <?php } ?>
            <h4 class="feature-title title"><?php echo esc_attr($title); ?></h4>
            <?php echo wpb_js_remove_wpautop($content, true); ?> 
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php }elseif($style=='style8'){ ?>
    <div class="feature-left feature-block <?php echo esc_attr($iclass); ?>">
        <?php if($icon!=''){ ?>
        <div class="feature-icon">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <?php } ?>
        <div class="feature-content">
            <h3 class="feature-title"><?php echo esc_attr($title); ?></h3>
            <?php echo wpb_js_remove_wpautop($content, true); ?> 
        </div>
    </div>
    <?php }elseif($style=='style9'){ ?>
    <div class="feature-block-v6 feature-block <?php echo esc_attr($iclass); ?>">
        <div class="feature-icon" style="<?php echo esc_attr($bg_color1);echo esc_attr($color1); ?>">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <div class="feature-content">
            <h4><?php echo esc_attr($title); ?></h4>
            <?php echo wpb_js_remove_wpautop($content, true); ?> 
        </div>
    </div>
    <?php }elseif($style=='style10'){ ?>
    <div class="feature-block-v7 feature-block <?php echo esc_attr($iclass); ?>">
        <div class="feature-icon" style="<?php echo esc_attr($bg_color1);echo esc_attr($color1); ?>">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <div class="feature-content">
            <?php if($title){ ?><h4><?php echo esc_attr($title); ?></h4><?php } ?>
            <?php echo wpb_js_remove_wpautop($content, true); ?> 
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php }else{ ?>
    <div class="<?php echo esc_attr($pattern); ?>">
        <div class="feature-block-v8 feature-block <?php echo esc_attr($iclass); ?>">
            <div class="feature-icon">
                <i class="<?php echo esc_attr($icon); ?>"></i>
            </div>
            <div class="feature-content">
                <h4><?php echo esc_attr($title); ?></h4>
                <?php echo wpb_js_remove_wpautop($content, true); ?> 
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Call To Action (quanto)
add_shortcode('cta','cta_func');
function cta_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'      =>  '',
        'stitle'     =>  '',
        'icon'       =>  '',
        'photo'      =>  '',
        'link'       =>  '',
        'link2'      =>  '',
        'pattern'    =>  '',
        'style'      =>  'style1',
        'iclass'     =>  '',
    ), $atts));
    $url = vc_build_link($link);
    $url2 = vc_build_link($link2);
    $img     = wp_get_attachment_image_src($photo,'full');
    $img     = $img[0];
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="cta-v4 cta <?php echo esc_attr($iclass); ?>">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12">
                    <div class="cta-icon">
                        <i class="<?php echo esc_attr($icon); ?>"></i>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                    <div class="cta-content">
                        <h2 class="cta-title text-white"><?php echo esc_attr($title); ?></h2>
                        <?php echo wpb_js_remove_wpautop($content, true); ?>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                        echo '<a class="btn btn-rounded btn-brand btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="cta-boxed <?php echo esc_attr($iclass); ?>">
        <div class="cta-boxed-content">
            <h3 class="cta-boxed-title"><?php echo esc_attr($title); ?> </h3>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-secondary btn-rounded mr-4" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
            <?php if ( strlen( $link2 ) > 0 && strlen( $url2['url'] ) > 0 ) {
                echo '<a class="btn-brand-link" href="' . esc_attr( $url2['url'] ) . '" target="' . ( strlen( $url2['target'] ) > 0 ? esc_attr( $url2['target'] ) : '_self' ) . '">' . esc_attr( $url2['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php }elseif ($style=='style3') { ?>
    <div class="cta cta-v1 <?php echo esc_attr($iclass); ?>">
       <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="cta-content">
                    <h1 class="cta-title"><?php echo esc_attr($title); ?></h1>
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="cta-btn">
                    <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                        echo '<a class="btn btn-brand btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                    } ?>
                    <?php if ( strlen( $link2 ) > 0 && strlen( $url2['url'] ) > 0 ) {
                        echo '<a class="text-white" href="' . esc_attr( $url2['url'] ) . '" target="' . ( strlen( $url2['target'] ) > 0 ? esc_attr( $url2['target'] ) : '_self' ) . '">' . esc_attr( $url2['title'] ) .'</a>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }elseif ($style=='style4') { ?>
    <div class="cta-boxed bg-primary rounded <?php echo esc_attr($iclass); ?>">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <div class="cta-boxed-content ">
                    <h1 class="cta-title text-white mb-0"><?php echo esc_attr($title); ?></h1>
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                    <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                        echo '<a class="btn btn-brand btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } elseif ($style=='style5') { ?>
    <div class="cta-v2 cta <?php echo esc_attr($iclass); ?>">
        <div class="container">
            <div class="row">
                <div class="offset-xl-1 col-xl-4 col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="cta-content">
                        <h1 class="cta-title"><?php echo esc_attr($title); ?></h1>
                        <?php echo wpb_js_remove_wpautop($content, true); ?>
                        <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-secondary btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                        } ?>
                    </div>
                </div>
                <div class="offset-xl-1 col-xl-6 col-lg-6 col-md-7 col-sm-12 col-12">
                    <div class="cta-img">
                        <img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } elseif($style=='style6') { ?>
    <div class="cta-v3 cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="cta-img">
                        <img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="cta-content">
                        <?php if($stitle!=''){ ?><p class="lead text-white"><?php echo esc_attr($stitle); ?></p><?php } ?>
                        <h1 class="cta-title"><?php echo esc_attr($title); ?></h1>
                        <?php echo wpb_js_remove_wpautop($content, true); ?>
                        <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-secondary btn-rounded btn-lg" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($pattern==true){ ?>
    <div class="pattern-bottom">
        <div class="pattern-slide-second"></div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php
    return ob_get_clean();
}

// Search Section (quanto)
add_shortcode('ctas2','ctas2_func');
function ctas2_func($atts, $content = null){
    extract(shortcode_atts(array(
        'photo'       =>  '',
        'title'       =>  '',
        'photo2'      =>  '',
        'photo3'      =>  '',
        'link'        =>  '',
        'link2'       =>  '',
        'iclass'      =>  '',
    ), $atts));
    $img     = wp_get_attachment_image_src($photo,'full');
    $img     = $img[0];
    $img2     = wp_get_attachment_image_src($photo2,'full');
    $img2     = $img2[0];
    $img3     = wp_get_attachment_image_src($photo3,'full');
    $img3     = $img3[0];
    ob_start(); ?>
    <div class="cta-curveshape">
        <div class="cta-curveshape-caption">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="cta-curveshape-caption-text">
                            <h1 class="text-white hero-curveshape-title"><?php echo esc_attr($title); ?></h1>
                            <?php echo wpb_js_remove_wpautop($content, true); ?>
                            <a href="<?php echo esc_url($link) ?>" class=""><img src="<?php echo esc_url($img); ?>" alt=""></a>
                            <a href="<?php echo esc_url($link2) ?>" class=""><img src="<?php echo esc_url($img2); ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="cta-curveshape-img">
                            <img src="<?php echo esc_url($img3) ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// insurance Icon Box (quanto)
add_shortcode('insb','insb_func');
function insb_func($atts, $content = null){
    extract(shortcode_atts(array(
        'pattern'     =>  '',
        'title'       =>  '',
        'icon'        =>  '',
        'iclass'      =>  '',
    ), $atts));
    ob_start(); ?>
    <div class="<?php echo esc_attr($iclass); ?> <?php echo esc_attr($pattern); ?>">
        <div class="feature-block-v8 feature-block">
            <div class="feature-icon">
                <i class="<?php echo esc_attr($icon); ?>"></i>
            </div>
            <div class="feature-content">
                <h4><?php echo esc_attr($title); ?></h4>
                <?php echo wpb_js_remove_wpautop($content, true); ?>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// insurance Slider (quanto)
add_shortcode('inslide', 'inslide_func');
function inslide_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'insurance'     =>  '',
        'show'          =>  '3',
        'arr'           =>  'true',
        'auto'          =>  '',
        'iclass'        =>  '',
    ), $atts));
    $ins = (array) vc_param_group_parse_atts( $insurance );
    ob_start(); ?>

    <div class="ins-product-carousel-v4 <?php echo esc_attr($iclass); ?>">
        <div class="owl-carousel owl-theme owl-insurance-product" data-show="<?php echo esc_attr($show); ?>" data-auto="<?php echo esc_attr($auto); ?>" data-arrow="<?php echo esc_attr($arr); ?>">
        <?php foreach ( $ins as $inslide ) :
            $icon = isset($inslide['icon']) ? $inslide['icon'] : '';
            $title = isset($inslide['title']) ? $inslide['title'] : '';
            $stitle = isset($inslide['stitle']) ? $inslide['stitle'] : '';
            $url = vc_build_link($inslide['link']);
            $color1    = (!empty($inslide['color']) ? 'color:'.$inslide['color'].';' : '');
            $bg_color1 = (!empty($inslide['bg_color']) ? 'background-color:'.$inslide['bg_color'].';' : '');
            $bg_color2 = (!empty($inslide['bg_color2']) ? 'background-color:'.$inslide['bg_color2'].';' : '');
            ?>
            <div class="item">
                <div class="product-card-v1 product-card">
                    <div class="product-head" style="<?php echo esc_attr($bg_color2); ?>">
                        <div class="product-icon" style="<?php echo esc_attr($bg_color1);echo esc_attr($color1); ?>"><i class="<?php echo esc_attr($icon) ?>"></i></div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title"><?php echo esc_attr($title); ?></h3>
                        <p class="product-text"><?php echo wp_specialchars_decode($stitle); ?> </p>
                        <?php if ( strlen( $inslide['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn-primary-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                        } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Calculator (quanto)
add_shortcode('calculatorf','calculatorf_func');
function calculatorf_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title_r'           =>  '',
        'title'             =>  '',
        'title2'            =>  '',
        'titletb'           =>  '',
        'link'              =>  '',
        'currency'          =>  '',
        'amount'            =>  '',
        'rate'              =>  '',
        'term'              =>  '',
        'amount_lb'         =>  '',
        'rate_lb'           =>  '',
        'rate_compare_lb'   =>  '',
        'term_bl'           =>  '',
        'term_alt'          =>  '',
        'payment_amount_tx' =>  '',
        'num_payments_tx'   =>  '',
        'total_payments_tx' =>  '',
        'total_interest_tx' =>  '',
        'error_tx'          =>  '',
        'thead1'            =>  '',
        'thead2'            =>  '',
        'thead3'            =>  '',
        'thead4'            =>  '',
        'thead5'            =>  '',
        'cal_dis'           =>  '',
        'as_dis'            =>  '',
    ), $atts));
    $url = vc_build_link($link);
    $currency1 = (!empty($currency) ? esc_attr($currency) : '$');
    $amount1 = (!empty($amount) ? esc_attr($amount) : '7,500');
    $rate1 = (!empty($rate) ? esc_attr($rate) : '7%');
    $term1 = (!empty($term) ? esc_attr($term) : '36m');
    $rate_compare1 = (!empty($rate_compare) ? esc_attr($rate_compare) : '1.49');
    $amount_tx = (!empty($amount_lb) ? esc_attr($amount_lb) : 'Loan Amount:');
    $rate_tx = (!empty($rate_lb) ? esc_attr($rate_lb) : 'Rate (APR):');
    $rate_compare_tx = (!empty($rate_compare_lb) ? esc_attr($rate_compare_lb) : 'Comparison Rate:');
    $term_tx = (!empty($term_bl) ? esc_attr($term_bl) : 'Term:');
    $term_alt_tx = (!empty($term_alt) ? esc_attr($term_alt) : 'Format: 12m, 36m, 3y, 7y');
    $payment_amount_tx1 = (!empty($payment_amount_tx) ? esc_attr($payment_amount_tx) : 'Monthly Payment:');
    $num_payments_tx1 = (!empty($num_payments_tx) ? esc_attr($num_payments_tx) : 'Number of Payments:');
    $total_payments_tx1 = (!empty($total_payments_tx) ? esc_attr($total_payments_tx) : 'Total Payments:');
    $total_interest_tx1 = (!empty($total_interest_tx) ? esc_attr($total_interest_tx) : 'Total Interest:');
    $error_tx1 = (!empty($error_tx) ? esc_attr($error_tx) : 'Please fill in all fields.');
    $payment_number = (!empty($thead1) ? esc_attr($thead1) : '#');
    $payment_amount = (!empty($thead2) ? esc_attr($thead2) : 'Payment Amt.');
    $total_interest = (!empty($thead3) ? esc_attr($thead3) : 'Total Interest');
    $total_payments = (!empty($thead4) ? esc_attr($thead4) : 'Total Payments:');
    $balance = (!empty($thead5) ? esc_attr($thead5) : 'Balance');
    ob_start(); ?>
    <?php if($cal_dis!=true){ ?>
    <div class="calculator card m-b-60">
        <div class="calculator-loan">
            <div class="calculator-form form">
                <h3 class="card-header"><?php echo esc_attr($title); ?></h3>
            </div>
            <div class="calculator-form">
                <h3 class="card-header"><?php echo esc_attr($title_r); ?></h3>
                <div class="results row"></div>
                <div class="row">
                    <div class="col-xl-12 p-5"> 
                        <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-brand btn-rounded btn-lg btn-block" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php } ?>

    <?php if($as_dis!=true){ ?>
    <div class="card m-b-60">
        <h4 class="card-header"><?php echo esc_attr($title2); ?></h4>
        <div class="card-body p-0">
            <div class="calculator-amortization">
                <div class="calculator-form-second form">
                </div>
                <div class="calculator-form-results">
                    <h4 class="pl-4 pb-2"><?php echo esc_attr($titletb); ?></h4>
                    <div class="results"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <?php } ?>
    <script type="text/javascript">
    (function($) {
   /*
 * Accrue.js
 * http://accruejs.com
 * Author: James Pederson (jpederson.com)
 * Licensed under the MIT, GPL licenses.
 * Version: 1.1.0
 */
;(function( $, window, document, undefined ){
    // let's start our plugin logic
    $.extend($.fn, {
        accrue: function( options ){
            // set our options from the defaults, overriding with the
            // parameter we pass into this function.
            options = $.extend( { calculationMethod: calculateBasic }, $.fn.accrue.options, options );
            // Iterate through all the matching elements and return
            // the jquery object to preserve chaining.
            return this.each(function(){
                // Store a jQuery object for our element so we can use it
                // inside our other bindings.
                var elem = $(this);
                // Create the form div if it doesn't exist.
                if ( !elem.find(".form").length ) {
                    elem.append( '<div class="form"></div>' );
                }
                // Get the amount, rate(s), and term - and clean the values
                var amount = get_field( elem, options, "amount" );
                var rate = get_field( elem, options, "rate" );
                var term = get_field( elem, options, "term" );
                // If we're in comparison mode, grab an additiona field/value.
                if ( options.mode=="compare" ) {
                    var rate_compare = get_field( elem, options, "rate_compare" );
                }
                // If we are using the default results div and it doesn't exist, create it.
                var output_elem;
                if ( options.response_output_div === ".results" ) {
                    if ( elem.find(".results").length === 0 ) {
                        elem.append('<div class="results"></div>');
                    }
                    // Set the output div as a variable so we can refer to it more easily.
                    output_elem = elem.find(".results");
                } else {
                    // Set the output div as a variable so we can refer to it more easily.
                    output_elem = $(options.response_output_div);

                }
                // Set the calculation method based on which mode we're in.
                var calculation_method;
                switch ( options.mode ) {
                    case "basic":
                        calculation_method = calculateBasic;
                    break;
                    case "compare":
                        calculation_method = calculateComparison;
                    break;
                    case "amortization":
                        calculation_method = calculateAmortization;
                    break;
                }
                // Get the information about the loan.
                calculation_method( elem, options, output_elem );
                // Do some different things if the operation mode is "button"
                if ( options.operation=="button" ) {
                    // If we are using button operation mode and the button doesn't exist, create one.
                    if ( elem.find("button").length === 0 && elem.find("input[type=submit]").length === 0 && elem.find("input[type=image]").length === 0 ) {
                        elem.find(".form").append('<button class="accrue-calculate">'+options.button_label+'</button>');
                    }
                    // If the developer has chosen to bind to a button instead
                    // of operate on keyup, let's set up a click event binding
                    // that performs the calculation.
                    elem.find("button, input[type=submit], input[type=image]").each(function(){
                        $(this).click(function( event ){
                            event.preventDefault();
                            calculation_method( elem, options, output_elem );
                        });
                    });
                } else {
                    // Bind to the select and input elements so that we calculate
                    // on keyup (or change in the case of the select list).
                    elem.find("input, select").each(function(){
                        $(this).bind( "keyup change", function(){
                            calculation_method( elem, options, output_elem );
                        });
                    });
                }
                // If the developer has chosen to bind to a button instead
                // of operate on keyup, let's set up a click event binding
                // that performs the calculation.
                elem.find("form").each(function(){
                    $(this).submit(function(event){
                        event.preventDefault();
                        calculation_method( elem, options, output_elem );
                    });
                });
            });
        }
    });
    // DEFAULTS
    // Set up some default options for our plugin that can be overridden 
    // as needed when we actually instantiate our plugin on a form.
    $.fn.accrue.options = {
        mode: "basic",
        operation: "keyup",
        default_values: {
            amount: "<?php echo esc_attr($currency1); ?><?php echo esc_attr($amount1); ?>",
            rate: "<?php echo esc_attr($rate1); ?>",
            rate_compare: "1.49%",
            term: "<?php echo esc_attr($term1); ?>"
        },
        field_titles: {
            amount: "<?php echo esc_attr($amount_tx); ?>",
            rate: "<?php echo esc_attr($rate_tx); ?>",
            rate_compare: "<?php echo esc_attr($rate_compare_tx); ?>",
            term: "<?php echo esc_attr($term_tx); ?>"
        },
        button_label: "Calculate",
        field_comments: {
            amount: "",
            rate: "",
            rate_compare: "",
            term: "<?php echo esc_attr($term_alt_tx); ?>"
        },
        response_output_div: ".results",
        response_basic: 
            '<div class="col-md-6"><div class="results-data"><?php echo esc_attr($payment_amount_tx1); ?><br /><span class="h2 text-primary fontweight-bold "><?php echo esc_attr($currency1); ?>%payment_amount%</span></div></div>'+
            '<div class="col-md-6"><div class="results-data"><?php echo esc_attr($num_payments_tx1); ?><br /><span class="h2 text-primary fontweight-bold ">%num_payments%</span></div></div>'+
            '<div class="col-md-6"><div class="results-data"><?php echo esc_attr($total_payments_tx1); ?><br /><span class="h2 text-primary fontweight-bold "><?php echo esc_attr($currency1); ?>%total_payments%</span></div></div>'+
            '<div class="col-md-6"><div class="results-data"><?php echo esc_attr($total_interest_tx1); ?><br /><span class="h2 text-primary fontweight-bold "><?php echo esc_attr($currency1); ?>%total_interest%</span></div></div>',
        response_compare: '<p class="total-savings">Save $%savings% in interest!</p>',
        error_text: '<p class="error"><?php echo esc_attr($error_tx1); ?></p>',
        callback: function ( elem, data ){}
    };
    // FORMAT MONEY
    // This function is used to add thousand seperators to numerical ouput
    // as a means of properly formatting money
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }
    // GET FIELD
    // A function just for grabbing the value from a particular field.
    // We need this because if the field doesn't exist, the plugin will
    // create it for them.
    var get_field = function( elem, options, name ) {
        // Check for an input with a class of the name.
        var field;
        if ( elem.find(".accrue-"+name).length ) { // if has a class of accrue-[name]
            field = elem.find(".accrue-"+name);
        } else if ( elem.find("."+name).length ) { // if we have class of just the name
            field = elem.find("."+name);
        } else if ( elem.find( "input[name~="+name+"]" ).length ) {
            elem.find( "input[name~="+name+"]" );
        } else {
            field = "";
        }
        // If we have the field value, return it right away so that the
        // calculator doesn't write the field to the form div since we
        // don't need it to.
        if ( typeof( field ) !== "string" ) {
            return field.val();
        }
        if ( name == "term_compare" ) {
            return false;
        }
        // If we've gotten here, no fields were found that match the
        // criteria. Create the form field and return the default value.
        elem.find(".form").append(
            '<div class="accrue-field-'+name+'">'+
                '<p><label>'+options.field_titles[name]+':</label>'+
                '<input type="text" class="'+name+'" value="'+options.default_values[name]+'" />'+
                ( options.field_comments[name].length>0 ? "<small>"+options.field_comments[name]+"</small>" : '' )+'</p>'+
            '</div>');
        return elem.find("."+name).val();
    };
    // CALCULATE BASIC
    // for the basic calculation, we're just getting the values and 
    // calculating loan info for a single loan.
    var calculateBasic = function( elem, options, output_elem ){
        // get the loan information from the current values in the form.
        var loan_info = $.loanInfo({
            amount: get_field( elem, options, "amount" ),
            rate: get_field( elem, options, "rate" ),
            term: get_field( elem, options, "term" )
        });
        // if valid, output into the output_elem that was passed into this function.
        if ( loan_info!==0 ) {
            // replace the placeholders with the response values.
            var output_content = options.response_basic
                .replace( "%payment_amount%", formatNumber(loan_info.payment_amount_formatted) )
                .replace( "%num_payments%", loan_info.num_payments )
                .replace( "%total_payments%",formatNumber(loan_info.total_payments_formatted) )
                .replace( "%total_interest%", formatNumber(loan_info.total_interest_formatted) );
            // output the content to the actual output element.
            output_elem.html( output_content );
        } else {
            // if the values for the loan calculation aren't valid, provide an error.
            output_elem.html( options.error_text );
        }
        // run the callback function after the calculation is done, including
        // the calculation info so it's available in the callback.
        options.callback( elem, loan_info );
    };
    // CALCULATE COMPARE
    // The comparison mode gets 4 values from the form and calculates, then
    // compares two different loans to determine savings in interest.
    var calculateComparison = function( elem, options, output_elem ){
        // see if there's a comparison term
        var term_compare = get_field( elem, options, "term_compare" );
        // if the comparison term is empty, use the normal term field
        if ( typeof( term_compare ) == "boolean" ) {
            term_compare = get_field( elem, options, "term" );
        }
        // Get information about the two different loans in question
        // and create a callback data variable that we'll pass into
        // our callback function.
        var loan_1_info = $.loanInfo({
                amount: get_field( elem, options, "amount" ),
                rate: get_field( elem, options, "rate" ),
                term: get_field( elem, options, "term" )
            }),
            loan_2_info = $.loanInfo({
                amount: get_field( elem, options, "amount" ),
                rate: get_field( elem, options, "rate_compare" ),
                term: term_compare
            }),
            callback_data = {
                loan_1: loan_1_info,
                loan_2: loan_2_info
            };
        // If both loans are good, populate response element with info,
        // else error.
        if ( loan_1_info!==0 && loan_2_info!==0 ) {
            if ( loan_1_info.total_interest-loan_2_info.total_interest > 0 ) {
                callback_data.savings = loan_1_info.total_interest-loan_2_info.total_interest;
            } else {
                callback_data.savings = 0;
            }
            // replace our savings placeholder in the response text with
            // the real difference in interest.
            var output_content = options.response_compare
                .replace( "%savings%", formatNumber(callback_data.savings.toFixed(2)) )
                .replace( "%loan_1_payment_amount%", formatNumber(loan_2_info.payment_amount_formatted) )
                .replace( "%loan_1_num_payments%", loan_2_info.num_payments )
                .replace( "%loan_1_total_payments%", loan_2_info.total_payments_formatted )
                .replace( "%loan_1_total_interest%", formatNumber(loan_2_info.total_interest_formatted) )
                .replace( "%loan_2_payment_amount%", formatNumber(loan_1_info.payment_amount_formatted) )
                .replace( "%loan_2_num_payments%", loan_1_info.num_payments )
                .replace( "%loan_2_total_payments%", loan_1_info.total_payments_formatted )
                .replace( "%loan_2_total_interest%", formatNumber(loan_1_info.total_interest_formatted) );
            output_elem.html( output_content );
        } else {
            // output an error
            output_elem.html( options.error_text );
        }
        // run the callback, passing our loan data into it.
        options.callback( elem, callback_data );
    };
    // CALCULATE AMORTIZATION SCHEDULE
    // This method outputs a table with the repayment schedule
    // for a single loan object.
        var calculateAmortization = function( elem, options, output_elem ){
        // Get the loan information so we can build out our amortization
        // schedule table.
        var loan_info = $.loanInfo({
                amount: get_field( elem, options, "amount" ),
                rate: get_field( elem, options, "rate" ),
                term: get_field( elem, options, "term" )
            });
        // If the loan info's good, start buildin'!
        if ( loan_info!==0 ) {
            // Set some initial variables for the table header, interest
            // per payment, amount from balance, and counter variables
            // to values as we list rows.
            var output_content = '<table class="accrue-amortization">'+
                    '<thead><tr>'+
                    '<th class="accrue-payment-number"><?php echo esc_attr($payment_number); ?></th>'+
                    '<th class="accrue-payment-amount"><?php echo esc_attr($payment_amount); ?></th>'+
                    '<th class="accrue-total-interest"><?php echo esc_attr($total_interest); ?></th>'+
                    '<th class="accrue-total-payments"><?php echo esc_attr($total_payments); ?></th>'+
                    '<th class="accrue-balance"><?php echo esc_attr($balance); ?></th>'+
                    '</tr></thead><tbody>',
                interest_per_payment = loan_info.payment_amount-(loan_info.original_amount/loan_info.num_payments),
                amount_from_balance = loan_info.payment_amount-interest_per_payment,
                counter_interest = 0,
                counter_payment = 0,
                counter_balance = parseInt(loan_info.original_amount, 10);
            // Start appending the table rows to our output variable.
            for ( var i=0; i<loan_info.num_payments; i++) { 
                // Record the payment in our counter variables.
                counter_interest = counter_interest+interest_per_payment;
                counter_payment = counter_payment+loan_info.payment_amount;
                counter_balance = counter_balance-amount_from_balance;
                // bold the last row of the table by using <th>s for
                // the values. 
                var cell_tag = "td";
                if ( i==(loan_info.num_payments-1) ) {
                    cell_tag = "th";
                }
                // Append a row to the table
                output_content = output_content+ 
                    '<tr>'+
                    '<'+cell_tag+' class="accrue-payment-number">'+(i+1)+'</'+cell_tag+'>'+
                    '<'+cell_tag+' class="accrue-payment-amount"><?php echo esc_attr($currency1); ?>'+formatNumber(loan_info.payment_amount_formatted)+'</'+cell_tag+'>'+
                    '<'+cell_tag+' class="accrue-total-interest"><?php echo esc_attr($currency1); ?>'+formatNumber(counter_interest.toFixed(2))+'</'+cell_tag+'>'+
                    '<'+cell_tag+' class="accrue-total-payments"><?php echo esc_attr($currency1); ?>'+formatNumber(counter_payment.toFixed(2))+'</'+cell_tag+'>'+
                    '<'+cell_tag+' class="accrue-balance"><?php echo esc_attr($currency1); ?>'+formatNumber(counter_balance.toFixed(2))+'</'+cell_tag+'>'+
                    '</tr>';
            }
            // Finish off our table tag.
            output_content = output_content+
                '</tbody></table>';
            // Push our output content into the output element.
            output_elem.html( output_content );
        } else {
            // Values aren't good yet, show the error.
            output_elem.html( options.error_text );
        }
        // Execute callback, passing in loan information.
        options.callback( elem, loan_info );
    };
    // BASIC LOGGING FUNCTION
    // Checks to see if the console is available before outputting
    // anything through console.log(). Prevent issues with IE.
    var log = function( message ){
        if ( window.console ) {
            console.log( message );
        }
    };
    // GENERAL LOAN INFORMATION FUNCTION
    // This is the public function we use inside our plugin function
    // and we're exposing it here so that we can also provide generic
    // calculations that just return JSON objects that can be used
    // for custom-developed plugins.
    $.loanInfo = function( input ) {
        var amount = ( typeof( input.amount )!=="undefined" ? input.amount : 0 ).toString().replace(/[^\d.]/ig, ''),
            rate = ( typeof( input.rate )!=="undefined" ? input.rate : 0 ).toString().replace(/[^\d.]/ig, ''),
            term = ( typeof( input.term )!=="undefined" ? input.term : 0 );
        // parse year values passed into the term value
        if ( term.match("y") ) {
            term = parseInt( term.replace(/[^\d.]/ig, ''), 10 )*12;
        } else {
            term = parseInt( term.replace(/[^\d.]/ig, ''), 10 );
        }
        // process the input values
        var monthly_interest = rate / 100 / 12;
        // Now compute the monthly payment amount.
        var x = Math.pow(1 + monthly_interest, term),
            monthly = (amount*x*monthly_interest)/(x-1);
        // If the result is a finite number, the user's input was good and
        // we have meaningful results to display
        if ( amount*rate*term>0 ) {
            // Fill in the output fields, rounding to 2 decimal places
            return {
                original_amount: amount,
                payment_amount: monthly,
                payment_amount_formatted: monthly.toFixed(2),
                num_payments: term,
                total_payments: ( monthly * term ), 
                total_payments_formatted: ( monthly * term ).toFixed(2), 
                total_interest: ( ( monthly * term ) - amount ),
                total_interest_formatted: ( ( monthly * term ) - amount ).toFixed(2)
            };
        } else {
            // The numbers provided won't provide good data as results,
            // so we'll return 0 so it's easy to test if one of the fields
            // is empty or invalid.
            return 0;
        }
    };
    // REVERSE LOAN INFORMATION FUNCTION
    // This is a copy of the above, only that given a payment amount, rate and term it
    // will return the principal amount that can be borrowed.
    $.loanAmount = function( input ) {
        var payment = ( typeof( input.payment )!=="undefined" ? input.payment : 0 ).toString().replace(/[^\d.]/ig, ''),
            rate = ( typeof( input.rate )!=="undefined" ? input.rate : 0 ).toString().replace(/[^\d.]/ig, ''),
            term = ( typeof( input.term )!=="undefined" ? input.term : 0 );
        // parse year values passed into the term value
        if ( term.match("y") ) {
            term = parseInt( term.replace(/[^\d.]/ig, ''), 10 )*12;
        } else {
            term = parseInt( term.replace(/[^\d.]/ig, ''), 10 );
        }
        // process the input values
        var monthly_interest = rate / 100 / 12,
            annual_interest = rate / 100;
        // Now compute.
        var x = payment * (1 - Math.pow(1 + monthly_interest, -1 * term)) * (12/(annual_interest));
        // If the result is a finite number, the user's input was good and
        // we have meaningful results to display
        if ( x>0 ) {
            // Fill in the output fields, rounding to 2 decimal places
            return {
                principal_amount: x,
                principal_amount_formatted: ( x * 1 ).toFixed(2),
                payment_amount: payment,
                payment_amount_formatted: ( payment * 1 ).toFixed(2),
                num_payments: term,
                total_payments: ( payment * term ), 
                total_payments_formatted: ( payment * term ).toFixed(2), 
                total_interest: ( ( payment * term ) - x ),
                total_interest_formatted: ( ( payment * term ) - x ).toFixed(2)
            };
        } else {
            // The numbers provided won't provide good data as results,
            // so we'll return 0 so it's easy to test if one of the fields
            // is empty or invalid.
            return 0;
        }
    };
})( jQuery, window, document );
    })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

// Socials Icon (quanto)
add_shortcode('socialsicon', 'socialsicon_func');
function socialsicon_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'slide'      =>  '',
    ), $atts));
    $slider = (array) vc_param_group_parse_atts( $slide );
    ob_start(); ?>

    <div class="social-media">
        <ul>
        <?php foreach ( $slider as $hslider ) :
            $hslider['icon'] = isset($hslider['icon']) ? $hslider['icon'] : '';
            $hslider['link'] = isset($hslider['link']) ? $hslider['link'] : '';
            $hslider['class']     = '' .esc_attr($hslider['size'] ).' '. esc_attr($hslider['ouline']).' '. esc_attr($hslider['style']).' '. esc_attr($hslider['type']).' '.esc_attr($hslider['iclass']);
            ?>
            <li><a href="<?php echo esc_url($hslider['link']); ?>" class="social-icon <?php echo esc_attr($hslider['class']); ?>"><i class="<?php echo esc_attr($hslider['icon']); ?> fa-fw"></i></a></li>
        <?php endforeach; ?>
        </ul>
    </div>

    <?php
    return ob_get_clean();
}

// List Box (quanto)
add_shortcode('listb', 'listb_func');
function listb_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'slide'      =>  '',
    ), $atts));
    $lists = (array) vc_param_group_parse_atts( $slide );
    ob_start(); ?>

    <div class="custom-list list-group">
        <?php foreach ( $lists as $list ) :
            $title = isset($list['title']) ? $list['title'] : '';
            $stitle = isset($list['stitle']) ? $list['stitle'] : '';
            $link = isset($list['link']) ? $list['link'] : '';
            ?>
            <a href="<?php echo esc_url($link); ?>" class="list-group-item flex-column list-group-item-action align-items-start">
                <h4 class="custom-list-title"><?php echo esc_attr($title); ?></h4>
                <p class="custom-list-text"><?php echo esc_attr($stitle); ?></p>
            </a>
        <?php endforeach; ?>
    </div>

    <?php
    return ob_get_clean();
}

// Process Box (quanto)
add_shortcode('howitwork','howitwork_func');
function howitwork_func($atts, $content = null){
    extract(shortcode_atts(array(
        'number'     =>  '',
        'title'      =>  '',
        'color'      =>  '',
        'bg'         =>  '',
        'icon'       =>  '',
        'stitle'     =>  '',
        'style'      =>  'style1',
        'iclass'     =>  '',
    ), $atts));
    $color1    = (!empty($color) ? 'color:'.$color.';' : '');
    $bg_color1 = (!empty($bg) ? 'background-color:'.$bg.';' : '');

    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="process-block-v1 process-block <?php echo esc_attr($iclass); ?>">
        <div class="process-block-content">
            <div class="icon-circle process-block-icon process-number" style="<?php echo esc_attr($bg_color1);echo esc_attr($color1); ?>"><?php echo esc_attr($number); ?></div>
            <?php if($title){ ?><h4 class="process-block-title"><?php echo esc_attr($title); ?></h4><?php } ?>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="process-block-v4 process-block">
        <div class="process-block-content">
            <div class="process-block-icon ">
                <?php echo esc_attr($number); ?>
            </div>
            <?php if($title){ ?><h4 class="process-block-title"><?php echo esc_attr($title); ?></h4><?php } ?>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>
    <?php }elseif($style=='style3'){ ?>
    <div class="process-block-v5 process-block <?php echo esc_attr($iclass); ?>">
        <div class="process-block-content">
            <div class=" icon-circle process-block-icon" style="background-color:<?php echo esc_attr($bg); ?>;">
                <i class="fa fa-fw <?php echo esc_attr($icon); ?>" style="color:<?php echo esc_attr($color); ?>;"></i>
            </div>
            <h4 class="process-block-title"><?php echo esc_attr($title); ?></h4>
            <div class="process-block-list">
                <?php echo wpb_js_remove_wpautop($content, true); ?>
            </div>
        </div>
    </div>    
    <?php }elseif($style=='style4'){ ?>
    <div class="process-block-v2 <?php echo esc_attr($iclass); ?>">
        <div class="process-block-content">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
                    <div class=" icon-circle process-block-icon bg-brand">
                        <?php echo esc_attr($number); ?>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
                    <h4 class="process-block-title"><?php echo esc_attr($title); ?></h4>
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="process-block-v3 process-block <?php echo esc_attr($iclass); ?>">
        <div class="process-block-content">
            <div class="process-block-icon icon-circle bg-primary text-white">
                <?php echo esc_attr($number); ?>
            </div>
            <h4 class="process-block-title"><?php echo esc_attr($title); ?></h4>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
    </div>
    <?php } ?>
    <?php
    return ob_get_clean();
}

// gallery List (quanto)
add_shortcode('listg','listg_func');
function listg_func($atts, $content = null){
    extract(shortcode_atts(array(
        'gallery'       =>  '',
        'show'          =>  '4',
        'nav'           =>  'true',
        'iclass'        =>  '',
    ), $atts));

    ob_start(); ?>
    <?php 
    $show2 = '';
    if($show == '3'){
        $show2 = 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12';
    }elseif($show == '4'){
        $show2 = 'col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12';
    }else{
        $show2 = 'col-md-6 col-sm-12 col-12';
    }
    ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php
        $img_ids = explode(",",$gallery);
        foreach( $img_ids AS $img_id ){
            $image_src = wp_get_attachment_image_src($img_id,'full');
            $meta = wp_prepare_attachment_for_js($img_id);
            $link = $meta['caption'];
            $alt = $meta['alt'];
            ?>
            <div class="<?php echo esc_attr($show2); ?> pl-xl-0 pr-xl-0 ">
            <?php if($link!=''){ ?><a href="<?php echo esc_url($link) ?>" class=""><?php } ?>
                <div class="gallery-img imghvr-shutter-out-vert mb-xl-0">
                    <img src="<?php echo esc_url($image_src[0]); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid">
                </div>
            <?php if($link!=''){ ?></a><?php } ?>
            </div>
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}

//Pricing Features (quanto)
add_shortcode('featuresbox', 'pfeatures_func');
function pfeatures_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon'        =>  '',
        'stitle'      =>  '',
        'title'       =>  '',
        'price'       =>  '',
        'check'       =>  '',
        'link'        =>  '',
        'iclass'      =>  '',
    ), $atts));
    $url    = vc_build_link( $link );
    ob_start(); ?>

    <div class="pricing-feature-block <?php echo esc_attr($iclass); ?>">
        <?php if($icon!=''){ ?><div class="pricing-feature-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div><?php } ?>
        <div class="pricing-feature-content">
            <?php if($title!=''){ ?><h4 class="pricing-feature-content-title"><?php echo esc_attr($title); ?></h4><?php } ?>
            <?php if($stitle!=''){ ?><p class="pricing-feature-content-text"><?php echo esc_attr($stitle); ?></p><?php } ?>
            <?php if($check != true ){ ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-rounded btn-brand" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
            <?php }else{ ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="text-brand" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '"><i class="fa fa-check"></i>' . esc_attr( $url['title'] ) .'</a>';
            } ?>
            <?php } ?>
            <span class="pricing-feature-content-meta-price"><?php echo esc_attr($price); ?></span>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Image Box (quanto)
add_shortcode('imgbox', 'imgbox_func');
function imgbox_func($atts, $content = null){
    extract(shortcode_atts(array(
        'photo'       =>  '',
        'pattern'     =>  'card-pattern-left',
        'title'       =>  '',
        'stitle'      =>  '',
        'link'        =>  '',
        'style'       =>  'style1',
        'iclass'      =>  '',
    ), $atts));
    $url    = vc_build_link( $link );
    $img     = wp_get_attachment_image_src($photo,'full');
    $img     = $img[0];
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="card <?php echo esc_attr($pattern); ?> <?php echo esc_attr($iclass); ?>">
        <div class="card-header">
            <h4 class=" mb-0"><?php echo esc_attr($title); ?></h4>
        </div>
        <div class="card-img zoomimg">
            <img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid">
        </div>
        <div class="card-body">
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
        <div class="card-footer bg-white">
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
        <div class="card thumbnail-small-block <?php echo esc_attr($iclass); ?>">
            <img src="<?php echo esc_url($img); ?>" alt="" class="card-img-top">
            <?php if($title!=''){ ?><div class="card-body">
                <h5 class="mb-0"><?php echo esc_attr($title); ?></h5>
            </div>
            <?php } ?>
        </div>
    <?php }else{ ?>
    <div class="card-pattern-center-bottom <?php echo esc_attr($iclass); ?>">
        <div class="case-study-block-v1 case-study-block">
            <?php if($img!=''){ ?>
            <div class="case-study-block-img">
                <img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid">
            </div>
            <?php } ?>
            <div class="case-study-block-content">
                <?php if($title!=''){ ?><h3 class="case-study-block-title"><?php echo esc_attr($title); ?></h3><?php } ?>
                <?php if($stitle!=''){ ?><p class="case-study-block-subtext"><?php echo esc_attr($stitle); ?></p><?php } ?>
                <?php echo wpb_js_remove_wpautop($content, true); ?>
                <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                    echo '<a class="btn-primary-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Bank Services Box (quanto)
add_shortcode('banksv', 'banksv_func');
function banksv_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'       =>  '',
        'price'       =>  '',
        'link'        =>  '',
        'iclass'      =>  '',
    ), $atts));
    $url    = vc_build_link( $link );
    ob_start(); ?>
    <div class="card <?php echo esc_attr($iclass); ?>">
        <div class="card-body p-4">
            <span class="mb-1 text-dark"><?php echo esc_attr($title); ?></span>
            <h1 class="text-primary mb-0"><?php echo esc_attr($price); ?></h1>
        </div>
        <div class="card-footer bg-white px-4 pb-3 pt-3 ">
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Bank Feature Box (quanto)
add_shortcode('bankft', 'bankft_func');
function bankft_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'       =>  '',
        'image'       =>  '',
        'img_post'    =>  'left',
        'link'        =>  '',
        'iclass'      =>  '',
    ), $atts));
    $url    = vc_build_link( $link );
    $img     = wp_get_attachment_image_src($image,'full');
    $img     = $img[0];
    ob_start(); ?>
    <div class="service-block-v4 service-block <?php echo esc_attr($iclass); ?>">
        <div class="row d-flex align-items-center">
            <?php if($img_post=='left'){ ?>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="service-block-img card-pattern-circle">
                    <img src="<?php echo esc_url($img); ?>" alt="" class="rounded-circle img-fluid">
                </div>
            </div>
            <?php } ?>
            <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 col-12">
                <div class="service-block-content">
                    <h3 class="service-block-title title"><?php echo esc_attr($title); ?></h3>
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                    <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                        echo '<a class="btn btn-rounded btn-outline-light" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                    } ?>
                </div>
            </div>
            <?php if($img_post=='right'){ ?>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="service-block-img card-pattern-circle">
                    <img src="<?php echo esc_url($img); ?>" alt="" class="rounded-circle img-fluid">
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Gallery Filter (quanto)
add_shortcode('galleryf', 'galleryf_func');
function galleryf_func($atts, $content = null){
    extract(shortcode_atts(array(
        'all'       =>  '',
        'num'       =>  '-1',
        'col'       =>  '4',
        'filter'    =>  '',
        'dis_popup' =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="portfolio filter-gallery <?php echo esc_attr($iclass); ?>">
        <?php if($filter) { ?>
            <div class="filters">
                <ul>
                <?php if($all) { ?><li class="active" data-filter="*"><?php echo esc_html($all); ?></li><?php } ?>
                <?php
                $categories = get_terms('category_gallery');
                foreach( (array)$categories as $categorie){
                    $cat_name = $categorie->name;
                    $cat_slug = $categorie->slug;
                    ?>
                    <li data-filter=".<?php echo esc_attr( $cat_slug ); ?>"><?php echo esc_html( $cat_name ); ?></li>
                <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <div class="filters-content">
            <div class="row grid">
            <?php
            $args = array(
                'post_type' => 'ot_gallery',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
                $cates = get_the_terms(get_the_ID(),'category_gallery');
                $cate_name ='';
                $cate_slug = '';
                foreach((array)$cates as $cate){
                    if(count($cates)>0){
                        $cate_slug .= $cate->slug .' ';
                    }
                }
            ?>
            <?php 
            $column = ' ';
                if( $col == 3 ){
                    $column = 'col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ';
                }elseif( $col == 2 ){
                    $column = 'col-md-6 col-sm-12 col-12 ';
                }else{
                    $column = 'col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 ';
                }
            ?>
            <div class="all <?php echo esc_attr($column.$cate_slug); ?>">
                <div class="item <?php if($dis_popup==true){ echo 'imghvr-shutter-out-vert';} ?>"> 
                    <?php if($dis_popup!=true){ ?><a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="image-link imghvr-shutter-out-vert" title=""><?php } ?>
                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid">
                    <?php if($dis_popup!=true){ ?></a><?php } ?>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// OT Bank Account List (quanto)
add_shortcode('banklist', 'banklist_func');
function banklist_func($atts, $content = null){
    extract(shortcode_atts(array(
        'num'       =>  '-1',
        'pattern'   =>  '',
        'col'       =>  '3',
    ), $atts));
    $column = '';
    if ($col == 3) {
      $column = 'col-lg-4 col-md-6 col-sm-12 col-12';
    }elseif ($col == 2) {
      $column = 'col-md-6 col-sm-12 col-12';
    }else{
      $column = 'col-lg-3 col-md-6 col-sm-12 col-12';
    }
    ob_start(); 
?>

<div class="row">
      <?php 
           $args = array(   
              'post_type' => 'bank_account',   
              'posts_per_page' => $num,
           );  
           $wp_query = new WP_Query($args);
           while ($wp_query -> have_posts()) : $wp_query -> the_post();
           $desc = get_post_meta(get_the_ID(),'desc_bank', true);
           $btn1 = get_post_meta(get_the_ID(),'btn', true);
           $link1 = get_post_meta(get_the_ID(),'link', true);
           $btn2 = get_post_meta(get_the_ID(),'btn2', true);
           $link2 = get_post_meta(get_the_ID(),'link2', true);

       ?>  
       <div class="<?php echo esc_attr($column); ?> <?php echo esc_attr($iclass); ?>">
            <div class="card <?php echo esc_attr($pattern); ?>">
                <div class="card-body">
                    <h3 class="card-title"><?php the_title(); ?></h3>
                    <p class="card-text"><?php echo esc_attr($desc); ?></p>
                </div>
                <div class="card-footer bg-white ">
                    <a href="<?php echo esc_url($link1); ?>" class="btn btn-brand btn-rounded"><?php echo esc_attr($btn1); ?></a>
                    <a href="<?php if($link2!=''){echo ' ' . esc_url($link2) . ' ';}else{echo ' '.the_permalink().' ';} ?>" class="btn btn-outline-light btn-rounded"><?php if($btn2!=''){echo ' ' . esc_attr($btn2) . ' ';}else{echo 'Learn More';} ?></a>
                </div>
            </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
</div>  

<?php
    return ob_get_clean();
}

// OT Bank Relate List (quanto)
add_shortcode('bankrelate', 'bankrelate_func');
function bankrelate_func($atts, $content = null){
    extract(shortcode_atts(array(
        'num'       =>  '-1',
        'pattern'   =>  '',
        'col'       =>  '3',
    ), $atts));
    $column = '';
    if ($col == 3) {
      $column = 'col-lg-4 col-md-6 col-sm-12 col-12';
    }elseif ($col == 2) {
      $column = 'col-md-6 col-sm-12 col-12';
    }else{
      $column = 'col-lg-3 col-md-6 col-sm-12 col-12';
    }
    ob_start(); 
?>

<div class="row">
      <?php 
            //Get array of terms
        $terms = get_the_terms( $post->ID , 'bank_account_cat', 'string');
        //Pluck out the IDs to get an array of IDS
        $term_ids = wp_list_pluck($terms,'term_id');

        //Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
        //Chose 'AND' if you want to query for posts with all terms
          $bank_query = new WP_Query( array(
              'post_type' => 'bank_account',
              'tax_query' => array(
                            array(
                                'taxonomy' => 'bank_account_cat',
                                'field' => 'id',
                                'terms' => $term_ids,
                                'operator'=> 'IN' //Or 'AND' or 'NOT IN'
                             )),
              'posts_per_page' => $num,
              'ignore_sticky_posts' => 1,
              'orderby' => 'rand',
              'post__not_in'=>array($post->ID)
           ) );
           while ($bank_query -> have_posts()) : $bank_query -> the_post();
           $desc = get_post_meta(get_the_ID(),'desc_bank', true);
           $btn1 = get_post_meta(get_the_ID(),'btn', true);
           $link1 = get_post_meta(get_the_ID(),'link', true);
           $btn2 = get_post_meta(get_the_ID(),'btn2', true);
           $link2 = get_post_meta(get_the_ID(),'link2', true);

       ?>  
       <div class="<?php echo esc_attr($column); ?> <?php echo esc_attr($iclass); ?>">
            <div class="card <?php echo esc_attr($pattern); ?>">
                <div class="card-body">
                    <h3 class="card-title"><?php the_title(); ?></h3>
                    <p class="card-text"><?php echo esc_attr($desc); ?></p>
                </div>
                <div class="card-footer bg-white ">
                    <a href="<?php echo esc_url($link1); ?>" class="btn btn-brand btn-rounded"><?php echo esc_attr($btn1); ?></a>
                    <a href="<?php if($link2!=''){echo ' ' . esc_url($link2) . ' ';}else{echo ' '.the_permalink().' ';} ?>" class="btn btn-outline-light btn-rounded"><?php if($btn2!=''){echo ' ' . esc_attr($btn2) . ' ';}else{echo 'Learn More';} ?></a>
                </div>
            </div>
        </div>
      <?php endwhile; ?>
</div>  

<?php
    return ob_get_clean();
}

// OT Loan List (quanto)
add_shortcode('ot_loanlist', 'ot_loanlist_func');
function ot_loanlist_func($atts, $content = null){
    extract(shortcode_atts(array(
        'num'       =>  '-1',
        'pattern'   =>  '',
        'col'       =>  '3',
    ), $atts));
    $grid_columns1 = '';
    if ($col == 3) {
      $column = 'col-lg-4 col-md-6 col-sm-12 col-12';
    }elseif ($col == 2) {
      $column = 'col-md-6 col-sm-12 col-12';
    }else{
      $column = 'col-lg-3 col-md-6 col-sm-12 col-12';
    }
    ob_start(); 
?>

<div class="row">
      <?php 
           $args = array(   
              'post_type' => 'loan',   
              'posts_per_page' => $num,
           );  
           $wp_query = new WP_Query($args);
           while ($wp_query -> have_posts()) : $wp_query -> the_post();
           $icon = get_post_meta(get_the_ID(),'icon', true);
           $desc = get_post_meta(get_the_ID(),'desc_loan', true);
           $btn1 = get_post_meta(get_the_ID(),'btn', true);
           $link1 = get_post_meta(get_the_ID(),'link', true);
           $btn2 = get_post_meta(get_the_ID(),'btn2', true);
           $link2 = get_post_meta(get_the_ID(),'link2', true);

       ?>  
       <div class="<?php echo esc_attr($column); ?> <?php echo esc_attr($iclass); ?>">
            <div class="service-block-v5 service-block <?php echo esc_attr($pattern); ?>">
                <div class="service-block-img">
                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid">
                    <div class="service-block-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                </div>
                <div class="service-block-content">
                    <h4 class="service-block-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="service-block-text"><?php echo esc_attr($desc); ?></p>
                </div>
                <div class="service-block-footer d-flex justify-content-center">
                    <div class="service-block-footer-item service-footer-item-bordered ">
                        <a href="<?php if($lin1k!=''){echo ' ' . esc_url($link1) . ' ';}else{echo ' '.the_permalink().' ';} ?>" class=""><?php if($btn1!=''){echo ' ' . esc_attr($btn1) . ' ';}else{echo 'Explore More';} ?></a>
                    </div>
                    <?php if($btn2!=''){ ?>
                    <div class="service-block-footer-item service-footer-bordered ">
                        <a href="<?php echo esc_url($link2); ?>" class=""><?php echo esc_attr($btn2); ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
</div>  

<?php
    return ob_get_clean();
}

// OT Mortgage List (quanto)
add_shortcode('ot_mortgage', 'ot_mortgage_func');
function ot_mortgage_func($atts, $content = null){
    extract(shortcode_atts(array(
        'num'       =>  '-1',
        'pattern'   =>  '',
        'btnshow'   =>  '',
        'col'       =>  '3',
        'btntext'   =>  '',
        'iclass'    =>  '',
        'ot_type'   =>  'client',
        'style'     =>  'style1',
    ), $atts));
    $btntext1 = (!empty($btntext) ? esc_attr($btntext) : 'Read More');
    $grid_columns1 = '';
    if ($col == 3) {
      $column = 'col-lg-4 col-md-6 col-sm-12 col-12';
    }elseif ($col == 2) {
      $column = 'col-md-6 col-sm-12 col-12';
    }else{
      $column = 'col-lg-3 col-md-6 col-sm-12 col-12';
    }
    ob_start(); 
?>

<div class="row <?php echo esc_attr($iclass); ?>">
      <?php 
      if($ot_type=='client') {
        $args = array(   
            'post_type' => 'ot_mortgage',   
            'posts_per_page' => $num,
            'tax_query' => array(
             array(
                    'taxonomy' => 'ot_mortgage_cat',
                    'field'    => 'slug',
                    'terms'    => 'client',
                ),
                    ),
                    );  
      }else{     
             $args = array(   
        'post_type' => 'ot_mortgage',   
        'posts_per_page' => $num,
        'tax_query' => array(
         array(
                'taxonomy' => 'ot_mortgage_cat',
                'field'    => 'slug',
                'terms'    => 'freelancer',
            ),
                ),
                );  

      }
          
        
           $wp_query = new WP_Query($args);
           while ($wp_query -> have_posts()) : $wp_query -> the_post();
           $icon = get_post_meta(get_the_ID(),'icon', true);
           $desc = get_post_meta(get_the_ID(),'desc_mortgage', true);

       ?>  
       <?php if($style=='style1'){ ?>
       <div class="<?php echo esc_attr($column); ?>">
            <div class="service-block-v1 service-block service-block-outline <?php echo esc_attr($pattern); ?>">
                <div class="service-block-content">
                    <?php if($icon!=''){ ?>
                    <div class="icon-circle service-block-icon">
                        <i class="<?php echo esc_attr($icon); ?>"></i>
                    </div>
                    <?php } ?>
                    <h3 class="service-block-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h3>
                    <?php if($desc!=''){ ?><p class="service-block-text"><?php echo esc_attr($desc); ?> </p><?php } ?>
                </div>
                <?php if($btnshow==true){ ?>
                <div class="service-block-footer">
                    <a href="<?php the_permalink(); ?>" class="btn-brand-link"> <?php echo esc_attr($btntext1); ?></a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php }else{ ?>
        <div class="<?php echo esc_attr($column); ?>">
            <div class="service-block service-block-v2">
                <div class=" service-block-icon icon-circle bg-primary-light text-primary">
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                </div>
                <div class="service-block-content">
                    <h3 class="service-block-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h3>
                    <?php if($desc!=''){ ?><p class="service-block-text"><?php echo esc_attr($desc); ?> </p><?php } ?>
                    <?php if($btnshow==true){ ?>
                    <a href="<?php the_permalink(); ?>" class="btn-brand-link"> <?php echo esc_attr($btntext1); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
      <?php endwhile; wp_reset_postdata(); ?>
</div>  

<?php
    return ob_get_clean();
}

// Lenders (quanto)
add_shortcode('lenders', 'lenders_func');
function lenders_func($atts, $content = null){
    extract(shortcode_atts(array(
        'number'    =>  '-1',
        'col'       =>  '3',
        'btntext'   =>  '',
        'btnshow'   =>  '',
        'iclass'    =>  '',
        'style'     =>  'style1',
    ), $atts));
    $btntext1 = (!empty($btntext) ? esc_attr($btntext) : 'Read More');
    ob_start(); ?>

    <?php if($style=='style1'){ ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php
        $args = array(
            'post_type' => 'ot_lenders',
            'posts_per_page' => $number,
        );
        $wp_query = new WP_Query($args);
        while ($wp_query -> have_posts()) : $wp_query -> the_post();
        $shortcont = get_post_meta(get_the_ID(),'shortcont', true);
        $review = get_post_meta(get_the_ID(),'review', true);
        $number = get_post_meta(get_the_ID(),'number', true);
        ?>

        <?php 
            $column = ' ';
            if( $col == 3 ){
                $column = 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ';
            }elseif( $col == 2 ){
                $column = 'col-md-6 col-sm-12 col-12 ';
            }else{
                $column = 'col-lg-3 col-md-6 col-sm-12 col-12 ';
            }
        ?>
        <div class="<?php echo esc_attr($column); ?>">
            <div class="lender-block-v1 lender-block">
                <div class="lender-header">
                    <div class="lender-img"> <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""></div>
                </div>
                <div class="lender-content">
                    <div class="rating mb-3">
                            <?php if($review=='1star'){ ?>
                            <span><i class="fa fa-star"></i></span>
                            <?php } elseif($review=='half'){ ?>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='1s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='2star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='2s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='3star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='3s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='4star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='4s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } else{ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } ?>
                        <?php if($number!=''){ ?><span class="text-primary ml-2"><?php echo esc_attr($number); ?></span><?php } ?>
                    </div>
                    <?php echo wpb_js_remove_wpautop($shortcont, true); ?>
                </div>
                <?php if($btnshow==true){ ?>
                <div class="lender-footer">
                    <a href="<?php the_permalink(); ?>" class="btn-brand-link"><?php echo esc_attr($btntext1); ?></a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php }else{ ?>
    <div class="card-deck <?php echo esc_attr($iclass); ?>">
        <?php
            $args = array(
                'post_type' => 'ot_lenders',
                'posts_per_page' => $number,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $desc = get_post_meta(get_the_ID(),'desc', true);
            $number = get_post_meta(get_the_ID(),'number', true);
        ?>
        <div class="client-block client-block-v1">
            <div class="client-block-content text-center">
                <div class="client-block-img"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""></div>
                <p class="client-block-text"> <?php echo wp_specialchars_decode($desc); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn-brand-link"><?php echo esc_attr($btntext1); ?></a>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Lenders Compare (quanto)
add_shortcode('lenders_ss', 'lenders_ss_func');
function lenders_ss_func($atts, $content = null){
    extract(shortcode_atts(array(
        'number'       =>  '-1',
        'btntext'  =>  '',
        'btn2'      =>  '',
        'thead1'  =>  '',
        'thead2'  =>  '',
        'thead3'  =>  '',
        'thead4'  =>  '',
        'iclass'    =>  '',
    ), $atts));
    $btntext1 = (!empty($btntext) ? esc_attr($btntext) : 'More Details');
    $btntext2 = (!empty($btn2) ? esc_attr($btn2) : 'More Info');
    ob_start(); ?>

    <div class="table-responsive <?php echo esc_attr($iclass); ?>">
        <table class="table lender-compare-table ">
            <thead>
                <tr>
                    <th scope="col"><?php echo esc_attr($thead1); ?></th>
                    <th scope="col"><?php echo esc_attr($thead2); ?></th>
                    <th scope="col"><?php echo esc_attr($thead3); ?></th>
                    <th scope="col"><?php echo esc_attr($thead4); ?></th>
                </tr>
            </thead>
        <?php
        $i=0;
        $args = array(
            'post_type' => 'ot_lenders',
            'posts_per_page' => $number,
        );
        $wp_query = new WP_Query($args);
        while ($wp_query -> have_posts()) : $wp_query -> the_post(); $i++;
        $shortcont = get_post_meta(get_the_ID(),'shortcont', true);
        $review = get_post_meta(get_the_ID(),'review', true);
        $number = get_post_meta(get_the_ID(),'number', true);
        $apr = get_post_meta(get_the_ID(),'lender_apr', true);
        $rate_text = get_post_meta(get_the_ID(),'lender_rate_text', true);
        $rate_value = get_post_meta(get_the_ID(),'lender_rate_value', true);
        $fee_text = get_post_meta(get_the_ID(),'lender_fee_text', true);
        $fee_alt = get_post_meta(get_the_ID(),'lender_fee_alt', true);
        $fee_value = get_post_meta(get_the_ID(),'lender_fee_value', true);
        $payment_text = get_post_meta(get_the_ID(),'lender_payment_text', true);
        $payment = get_post_meta(get_the_ID(),'lender_payment', true);
        $hotline = get_post_meta(get_the_ID(),'lender_hotline', true);
        ?>

        <tbody>
            <tr>
                <td>
                    <div class="lender-data">
                        <div class="lender-data-img"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""></div>
                        <div class="lender-data-rating">
                            <div class="rating">
                            <?php if($review=='1star'){ ?>
                            <span><i class="fa fa-star"></i></span>
                            <?php } elseif($review=='half'){ ?>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='1s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='2star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='2s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='3star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='3s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='4star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='4s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } else{ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } ?>
                                <span class="text-dark rating-text"><?php echo esc_attr($number); ?></span>
                            </div>
                            <small class="lender-id"><?php esc_html_e('ID #1','quanto'); ?><?php echo esc_attr($i); ?></small>
                        </div>
                        <p class="lender-fee-year"><?php echo esc_attr($thead1); ?></p>
                    </div>
                </td>
                <td>
                    <div class="lender-rate">
                        <h3 class="lender-rate-value"><?php echo esc_attr($apr); ?></h3>
                        <div class="lender-rate-data">
                            <small class="lender-rate-meta fontweight-medium "><span class="lender-rate-meta-text text-light"><?php echo esc_attr($rate_text); ?></span> <span class="lender-rate-meta-value"><?php echo esc_attr($rate_value); ?></span></small><br>
                            <small class="lender-rate-meta fontweight-medium "><span class="lender-rate-meta-fees text-light"><?php echo esc_attr($fee_text); ?></span> <span class="lender-rate-meta-amount"><?php echo esc_attr($fee_value); ?></span> <a href="javascript:void(0)" class="btn-popover" data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo esc_attr($fee_alt); ?>"> <i class="fa fa-exclamation-circle "></i> </a>
                            </small>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="lender-payment">
                        <h3 class="lender-payment-amount"><?php echo esc_attr($payment); ?></h3>
                        <small class="lender-payment-amount-meta"><?php echo esc_attr($payment_text); ?></small>
                    </div>
                </td>
                <td>
                    <div class="lender-info">
                        <div class=" text-center">
                            <a href="<?php the_permalink(); ?>" class="btn btn-brand btn-rounded btn-sm"> <?php echo esc_attr($btntext1); ?></a><br>
                            <small class="text-light lender-info-call-text"><?php echo esc_attr($hotline); ?></small>
                        </div>
                        <!-- Button trigger modal -->
                        <a href="#" class="mt-4 d-block text-center" data-toggle="modal" data-target="#modal-<?php echo esc_attr($i); ?>"> <i class="fa fa-plus-circle"></i> <?php echo esc_attr($btntext2); ?></a>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-<?php echo esc_attr($i); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php the_content(); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php esc_html_e('Close','quanto'); ?></button>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Start With Landers','quanto'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
        <?php endwhile; wp_reset_postdata(); ?>
        </table>
    </div>

    <?php
    return ob_get_clean();
}

// Credit Card Compare (quanto)
add_shortcode('creditcom', 'creditcom_func');
function creditcom_func($atts, $content = null){
    extract(shortcode_atts(array(
        'num'           =>  '-1',
        'credit_score'  =>  '',
        'object_lb'  =>  '',
        'annual_fee_lb'  =>  '',
        'bouns_offer_lb'  =>  '',
        'apr_lb'  =>  '',
        'ongoing_apr_lb'  =>  '',
        'earn_re_lb'  =>  '',
        'pros_lb'  =>  '',
        'cons_lb'  =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="table-responsive <?php echo esc_attr($iclass); ?>">
        <table class="table compare-table">
        <tbody>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $review = get_post_meta(get_the_ID(),'review', true);
            $reviewtext = get_post_meta(get_the_ID(),'reviewtext', true);
            $btn1 = get_post_meta(get_the_ID(),'btn1', true);
            $link1 = get_post_meta(get_the_ID(),'link1', true);
            ?>
            <td class="border-0 border-right px-3">
                <div class="card-block">
                    <div class="card-block-img"><a href="#"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid"></a></div>
                    <div class="card-block-content">
                        <div class="card-block-head border-0">
                            <h4 class="card-block-head-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h4>
                            <div class="rating mb-3">
                            <?php if($review=='1star'){ ?>
                            <span><i class="fa fa-star"></i></span>
                            <?php } elseif($review=='half'){ ?>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='1s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='2star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='2s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='3star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='3s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } elseif($review=='4star'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } elseif($review=='4s-half'){ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star-half"></i> </span>
                            <?php } else{ ?>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <span><i class="fa fa-star"></i> </span>
                            <?php } ?>
                                <?php if($reviewtext){ ?><span class="text-primary fontweight-bold"><?php echo esc_attr($reviewtext); ?></span><?php } ?>
                            </div>
                        </div>
                        <a href="<?php echo esc_url($link1); ?>" class="btn btn-rounded btn-primary"><?php echo esc_attr($btn1); ?></a>
                    </div>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="credit-score border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($credit_score); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $score_tt = get_post_meta(get_the_ID(),'score_tt', true);
            $score_tx = get_post_meta(get_the_ID(),'score_tx', true);
            $score_if = get_post_meta(get_the_ID(),'score_if', true);
            $score_pb = get_post_meta(get_the_ID(),'score_pb', true);
            ?>
            <td class="border-right">
                <div class="p-t-20 p-b-20">
                    <h5><?php echo esc_attr($score_tt); ?></h5>
                    <p class="d-flex justify-content-between mb-0"><?php echo esc_attr($score_tx); ?> <span><?php echo esc_attr($if); ?></span></p>
                    <div class="progress progress-md">
                        <div class="progress-bar bg-brand" role="progressbar" style="width: <?php echo esc_attr($score_pb); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="great-for border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($object_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $objects = get_post_meta(get_the_ID(),'objects_for', true);
            ?>
            <td class="border-right pl-0 pr-0">
                <div class="p-t-20 p-b-20">
                    <?php echo wpb_js_remove_wpautop($objects, true); ?>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="annual-fee border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($annual_fee_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $annual_fee_value = get_post_meta(get_the_ID(),'annual_fee_value', true);
            ?>
            <td class="border-right pr-0">
                <div class="p-t-20 p-b-20">
                    <h3 class="mb-0"><?php echo wp_specialchars_decode($annual_fee_value); ?></h3>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="bouns-offer border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($bouns_offer_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $bouns_off = get_post_meta(get_the_ID(),'bouns_off', true);
            ?>
            <td class="border-right pr-0">
                <div class="p-t-20 p-b-20">
                    <p><?php echo esc_attr($bouns_off); ?></p>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="apr border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($apr_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $apr = get_post_meta(get_the_ID(),'apr', true);
            ?>
            <td class="border-right pr-0">
                <div class="p-t-20 p-b-20">
                    <p><?php echo esc_attr($apr); ?></p>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="ongoing-apr border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($ongoing_apr_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $ongoing_apr = get_post_meta(get_the_ID(),'ongoing_apr', true);
            ?>
            <td class="border-right pr-0">
                <div class="p-t-20 p-b-20">
                    <p><?php echo wp_specialchars_decode($ongoing_apr); ?></p>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="earning-rewards border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($earn_re_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $earning_rew = get_post_meta(get_the_ID(),'earning_rew', true);
            ?>
            <td class="border-right pr-0">
                <div class="p-t-20 p-b-20">
                    <p><?php echo wp_specialchars_decode($earning_rew); ?></p>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>

        <tbody class="pros border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($pros_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $pros = get_post_meta(get_the_ID(),'pros', true);
            ?>
            <td class="border-right pr-0">
                <div class="p-t-20 p-b-20">
                    <?php echo wpb_js_remove_wpautop($pros, true); ?>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>
        <tbody class="cons border-0">
            <tr>
                <th scope="row" class="bg-white px-3"><?php echo esc_attr($cons_lb); ?></th>
                <th scope="row" class="bg-white px-3"></th>
                <th scope="row" class="bg-white px-3"></th>
            </tr>
            <tr>
            <?php
            $args = array(
                'post_type' => 'credit_card',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            $cons = get_post_meta(get_the_ID(),'cons', true);
            ?>
            <td class="border-right pr-0">
                <div class="p-t-20 p-b-20">
                    <?php echo wpb_js_remove_wpautop($cons, true); ?>
                </div>
            </td>
            <?php endwhile; ?>
            </tr>
        </tbody>

        </table>
    </div>

    <?php
    return ob_get_clean();
}

// Credit Card (quanto)
add_shortcode('creditcard', 'creditcard_func');
function creditcard_func($atts, $content = null){
    extract(shortcode_atts(array(
        'number'    =>  '-1',
        'col'       =>  '3',
        'idpost'    =>  '',
        'style'     =>  'style1',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php
        if($idpost!=''){
        $args = array(
            'post_type' => 'credit_card',
            'posts_per_page' => $number,
            'post__in' => explode(',',$idpost)
        );
        }else{
        $args = array(
            'post_type' => 'credit_card',
            'posts_per_page' => $number,
        );    
        }
        $wp_query = new WP_Query($args);
        while ($wp_query -> have_posts()) : $wp_query -> the_post();
        $cates = get_the_terms(get_the_ID(),'creditcard_cat');
        $cate_name ='';
        $cate_slug = '';
        foreach((array)$cates as $cate){
            if(count($cates)>0){
                $cate_name .= $cate->name .' ';
                $cate_slug .= $cate->slug .' ';
            }
        }
        $desc = get_post_meta(get_the_ID(),'desc', true);
        $shortcont = get_post_meta(get_the_ID(),'shortcont', true);
        $reviewtit = get_post_meta(get_the_ID(),'reviewtit', true);
        $review = get_post_meta(get_the_ID(),'review', true);
        $reviewtext = get_post_meta(get_the_ID(),'reviewtext', true);
        $value1 = get_post_meta(get_the_ID(),'value1', true);
        $value2 = get_post_meta(get_the_ID(),'value2', true);
        $disclosure = get_post_meta(get_the_ID(),'disclosure', true);
        $btn1 = get_post_meta(get_the_ID(),'btn1', true);
        $link1 = get_post_meta(get_the_ID(),'link1', true);
        $btn2 = get_post_meta(get_the_ID(),'btn2', true);
        $link2 = get_post_meta(get_the_ID(),'link2', true);
        $regular_apr_text = get_post_meta(get_the_ID(),'regular_apr', true);
        $apr_value = get_post_meta(get_the_ID(),'regular_apr_value', true);
        $annual_fee = get_post_meta(get_the_ID(),'annual_fee', true);
        $annual_fee_value = get_post_meta(get_the_ID(),'annual_fee_value', true);
        $purchase_intro = get_post_meta(get_the_ID(),'purchase_intro', true);
        $purchase_intro_value = get_post_meta(get_the_ID(),'purchase_intro_value', true);
        $balance_transfer_intro = get_post_meta(get_the_ID(),'balance_transfer_intro', true);
        $balance_transfer_intro_value = get_post_meta(get_the_ID(),'balance_transfer_intro_value', true);
        ?>
        <?php if($style=='style1'){ ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-heading-single">
                <h3 class="section-heading-title"><?php the_title(); ?></h3>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card credit-card-balance">
                <div class="card-header d-flex justify-content-between ">
                    <?php if($cate_name!=''){ ?><h4 class="mb-0 font-21"><?php echo esc_attr($cate_name); ?></h4><?php } ?>
                    <?php if($disclosure!=''){ ?><p><small><?php echo esc_attr($disclosure); ?></small> </p><?php } ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 col-12">
                            <div class="credit-card-balance-img">
                                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid">
                            </div>
                            <div class="credit-card-balance-review ">
                                <?php if($reviewtit!=''){ ?><h4 class="credit-card-balance-review-title"><?php echo esc_attr($reviewtit); ?></h4><?php } ?>
                                <div class="rating mb-3">
                                <?php if($review=='1star'){ ?>
                                <span><i class="fa fa-star"></i></span>
                                <?php } elseif($review=='half'){ ?>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='1s-half'){ ?>
                                <span><i class="fa fa-fw fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='2star'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } elseif($review=='2s-half'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='3star'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } elseif($review=='3s-half'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='4star'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } elseif($review=='4s-half'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } else{ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } ?>
                                    <?php if($reviewtext!=''){ ?><span class="rating-text"><?php echo esc_attr($reviewtext); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="credit-card-balance-value">
                                <?php if($value1!=''){ ?><h5 class="mb-0"><?php echo esc_attr($value1); ?></h5><?php } ?>
                                <?php if($value2!=''){ ?><p><small class="fontweight-medium"><?php echo esc_attr($value2); ?></small></p><?php } ?>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="credit-card-balance-list">
                            <?php echo wpb_js_remove_wpautop($shortcont, true); ?>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 text-right">
                            <?php if($btn1!=''){ ?><a href="<?php echo esc_url($link1) ?>" class="btn btn-rounded btn-primary mb-3 "><?php echo esc_attr($btn1); ?></a><?php } ?>
                            <?php if($btn2!=''){ ?><a href="<?php echo esc_url($link2) ?>" class="btn btn-rounded btn-outline-light"><span class="mr-3"><i class="fa fa-fw fa-plus"></i></span><?php echo esc_attr($btn2); ?></a><?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-xl-flex credit-card-balance-footer ">
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($regular_apr_text); ?> </h5>
                        <p><?php echo esc_attr($apr_value); ?></p>
                    </div>
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($annual_fee); ?> </h5>
                        <p><?php echo esc_attr($annual_fee_value); ?> </p>
                    </div>
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($purchase_intro); ?> </h5>
                        <p><?php echo esc_attr($purchase_intro_value); ?> </p>
                    </div>
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($balance_transfer_intro); ?></h5>
                        <p><?php echo esc_attr($balance_transfer_intro_value); ?> </p>
                    </div>
                </div>
            </div>
            <!-- card balance close -->
        </div>
        <?php }elseif($style=='remotify'){ ?> 
            <?php 
            $column = ' ';
                if( $col == 3 ){
                    $column = 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ';
                }elseif( $col == 2 ){
                    $column = 'col-md-6 col-sm-12 col-12 ';
                }else{
                    $column = 'col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 ';
                } 
            ?>
        
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="section-heading-single">
                <h3 class="section-heading-title"><?php the_title(); ?></h3>
            </div>
            <div class="card credit-card-balance">
                <div class="card-header d-flex justify-content-between ">
                    <?php if($cate_name!=''){ ?><h4 class="mb-0 font-21"><?php echo esc_attr($cate_name); ?></h4><?php } ?>
                    <?php if($disclosure!=''){ ?><p><small><?php echo esc_attr($disclosure); ?></small> </p><?php } ?>
                </div>
                <div class="card-body">
                    <div class="row">
                       <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="credit-card-balance-list">
                            <?php echo wpb_js_remove_wpautop($shortcont, true); ?>
                            </div>
                        </div>
                       <div class="col-xl-3 col-lg-3 col-md-2 col-sm-12 col-12">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12 text-right">
                         <!--   <?php if($btn1!=''){ ?><a href="<?php echo esc_url($link1) ?>" class="btn btn-rounded btn-primary mb-3 "><?php echo esc_attr($btn1); ?></a><?php } ?>
                            <?php if($btn2!=''){ ?><a href="<?php echo esc_url($link2) ?>" class="btn btn-rounded btn-outline-light"><span class="mr-3"><i class="fa fa-fw fa-plus"></i></span><?php echo esc_attr($btn2); ?></a><?php } ?>
                        -->
                        </div>
                    </div>
                </div>
                <div class="card-footer d-xl-flex credit-card-balance-footer ">
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($regular_apr_text); ?> </h5>
                        <p><?php echo esc_attr($apr_value); ?></p>
                    </div>
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($annual_fee); ?> </h5>
                        <p><?php echo esc_attr($annual_fee_value); ?> </p>
                    </div>
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($purchase_intro); ?> </h5>
                        <p><?php echo esc_attr($purchase_intro_value); ?> </p>
                    </div>
                    <div class="card-footer-item card-footer-item-bordered">
                        <h5 class="mb-0"> <?php echo esc_attr($balance_transfer_intro); ?></h5>
                        <p><?php echo esc_attr($balance_transfer_intro_value); ?> </p>
                    </div>
                </div>
            </div>
            <!-- card balance close -->
        </div>
        <?php }else{ ?> 
            <?php 
            $column = ' ';
                if( $col == 3 ){
                    $column = 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ';
                }elseif( $col == 2 ){
                    $column = 'col-md-6 col-sm-12 col-12 ';
                }else{
                    $column = 'col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 ';
                } 
            ?>
        <div class="<?php echo esc_attr($column); ?>">
            <!-- card block start -->
            <div class="card-block">
                <div class="card-block-img"><a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid"></a></div>
                <div class="card-block-content">
                    <div class="card-block-head">
                        <h4 class="card-block-head-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h4>
                        <div class="rating mb-3">
                                <?php if($review=='1star'){ ?>
                                <span><i class="fa fa-star"></i></span>
                                <?php } elseif($review=='half'){ ?>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='1s-half'){ ?>
                                <span><i class="fa fa-fw fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='2star'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } elseif($review=='2s-half'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='3star'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } elseif($review=='3s-half'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } elseif($review=='4star'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } elseif($review=='4s-half'){ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star-half"></i> </span>
                                <?php } else{ ?>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <span><i class="fa fa-star"></i> </span>
                                <?php } ?>
                            <span class="text-dark fontweight-bold"><?php echo esc_attr($reviewtext); ?></span>
                        </div>
                    </div>
                    <p><?php echo esc_attr($desc); ?> </p>
                </div>
            </div>
            <!-- card block close -->
        </div>
        <?php } ?>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php
    return ob_get_clean();
}

// Portfolio Filter (quanto)
add_shortcode('portfoliof', 'portfoliof_func');
function portfoliof_func($atts, $content = null){
    extract(shortcode_atts(array(
        'all'       =>  '',
        'num'       =>  '-1',
        'col'       =>  '4',
        'filter'    =>  '',
        'dis_cont'  =>  '',
        'link_st'   =>  'single',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="portfolio filter-gallery <?php echo esc_attr($iclass); ?>">
        <?php if($filter) { ?>
            <div class="filters">
                <ul>
                <?php if($all) { ?><li class="active" data-filter="*"><?php echo esc_html($all); ?></li><?php } ?>
                <?php
                $categories = get_terms('portfolio_cat');
                foreach( (array)$categories as $categorie){
                    $cat_name = $categorie->name;
                    $cat_slug = $categorie->slug;
                    ?>
                    <li data-filter=".<?php echo esc_attr( $cat_slug ); ?>"><?php echo esc_html( $cat_name ); ?></li>
                <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <div class="filters-content">
            <div class="row grid">
            <?php
            $args = array(
                'post_type' => 'ot_portfolio',
                'posts_per_page' => $num,
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
                $cates = get_the_terms(get_the_ID(),'portfolio_cat');
                $cate_name ='';
                $cate_slug = '';
                foreach((array)$cates as $cate){
                    if(count($cates)>0){
                        $cate_slug .= $cate->slug .' ';
                        $cate_name .= $cate->name .' ';
                    }
                }
                ?>
                <?php 
                $column = ' ';
                    if( $col == 3 ){
                        $column = 'col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ';
                    }elseif( $col == 2 ){
                        $column = 'col-md-6 col-sm-12 col-12 ';
                    }else{
                        $column = 'col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 ';
                    }
                ?>
                <div class="all <?php echo esc_attr($column.$cate_slug); ?>">
                    <!-- portfolio block start -->
                    <div class="portfolio-block">
                        <div class="portfolio-img">
                            <a href="<?php if($link_st=='popup'){echo ' '.wp_get_attachment_url(get_post_thumbnail_id()).' ';}else{echo ' '.the_permalink().' ';} ?>" class="<?php if($link_st=='popup'){echo 'image-link';} ?> imghvr-shutter-out-vert"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid"></a>
                        </div>
                        <?php if($dis_cont!=true){ ?>
                        <div class="portfolio-content">
                            <h3 class="portfolio-content-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h3>
                            <p class="portfolio-content-text"><?php echo esc_attr($cate_name); ?></p>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- portfolio block close -->
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Testimonials List (quanto)
add_shortcode('testimonialslist', 'testimonialslist_func');
function testimonialslist_func($atts, $testi, $iclass, $content = null){
    extract(shortcode_atts(array(
        'testi'     =>  '',
        'testi2'     =>  '',
        'iclass'    =>  '',
        'col'    =>  '3',
        'style'     =>  'style1',
    ), $atts));
    $says = (array) vc_param_group_parse_atts( $testi );
    $says2 = (array) vc_param_group_parse_atts( $testi2 );
    ob_start(); ?>
    <?php 
        $col2 = '';
        if($col == '2'){
            $col2 = 'col-md-6 col-sm-12 col-12';
        }elseif($col == '4'){
            $col2 = 'col-lg-3 col-md-6 col-sm-12 col-12';
        }else{
            $col2 = 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12';
        }
    ?>
    <?php if($style=='style1'){ ?>
    <div class="testimonial-block-v1 <?php echo esc_attr($iclass); ?>">
        <div class="row">
        <?php foreach ( $says as $say ) :
            $say['photo'] = isset($say['photo']) ? $say['photo'] : '';
            $img = wp_get_attachment_image_src($say['photo'],'full'); $img = $img[0];
            $say['name'] = isset($say['name']) ? $say['name'] : '';
            $say['job'] = isset($say['job']) ? $say['job'] : '';
            $say['des'] = isset($say['des']) ? $say['des'] : '';
            ?>
            <?php if($img!=''){ ?>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="testimonial-img shadow card-pattern-right">
                    <img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid">
                </div>
            </div>
            <?php } ?>
            <div class="offset-xl-1 col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="testimonial-block">
                    <div class="testimonial-content">
                        <p class="testimonail-text"><?php echo esc_attr($say['des']); ?></p>
                        <div class="testimonial-meta-text">
                            <span class="testimonial-meta-name"><?php echo esc_attr($say['name']); ?></span>
                            <small class="testimonial-meta-subtext"><?php echo esc_attr($say['job']); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $says2 as $say2 ) :
            $say2['photo'] = isset($say2['photo']) ? $say2['photo'] : '';
            $img = wp_get_attachment_image_src($say2['photo'],'full'); $img = $img[0];
            $say2['name'] = isset($say2['name']) ? $say2['name'] : '';
            $say2['des'] = isset($say2['des']) ? $say2['des'] : '';
            $say2['rate'] = isset($say2['rate']) ? $say2['rate'] : '';
            $say2['col'] = isset($say2['col']) ? $say2['col'] : '';
        ?>
        
        <div class="<?php echo esc_attr($col2); ?>">
            <div class="testimonial-block-v2 testimonial-block ">
                <div class="testimonial-content">
                    <div class="testimonial-comment-icon"><i class="fa fa-commenting-o fa-2x text-primary"></i></div>
                    <p class="testimonial-text"><?php echo esc_attr($say2['des']); ?></p>
                </div>
                <!-- testimonial footer -->
                <div class="testimonial-footer d-flex justify-content-start">
                    <?php if($img!=''){ ?>
                    <div class="tesstimonial-img align-self-center">
                        <img src="<?php echo esc_url($img); ?>" alt="" class="user-avatar-lg rounded-circle">
                    </div>
                    <?php } ?>
                    <!-- testimonial meta -->
                    <div class="testimonial-meta">
                        <h5 class="testimonial-meta-name"><?php echo esc_attr($say2['name']); ?></h5>
                        <?php if($say2{'dis_rate'}!=true){ ?>
                        <div class="rating">
                            <?php if($say2['rate']=='1star'){ ?>
                            <i class="fa fa-fw fa-star"></i>
                            <?php } elseif($say2['rate']=='half'){ ?>
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($say2['rate']=='1s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($say2['rate']=='2star'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } elseif($say2['rate']=='2s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($say2['rate']=='3star'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } elseif($say2['rate']=='3s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } elseif($say2['rate']=='4star'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } elseif($say2['rate']=='4s-half'){ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star-half"></i> 
                            <?php } else{ ?>
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <i class="fa fa-fw fa-star"></i> 
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php }elseif($style=='style3'){ ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $says2 as $say2 ) :
            $say2['photo'] = isset($say2['photo']) ? $say2['photo'] : '';
            $img = wp_get_attachment_image_src($say2['photo'],'full'); $img = $img[0];
            $say2['name'] = isset($say2['name']) ? $say2['name'] : '';
            $say2['des'] = isset($say2['des']) ? $say2['des'] : '';
            $say2['rate'] = isset($say2['rate']) ? $say2['rate'] : '';
            $say2['ratext'] = isset($say2['ratext']) ? $say2['ratext'] : '';
            $say2['col'] = isset($say2['col']) ? $say2['col'] : '';
        ?>
        <div class="<?php echo esc_attr($col2); ?>">
            <div class="testimonial-block testimonial-block-v3 <?php echo esc_attr($say2['pattern']); ?>">
                <div class="testimonial-content">
                    <p class="testimonial-text"><?php echo esc_attr($say2['des']); ?></p>
                    <div class="testimonial-footer d-flex justify-content-start">
                    <?php if($img!=''){ ?>
                        <div class="tesstimonial-img align-self-center">
                            <img src="<?php echo esc_url($img); ?>" alt="" class="user-avatar-lg rounded-circle">
                        </div>
                    <?php } ?>
                    <div class="testimonial-meta">
                        <h5 class="testimonial-meta-name"><?php echo esc_attr($say2['name']); ?></h5>
                        <?php if($say2{'dis_rate'}!=true){ ?>
                        <div class="rating">
                            <?php if($say2['rate']=='1star'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <?php } elseif($say2['rate']=='half'){ ?>
                            <span><i class="fa fa-fw fa-star-half"></i></span>
                            <?php } elseif($say2['rate']=='1s-half'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star-half"></i></span>
                            <?php } elseif($say2['rate']=='2star'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <?php } elseif($say2['rate']=='2s-half'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star-half"></i></span>
                            <?php } elseif($say2['rate']=='3star'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <?php } elseif($say2['rate']=='3s-half'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star-half"></i></span>
                            <?php } elseif($say2['rate']=='4star'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <?php } elseif($say2['rate']=='4s-half'){ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star-half"></i></span>
                            <?php } else{ ?>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <span><i class="fa fa-fw fa-star"></i></span>
                            <?php } ?>
                            <?php if($say2['ratext']!=''){ ?><span class="text-dark fontweight-bold"><?php echo esc_attr($say2['ratext']); ?></span><?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php }elseif($style=='style4'){ ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $says2 as $say2 ) :
            $say2['photo'] = isset($say2['photo']) ? $say2['photo'] : '';
            $img = wp_get_attachment_image_src($say2['photo'],'full'); $img = $img[0];
            $say2['name'] = isset($say2['name']) ? $say2['name'] : '';
            $say2['des'] = isset($say2['des']) ? $say2['des'] : '';
            $say2['rate'] = isset($say2['rate']) ? $say2['rate'] : '';
            $say2['ratext'] = isset($say2['ratext']) ? $say2['ratext'] : '';
            $say2['col'] = isset($say2['col']) ? $say2['col'] : '';
        ?>
        <div class="<?php echo esc_attr($col2); ?>">
            <div class="testimonial-block-v2 testimonial-block <?php echo esc_attr($say2['pattern']); ?>">
                <div class="testimonial-content">
                    <?php if($say2{'dis_rate'}!=true){ ?>
                    <div class="rating m-b-20 m-t-20">
                        <?php if($say2['rate']=='1star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='half'){ ?>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='1s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='2star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='2s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='3star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='3s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='4star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='4s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } else{ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <p class="testimonial-text"><?php echo esc_attr($say2['des']); ?></p>
                    <div class="d-flex justify-content-start">
                        <?php if($img!=''){ ?>
                            <div class="tesstimonial-img align-self-center">
                                <img src="<?php echo esc_url($img); ?>" alt="" class="user-avatar-lg rounded-circle">
                            </div>
                        <?php } ?>
                        <div class="testimonial-meta">
                            <h5 class="testimonial-meta-name mb-0 text-primary fontweight-bold"><?php echo esc_attr($say2['name']); ?></h5>
                            <?php if($say2['ratext']!=''){ ?><small><?php echo esc_attr($say2['ratext']); ?></small><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php }else{ ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $says2 as $say2 ) :
            $say2['photo'] = isset($say2['photo']) ? $say2['photo'] : '';
            $img = wp_get_attachment_image_src($say2['photo'],'full'); $img = $img[0];
            $say2['name'] = isset($say2['name']) ? $say2['name'] : '';
            $say2['des'] = isset($say2['des']) ? $say2['des'] : '';
            $say2['rate'] = isset($say2['rate']) ? $say2['rate'] : '';
            $say2['ratext'] = isset($say2['ratext']) ? $say2['ratext'] : '';
            $say2['col'] = isset($say2['col']) ? $say2['col'] : '';
        ?>
        <div class="<?php echo esc_attr($col2); ?>">
            <div class="testimonial-block-v2 testimonial-block <?php echo esc_attr($say2['pattern']); ?>">
                <div class="testimonial-content">
                    <?php if($say2{'dis_rate'}!=true){ ?>
                    <div class="rating m-b-20 m-t-20">
                        <?php if($say2['rate']=='1star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='half'){ ?>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='1s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='2star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='2s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='3star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='3s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } elseif($say2['rate']=='4star'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } elseif($say2['rate']=='4s-half'){ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star-half"></i></span>
                        <?php } else{ ?>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <span><i class="fa fa-fw fa-star"></i></span>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <p class="testimonial-text"><?php echo esc_attr($say2['des']); ?></p>
                    <div class="d-flex justify-content-start">
                        <?php if($img!=''){ ?>
                            <div class="tesstimonial-img align-self-center">
                                <img src="<?php echo esc_url($img); ?>" alt="" class="user-avatar-lg rounded-circle">
                            </div>
                        <?php } ?>
                        <div class="testimonial-meta">
                            <h5 class="testimonial-meta-name mb-0 text-primary fontweight-bold"><?php echo esc_attr($say2['name']); ?></h5>
                            <?php if($say2['ratext']!=''){ ?><small><?php echo esc_attr($say2['ratext']); ?></small><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Testimonials (quanto)
add_shortcode('testimonials', 'testimonials_func');
function testimonials_func($atts, $testi, $iclass, $content = null){
    extract(shortcode_atts(array(
        'testi'         =>  '',
        'testi2'        =>  '',
        'show'          =>  '3',
        'show2'         =>  '5',
        'auto'          =>  '',
        'parttern'      =>  '',
        'style'         =>  'style1',
        'nav'           =>  '',
        'iclass'        =>  '',
    ), $atts));
    $says = (array) vc_param_group_parse_atts( $testi );
    $says2 = (array) vc_param_group_parse_atts( $testi2 );
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="testimonial-carousel-v2 <?php echo esc_attr($iclass); ?>">
        <div class="owl-carousel owl-theme owl-testimonial-second" data-show="<?php echo esc_attr($show); ?>" data-auto="<?php echo esc_attr($auto); ?>" data-arrow="<?php echo esc_attr($nav); ?>">
            <?php foreach ( $says as $say ) :
                $say['photo'] = isset($say['photo']) ? $say['photo'] : '';
                $img = wp_get_attachment_image_src($say['photo'],'full'); $img = $img[0];
                $say['name'] = isset($say['name']) ? $say['name'] : '';
                $say['job'] = isset($say['job']) ? $say['job'] : '';
                $say['des'] = isset($say['des']) ? $say['des'] : '';
                ?>
                <div class="item">
                    <div class="testimonial-block-v4 testimonial-block <?php echo esc_attr($parttern); ?>">
                        <div class="testimonial-content">
                            <div class="testimonial-img">
                                <img src="<?php echo esc_url($img); ?>" alt="" class="user-avatar-xl rounded-circle">
                            </div>
                            <p class="testimonial-text"><?php echo wp_specialchars_decode($say['des']); ?></p>
                            <div class="testimonial-meta">
                                <h4 class="testimonial-meta-name"><?php echo wp_specialchars_decode($say['name']); ?></h4>
                                <small><?php echo wp_specialchars_decode($say['job']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="carousel slide <?php echo esc_attr($iclass); ?>" data-ride="carousel" id="testimonial-carousel-v2">
        <div class="carousel-inner text-center">
            <?php 
                $i=0;
                foreach ( $says as $say ) :
                $say['name'] = isset($say['name']) ? $say['name'] : '';
                $say['job'] = isset($say['job']) ? $say['job'] : '';
                $say['des'] = isset($say['des']) ? $say['des'] : '';
                $i++;
                ?>
                <div class="carousel-item p-2 <?php if($i==1){echo 'active';} ?>">
                    <div class="testimonial-carousel-v2-content">
                        <p><?php echo wp_specialchars_decode($say['des']); ?></p>
                        <h4 class="mb-0"><?php echo wp_specialchars_decode($say['name']); ?></h4>
                        <small><?php echo wp_specialchars_decode($say['job']); ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <ol class="carousel-indicators">
            <?php
                $i=0;
                foreach ( $says as $say ) :
                $say['photo'] = isset($say['photo']) ? $say['photo'] : '';
                $img = wp_get_attachment_image_src($say['photo'],'full'); $img = $img[0];
                $i++;
                $j=$i-1;
                ?>
                <li data-target="#testimonial-carousel-v2" data-slide-to="<?php echo esc_attr($j); ?>" class="<?php if($i==1){echo 'active';} ?>"><img class="img-fluid " src="<?php echo esc_url($img); ?>" alt=""></li>
            <?php endforeach; ?>
        </ol>
    </div>
    <?php }elseif($style=='style3'){ ?>
    <div class="testimonial-carousel <?php echo esc_attr($iclass); ?>">
        <div class="owl-carousel owl-theme owl-testimonial" data-show="<?php echo esc_attr($show); ?>" data-auto="<?php echo esc_attr($auto); ?>" data-arrow="<?php echo esc_attr($nav); ?>">
            <?php foreach ( $says2 as $say2 ) :
                $say2['photo'] = isset($say2['photo']) ? $say2['photo'] : '';
                $img = wp_get_attachment_image_src($say2['photo'],'full'); $img = $img[0];
                $say2['name'] = isset($say2['name']) ? $say2['name'] : '';
                $say2['des'] = isset($say2['des']) ? $say2['des'] : '';
                ?>
                <div class="item p-2">
                    <div class="testimonial-block testimonial-block-v2">
                        <div class="testimonial-content">
                            <div class="testimonial-comment-icon"><i class="fa fa-commenting-o fa-2x text-primary"></i></div>
                            <p class="testimonial-text"><?php echo wp_specialchars_decode($say2['des']); ?></p>
                        </div>
                        <div class="testimonial-footer d-flex justify-content-start">
                            <div class="testimonial-img align-self-center">
                                <img src="<?php echo esc_url($img); ?>" alt="" class="user-avatar-lg rounded-circle">
                            </div>
                            <div class="testimonial-meta">
                                <h5 class="testimonial-meta-name"><?php echo wp_specialchars_decode($say2['name']); ?></h5>
                                <div class="rating">
                                    <?php if($say2['rate']=='1star'){ ?>
                                    <i class="fa fa-fw fa-star"></i>
                                    <?php } elseif($say2['rate']=='half'){ ?>
                                    <i class="fa fa-fw fa-star-half"></i> 
                                    <?php } elseif($say2['rate']=='1s-half'){ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star-half"></i> 
                                    <?php } elseif($say2['rate']=='2star'){ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <?php } elseif($say2['rate']=='2s-half'){ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star-half"></i> 
                                    <?php } elseif($say2['rate']=='3star'){ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <?php } elseif($say2['rate']=='3s-half'){ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star-half"></i> 
                                    <?php } elseif($say2['rate']=='4star'){ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <?php } elseif($say2['rate']=='4s-half'){ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star-half"></i> 
                                    <?php } else{ ?>
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <i class="fa fa-fw fa-star"></i> 
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style4'){ ?>
    <div class="testimonial-carousel-v3 <?php echo esc_attr($iclass); ?>">
        <div class="owl-carousel owl-theme owl-testimonial-third" data-show="<?php echo esc_attr($show2); ?>" data-auto="<?php echo esc_attr($auto); ?>" data-arrow="<?php echo esc_attr($nav); ?>">
            <?php foreach ( $says as $say ) :
                $say['photo'] = isset($say['photo']) ? $say['photo'] : '';
                $img = wp_get_attachment_image_src($say['photo'],'full'); $img = $img[0];
                $say['name'] = isset($say['name']) ? $say['name'] : '';
                $say['job'] = isset($say['job']) ? $say['job'] : '';
                $say['des'] = isset($say['des']) ? $say['des'] : '';
                ?>
                <div class="item">
                    <div class="testimonial-block-v5 testimonial-block ">
                        <div class="testimonial-content">
                            <div class="testimonial-img">
                                <img src="<?php echo esc_url($img); ?>" alt="" class="rounded-circle">
                            </div>
                            <p class="testimonial-text"><?php echo wp_specialchars_decode($say['des']); ?></p>
                            <div class="testimonial-meta">
                                <h4 class="testimonial-meta-name"><?php echo wp_specialchars_decode($say['name']); ?></h4>
                                <small><?php echo wp_specialchars_decode($say['job']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php }else{ ?>
    <div class="testimonial-carousel-v4 <?php echo esc_attr($iclass); ?>">
        <div class="owl-carousel owl-theme owl-testimonial-fourth" data-show="<?php echo esc_attr($show2); ?>" data-auto="<?php echo esc_attr($auto); ?>" data-arrow="<?php echo esc_attr($nav); ?>">
            <?php foreach ( $says as $say ) :
                $say['photo'] = isset($say['photo']) ? $say['photo'] : '';
                $img = wp_get_attachment_image_src($say['photo'],'full'); $img = $img[0];
                $say['name'] = isset($say['name']) ? $say['name'] : '';
                $say['job'] = isset($say['job']) ? $say['job'] : '';
                $say['des'] = isset($say['des']) ? $say['des'] : '';
                ?>
                <div class="item">
                    <div class="testimonial-block testimonial-block-v6">
                        <div class="testimonial-content">
                            <div class="testimonial-comment-icon"><i class="fa fa-quote-left fa-2x text-brand"></i></div>
                            <p class="testimonial-text"><?php echo wp_specialchars_decode($say['des']); ?></p>
                            <div class="d-flex justify-content-start">
                                <div class="testimonial-img align-self-center">
                                    <img src="<?php echo esc_url($img); ?>" alt="" class="user-avatar-xl rounded-circle">
                                </div>
                                <div class="testimonial-meta">
                                    <h5 class="testimonial-meta-name"><?php echo wp_specialchars_decode($say['name']); ?></h5>
                                    <small class="text-primary-light"><?php echo wp_specialchars_decode($say['job']); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Review box (quanto)
add_shortcode('reviewbox', 'reviewbox_func');
function reviewbox_func($atts, $testi, $iclass, $content = null){
    extract(shortcode_atts(array(
        'review'      =>  '5star',
        'num_rate'    =>  '',
        'link'        =>  '',
        'title'       =>  '',
        'date'        =>  '',
        'stitle'      =>  '',
        'author'      =>  '',
        'text'        =>  '',
        'info'        =>  '',
        'rate_text'   =>  '',
        'iclass'      =>  '',
        'style'       =>  'style1',
    ), $atts));
    $url = vc_build_link($link); 
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="rating <?php echo esc_attr($iclass); ?>">
        <?php if($review=='1star'){ ?>
        <span><i class="fa fa-fw fa-star"></i></span>
        <?php } elseif($review=='half'){ ?>
        <span><i class="fa fa-fw fa-star-half"></i> </span>
        <?php } elseif($review=='1s-half'){ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star-half"></i> </span>
        <?php } elseif($review=='2star'){ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <?php } elseif($review=='2s-half'){ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star-half"></i> </span>
        <?php } elseif($review=='3star'){ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <?php } elseif($review=='3s-half'){ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star-half"></i> </span>
        <?php } elseif($review=='4star'){ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <?php } elseif($review=='4s-half'){ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star-half"></i> </span>
        <?php } else{ ?>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <span><i class="fa fa-fw fa-star"></i> </span>
        <?php } ?>
        <?php if($num_rate!=''){ ?><span class="text-primary ml-2"><?php echo esc_attr($num_rate); ?></span><?php } ?>
        <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
            echo '<span class="review-details"><a href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a></span>';
        } ?>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="review-block <?php echo esc_attr($iclass); ?>">
        <div class="review-content">
            <div class="rating mb-1">
                <?php if($review=='1star'){ ?>
                <span><i class="fa fa-fw fa-star"></i></span>
                <?php } elseif($review=='half'){ ?>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='1s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='2star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='2s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='3star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='3s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='4star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='4s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } else{ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } ?>
                <?php if($num_rate!=''){ ?><span class="rating-number"><?php echo esc_attr($num_rate); ?></span><?php } ?>
                <?php if($rate_text!=''){ ?><span class="rating-text"><i class="fa fa-check-circle"></i><?php echo esc_attr($rate_text); ?>!</span><?php } ?>
            </div>
            <div class="review-sub-content">
                <?php if($date!=''){ ?><p class="review-date"> <?php echo esc_attr($date); ?></p><?php } ?>
                <?php if($title!=''){ ?><h4 class="review-title"><?php echo esc_attr($title); ?></h4><?php } ?>
                <?php if($stitle!=''){ ?><p class="review-text"><?php echo esc_attr($stitle);  ?></p><?php } ?>
                <?php if($author!=''){ ?><span class="reviewer-name"><?php echo esc_attr($author); ?></span><?php } ?>
                <?php if($info!=''){ ?><small class="review-meta-text"><?php echo esc_attr($info); ?></small><?php } ?>
            </div>
        </div>
    </div>
    <?php }elseif($style=='style3'){ ?>
    <div class="review-block <?php echo esc_attr($iclass); ?>">
        <div class="border-bottom pb-4 mb-3">
            <div class="rating mb-2">
                <?php if($review=='1star'){ ?>
                <span><i class="fa fa-fw fa-star"></i></span>
                <?php } elseif($review=='half'){ ?>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='1s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='2star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='2s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='3star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='3s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='4star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='4s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } else{ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } ?>
                <?php if($date!=''){ ?><span class="text-dark ml-2"><?php echo esc_attr($date); ?></span><?php } ?>
            </div>
            <?php if($title!=''){ ?><h4 class="review-title"><?php echo esc_attr($title); ?></h4><?php } ?>
            <?php if($author!=''){ ?><p class="review-meta"><?php echo esc_attr($author); ?> <span class="review-location"><i class="fa fa-map-marker-alt"></i><?php echo esc_attr($info); ?></span></p><?php } ?>
            <?php if($stitle!=''){ ?><p class="review-text"><?php echo esc_attr($stitle);  ?></p><?php } ?>
        </div>
    </div>    
    <?php }else{ ?>
    <div class="card card-outline">
        <div class="card-header ">
            <div class="rating">
                <?php if($review=='1star'){ ?>
                <span><i class="fa fa-fw fa-star"></i></span>
                <?php } elseif($review=='half'){ ?>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='1s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='2star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='2s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='3star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='3s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } elseif($review=='4star'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } elseif($review=='4s-half'){ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star-half"></i> </span>
                <?php } else{ ?>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <span><i class="fa fa-fw fa-star"></i> </span>
                <?php } ?>
                <span class="text-muted ml-3"><?php echo esc_attr($date); ?></span>
            </div>
        </div>
        <div class="card-body">
            <?php if($title!=''){ ?><h4 class=""><?php echo esc_attr($title); ?></h4><?php } ?>
            <?php if($stitle!=''){ ?><p><?php echo esc_attr($stitle);  ?></p><?php } ?>
            <small><?php echo esc_attr($text); ?> <span class="fontweight-medium"><?php echo esc_attr($author); ?></span></small>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Help Center (quanto)
add_shortcode('helpcenter', 'helpcenter_func');
function helpcenter_func($atts, $content = null){
    extract(shortcode_atts(array(
        'all'       =>  '',
        'num'       =>  '-1',
        'col'       =>  '3',
        'idpost'    =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="hc-featured-artical-block-list <?php echo esc_attr($iclass); ?>">
        <ul class="list-unstyled angle">
        <?php
        $args = array(
            'post_type' => 'ot_help_center',
            'posts_per_page' => $num,
            'post__in' => explode(',',$idpost)
        );
        $wp_query = new WP_Query($args);
        while ($wp_query -> have_posts()) : $wp_query -> the_post();
        ?>
          <li><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></li>
                  
        <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    </div>

    <?php
    return ob_get_clean();
}

// Help Center Category (quanto)
add_shortcode('helpcate', 'helpcate_func');
function helpcate_func($atts, $content = null){
    extract(shortcode_atts(array(
        'num'       =>  '-1',
        'link'    =>  '',
        'idcate'    =>  '',
        'iclass'    =>  '',
    ), $atts));
    $url = vc_build_link($link);
    ob_start(); ?>
    <div class="hc-category-page-block">
        <div class="hc-category-page-block-heading">
            <?php 
                $categories = explode(",",$idcate);
                foreach( (array)$categories as $categorie){
                    $cates = get_term_by('slug', $categorie, 'help_center_cat');
                    $cat_name = $cates->name;
            ?>                          
              <h3 class="mb-0"><?php echo esc_attr($cat_name); ?></h3>
            <?php } ?> 
        </div>
        <div class="hc-category-page-block-content <?php echo esc_attr($iclass); ?>">
            <ul class="list-unstyled">
            <?php
            $args = array(
                'post_type' => 'ot_help_center',
                'posts_per_page' => $num,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'help_center_cat',
                        'field' => 'slug',
                        'terms' => explode(',',$idcate),
                    ),
                ),  
            );
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            ?>
              <li><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_postdata(); ?>
            </ul>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
            echo '<a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Help Center Relate (quanto)
add_shortcode('helprelate', 'helprelate_func');
function helprelate_func($atts, $content = null){
    extract(shortcode_atts(array(
        'num'       =>  '-1',
        'title'    =>  '',
        'iclass'    =>  '',
    ), $atts));
    $url = vc_build_link($link);
    ob_start(); ?>
    <div class="hc-sidebar <?php echo esc_attr($iclass); ?>">
        <div class="hc-sidebar-widget">
            <h4 class="hc-sidebar-widget-title"><?php echo esc_attr($title); ?></h4>
            <div class="hc-sidebar-widget-content">
                <ul class="list-unstyled">
                    <?php
                    //Get array of terms
                    $terms = get_the_terms( $post->ID , 'help_center_cat', 'string');
                    //Pluck out the IDs to get an array of IDS
                    $term_ids = wp_list_pluck($terms,'term_id');

                    //Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
                    //Chose 'AND' if you want to query for posts with all terms
                      $second_query = new WP_Query( array(
                          'post_type' => 'ot_help_center',
                          'tax_query' => array(
                                        array(
                                            'taxonomy' => 'help_center_cat',
                                            'field' => 'id',
                                            'terms' => $term_ids,
                                            'operator'=> 'IN' //Or 'AND' or 'NOT IN'
                                         )),
                          'posts_per_page' => $num,
                          'ignore_sticky_posts' => 1,
                          'orderby' => 'DESC',
                          'post__not_in'=>array($post->ID)
                       ) );
                    while ($second_query -> have_posts()) : $second_query -> the_post();
                    ?>
                      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>      
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Accordions (quanto)
add_shortcode('accordions', 'accordions_func');
function accordions_func($atts, $testi, $iclass, $content = null){
    extract(shortcode_atts(array(
        'accordions'    =>  '',
        'style'        =>  'style1',
        'iclass'        =>  '',
    ), $atts));
    $accordions = (array) vc_param_group_parse_atts( $accordions );
    $rd = rand(0,9999999);
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="accrodion-regular <?php echo esc_attr($iclass); ?>">
        <div id="accordion-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <div class="card">
                <div class="card-header <?php if($i==1){echo 'active';}else{echo '';} ?>" id="heading-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>">
                    <h5 class="card-title">
                        <a href="#collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" class="" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" aria-expanded="<?php if($i==1){echo 'true';}else{echo 'false';} ?>" aria-controls="collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>">
                            <?php echo esc_attr($faq['title']); ?> <span class="fa fa-angle-down "></span>
                        </a>
                    </h5>
                </div>
                <div id="collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" class="collapse <?php if($faq['show']==true){echo 'show';} ?>" aria-labelledby="heading-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" data-parent="#accordion-<?php echo esc_attr($rd); ?>">
                    <div class="card-body">
                        <?php echo wp_specialchars_decode($faq['desc']); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="accrodion-second-regular <?php echo esc_attr($iclass); ?>">
        <div id="accordion-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <div class="card">
                <div class="card-header <?php if($i==1){echo 'active';}else{echo '';} ?>" id="heading-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>">
                    <h5 class="card-title ">
                        <a href="#collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" class="text-primary" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>">
                            <span class="fa fa-chevron-circle-down mr-3 p-t-10"></span><?php echo esc_attr($faq['title']); ?>
                        </a>
                    </h5>
                </div>
                <div id="collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" class="collapse <?php if($faq['show']==true){echo 'show';} ?>" aria-labelledby="heading-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" data-parent="#accordion-<?php echo esc_attr($rd); ?>">
                    <div class="card-body">
                        <?php echo wp_specialchars_decode($faq['desc']); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }else{ ?>
    <div class="accrodion-regular <?php echo esc_attr($iclass); ?>">
        <div id="accordion1-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <div class="accrodion-block">
                <div class="accordion-head <?php if($i==1){echo 'active';}else{echo '';} ?>" id="heading-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>">
                    <h5 class="accordion-title">
                        <a href="#collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" class="text-dark" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>">
                            <span class="fa fa-fw fa-plus-circle "></span><?php echo esc_attr($faq['title']); ?>
                        </a>
                    </h5>
                </div>
                <div id="collapse-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" class="collapse <?php if($faq['show']==true){echo 'show';} ?>" aria-labelledby="heading-<?php echo esc_attr($i); ?>-<?php echo esc_attr($rd); ?>" data-parent="#accordion1-<?php echo esc_attr($rd); ?>">
                    <div class="accordion-content">
                        <?php echo wp_specialchars_decode($faq['desc']); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Tab (quanto)
add_shortcode('tab_ot', 'tab_ot_func');
function tab_ot_func($atts, $tab_ot, $iclass, $content = null){
    extract(shortcode_atts(array(
        'accordions'    =>  '',
        'accordions2'    =>  '',
        'iclass'        =>  '',
        'style'         =>  'style1',
    ), $atts));
    $accordions = (array) vc_param_group_parse_atts( $accordions );
    $accordions2 = (array) vc_param_group_parse_atts( $accordions2 );
    $rd = rand(0,9999999);
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="tab-regular <?php echo esc_attr($iclass); ?>">
        <ul class="nav nav-tabs " id="myTab-<?php echo esc_attr($rd); ?>" role="tablist">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <li class="nav-item">
                <a class="nav-link <?php if($faq['show']==true){echo 'active';}else{echo '';} ?>" id="tab-<?php echo esc_attr($i); ?>" data-toggle="tab" href="#home-<?php echo esc_attr($i); ?>" role="tab" aria-controls="home-<?php echo esc_attr($i); ?>" aria-selected="true"><?php echo esc_attr($faq['title']); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['titct'] = isset($faq['titct']) ? $faq['titct'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            $faq['link'] = isset($faq['link']) ? $faq['link'] : '';
            $url = vc_build_link($faq['link']);
            ?>
            <div class="tab-pane fade <?php if($faq['show']==true){echo 'show active';}else{echo '';} ?>" id="home-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr($i); ?>">
                <?php if($faq['titct']!=''){ ?><h3><?php echo esc_attr($faq['titct']); ?></h3><?php } ?>
                <?php echo wp_specialchars_decode($faq['desc']); ?>
                <?php if ( strlen( $faq['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-secondary btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="tab-vertical <?php echo esc_attr($iclass); ?>">
        <ul class="nav nav-tabs " id="myTab3-<?php echo esc_attr($rd); ?>" role="tablist">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <li class="nav-item">
                <a class="nav-link <?php if($faq['show']==true){echo 'active';}else{echo '';} ?>" id="home-vertical-tab-<?php echo esc_attr($i); ?>" data-toggle="tab" href="#home-vertical-<?php echo esc_attr($i); ?>" role="tab" aria-controls="home-<?php echo esc_attr($i); ?>" aria-selected="true"><?php echo esc_attr($faq['title']); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent3-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['titct'] = isset($faq['titct']) ? $faq['titct'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            $faq['link'] = isset($faq['link']) ? $faq['link'] : '';
            $url = vc_build_link($faq['link']);
            ?>
            <div class="tab-pane fade <?php if($faq['show']==true){echo 'show active';}else{echo '';} ?>" id="home-vertical-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="home-vertical-tab-<?php echo esc_attr($i); ?>">
                <?php if($faq['titct']!=''){ ?><h3><?php echo esc_attr($faq['titct']); ?></h3><?php } ?>
                <?php echo wp_specialchars_decode($faq['desc']); ?>
                <?php if ( strlen( $faq['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-secondary btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style3'){ ?>
    <div class="simple-card <?php echo esc_attr($iclass); ?>">
        <ul class="nav nav-tabs " id="myTab5-<?php echo esc_attr($rd); ?>" role="tablist">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <li class="nav-item">
                <a class="nav-link <?php if($faq['show']==true){echo 'active border-left-0';}else{echo '';} ?>" id="home-tab-simple-<?php echo esc_attr($i); ?>" data-toggle="tab" href="#tab-simple-<?php echo esc_attr($i); ?>" role="tab" aria-controls="tab-simple-<?php echo esc_attr($i); ?>" aria-selected="true"><?php echo esc_attr($faq['title']); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent5-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['titct'] = isset($faq['titct']) ? $faq['titct'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            $faq['link'] = isset($faq['link']) ? $faq['link'] : '';
            $url = vc_build_link($faq['link']);
            ?>
            <div class="tab-pane fade <?php if($faq['show']==true){echo 'show active';}else{echo '';} ?>" id="tab-simple-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="home-tab-simple-<?php echo esc_attr($i); ?>">
                <?php if($faq['titct']!=''){ ?><h3><?php echo esc_attr($faq['titct']); ?></h3><?php } ?>
                <?php echo wp_specialchars_decode($faq['desc']); ?>
                <?php if ( strlen( $faq['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-secondary btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style4'){ ?>
    <div class="pills-regular <?php echo esc_attr($iclass); ?>">
        <ul class="nav nav-pills mb-1 " id="pills-tab-<?php echo esc_attr($rd); ?>" role="tablist">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <li class="nav-item">
                <a class="nav-link <?php if($faq['show']==true){echo 'active';}else{echo '';} ?>" id="pills-home-tab-<?php echo esc_attr($i); ?>" data-toggle="pill" href="#pills-home-<?php echo esc_attr($i); ?>" role="tab" aria-controls="pills-<?php echo esc_attr($i); ?>" aria-selected="true"><?php echo esc_attr($faq['title']); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent5-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['titct'] = isset($faq['titct']) ? $faq['titct'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            $faq['link'] = isset($faq['link']) ? $faq['link'] : '';
            $url = vc_build_link($faq['link']);
            ?>
            <div class="tab-pane fade <?php if($faq['show']==true){echo 'show active';}else{echo '';} ?>" id="pills-home-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="pills-home-tab-<?php echo esc_attr($i); ?>">
                <?php if($faq['titct']!=''){ ?><h3><?php echo esc_attr($faq['titct']); ?></h3><?php } ?>
                <?php echo wp_specialchars_decode($faq['desc']); ?>
                <?php if ( strlen( $faq['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-secondary btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }elseif($style=='style5'){ ?>
    <div class="pills-vertical <?php echo esc_attr($iclass); ?>">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="nav flex-column nav-pills" id="v-pills-tab-<?php echo esc_attr($rd); ?>" role="tablist" aria-orientation="vertical">
                <?php 
                    $i=0;
                    foreach ( $accordions as $faq ) :
                    $i++;
                    $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
                    $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
                    ?>
                    <a class="nav-link <?php if($faq['show']==true){echo 'active';}else{echo '';} ?>" id="v-pills-home-tab-<?php echo esc_attr($i); ?>" data-toggle="pill" href="#v-pills-home-<?php echo esc_attr($i); ?>" role="tab" aria-controls="v-pills-home-<?php echo esc_attr($i); ?>" aria-selected="true"><?php echo esc_attr($faq['title']); ?></a>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                <div class="tab-content" id="v-pills-tabContent-<?php echo esc_attr($rd); ?>">
                <?php 
                    $i=0;
                    foreach ( $accordions as $faq ) :
                    $i++;
                    $faq['titct'] = isset($faq['titct']) ? $faq['titct'] : '';
                    $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
                    $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
                    $faq['link'] = isset($faq['link']) ? $faq['link'] : '';
                    $url = vc_build_link($faq['link']);
                    ?>
                    <div class="tab-pane fade <?php if($faq['show']==true){echo 'show active';}else{echo '';} ?>" id="v-pills-home-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="v-pills-home-tab-<?php echo esc_attr($i); ?>">
                        <?php if($faq['titct']!=''){ ?><h3><?php echo esc_attr($faq['titct']); ?></h3><?php } ?>
                        <?php echo wp_specialchars_decode($faq['desc']); ?>
                        <?php if ( strlen( $faq['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                        echo '<a class="btn btn-secondary btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                        } ?>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php }elseif($style=='style6'){ ?>
    <div class="tab-regular <?php echo esc_attr($iclass); ?>">
        <ul class="nav nav-tabs nav-fill" id="myTab7-<?php echo esc_attr($rd); ?>" role="tablist">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['title'] = isset($faq['title']) ? $faq['title'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            ?>
            <li class="nav-item">
                <a class="nav-link <?php if($faq['show']==true){echo 'active';}else{echo '';} ?>" id="home-tab-justify-<?php echo esc_attr($i); ?>" data-toggle="pill" href="#home-justify-<?php echo esc_attr($i); ?>" role="tab" aria-controls="home-<?php echo esc_attr($i); ?>" aria-selected="true"><?php echo esc_attr($faq['title']); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent5-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions as $faq ) :
            $i++;
            $faq['titct'] = isset($faq['titct']) ? $faq['titct'] : '';
            $faq['desc'] = isset($faq['desc']) ? $faq['desc'] : '';
            $faq['show'] = isset($faq['show']) ? $faq['show'] : '';
            $faq['link'] = isset($faq['link']) ? $faq['link'] : '';
            $url = vc_build_link($faq['link']);
            ?>
            <div class="tab-pane fade <?php if($faq['show']==true){echo 'show active';}else{echo '';} ?>" id="home-justify-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="home-tab-justify-<?php echo esc_attr($i); ?>">
                <?php if($faq['titct']!=''){ ?><h3><?php echo esc_attr($faq['titct']); ?></h3><?php } ?>
                <?php echo wp_specialchars_decode($faq['desc']); ?>
                <?php if ( strlen( $faq['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-secondary btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php }else{ ?>
    <div class="tab-regular-justify <?php echo esc_attr($iclass); ?>">
        <ul class="nav nav-tabs nav-fill" id="myTab7-<?php echo esc_attr($rd); ?>" role="tablist">
        <?php 
            $i=0;
            foreach ( $accordions2 as $faq2 ) :
            $i++;
            $faq2['title'] = isset($faq2['title']) ? $faq2['title'] : '';
            $faq2['show'] = isset($faq2['show']) ? $faq2['show'] : '';
            ?>
            <li class="nav-item">
                <a class="nav-link <?php if($faq2['show']==true){echo 'active';}else{echo '';} ?>" id="regular-tab-justify-<?php echo esc_attr($i); ?>" data-toggle="pill" href="#regular-justify-<?php echo esc_attr($i); ?>" role="tab" aria-controls="home-<?php echo esc_attr($i); ?>" aria-selected="true"><?php echo esc_attr($faq2['title']); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="tab-content p-0" id="myTabContent7-<?php echo esc_attr($rd); ?>">
        <?php 
            $i=0;
            foreach ( $accordions2 as $faq2 ) :
            $i++;
            $faq2['titct'] = isset($faq2['titct']) ? $faq2['titct'] : '';
            $faq2['desc'] = isset($faq2['desc']) ? $faq2['desc'] : '';
            $faq2['show'] = isset($faq2['show']) ? $faq2['show'] : '';
            $faq2['link'] = isset($faq2['link']) ? $faq2['link'] : '';
            $faq2['image'] = isset($faq2['image']) ? $faq2['image'] : '';
            $img = wp_get_attachment_image_src($faq2['image'],'full'); $img = $img[0];
            $faq2['image2'] = isset($faq2['image2']) ? $faq2['image2'] : '';
            $img2 = wp_get_attachment_image_src($faq2['image2'],'full'); $img2 = $img2[0];
            $url = vc_build_link($faq2['link']);
            ?>
            <div class="tab-pane fade <?php if($faq2['show']==true){echo 'show active';}else{echo '';} ?>" id="regular-justify-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="regular-tab-justify-<?php echo esc_attr($i); ?>">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="tab-feature-content ">
                            <?php if($faq2['titct']!=''){ ?><h3><?php echo esc_attr($faq2['titct']); ?></h3><?php } ?>
                            <?php echo wp_specialchars_decode($faq2['desc']); ?>
                            <?php if ( strlen( $faq2['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                            echo '<a class="btn btn-secondary btn-rounded" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                            } ?>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                        <div class="position-relative">
                            <img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid">
                        </div>
                        <?php if($img2!=''){ ?>
                        <div class="character-img">
                            <img src="<?php echo esc_url($img2); ?>" alt="" class="img-fluid">
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php } ?>
    <?php
    return ob_get_clean();
}

// Mortgage Feature Box (quanto)
add_shortcode('mortftb', 'mortftb_func');
function mortftb_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'       =>  '',
        'pattern'     =>  '',
        'link'        =>  '',
        'iclass'      =>  '',
    ), $atts));
    $url    = vc_build_link( $link );
    ob_start(); ?>
    <div class="card card-outline <?php echo esc_attr($pattern); ?> <?php echo esc_attr($iclass); ?>">
        <div class="card-body">
            <h3><?php echo esc_attr($title); ?></h3>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>
        <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
            echo '<div class="card-footer bg-white"><a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a></div>';
        } ?>
    </div>

    <?php
    return ob_get_clean();
}

// Mortgage Rates Block (quanto)
add_shortcode('mortgage_rate', 'mortgage_rate_func');
function mortgage_rate_func($atts, $content = null){
    extract(shortcode_atts(array(
        'rate'      =>  '',
        'rate2'     =>  '',
        'iclass'    =>  '',
        'style'     =>  'style1',
    ), $atts));
    $mortgage_rate = (array) vc_param_group_parse_atts( $rate );
    $mortgage_rate2 = (array) vc_param_group_parse_atts( $rate2 );
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="d-xl-flex d-lg-flex d-md-flex bd-highlight <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $mortgage_rate as $rates ) :
            $rates['title'] = isset($rates['title']) ? $rates['title'] : '';
            $rates['rate'] = isset($rates['rate']) ? $rates['rate'] : '';
            ?>
            <div class="p-4 flex-xl-fill flex-lg-fill flex-md-fill rate-block text-center mr-minus-2">
                <p class="text-primary rate-block-small-text"><?php echo esc_attr($rates['title']); ?></p>
                <span class="rate-block-heading text-dark"><?php echo esc_attr($rates['rate']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <?php }else{ ?>
    <div class="d-xl-flex d-lg-flex d-md-flex <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $mortgage_rate2 as $rates2 ) :
            $rates2['title'] = isset($rates2['title']) ? $rates2['title'] : '';
            $rates2['rate'] = isset($rates2['rate']) ? $rates2['rate'] : '';
            $rates2['apr'] = isset($rates2['apr']) ? $rates2['apr'] : '';
            $rates2['desc'] = isset($rates2['apr']) ? $rates2['desc'] : '';
            ?>
            <div class="flex-xl-fill flex-lg-fill flex-md-fill rate-block rounded-0 text-center mr-minus-2">
                <div class="rate-block-header">
                    <h5 class="rate-block-header-title"><?php echo esc_attr($rates2['title']); ?></h5>
                </div>
                <div class="rate-block-content">
                    <span class="rate-block-heading text-dark fontweight-bold"><?php echo esc_attr($rates2['rate']); ?></span>
                    <p class="rate-block-text text-primary"><?php echo esc_attr($rates2['apr']); ?></p>
                    <p><?php echo wp_specialchars_decode($rates2['desc']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Team List (quanto)
add_shortcode('teamlist', 'teamlist_func');
function teamlist_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'team'      =>  '',
        'col'       =>  '4',
        'iclass'    =>  '',
    ), $atts));
    $teams = (array) vc_param_group_parse_atts( $team );
    ob_start(); ?>

    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $teams as $member ) :
            $member['photo'] = isset($member['photo']) ? $member['photo'] : '';
            $img = wp_get_attachment_image_src($member['photo'],'full'); $img = $img[0];
            $member['name'] = isset($member['name']) ? $member['name'] : '';
            $member['job'] = isset($member['job']) ? $member['job'] : '';
            $member['des'] = isset($member['des']) ? $member['des'] : '';
            ?>
            <div class="<?php if($col=='3'){ echo 'col-xl-4';}elseif($col=='4'){echo 'col-xl-3';} ?> col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="team-block-v3 team-block">
                    <p class="team-member-designation"><?php echo wp_specialchars_decode($member['job']); ?></p>
                    <div class="team-img"><img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid"></div>
                    <div class="team-content">
                        <h4 class="team-member-name"><?php echo wp_specialchars_decode($member['name']); ?><span class="team-plus-icon"><i class="fa fa-plus"></i></span></h4>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    return ob_get_clean();
}

// Team (quanto)
add_shortcode('team','team_func');
function team_func($atts, $content = null){
    extract(shortcode_atts(array(
        'col'       =>  '3',
        'number'    =>  '6',
        'btn'       =>  '',
        'iclass'    =>  '',
        'style'     =>  'style1',
    ), $atts));

    ob_start();
    ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
    <?php 
        $args = array(   
            'post_type' => 'team',   
            'posts_per_page' => $number,
        );  
        $wp_query = new WP_Query($args);
        while($wp_query->have_posts()) : $wp_query->the_post(); 
        $job = get_post_meta(get_the_ID(),'job', true);
        $phone = get_post_meta(get_the_ID(),'phone', true);
        $mail = get_post_meta(get_the_ID(),'email', true);
        $desc = get_post_meta(get_the_ID(),'desc_mem', true);
    ?>
    <?php if($style=='style1'){ ?>
    <div class="<?php if($col=='3'){ echo 'col-xl-4';}elseif($col=='4'){echo 'col-xl-3';} ?> col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="team-block-v2 team-block">
            <a href="<?php the_permalink(); ?>">
            <div class="team-img"><?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?></div>
            <div class="team-content">
                <h4 class="team-member-name"><?php the_title(); ?></h4>
                <p class="team-member-designation"><?php echo wp_specialchars_decode($job); ?></p>
            </div>
            </a>
        </div>
    </div>
    <?php }elseif($style=='style2'){ ?>
    <div class="<?php if($col=='3'){ echo 'col-xl-4';}elseif($col=='4'){echo 'col-xl-3';} ?> col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="team-block-v3 team-block">
            <p class="team-member-designation"><?php echo wp_specialchars_decode($job); ?></p>
            <div class="team-img"><?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?></div>
            <div class="team-content">
                <h4 class="team-member-name"><?php the_title(); ?><span class="team-plus-icon"><i class="fa fa-plus"></i></span></h4>
            </div>
        </div>
    </div>
    <?php }elseif($style=='remotify'){ ?>
    <style>
    @media only screen and (max-width: 768px) {
        .remotify .team-block-v1.team-block {
    flex-direction: column !important;
    padding-top: 25px !important;
    text-align: center !important;
}
}
    .remotify .team-block-v1.team-block {
    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    background: #fff;
    padding: 0px 25px;
    -webkit-box-shadow: 0px 5px 32px -14px rgb(0 0 0 / 50%);
    -moz-box-shadow: 0px 5px 32px -14px rgba(0,0,0,0.5);
    box-shadow: 0px 5px 32px -14px rgb(0 0 0 / 50%);
    border-radius: 5px;
}.team-block-v1 .team-text {
    margin: 0;
    margin-bottom: 20px;
    font-size: 15px;
}

.remotify .team-img img {   
    max-width: 120px !important;
    min-width: 120px;
    margin: auto;
    border-radius: 100% !important;
    filter: grayscale(1);
    }

.remotify .team-img {display: inline-flex;}

.remotify .team-block-v1 .team-content {
    border: unset !important;
    padding: 20px ​0px 20px 25px;
}
.remotify a.btn.btn-cstm {
    padding: 0 20px;
    height: 30px;
    line-height: 30px;
    font-weight: 400 !important;
    color: #fff;
}
.remotify a.btn.btn-cstm {
    font-family: 'Quicksand' !important;
    padding: 0 12px;
    height: 24px;
    min-width: 50px;
    line-height: 24px;
    font-weight: 400 !important;
    color: #fff;
    border-radius: 100px !important;
    margin: 0 10px 10px 0px;
    font-size: 12px;
    border: unset !important;
}
.btn-clr-1{
  background: #1CB1C3 !important;  
}
.btn-clr-2{
  background: #0EE1DC !important;  
}
.btn-clr-3{
  background: #33629B !important;  
}
</style>
        <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12  col-12  remotify">
        <div class="team-block-v1 team-block">
            <div class="team-img">
                <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
            </div>
            <div class="team-content">
                <h4 class="team-member-name"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h4>
                <span class="team-member-designation"><?php echo wp_specialchars_decode($job); ?></span>
                <p class="team-text"><?php echo substr(wp_specialchars_decode($desc), 0, 70); ?>... </p>
                <p class="team-member-info"><!--<span class="fontweight-medium"><?php echo wp_specialchars_decode($mail); ?></span><br>--><?php
                 $data = explode(',',wp_specialchars_decode($phone)); 
                 $i=0;
                 foreach ($data as $key => $value) {
                     if($i < 4){
                    if($i % 3 === 0){$extraclass= "3";}
                    elseif($i % 2 === 0){$extraclass= "2";}
                    elseif($i % 1 === 0){$extraclass= "1";} 
                    echo '<a href="#" class="btn-clr-'.$extraclass.' btn btn-cstm">'.$value.'</a>';
                      }$i++;
                    $extraclass="";
                 }
                 ?> </p>
            </div>
            <?php if($btn!=''){ ?>
            <div class="team-footer">
                <a href="<?php the_permalink(); ?>" class="btn-brand-link"> <?php echo esc_attr($btn); ?></a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php }else{ ?>
    <div class="<?php if($col=='3'){ echo 'col-lg-4';}elseif($col=='4'){echo 'col-lg-3';}else{ echo 'col-lg-6';} ?> col-md-12 col-sm-12 col-12">
        <div class="team-block-v1 team-block">
            <div class="team-img">
                <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
            </div>
            <div class="team-content">
                <h4 class="team-member-name"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h4>
                <span class="team-member-designation"><?php echo wp_specialchars_decode($job); ?></span>
                <p class="team-text"><?php echo wp_specialchars_decode($desc); ?> </p>
                <p class="team-member-info"><?php echo wp_specialchars_decode($phone); ?> <br> <span class="fontweight-medium"><?php echo wp_specialchars_decode($mail); ?></span></p>
            </div>
            <?php if($btn!=''){ ?>
            <div class="team-footer">
                <a href="<?php the_permalink(); ?>" class="btn-brand-link"> <?php echo esc_attr($btn); ?></a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  </div>

    <?php
    return ob_get_clean();
}

// Lastest News (quanto)
add_shortcode('lastestnews','lastestnews_func');
function lastestnews_func($atts, $content = null){
    extract(shortcode_atts(array(
        'show'      =>  '3',
        'num'       =>  '3',
        'excerpt'   =>  '',
        'order'     =>  'DESC',
        'orderby'   =>  'date',
        'style'     =>  'style1',
        'text'      =>  'By: ',
        'iclass'    =>  '',
    ), $atts));
        $excerpt1 = (!empty($excerpt)) ? $excerpt : 15;
        $order1 = (!empty($order) ? $order : 'DESC');
        $orderby1 = (!empty($orderby) ? $orderby : 'date');
        $text1 = (!empty($text) ? $text : 'By: ');
    ob_start();
    ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php
        $i=0;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $num,
            'order' => $order1,
            'orderby' => $orderby1
        );
        $blogpost = new WP_Query($args);
        if($blogpost->have_posts()) : while($blogpost->have_posts()) : $blogpost->the_post(); $i++;
            $format = get_post_format();
        ?>
        <?php 
        $column = ' ';
            if( $show == 3 ){
                $column = 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ';
            }elseif( $show == 2 ){
                $column = 'col-md-6 col-sm-12 col-12 ';
            }else{
                $column = 'col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ';
            }
        ?>
        <?php if($style=='style1'){ ?>
            <div class="<?php echo esc_attr($column); ?>">
                <div class="post-block">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-img zoomimg">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array('class' => 'img-fluid') );  ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="post-content">
                        <div class="meta-cat"><?php quanto_posted_in(); ?></div>
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a></h3>
                        <p><?php echo quanto_excerpt($excerpt1); ?></p>
                        <div class="post-meta">
                            <div class="meta">
                                <?php quanto_post_meta(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($style=='style2'){ ?>
            <?php if($i==1){ ?>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <!-- card start  -->
                <div class="card text-white zoomimg">
                    <a href="<?php the_permalink(); ?>"><img class="card-img" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""></a>
                    <div class="card-content-overlay text-white">
                        <div class="meta-cat"><?php quanto_posted_in(); ?></div>
                        <h3 class="card-title text-white"><a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a></h3>
                        <div class="meta"><span class="meta-date text-white"><?php the_time( get_option( 'date_format' ) ); ?></span></div>
                    </div>
                </div>
                <!-- card close  -->
            </div>
            <?php }else{ ?>
            <?php if($i==2){ ?>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="row">
            <?php } ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                    <!-- card start  -->
                    <div class="card flex-md-row mb-2 post-small-thumb">
                        <a href="<?php the_permalink(); ?>"><img class="p-2 flex-auto" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""></a>
                        <div class="card-body d-flex flex-column align-items-start">
                            <div class="meta-cat"><?php quanto_posted_in(); ?></div>
                            <h4 class="card-title"><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h4>
                            <div class="meta"><span class="meta-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                            </div>
                        </div>
                    </div>
                <!-- card close  -->
                </div>
            <?php if($i==$num){ ?>
                </div>
            </div>
            <?php } ?>
        <?php } }elseif($style=='style3'){ ?>
        <div class="<?php echo esc_attr($column); ?>">
            <div class="post-block-v2 post-block">
                <div class="post-img">
                    <div class="zoomimg">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid rounded"></a>
                    </div>
                </div>
                <div class="post-content">
                    <div class="meta-cat"><?php quanto_posted_in(); ?></div>
                    <h3 class="post-title"><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                    </h3>
                    <span class="meta meta-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                </div>
                <div class="post-footer d-flex justify-content-start">
                    <div class="post-author-img align-self-center">
                        <img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="" class="user-avatar-md rounded-circle">
                    </div>
                    <div class="post-author-name">
                        <span class="text-center fontweight-medium"><?php echo esc_attr($text1); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?> " class="post-author-name-text"><?php the_author(); ?></a></span>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ ?>
        <div class="<?php echo esc_attr($column); ?>">
            <div class="post-block ">
                <div class="post-img zoomimg">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" class="img-fluid"></a>
                </div>
                <div class="post-content border-0">
                    <div class="meta-cat"><?php quanto_posted_in(); ?></div>
                    <h4 class="post-title"><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a></h4>
                    <p> <?php echo quanto_excerpt($excerpt1); ?> </p>
                    <p class="meta d-flex justify-content-between">
                        <span class="meta-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                        <span class=""><?php echo esc_attr($text1); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <?php
    return ob_get_clean();
}

// Logo Clients (quanto)
add_shortcode('clients','clients_func');
function clients_func($atts, $content = null){
    extract(shortcode_atts(array(
        'gallery'       =>  '',
        'show'          =>  '6',
        'iclass'        =>  '',
        'style'        =>  'style1',
    ), $atts));
    $img = wp_get_attachment_image_src($gallery,'full');
    $img = $img[0];
    ob_start(); ?>
    <?php 
        $show2 = '';
        if($show == '3'){
            $show2 = 'col-md-4 col-sm-6 col-6';
        }elseif($show == '4'){
            $show2 = 'col-md-3 col-sm-6 col-6';
        }elseif($show == '5'){
            $show2 = 'col-lg-1/5 col-md-3 col-sm-6 col-6';
        }else{
            $show2 = 'col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6';
        }
    ?>

        <?php if($style!='style4' && $style!='style5'){ ?><div class="row <?php echo esc_attr($iclass); ?>"><?php } 
            elseif($style=='style5'){ ?>
            <ul class="client-block-v6 client-logos">
            <?php } ?>

            <?php
            $img_ids = explode(",",$gallery);
            foreach( $img_ids AS $img_id ){
                $meta = wp_prepare_attachment_for_js($img_id);
                $link = $meta['caption'];
                $alt = $meta['alt'];
                $image_src = wp_get_attachment_image_src($img_id,'');
                ?>
                <?php if($style=='style1'){ ?>
                <div class="<?php echo esc_attr($show2); ?> text-center">
                    <div class="client-logo">
                        <?php if($link) { ?><a target="_blank" href="<?php esc_url($link); ?>"><?php } ?>
                        <div class="client-logo-img"> <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid"></div>
                        <?php if($link) { ?></a><?php } ?>
                    </div>
                </div>
                <?php }elseif($style=='style2'){ ?>
                <div class="<?php echo esc_attr($show2); ?>">
                <?php if($link) { ?><a href="<?php esc_url($link); ?>"><?php } ?>
                    <div class="client-block-v2 client-block">
                        <div class="client-block-img"><img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid"></div>
                    </div>
                <?php if($link) { ?></a><?php } ?>
                </div>
                <?php }elseif($style=='style3'){ ?>
                <div class="<?php echo esc_attr($show2); ?>">
                    <?php if($link) { ?><a href="<?php esc_url($link); ?>"><?php } ?>
                        <div class="client-block-v4 client-block">
                            <div class="client-block-img"><img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid"></div>
                        </div>
                    <?php if($link) { ?></a><?php } ?>
                </div>
                <?php }elseif($style=='style4'){ ?>
                <?php if($link) { ?><a href="<?php esc_url($link); ?>"><?php } ?>
                    <div class="client-block-v4 client-block shadow <?php echo esc_attr($iclass); ?>">
                        <div class="client-block-img"><img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid"></div>
                    </div>
                <?php if($link) { ?></a><?php } ?>
                <?php }else{ ?>
                    <li><?php if($link) { ?><a href="<?php esc_url($link); ?>"><?php } ?><img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($alt); ?>"><?php if($link) { ?></a><?php } ?></li>
                <?php } ?>
            <?php } ?>
        <?php if($style!='style4' && $style!='style5'){ ?></div><?php }elseif($style=='style5'){ ?>
        </ul>
        <?php } ?>

    <?php
    return ob_get_clean();
}

// Logo Clients Style Hover (quanto)
add_shortcode('clienthv', 'clienthv_func');
function clienthv_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'client'      =>  '',
        'show'        =>  '',
        'iclass'      =>  '',
        'style'      =>  'style1',
    ), $atts));
    $logo = (array) vc_param_group_parse_atts( $client );
    ob_start(); ?>
    <?php 
        $show2 = '';
        if($show == '3'){
            $show2 = 'col-lg-4 col-md-6 col-sm-12 col-12';
        }elseif($show == '4'){
            $show2 = 'col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12';
        }elseif($show == '5'){
            $show2 = 'col-lg-1/5 col-md-6 col-sm-12 col-12';
        }else{
            $show2 = 'col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12';
        }
    ?>
    <div class="row <?php echo esc_attr($iclass); ?>">
        <?php foreach ( $logo as $logos ) :
            $logos['photo'] = isset($logos['photo']) ? $logos['photo'] : '';
            $img = wp_get_attachment_image_src($logos['photo'],'full'); $img = $img[0];
            $logos['photohv'] = isset($logos['photohv']) ? $logos['photohv'] : '';
            $img2 = wp_get_attachment_image_src($logos['photohv'],'full'); $img2 = $img2[0];
            $logos['link'] = isset($logos['link']) ? $logos['link'] : '';
            ?>
            <div class="<?php echo esc_attr($show2); ?>">
                <div class="<?php if($style=='style1'){echo 'client-logo-third';}else{echo 'client-logo-second';} ?>">
                    <?php if($logos['link']!=''){ ?><a href="<?php echo esc_url($logos['link']); ?>"><?php }else{ ?><div class="client-hv"><?php } ?>
                        <img class="main-img" src="<?php echo esc_url($img); ?>" alt="">
                        <img class="hover-img" src="<?php echo esc_url($img2); ?>" alt="">
                    <?php if($logos['link']!=''){ ?></a><?php }else{ ?></div><?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    return ob_get_clean();
}

// Logo Block (quanto)
add_shortcode('clientsblock','clientsblk_func');
function clientsblk_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image'       =>  '',
        'link'        =>  '',
        'title'       =>  '',
        'parttern'    =>  '',
        'iclass'      =>  '',
        'style'       =>  'style1',
    ), $atts));
    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
    $url = vc_build_link($link);
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
        <div class="client-block-v3 client-block <?php echo esc_attr($parttern.$iclass); ?>">
            <div class="client-block-content">
                <div class="client-block-img"><img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid"></div>
                <?php echo wpb_js_remove_wpautop($content, true); ?>
                <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn-brand-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
            </div>
        </div>
    <?php }else{ ?>
        <div class="client-block-v5 client-block <?php echo esc_attr($iclass); ?>">
            <div class="client-block-img"><img src="<?php echo esc_url($img); ?>" alt="" class="img-fluid"></div>
            <div class="client-block-content">
                <h4><?php echo esc_attr($title); ?></h4>
                <?php echo wpb_js_remove_wpautop($content, true); ?>
            </div>
        </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Categorues Box (quanto)
add_shortcode('catbox', 'catbox_func');
function catbox_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image'         =>  '',
        'title'         =>  '',
        'link'          =>  '',
        'link_cat'      =>  '',
        'icon'          =>  '',
        'iclass'        =>  '',
        'style'         =>  'style1',
    ), $atts));
    $poster = wp_get_attachment_image_src($image,'full');
    $poster = $poster[0];
    $url = vc_build_link($link);
    ob_start(); ?>
    <?php if($style=='style1'){ ?>
    <div class="hc-categrory-block <?php echo esc_attr($iclass); ?>">
         <?php if($poster!=''){ ?><div class="hc-categrory-icon"> <img src="<?php echo esc_url($poster); ?>" alt=""></div><?php } ?>
         <div class="hc-categrory-content">
            <?php if($title!=''){ ?><h4><?php echo esc_attr($title); ?></h4><?php } ?>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn btn-rounded btn-light" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
                } ?>
         </div>
      </div>
    <?php }else{ ?>
    <a href="<?php echo esc_url($link_cat); ?>" class="event-card">
        <div class="service-block-v6 service-block <?php echo esc_attr($iclass); ?>">
            <div class="service-block-content">
                <div class="service-block-icon icon-circle">
                    <i class="fa-fw <?php echo esc_attr($icon); ?>"></i>
                </div>
                <?php if($title!=''){ ?><h5 class="service-block-title"><?php echo esc_attr($title); ?></h5><?php } ?>
            </div>
        </div>
    </a>
    <?php } ?>

<?php
    return ob_get_clean();
}

// Service Box (quanto)
add_shortcode('service', 'service_func');
function service_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon'          =>  '',
        'bg'            =>  '',
        'title'         =>  '',
        'link'          =>  '',
        'color'         =>  '',
        'bg_color'      =>  '',
        'iclass'        =>  '',
    ), $atts));
    $bg = wp_get_attachment_image_src($bg,'full');
    $bg = $bg[0];
    $url = vc_build_link($link);
    $color1    = (!empty($color) ? 'color:'.$color.';' : '');
    $bg_color1 = (!empty($bg_color) ? 'background-color:'.$bg_color.';' : '');
    ob_start(); ?>
    <div class="service-block-v7 service-block <?php echo esc_attr($iclass); ?>" <?php if($bg!=''){ ?>style="background-image: url(<?php echo esc_url($bg); ?>);"<?php } ?>>
        <div class="service-block-icon" style="<?php echo esc_attr($bg_color1);echo esc_attr($color1); ?>">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
        <div class="service-block-content">
            <h3 class="service-block-title"><?php echo esc_attr($title); ?></h3>
            <?php echo wpb_js_remove_wpautop($content, true); ?>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn-primary-link" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>

<?php
    return ob_get_clean();
}

// Slide Box (quanto)
add_shortcode('slidecatbox', 'slcatbox_func');
function slcatbox_func($atts, $content = null){
    extract(shortcode_atts(array(
        'slide'         =>  '',
        'iclass'        =>  '',
    ), $atts));
    $slide_cat = (array) vc_param_group_parse_atts($slide);
    ob_start(); ?>
    <div class="preview-carousel <?php echo esc_attr($iclass); ?>">
    <?php foreach ( $slide_cat as $slides ) :
        $slides['icon'] = isset($slides['icon']) ? $slides['icon'] : '';
        $slides['title'] = isset($slides['title']) ? $slides['title'] : '';
        $slides['stitle'] = isset($slides['stitle']) ? $slides['stitle'] : '';
        $slides['link'] = isset($slides['link']) ? $slides['link'] : '';
        $slides['btn'] = isset($slides['btn']) ? $slides['btn'] : '';
        $color1    = (!empty($slides['color']) ? 'color:'.$slides['color'].';' : '');
        $bg_color1 = (!empty($slides['bg_color']) ? 'background-color:'.$slides['bg_color'].';' : '');
    ?>
        <div class="item">
            <div class="service-block-v3 service-block">
                <div class="service-block-content">
                    <div class="icon-circle service-block-icon" style="<?php echo esc_attr($bg_color1); ?>">
                        <i class="<?php echo esc_attr($slides['icon']); ?>" style="<?php echo esc_attr($color1); ?>"></i>
                    </div>
                    <h4 class="service-block-title"><?php echo esc_attr($slides['title']); ?></h4>
                    <?php if($slides['stitle']!=''){ ?><p class="service-block-text"><?php echo esc_attr($slides['stitle']); ?></p><?php } ?>
                    <?php if($slides['btn']!=''){ ?><a href="<?php echo esc_url($slides['link']); ?>" class="btn-brand-link"><?php echo esc_attr($slides['btn']); ?></a><?php } ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

<?php
    return ob_get_clean();
}

// Image Carousel (quanto)
add_shortcode('imgowl','imgowl_func');
function imgowl_func($atts, $content = null){
    extract(shortcode_atts(array(
        'gallery'       =>  '',
        'show'          =>  '3',
        'auto'          =>  'true',
        'arr'           =>  'true',
        'dots'          =>  'true',
        'iclass'        =>  '',
    ), $atts));
    $img = wp_get_attachment_image_src($gallery,'full');
    $img = $img[0];
    ob_start(); ?>

        <div class="preview-carousel-second <?php echo esc_attr($iclass); ?>" data-show="<?php echo esc_attr($show); ?>" data-auto="<?php echo esc_attr($auto); ?>" data-arrow="<?php echo esc_attr($arr); ?>" data-dots="<?php echo esc_attr($dots); ?>">

            <?php
            $img_ids = explode(",",$gallery);
            foreach( $img_ids AS $img_id ){
                $meta = wp_prepare_attachment_for_js($img_id);
                $link = $meta['caption'];
                $alt = $meta['alt'];
                $image_src = wp_get_attachment_image_src($img_id,'');
                ?>
                <div class="item">
                    <div class="">
                        <?php if($link) { ?><a target="_blank" href="<?php esc_url($link); ?>"><?php } ?>
                        <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($alt); ?>" class="">
                        <?php if($link) { ?></a><?php } ?>
                    </div>
                </div>
        <?php } ?>
        </div>

    <?php
    return ob_get_clean();
}
// Videp Player (quanto)
add_shortcode('videopl', 'videopl_func');
function videopl_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image'        =>  '',
        'title'       =>  '',
        'link'       =>  '',
        'iclass'      =>  '',
    ), $atts));
    $poster = wp_get_attachment_image_src($image,'full');
    $poster = $poster[0];
    ob_start(); ?>

    <?php if($title!=''){ ?><div class="card"><?php } ?>
      <div class="video-container">
         <img src="<?php echo esc_url($poster); ?>" alt="" class="img-fluid">                   
         <a href="<?php echo esc_attr($link); ?>"></a>
      </div>
        <?php if($title!=''){ ?><div class="card-footer bg-white"><?php echo esc_attr($title); ?></div><?php } ?>
    <?php if($title!=''){ ?></div><?php } ?>

<?php
    return ob_get_clean();
}

// Alert (quanto)
add_shortcode('alert', 'alert_func');
function alert_func($atts, $content = null){
    extract(shortcode_atts(array(
        'style'       =>  'alert-primary',
        'color'       =>  '',
        'bg_color'    =>  '',
        'bo_color'    =>  '',
        'iclass'      =>  '',
    ), $atts));
    $color1    = (!empty($color) ? 'color:'.$color.';' : '');
    $bg_color1 = (!empty($bg_color) ? 'background-color:'.$bg_color.';' : '');
    $bo_color1 = (!empty($bo_color) ? 'border-color:'.$bo_color.';' : '');
    ob_start(); ?>

    <div class="alert <?php echo esc_attr($style); ?> <?php echo esc_attr($iclass); ?>" role="alert" style="<?php echo esc_attr($color1);echo esc_attr($bg_color1);echo esc_attr($bo_color1); ?>">
        <?php echo wpb_js_remove_wpautop($content, true); ?>
    </div>

<?php
    return ob_get_clean();
}

// Contact Info (quanto)
add_shortcode('cinfo', 'cinfo_func');
function cinfo_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon'        =>  '',
        'title'       =>  '',
        'iclass'      =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="contact-info-block <?php echo esc_attr($iclass); ?>">
        <div class="contact-info-content">
            <div class="contact-info-icon icon-circle">
                <i class="<?php echo esc_attr($icon); ?>"></i>
            </div>
            <h4 class="contact-info-title"><?php echo wp_specialchars_decode($title); ?></h4>
            <p class="contact-info-text"><?php echo wp_specialchars_decode($content); ?></p>
        </div>
    </div>

<?php
    return ob_get_clean();
}

