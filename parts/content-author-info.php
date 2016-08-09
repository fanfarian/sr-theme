<p class="byline">
	<span class="author"><?php _e('Written by', 'sr-theme'); ?> <?php the_author_posts_link(); ?>, </span>
	<time datetime="<?php the_time('c'); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time> - 
	<span class="category"><?php the_category(', ') ?></span>
</p>