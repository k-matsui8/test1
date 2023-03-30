<?php get_header(); ?>
<div class="container">
      <div class="pagewraps">
      <?php get_sidebar('left');?>     
    		 <section class="site-content-wrap"> 
                <div class="contentbox">
						<?php woocommerce_content(); ?>
 				<div class="clear"></div>          
               </div>
            </section><!-- section-->   
     <?php get_sidebar();?>      
    <div class="clear"></div>
    </div><!-- .pagewraps --> 
 </div><!-- .container --> 
<?php get_footer(); ?>