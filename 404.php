<?php get_header(); ?>
			
	<div id="inner-content" class="row">

	    <main id="main" class="large-8 medium-8 columns" role="main">

			<article id="content-not-found">
			
				<header class="article-header">
					<h1><?php _e('404 - Article Not Found', 'sr-theme'); ?></h1>
				</header> <!-- end article header -->
		
				<section class="entry-content">
					<p><?php _e('The article you were looking for was not found, but maybe try looking again!', 'sr-theme'); ?></p>
				</section> <!-- end article section -->

				<section class="search">
				    <p><?php get_search_form(); ?></p>
				</section> <!-- end search section -->
		
			</article> <!-- end article -->

		</main> <!-- end #main -->
		
		<?php get_sidebar(); ?>

	</div> <!-- end #inner-content -->

<?php get_footer(); ?>