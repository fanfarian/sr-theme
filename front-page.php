<?php get_header(); ?>
	
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="small-12 columns" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
						
						<header class="article-header">
							<h1 class="page-title"><?php the_title(); ?></h1>
						</header> <!-- end article header -->
										
					    <section class="entry-content">
						    <?php the_content(); ?>
						    <?php wp_link_pages(); ?>
						</section> <!-- end article section -->
										
					</article> <!-- end article -->
			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>