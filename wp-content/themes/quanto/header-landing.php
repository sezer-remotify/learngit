<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Industro
 */

?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if(quanto_get_option('boxed_switch')!=false){ ?><div class="boxed-layout-wrapper"><?php } ?>

	<div class="header-transparent">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-transparent">
            	<?php 
                    $logo = quanto_get_option( 'logo' ) ? quanto_get_option( 'logo' ) : get_template_directory_uri().'/images/logo-helpcenter.png'; 
                ?>
               <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
               	 <img src="<?php echo esc_url($logo); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
               </a>
               <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-transparent" aria-controls="navbar-transparent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="icon-bar top-bar mt-0"></span>
               <span class="icon-bar middle-bar"></span>
               <span class="icon-bar bottom-bar"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbar-transparent">
            	<?php if ( quanto_get_option('infoland_switch') != false ){ ?>
                  <ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-3">
                	<?php $landing = quanto_get_option( 'headerld_info', array() ); ?>
                    <?php foreach ( $landing as $infold ) { ?>
	                     <li class="nav-item">
	                        <a class="nav-link" href="<?php echo esc_url($infold['link']); ?>"><?php echo esc_attr($infold['btn']); ?></a>
	                     </li>
                    <?php } ?>
                  </ul>
              	<?php } ?>
                  <?php if(quanto_get_option('btext_land')!=''){ ?>
                  <a href="<?php echo esc_url(quanto_get_option('blink_land')); ?>" class="btn btn-brand btn-rounded btn-sm"><?php echo esc_attr(quanto_get_option('btext_land')); ?>
                  </a>
                  <?php } ?>
               </div>
            </nav>
        </div>
    </div>

    <?php quanto_page_header(); ?>
