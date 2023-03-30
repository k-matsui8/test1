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
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="header">
    <div class="container">
      <div class="logo">
  			<?php twenty_minutes_the_custom_logo(); ?>
          <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_attr(bloginfo( 'name' )); ?></a></h1>
          <?php $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
          <p><?php echo esc_html( $description ); ?></p>
        <?php endif; ?>
      </div><!-- logo -->
        <div class="header_right">             
          <?php if ( ! dynamic_sidebar( 'header-widget' ) ) : ?>                
          <?php endif; // end sidebar widget area ?>          
        <div class="clear"></div>
      </div><!-- header_right -->
      <div class="clear"></div>
    </div><!-- container -->
  </div><!--.header -->
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