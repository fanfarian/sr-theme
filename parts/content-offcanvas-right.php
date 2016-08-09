<div class="off-canvas position-right" id="offCanvas" data-off-canvas data-position="right">
	
	<?php sr_offcanvas_navigation(); ?>
	
	<?php if ( is_active_sidebar( 'sr-offcanvas' ) ) : ?>
		<?php dynamic_sidebar( 'sr-offcanvas' ); ?>
	<?php endif; ?>
	
</div>