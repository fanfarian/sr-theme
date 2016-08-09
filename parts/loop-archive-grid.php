<?php 
	$grid_columns = 4; 																																			// Adjust the amount of rows in the grid
 ?>

<?php if( 0 === ( $wp_query->current_post  )  % $grid_columns ): ?>

    <div class="row archive-grid" data-equalizer> <!--Begin Row:--> 

<?php endif; ?> 

		<!--Item: -->
		<div class="large-3 medium-3 columns panel" data-equalizer-watch>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
			
				<section class="featured-image">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
				</section> <!-- end article section -->
			
				<header class="article-header">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<?php get_template_part( 'parts/content', 'author-info' ); ?>				
				</header> <!-- end article header -->	
								
				<section class="entry-content">
					<?php the_content('<button class="tiny">'. __('Read more...', 'sr-theme') .'</button>'); ?>
				</section> <!-- end article section -->
				
				<footer class="article-footer">
					<p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'sr-theme') . '</span> ', ', ', ''); ?></p>
				</footer> <!-- end article footer -->				    						
								    							
			</article> <!-- end article -->
			
		</div>

<?php if( 0 === ( $wp_query->current_post + 1 )  % $grid_columns ||  ( $wp_query->current_post + 1 ) ===  $wp_query->post_count ): ?>

   </div>  <!--End Row: --> 

<?php endif; ?>