<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
	<header class="article-header">	
		<h1 class="entry-title single-title"><?php the_title(); ?></h1>
		<?php get_template_part( 'parts/content', 'author-info' ); ?>
    </header> <!-- end article header -->
					
    <section class="entry-content">
		<?php 
		if( has_post_thumbnail() ) :
			the_post_thumbnail('full');
		endif;
		
		the_content(); 
		?>
	</section> <!-- end article section -->
						
	<footer class="article-footer">
	    <?php wp_link_pages( array(
			'before'			=> '<div class="page-navigation"><ul class="menu"><li class="menu-text">' . __( 'Pages:', 'sr-theme' ) . '</li>',
			'after'			=> '</ul></div>',
			'link_before' 	=> '<span class="menu-item">',
			'link_after'  	=> '</span>',
			'pagelink'    	=> __( 'Page', 'sr-theme' ) . ' %',
			) );
		?>
		
		<?php if( has_tag() ) : ?>
			<p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'sr-theme') . '</span> ', ', ', ''); ?></p>	
		<?php endif; ?>

	</footer> <!-- end article footer -->
									
	<?php comments_template(); ?>	
													
</article> <!-- end article -->