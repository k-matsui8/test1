<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Twenty Minutes
 */

get_header(); ?>

<div class="container">
     <div class="pagewraps">     
        <section class="site-content-wrap">
           <div class="contentbox">            
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'single' ); ?>
                    <?php the_post_navigation(); ?>
                <?php endwhile; // end of the loop. ?>
                <div class="clear"></div>
				<?php get_template_part( 'related' ); ?>
            </div>
         </section>       
        <?php get_sidebar();?>
        <div class="clear"></div>
    </div><!-- pagewraps -->
</div><!-- container -->	
<?php get_footer(); ?>