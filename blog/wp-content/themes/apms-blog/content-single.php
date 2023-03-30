<?php
/**
 * @package Twenty Minutes
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header> <!-- .entry-header -->
  <div class="postmeta">
    <div class="post-date"><?php echo get_the_date(); ?></div><!-- post-date -->
    <div class="clear"></div>
  </div> <!-- postmeta -->
  <div class="entry-content">
    <?php the_content(); ?>
    <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'twenty-minutes' ),
            'after'  => '</div>',
        ) );
        ?>
    <div class="postmeta">
      <div class="post-categories">
        <?php the_category(); ?>
      </div>
      <div class="post-tags">
       <?php the_tags(); ?>
      </div>
      <div class="clear"></div>
    </div><!-- postmeta --> 
  </div><!-- .entry-content -->
  
</article>