<?php
/**
 * Twenty Minutes Theme Customizer
 *
 * @package Twenty Minutes
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function twenty_minutes_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class Twenty_Minutes_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h4><?php echo esc_html( $this->label ); ?></h4>
        <?php
        }
    }
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#da3813',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_options',array(
			'label' => __('Color Options','twenty-minutes'),
			'description' => __( 'More color options in pro version.', 'twenty-minutes' ),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
 }
add_action( 'customize_register', 'twenty_minutes_customize_register' );

function twenty_minutes_custom_css(){
	?>
	<style type="text/css"> 
		a,	#sidebar ul li a:hover,
		.post_lists h5 a:hover,
		.logo h1 span,
		.postmeta a:hover,
		.copyright-wrapper a:hover	,
		.sitenav ul li a:hover, .sitenav ul li.current_page_item a,
		.current{ color:<?php echo esc_html(get_theme_mod('color_scheme','#da3813')); ?>;}
		.pagination ul li .current, .pagination ul li a:hover, 
		#commentform input#submit:hover,
		.toggle a,
		#sidebar .search-form input.search-submit,
		.pagination .nav-links span.current, 
		.pagination .nav-links a:hover,
		.wpcf7 input[type='submit']{ background-color:<?php echo esc_html(get_theme_mod('color_scheme','#da3813')); ?>;}
	</style> 
<?php
}
add_action('wp_head','twenty_minutes_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function twenty_minutes_custom_customize_enqueue() {
	wp_enqueue_script( 'twenty-minutes-custom-customize', get_template_directory_uri() . '/js/custom.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'twenty_minutes_custom_customize_enqueue' );