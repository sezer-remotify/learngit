<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Quanto
 */

?>	

<?php if( quanto_get_option('footer_layout') == 'footer2'){ ?>

    <?php get_template_part('template-parts/footers/footer-2'); ?>

<?php }else{ ?>
	<?php if ( quanto_get_option('footer_cta_switch') != false ){ ?>
	<div class="cta-v1-section">
        <div class="container">
            <div class="cta cta-v1">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="cta-content">
                            <?php if(quanto_get_option('tit_cta')!=''){ ?><h1 class="cta-title"><?php echo esc_attr(quanto_get_option('tit_cta')); ?></h1><?php } ?>
                            <?php if(quanto_get_option('sub_cta')!=''){ ?><p class="cta-text"><?php echo esc_attr(quanto_get_option('sub_cta')); ?></p><?php } ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="cta-btn">
                            <?php if(quanto_get_option('btext_cta')!=''){ ?><a href="<?php echo esc_url(quanto_get_option('blink_cta')); ?>" class="btn btn-brand btn-rounded btn-lg"><?php echo esc_attr(quanto_get_option('btext_cta')); ?></a><?php } ?>
                            <?php if(quanto_get_option('mail_cta')!=''){ ?><a href="<?php echo esc_url(quanto_get_option('link_mail_cta')); ?>" class="text-white"><?php echo esc_attr(quanto_get_option('mail_cta')); ?></a><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-pattern-top">
        <div class="footer-pattern-slide"></div>
    </div>
    <?php } ?>
	<!-- footer-section -->
	<?php if(quanto_get_option('footer-select-pages')){ 
  		$about_id = quanto_get_option('footer-select-pages');
        $about_page = get_post($about_id);
    ?>
	    <div class="footer">
        	<?php echo do_shortcode( $about_page->post_content ); ?>
        </div>
    <?php }else{ ?>
    <?php if ( is_active_sidebar( 'footer-area-1' ) || is_active_sidebar( 'footer-area-2' ) || is_active_sidebar( 'footer-area-3' ) || is_active_sidebar( 'footer-area-4' ) ){ ?>
    <div class="footer-pattern-top">
        <div class="footer-pattern-slide"></div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <?php get_sidebar('footer');?>
            </div>
        </div>
    </div>
    <?php } } ?>
	<!-- tiny-footer-section -->
	<div class="tiny-footer">
        <div class="container">
            <div class="row">
            	<?php if ( quanto_get_option('footer_info_switch') != false ){ ?>
                <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <ul class="list-unstyled">
                    	<?php $fcontact_infos = quanto_get_option( 'footer_contact_info', array() ); ?>
						<?php foreach ( $fcontact_infos as $fcontact_info ) { ?>
							<li><a href="<?php echo esc_attr($fcontact_info['info_link']); ?>"><i class="<?php echo esc_attr($fcontact_info['info_icon']); ?>"></i></a></li>
						<?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12 text-right">
                    <?php echo wp_kses( quanto_get_option('copyright'), wp_kses_allowed_html('post') ); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if(quanto_get_option('boxed_switch')!=false){ ?></div><?php } ?>
	<a href="javascript:" id="return-to-top" class="returntotop"><i class="fa fa-angle-up"></i></a>
	<!-- /.tiny-footer-section -->

<?php wp_footer(); ?>
<!-- Start of Async Drift Code -->
<script>
"use strict";
!function() {
  var t = window.driftt = window.drift = window.driftt || [];
  if (!t.init) {
    if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
    t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ],
    t.factory = function(e) {
      return function() {
        var n = Array.prototype.slice.call(arguments);
        return n.unshift(e), t.push(n), t;
      };
    }, t.methods.forEach(function(e) {
      t[e] = t.factory(e);
    }), t.load = function(t) {
      var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
      o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
      var i = document.getElementsByTagName("script")[0];
      i.parentNode.insertBefore(o, i);
    };
  }
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('fyb4gnwezdv6');
</script>
<!-- End of Async Drift Code -->
</body>
</html>
