<div class="off-canvas position-left" id="offCanvas" data-off-canvas>
	
	<?php sr_offcanvas_navigation(); ?>
	
	<?php if ( is_active_sidebar( 'sr-offcanvas' ) ) : ?>
		<?php dynamic_sidebar( 'sr-offcanvas' ); ?>
	<?php endif; ?>
	
</div>