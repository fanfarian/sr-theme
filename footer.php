					<footer class="footer" role="contentinfo">
						<section id="inner-footer" class="row">
							
							<div class="small-12 columns">
								<nav role="navigation">
		    						<?php sr_footer_menu(); ?>
		    					</nav>
		    				</div>
							
							<?php if ( is_active_sidebar( 'sr-footer' ) ) : ?>
								<div id="sidebar-sr-footer" class="small-12 columns">
									<?php dynamic_sidebar( 'sr-footer' ); ?>
								</div>
							<?php endif; ?>
							
							<div class="small-12 columns">
								<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
							</div>
							
						</section> <!-- end #inner-footer -->
					</footer> <!-- end .footer -->
					
				</div>  <!-- end .main-content -->
			</div> <!-- end .off-canvas-wrapper-inner -->
		</div> <!-- end .off-canvas-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->