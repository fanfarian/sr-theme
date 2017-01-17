<?php

if( ! function_exists( 'sr_image_sizes' )) :
/**
 * Additional Images sizes for Content
 */
function sr_image_sizes() {

	add_theme_support( 'post-thumbnails' );																														// Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
	set_post_thumbnail_size( 240, 240, true );																													// square thumbnails

	add_image_size( 'NAME', 240, 0 );																															// add custom thumbnail
}
endif; // sr_image_sizes
// add_action( 'after_setup_theme', 'sr_image_sizes', 999 );


if( ! function_exists( 'sr_image_sizes_choose' )) :
/**
 * Add new image sizes to mediathek
 */
function sr_image_sizes_choose($sizes) {
	$custom_sizes = array(
		'NAME' 		=> 'Name in WP-Admin',																														// Add custom size to wp-admin media
	);
	return array_merge($sizes, $custom_sizes);																													// Merge new sizes with existing
//	return $custom_sizes;																																		// Return only new sizes
}
endif; // sr_image_sizes_choose
// add_filter( 'image_size_names_choose', 'sr_image_sizes_choose', 999 );


?>
