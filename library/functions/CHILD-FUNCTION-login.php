<?php
	
if( ! function_exists( 'sr_login_css' )) : 
/**
 * Customize the WordPress login menu
 * managed through assets/scss/login.scss
 */
function sr_login_css() {
	wp_enqueue_style( 'sr-theme-login-css', get_stylesheet_directory_uri() . '/assets/css/login.css', false );
}
endif;
add_action( 'login_enqueue_scripts', 'sr_login_css', 10 );


if( ! function_exists( 'sr_login_url' )) :  
/**
 * Change the logo link from wordpress.org to your site
 */
function sr_login_url() { 
	return home_url(); 
}
endif;
add_filter( 'login_headerurl', 'sr_login_url' );


if( ! function_exists( 'sr_login_title' )) : 
/**
 * Change the alt text on the logo to show your site name
 */
function sr_login_title() { 
	return get_option('blogname'); 
}
endif;
add_filter( 'login_headertitle', 'sr_login_title' );

?>
