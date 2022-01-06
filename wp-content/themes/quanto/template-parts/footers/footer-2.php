<div class="footer-second">
    <?php if ( is_active_sidebar( 'footer-area-1' ) || is_active_sidebar( 'footer-area-2' ) || is_active_sidebar( 'footer-area-3' ) || is_active_sidebar( 'footer-area-4' ) ){ ?>
        <div class="container">
            <div class="row">
                <?php get_sidebar('footer');?>
            </div>
        </div>
    <?php } ?>
	<!-- tiny-footer-section -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="tiny-footer text-center">
                    <?php echo wp_kses( quanto_get_option('copyright'), wp_kses_allowed_html('post') ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
