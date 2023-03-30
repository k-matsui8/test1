<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Twenty Minutes
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PPMPD8J');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PPMPD8J"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <div class="header">
        <div class="container">
			<?php if ( is_home() || is_front_page() ) : ?>
            <h1 class="logo">
				<a href="/" title="<?php bloginfo('name'); ?>">
					<img class="site-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/logo-ap_hito02.png" alt="<?php bloginfo('name'); ?>" />
				</a>
            </h1><!-- logo -->
			<?php else: ?>
            <div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
					<img class="site-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/logo-ap_hito02.png" alt="<?php bloginfo('name'); ?>" />
				</a>
            </div><!-- logo -->
			<?php endif; ?>
			
            <div class="header_right">             
				<div id="menubar">
					<div class="container">
						<div class="toggle">
							<a class="toggleMenu" href="<?php echo esc_url('#');?>"><?php esc_html_e('Menu','twenty-minutes'); ?></a>
						</div><!-- toggle --> 
						<div class="sitenav">
							<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
						</div><!-- site-nav -->
					</div>
				</div><!--#menubar -->
			</div><!-- header_right -->
        </div><!-- container -->
  </div><!--.header -->