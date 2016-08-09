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
	wp_enqueue_script( 'what-input', get_template_directory_uri() . '/library/vendor/what-input/dist/what-input.min.js', array(), '', true );					// What-Input plugin for input specific styles with foundation
	
	// use newest jquery from /library/vendor/
	wp_deregister_script('jquery');																																// disable WP internal jquery for own version
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/library/vendor/jquery/dist/jquery.min.js', array( ), '2.2.3', true );
	
	// Adding Foundation scripts file in the footer
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', array( 'jquery', 'what-input' ), '6.2.3', true );
	
	// Adding fontfaceboserver scripts file in the header
	wp_enqueue_script( 'fontfaceobserver', get_template_directory_uri() . '/library/vendor/fontfaceobserver/fontfaceobserver.js', array( ), '1.7.1', false );	// Fontfaceobserver from https://github.com/bramstein/fontfaceobserver
	wp_enqueue_script( 'sr-fontface', get_template_directory_uri() . '/assets/js/fontface.min.js', array( 'fontfaceobserver' ), '1.0', false );					// Will be overwritten in child theme
	
	// enqueue comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
}
endif; // sr_enqueue_style
add_action( 'wp_enqueue_scripts', 'sr_enqueue_scripts_styles', 99 );

?>