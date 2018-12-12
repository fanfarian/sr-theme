<?php

/**
 * functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage sr-theme
 * @since 1.0.0
 */


##############################################################################################################################
##############################################################################################################################

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;						// Based on Foundation global default settings in /assets/scss/_settings.scss
}


##############################################################################################################################
##############################################################################################################################

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
require_once(get_template_directory().'/library/functions/theme-support.php');


##############################################################################################################################
##############################################################################################################################

/**
 * Enqueue scripts and styles.
 */
require_once(get_template_directory().'/library/functions/enqueue-scripts-styles.php');


##############################################################################################################################
##############################################################################################################################

/**
 * Register custom menus and menu walkers.
 */
require_once(get_template_directory().'/library/functions/menu.php');

/**
 * Numbered pagination Links
 */
require_once(get_template_directory().'/library/functions/menu-pagination.php');


##############################################################################################################################
##############################################################################################################################

/**
 * Better WordPress comments.
 */
require_once(get_template_directory().'/library/functions/comments.php');
require_once(get_template_directory().'/library/functions/comments-navigation.php');


##############################################################################################################################
##############################################################################################################################

/**
 * Foundation enhancements and changes.
 */
require_once(get_template_directory().'/library/functions/foundation.php');


##############################################################################################################################
##############################################################################################################################

/**
 * Register widget areas. Default: Left, Right, Offcanvas, Footer.
 */
require_once(get_template_directory().'/library/functions/theme-widgets.php');


##############################################################################################################################
##############################################################################################################################

if( ! function_exists( 'modify_footer_admin' )) :
/*
 * Custom footer content in wp-admin
 *
 */
function modify_footer_admin() {
	echo '<span id="footer-thankyou">Site developed with <a href="https://sr-theme.com">sr-theme</a>. Powered by <a href="http://www.wordpress.org">WordPress</a></span>';
}
endif; // modify_footer_admin
add_filter('admin_footer_text', 'modify_footer_admin');


##############################################################################################################################
##############################################################################################################################

/**
 * Theme updater checker
 */
require_once( get_template_directory().'/library/plugin-update-checker/plugin-update-checker.php' );
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/fanfarian/sr-theme/',
    __FILE__,
    'sr-theme'
);

$myUpdateChecker->setBranch('master');


?>
