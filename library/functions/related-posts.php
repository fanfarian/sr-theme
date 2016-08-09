<?php
if ( ! function_exists( 'sr_related_posts' ) ) :
/**
 * Related Posts Function, matches posts by tags - call using sr_related_posts();
 */
function sr_related_posts() {
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
	
		$args = array(
			'tag' 			=> $tag_arr,
			'numberposts' 	=> 3,																																// show 3 related posts
			'post__not_in' 	=> array($post->ID)
		);
	
		$related_posts = get_posts( $args );
		if($related_posts) {
			echo '<h4 class="related-posts-headline">'.__('Related Posts', 'sr-theme').'</h4>';
			echo '<ul id="related-posts-list">';

			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related-posts-items">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<?php get_template_part( 'parts/content', 'author-info' ); ?>
				</li>
			<?php endforeach;
		}
	wp_reset_postdata();
	echo '</ul>';
}
endif;


/**
 * for use in the loop, list 5 post titles related to first tag on current post
 */

/*
$tags = wp_get_post_tags($post->ID);
if ($tags) {
  $tag_ids = array();
  foreach($tags as $individual_tag) {
	$tag_ids[] = $individual_tag->term_id;
  }

  echo 'Related Posts';
  
  $args=array(
    'tag__in' => $tag_ids,
    'post__not_in' => array($post->ID),
    'showposts'=>5,
    'ignore_sticky_posts'=>1
   );

  $my_query = new WP_Query($args);

  if( $my_query->have_posts() ) {
    while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <p><a href="<?php the_permalink() ?>" rel="bookmark" title="
      <?php the_title_attribute(); ?>">
      <?php the_title(); ?></a></p>
      <?php
    endwhile;
  }
}
*/

?>
