<?php get_header(); ?>
			
	<div id="inner-content" class="row">

		<main id="main" class="large-8 medium-8 columns first" role="main">
			<header>
				<h1 class="archive-title"><?php _e('Search Results for:', 'sr-theme'); ?> <?php echo esc_attr(get_search_query()); ?></h1>
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
