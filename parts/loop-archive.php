<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">					
	<header class="article-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'sr-theme' ); ?></span>
		<?php endif; ?>
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'parts/content', 'author-info' ); ?>
	</header> <!-- end article header -->
					
	<section class="entry-content">
		<?php if( has_post_thumbnail() ): ?> 
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a> 
		<?php endif; ?>
		<?php the_content('<button class="tiny">'. __('Read more...', 'sr-theme') .'</button>'); ?>
	</section> <!-- end article section -->
						
	<footer class="article-footer">
	
	</footer> <!-- end article footer -->				    						
</article> <!-- end article -->