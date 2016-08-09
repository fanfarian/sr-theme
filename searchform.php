<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo __( 'Search for:', 'sr-theme' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', '', 'sr-theme' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
	</label>
	<input type="submit" class="search-submit button" value="<?php echo esc_attr_x( 'Search', '', 'sr-theme' ) ?>" />
</form>