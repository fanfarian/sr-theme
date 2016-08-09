<?php

if( ! function_exists( 'sr_remove_sticky_class' )) :
/**
 *  Stop WordPress from using the sticky class (which conflicts with Foundation), and style WordPress sticky posts using the .wp-sticky class instead
 */
function sr_remove_sticky_class( $classes ) {
	if(in_array( 'sticky', $classes )) {
		$classes = array_diff( $classes, array( 'sticky' ));
		$classes[] = 'wp-sticky';
	}
	
	return $classes;
}
endif; // sr_remove_sticky_class
add_filter('post_class','sr_remove_sticky_class');

?>
