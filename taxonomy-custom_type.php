<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>
			
	<div id="inner-content" class="row">

	    <main id="main" class="large-8 medium-8 columns first" role="main">
	
		    <header>
		    	<h1 class="page-title"><span><?php _e('Posts Categorized:', 'sr-theme'); ?></span> <?php single_cat_title(); ?></h1>
		    </header>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
				<!-- To see additional archive styles, visit the /parts directory -->
				<?php get_template_part( 'parts/loop', 'archive' ); ?>
			    
			<?php endwhile; ?>	

				<?php sr_pagination_menu(); ?>
				
			<?php else : ?>
										
				<?php get_template_part( 'parts/content', 'none' ); ?>
					
			<?php endif; ?>

	    </main> <!-- end #main -->

	    <?php get_sidebar(); ?>
	    
	</div> <!-- end #inner-content -->

<?php get_footer(); ?>
