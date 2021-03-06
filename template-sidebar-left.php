<?php
/*
	Template Name: Left Sidebar
*/
?>

<?php get_header(); ?>
	
	<div id="inner-content" class="row">

	    <main id="main" class="large-8 medium-8 medium-push-4 columns" role="main">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		    	<?php get_template_part( 'parts/loop', 'page' ); ?>
		    
		    <?php endwhile; endif; ?>							
		    					
		</main> <!-- end #main -->

	    <?php get_sidebar( 'left' ); ?>
	    
	</div> <!-- end #inner-content -->

<?php get_footer(); ?>
