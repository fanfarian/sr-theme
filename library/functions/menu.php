<?php
	
/**
 * Register custom menus
 */	
register_nav_menus(
	array(
		'primary' 		=> __( 'Main Menu', 'sr-theme' ),  		 																								// Main Menu in header
		'subnav'  		=> __( 'Subnav Menu', 'sr-theme' ),																										// Sub menu in header
		'footer'  		=> __( 'Footer Menu', 'sr-theme' ), 																									// Third menu in footer
		'socialmedia'  => __( 'Socialmedia Menu', 'sr-theme' ) 																									// Social Media Links
	)
);

if( ! function_exists( 'sr_top_navigation' )) : 
/**
 * The Main Menu - placed in /parts/nav-[topbar|title-bar|offcanvas-topbar]
 */	
function sr_top_navigation() {
	
	if (has_nav_menu('primary')) {
		wp_nav_menu(array(
	        'container' 	=> false,                          																									// Remove nav container
	        'menu_class' 	=> 'menu vertical medium-horizontal',       																						// Adding custom nav class
	        'items_wrap' 	=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
	        'theme_location' => 'primary',        																												// Where it's located in the theme
	        'depth' 		=> 5,                                   																							// Limit the depth of the nav
	        'walker' 		=> new Topbar_Menu_Walker() 																										// Custom Menu Walker
	    ));
    }
} /* End Top Menu */
endif;


if( ! function_exists( 'sr_drilldown_navigation' )) :
/**
 * Alternative Main Menu - placed in /parts/nav-title-bar-drilldown
 */	
function sr_drilldown_navigation() {
	
	if (has_nav_menu('primary')) {
		wp_nav_menu(array(
	        'container' 	=> false,                          																									// Remove nav container
	        'menu_class' 	=> 'menu vertical medium-horizontal',       																						// Adding custom nav class
	        'items_wrap' 	=> '<ul id="%1$s" class="%2$s" data-responsive-menu="drilldown medium-dropdown">%3$s</ul>',
	        'theme_location' => 'primary',        																												// Where it's located in the theme
	        'depth' 		=> 5,                                   																							// Limit the depth of the nav
	        'walker' 		=> new Topbar_Menu_Walker() 																										// Custom Menu Walker
	    ));
	}
} /* End Top Menu */
endif;


if( ! function_exists( 'sr_subnav_menu' )) :
/**
 * The Subnav Menu - not placed in any template
 */	
function sr_subnav_menu() {
	
	if (has_nav_menu('subnav')) {
		wp_nav_menu(array(
	        'container' 	=> false,                          																									// Remove nav container
	    	'menu' 			=> __( 'Subnav Menu', 'sr-theme' ),   																								// Nav name
	        'menu_class' 	=> 'menu vertical medium-horizontal',       																						// Adding custom nav class
	        'items_wrap' 	=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
	        'theme_location' => 'subnav',        																												// Where it's located in the theme
	        'depth' 		=> 5,                                   																							// Limit the depth of the nav
	        'fallback_cb' 	=> false,                         																									// Fallback function (see below)
	        'walker'		=> new Topbar_Menu_Walker()																											// Custom Menu Walker
	    ));
	}
} /* End Footer Menu */
endif;


if( ! function_exists( 'sr_offcanvas_navigation' )) :
/**
 * The Off Canvas Menu - placed in /parts/content-offcanvas-[left|right]
 */	
function sr_offcanvas_navigation() {

	if (has_nav_menu('primary')) {
		wp_nav_menu(array(
	        'container' 	=> false,                          																						 			// Remove nav container
	        'menu_class'	=> 'menu vertical',       																											// Adding custom nav class
	        'items_wrap' 	=> '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
	        'theme_location' => 'primary',        																												// Where it's located in the theme
	        'depth' 		=> 5,                                   																							// Limit the depth of the nav
	        'fallback_cb' 	=> false,                         																									// Fallback function (see below)
	        'walker' 		=> new Off_Canvas_Menu_Walker() 																									// Custom Menu Walker
	    ));
	}
} /* End Off Canvas Menu */
endif;


if( ! function_exists( 'sr_footer_menu' )) :
/**
 * The Footer Menu - placed in /footer.php
 */	
function sr_footer_menu() {
    wp_nav_menu(array(
		'container' 	=> false,                         																							    		// Remove nav container
		'menu' 			=> __( 'Footer Menu', 'sr-theme' ),   																									// Nav name
		'menu_class' 	=> 'menu vertical medium-horizontal',       																							// Adding custom nav class
		'theme_location' => 'footer',            																												// Where it's located in the theme
		'depth' 		=> 0,                                   																								// Limit the depth of the nav
		'fallback_cb' 	=> false,                         																										// Fallback function (see below)
		'walker' 		=> new Topbar_Menu_Walker()																												// Custom Menu Walker
	));
} /* End Footer Menu */
endif;


if( ! function_exists( 'sr_socialmedia_menu' )) :
/**
 * The Social Meida Menu- not placed in any template
 */	
function sr_socialmedia_menu() {
    wp_nav_menu(array(
    	'container' 	=> false,                         																							    		// Remove nav container
    	'menu' 			=> __( 'Socialmedia Menu', 'sr-theme' ),   																								// Nav name
        'menu_class' 	=> 'menu vertical medium-horizontal',       																							// Adding custom nav class
		'items_wrap' 	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
    	'theme_location' => 'socialmedia',            																											// Where it's located in the theme
        'depth' 		=> 0,                                   																								// Limit the depth of the nav
        'fallback_cb' 	=> false,                         																										// Fallback function (see below)
        'walker' 		=> new Socialmedia_Menu_Walker()																												// Custom Menu Walker
	));
} /* End Footer Menu */
endif;



/**
 * Navigation Walker Classes
 */	
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}


class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical nested menu\">\n";
    }
}

class Socialmedia_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
    
    // Displays start of an element. E.g '<li> Item Name'
    // @see Walker::start_el()
    function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		$classes = array_unique($classes);				
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
		
		$link_icon_class = strtolower( $item->title );
		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$item_output  = $args->before;
		$item_output .= '<a class="icon-'.$link_icon_class .'" '. $attributes .'>';
//		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= $item_output;
//		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
    
    // Displays end of an element. E.g '</li>'
    // @see Walker::end_el()
    function end_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {
		$output .= "</li>\n";
    }
}



if( ! function_exists( 'required_active_nav_class' )) :
/**
 * Add Foundation active class to menu
 */	
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
endif;
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );

?>
