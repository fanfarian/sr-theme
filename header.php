<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">
		
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="initial-scale=1.0, width=device-width">
		<meta class="foundation-mq">		

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

	</head>
			
	<body <?php body_class(); ?>>

		<div class="off-canvas-wrapper">
			
			<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
				
				<!-- Include 'offcanvas-left' for navigation on the left side	-->
				<?php // get_template_part( 'parts/content', 'offcanvas-right' ); ?>
				
				<div class="off-canvas-content" data-off-canvas-content>
					
					<header class="header" role="banner">
							
						 <!-- Include your navigation here, please see /template-parts for other styles -->
						<?php get_template_part( 'parts/nav', 'title-bar' ); ?>
		 	
					</header> <!-- end .header -->