<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage sr-theme
 * @since 1.0
 */
?>

<aside id="sidebar-sr-left" class="sidebar large-4 medium-4 medium-pull-8 columns" role="complementary">

	<?php if ( is_active_sidebar( 'sr-left' ) ) : ?>
		<?php dynamic_sidebar( 'sr-left' ); ?>
	<?php endif; ?>

</aside>