<!-- This menu will use off-canvas for small and a topbar for medium-up -->

<!-- Contain navigation to the grid -->
<!--
<div class="row">
    <div class="small-12 columns">
-->

		<div class="top-bar" id="top-bar-menu">
			<div class="top-bar-left float-left">
				<ul class="menu">
					<li class="menu-text"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></li>
				</ul>
			</div>
			<div class="top-bar-right show-for-medium">
				<?php sr_top_navigation(); ?>
			</div>
			<div class="top-bar-right float-right show-for-small-only">
				<ul class="menu">
					<!-- Add the hamburger lines as navigation trigger -->
					<!-- <li><button class="menu-icon" type="button" data-toggle="offCanvas"></button></li> -->
					
					<!-- Add Menu as navigation trigger -->
					<li><a data-toggle="offCanvas">Menu</a></li>
				</ul>
			</div>
		</div>

<!-- Contain navigation to the grid -->
<!--
    </div>
</div>
-->