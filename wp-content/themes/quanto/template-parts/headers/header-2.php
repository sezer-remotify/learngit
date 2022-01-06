<div class="header-boxed fixed-top">
    <!-- navigation start -->
    <div class="<?php if(quanto_get_option('width_head') == 'full'){echo 'container-fluid';}else{echo 'container';} ?>">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <nav class="navbar navbar-expand-lg navbar-light navbar-boxed">
                    <?php 
                        $logo = quanto_get_option( 'logo' ) ? quanto_get_option( 'logo' ) : get_template_directory_uri().'/images/logo.png'; 
                    ?>
                	<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img src="<?php echo esc_url($logo); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
                	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-classic" aria-controls="navbar-classic" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar top-bar mt-0"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
	                <div class="collapse navbar-collapse" id="navbar-classic">
                        <?php
                            $primary = array(
                                'theme_location'  => 'primary',
                                'menu'            => '',
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => '',
                                'menu_id'         => 'primary-menu',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                                'walker'          => new quanto_Walker_Mega_Menu(),
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-3">%3$s</ul>',
                                'depth'           => 0,
                            );
                            if ( has_nav_menu( 'primary' ) ) {
                                wp_nav_menu( $primary );
                            }
                        ?>
                        <?php if(quanto_get_option('btext_head')!=''){ ?><a href="<?php echo esc_url(quanto_get_option('blink_head')); ?>" class="btn btn-brand btn-rounded btn-sm"><?php echo esc_attr(quanto_get_option('btext_head')); ?></a><?php } ?>
	                </div>
                </nav>
            </div>
        </div>
    </div>
</div>