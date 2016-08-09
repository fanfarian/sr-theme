<?php
	
if( ! function_exists( 'sr_widgets_init' )) :
/**
 * Register widget areas
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sr_widgets_init() {
	
	// Right
	register_sidebar( array(
		'id'            => 'sr-right',
		'name'          => __( 'Right Sidebar', 'sr-theme' ),
		'description'   => __( 'Widgets in the right sidebar', 'sr-theme' ),
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => "</h4>\n",
	) );

	// Left
	register_sidebar( array(
		'id'            => 'sr-left',
		'name'          => __( 'Left Sidebar', 'sr-theme' ),
		'description'   => __( 'Widgets in the left sidebar', 'sr-theme' ),
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => "</h4>\n",
	) );


	// Offcanvas
	register_sidebar(array(
		'id' 			=> 'sr-offcanvas',
		'name' 			=> __('Offcanvas Widgets', 'sr-theme'),
		'description' 	=> __('Widgets in the offcanvas navigation ', 'sr-theme'),
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</article>',
		'before_title'	 => '<h4 class="widgettitle">',
		'after_title' 	=> '</h4>',
	));
	
	// Footer
	register_sidebar( array(
		'id'            => 'sr-footer',
		'name'          => __( 'Footer Widgets', 'sr-theme' ),
		'description'   => __( 'Footer Widget Area', 'sr-theme' ),
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => "</h2>\n",
	) );

}
endif;
add_action( 'widgets_init', 'sr_widgets_init' );	
	
?>
