<?php
	
if( ! function_exists( 'sr_enqueue_scripts_styles' )) :
/**
 * Enqueue scripts and styles.
 */
function sr_enqueue_scripts_styles()
{
	// Register main stylesheet
	wp_enqueue_style( 'sr-theme', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );
	
	// Load What-Input files in footer
	wp_enqueue_script( 'what-input', get_template_directory_uri() . '/library/vendor/what-input/dist/what-input.min.js', array(), '4.0.6', true );				// What-Input plugin for input specific styles with foundation
	
	// use newest jquery from /library/vendor/
	wp_deregister_script('jquery');																																// disable WP internal jquery for own version
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/library/vendor/jquery/dist/jquery.min.js', array( ), '3.1.1', true );
	wp_deregister_script('jquery-migrate');																														// disable WP internal jquery-migrate for own version
	wp_enqueue_script( 'jquery-migrate', get_template_directory_uri() . '/assets/js/jquery-migrate-3.0.0.min.js', array( ), '3.0.0', true );
	
	// Adding Foundation scripts file in the footer
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', array( 'jquery', 'what-input' ), '6.3.1', true );			// Foundation init + js
	
	
	// enqueue comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
}
endif; // sr_enqueue_style
add_action( 'wp_enqueue_scripts', 'sr_enqueue_scripts_styles', 99 );

?>
