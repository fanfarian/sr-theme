<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage sr-theme
 * @since 1.0
 */
?>

<aside id="sidebar-sr-right" class="sidebar large-4 medium-4 columns" role="complementary">

	<?php if ( is_active_sidebar( 'sr-right' ) ) : ?>
		<?php dynamic_sidebar( 'sr-right' ); ?>
	<?php endif; ?>

</aside>