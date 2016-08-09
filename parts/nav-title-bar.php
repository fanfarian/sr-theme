<!-- This menu will use the standard hamburger with vertical accordion for mobile and a horizontal dropdown for medium-up -->

<?php
$breakpoint = "medium"; 				// Adjust the breakpoint of the title-bar by adjusting this variable
?>

<!-- Contain navigation to the grid -->
<!--
<div class="row">
    <div class="small-12 columns">
-->

		<div class="title-bar" data-responsive-toggle="title-bar-menu" data-hide-for="<?php echo $breakpoint ?>">
			<button class="menu-icon" type="button" data-toggle></button>
			<div class="title-bar-title">Menu</div>
		</div>
		
		
		<div class="top-bar" id="title-bar-menu">
			<div class="top-bar-left show-for-<?php echo $breakpoint ?>">
				<ul class="menu">
					<li class="menu-text"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></li>			
				</ul>
			</div>
			<div class="top-bar-right">
				<?php sr_top_navigation(); ?>
			</div>
		</div>

<!-- Contain navigation to the grid -->
<!--
    </div>
</div>
-->