<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Twenty Minutes
 */
?>
<div id="footer-wrapper">
	<div class="container">
      	<p><?php bloginfo('name'); ?>. <?php esc_html_e('All Rights Reserved', 'twenty-minutes');?></p>
      	<p><a href="<?php echo esc_url( __( 'https://www.classictemplate.com/', 'twenty-minutes' ) ); ?>"><?php /* translators: %s: post title */ printf( esc_html__( 'Powered by %s', 'twenty-minutes' ), 'WordPress' ); ?></a></p>
    </div><!--end .container-->
</div><!--end .footer-wrapper-->
<?php wp_footer(); ?>
</body>
</html>