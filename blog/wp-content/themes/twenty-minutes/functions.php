<?php    
/**
 * Twenty Minutes functions and definitions
 *
 * @package Twenty Minutes
 */
 
if ( ! function_exists( 'twenty_minutes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function twenty_minutes_setup() {
	global $content_width; 
    if ( ! isset( $content_width ) )
		$content_width = 855; /* pixels */
		
	load_theme_textdomain( 'twenty-minutes', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 255,
		'flex-height' => true,
	) );
	add_theme_support( 'title-tag' );		
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twenty-minutes' ),		
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // twenty_minutes_setup
add_action( 'after_setup_theme', 'twenty_minutes_setup' );


function twenty_minutes_widgets_init() { 
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'twenty-minutes' ),
		'description'   => __( 'Appears on blog page sidebar', 'twenty-minutes' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',	
		'after_widget'  => '</aside>',	
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Widget', 'twenty-minutes' ),
		'description'   => __( 'Appears on header of site', 'twenty-minutes' ),
		'id'            => 'header-widget',
		'before_widget' => '<div class="headerarea">',	
		'after_widget'  => '</div>',	
		'before_title'  => '<h3 class="hdrtitle">',
		'after_title'   => '</h3>',		
	) );	
	
}
add_action( 'widgets_init', 'twenty_minutes_widgets_init' );


function twenty_minutes_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Roboto, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on','roboto:on or off','twenty-minutes');	
		
		if('off' !== $roboto ){
			$font_family = array();			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,700,800,900';
			}						
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}

function twenty_minutes_scripts() {
	wp_enqueue_style( 'twenty-minutes-font', twenty_minutes_font_url(), array());
	wp_enqueue_style( 'twenty-minutes-basic-style', get_stylesheet_uri() );	
	wp_enqueue_style( 'twenty-minutes-responsive', get_template_directory_uri().'/css/responsive.css');		
	wp_enqueue_style( 'twenty-minutes-default', get_template_directory_uri().'/css/default.css');
	wp_enqueue_script( 'jquery-nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'twenty-minutes-custom', get_template_directory_uri() . '/js/custom.js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_minutes_scripts' );

function twenty_minutes_ie_stylesheet(){
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style('twenty-minutes-ie', get_template_directory_uri().'/css/ie.css', array( 'twenty-minutes-style' ), '20161109' );
	wp_style_add_data('twenty-minutes-ie','conditional','lt IE 10');
	
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twenty-minutes-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twenty-minutes-style' ), '20161109' );
	wp_style_add_data( 'twenty-minutes-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twenty-minutes-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twenty-minutes-style' ), '20161109' );
	wp_style_add_data( 'twenty-minutes-ie7', 'conditional', 'lt IE 8' );
	}
add_action('wp_enqueue_scripts','twenty_minutes_ie_stylesheet');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

if ( ! function_exists( 'twenty_minutes_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function twenty_minutes_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;