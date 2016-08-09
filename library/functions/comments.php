<?php

if( ! function_exists( 'sr_theme_comments' )) :
/**
 * Comment Layout
 */
function sr_theme_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('callout'); ?>>
		<div class="media-object">
			<div class="media-object-section">
			    <?php echo get_avatar( $comment, 75 ); ?>
			  </div>
			<div class="media-object-section">
				<article id="comment-<?php comment_ID(); ?>" class="clearfix large-12 columns">
					<header class="comment-author">
						<?php
							// create variable
							$bgauthemail = get_comment_author_email();
						?>
						<?php printf(__('%s', 'sr-theme'), get_comment_author_link()) ?> on
						<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__(' F jS, Y - g:ia', 'sr-theme')); ?> </a></time>
						<?php edit_comment_link(__('(Edit)', 'sr-theme'),'  ','') ?>
					</header>
					<?php if ($comment->comment_approved == '0') : ?>
						<div class="alert alert-info">
							<p><?php _e('Your comment is awaiting moderation.', 'sr-theme') ?></p>
						</div>
					<?php endif; ?>
					<section class="comment_content clearfix">
						<?php comment_text(); ?>
					</section>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</article>
			</div>
		</div>
	<!-- </li> is added by WordPress automatically -->
<?php
}
endif;

?>
