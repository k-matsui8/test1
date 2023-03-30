<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Twenty Minutes
 */

get_header(); ?>

<div class="container">
     <div class="pagewraps">    
        <section class="site-content-wrap">
			<?php if ( have_posts() ) : ?>
                <header class="page-header">
                   <?php
						the_archive_title( '<h1 class="entry-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>         
                </header><!-- .page-header -->
				<div class="posts-area">
					<?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content' ); ?>
                    <?php endwhile; ?>
                </div>
                <?php 
				// Previous/next post navigation.
				the_posts_pagination( array(
					'mid_size' => 2,
					'prev_text' => __( 'Back', 'twenty-minutes' ),
					'next_text' => __( 'Next', 'twenty-minutes' ),
					'screen_reader_text' => __( 'Posts navigation', 'twenty-minutes' )
				) ); 
				?>
            <?php else : ?>
                <?php get_template_part( 'no-results', 'archive' ); ?>
            <?php endif; ?>
            <div class="clear"></div>
        </section>
       <?php get_sidebar();?>       
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- container -->
	
<?php get_footer(); ?>