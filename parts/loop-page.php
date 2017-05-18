<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
						
	<header class="article-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header> <!-- end article header -->
					
    <section class="entry-content">
	    <?php the_content(); ?>
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
	</footer> <!-- end article footer -->

</article> <!-- end article -->