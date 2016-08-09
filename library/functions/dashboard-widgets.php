<?php

if( ! function_exists( 'sr_add_custom_dashboard_activity' )) :
/**
 * Register your custom activity widgets
 */
function sr_add_custom_dashboard_activity() {
    wp_add_dashboard_widget('sr_custom_static_content', 'Widget with static content', 'sr_custom_static_content_function');

    wp_add_dashboard_widget('sr_custom_activity_content', 'Widget with custom dynamic content', 'sr_custom_activity_content_function');

}
endif;
add_action('wp_dashboard_setup', 'sr_add_custom_dashboard_activity' );


if( ! function_exists( 'sr_custom_static_content_function' )) :
/**
 * Function that outputs the contents of the dashboard widget
 */
function sr_custom_static_content_function() {
	echo 'Place any static HTML content e.g text, links and show them in a custom dashboard widget.';
}
endif;


if( ! function_exists( 'sr_custom_activity_content_function' )) :
/**
 * The Dashboard widget
 */
function sr_custom_activity_content_function() {


	/* Insert any custom wordpress function for your dashboard widget
	 * Example below: Get future and recent posts from custom post type 'projekte'
	 */

    echo '<div id="activity-widget">';

    $future_posts = sr_dashboard_recent_post_types( array(
        'post_type'  => 'projekte',
        'display' => 5,
        'max'     => 7,
        'status'  => 'future',
        'order'   => 'ASC',
        'title'   => __( 'Publishing Soon', 'sr-theme' ),
        'id'      => 'future-posts',
    ) );

    $recent_posts = sr_dashboard_recent_post_types( array(
        'post_type'  => 'projekte',
        'display' => 5,
        'max'     => 7,
        'status'  => 'publish',
        'order'   => 'DESC',
        'title'   => __( 'Recently Published', 'sr-theme' ),
        'id'      => 'published-posts',
    ) );


    if ( !$future_posts && !$recent_posts ) {
        echo '<div class="no-activity">';
        echo '<p class="smiley"></p>';
        echo '<p>' . __( 'No activity yet!', 'sr-theme' ) . '</p>';
        echo '</div>';
    }

    echo '</div>';
}
endif;


if( ! function_exists( 'sr_dashboard_recent_post_types' )) :
/**
 * Get Dashboard data
 */
function sr_dashboard_recent_post_types( $args ) {

	if ( ! $args['post_type'] ) {
		$args['post_type'] = 'any';
	}

	$query_args = array(
		'post_type'      => $args['post_type'],
		'post_status'    => $args['status'],
		'orderby'        => 'date',
		'order'          => $args['order'],
		'posts_per_page' => intval( $args['max'] ),
		'no_found_rows'  => true,
		'cache_results'  => false
	);
	$posts = new WP_Query( $query_args );

	if ( $posts->have_posts() ) {

		echo '<div id="' . $args['id'] . '" class="activity-block">';

		if ( $posts->post_count > $args['display'] ) {
			echo '<small class="show-more hide-if-no-js"><a href="#">' . sprintf( __( 'See %s more...', 'sr-theme'), $posts->post_count - intval( $args['display'] ) ) . '</a></small>';
		}

		echo '<h4>' . $args['title'] . '</h4>';
		echo '<ul>';

		$i = 0;
		$today    = date( 'Y-m-d', current_time( 'timestamp' ) );
		$tomorrow = date( 'Y-m-d', strtotime( '+1 day', current_time( 'timestamp' ) ) );

		while ( $posts->have_posts() ) {
			$posts->the_post();

			$time = get_the_time( 'U' );
			if ( date( 'Y-m-d', $time ) == $today ) {
				$relative = __( 'Today', 'sr-theme' );
			} elseif ( date( 'Y-m-d', $time ) == $tomorrow ) {
				$relative = __( 'Tomorrow', 'sr-theme' );
			} else {
				// translators: date and time format for recent posts on the dashboard, see http://php.net/date
				$relative = date_i18n( __( 'M jS', 'sr-theme' ), $time );
			}
			
			$text = sprintf(
			// translators: 1: relative date, 2: time, 4: post title
				__( '<span>%1$s, %2$s</span> <a href="%3$s">%4$s</a>', 'sr-theme' ),
				$relative,
				get_the_time(),
				get_edit_post_link(),
				_draft_or_post_title()
			);

			$hidden = $i >= $args['display'] ? ' class="hidden"' : '';
			echo "<li{$hidden}>$text</li>";
			$i++;
		}

		echo '</ul>';
		echo '</div>';

	} else {
		return false;
	}
	wp_reset_postdata();

	return true;
}
endif;
	
?>
