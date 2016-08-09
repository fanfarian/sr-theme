<?php
	if ( post_password_required() ) {
		return;
	}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here ?>

	<?php if ( have_comments() ) : ?>
	
		<h2 class="comments-title">
			<?php comments_number(__('No Comments on', 'sr-theme'), __('One Comment on', 'sr-theme'), __('% Comments on', 'sr-theme') ); ?> 
			&#8220;<?php the_title(); ?>&#8221;
		</h2>

		<?php sr_comment_nav(); ?>

		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=sr_theme_comments'); ?>
		</ol>

		<?php sr_comment_nav(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sr-theme' ); ?></p>
	<?php endif; ?>

	<?php comment_form(array('class_submit'=>'button')); ?>

</div><!-- #comments -->