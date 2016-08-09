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


if( ! function_exists( 'sr_content_image_sizes_attr' )) : 
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since sr-theme 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function sr_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
endif;
//add_filter( 'wp_calculate_image_sizes', 'sr_content_image_sizes_attr', 10 , 2 );


if( ! function_exists( 'sr_post_thumbnail_sizes_attr' )) :
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since sr-theme 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function sr_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
endif;
//add_filter( 'wp_get_attachment_image_attributes', 'sr_post_thumbnail_sizes_attr', 10 , 3 );

?>
