<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
	</head>
	
	<?php 
		
		if( is_front_page() ):
			$AR_classes = array( 'AR-home');
		else:
			$AR_classes = array( 'AR-blog' );
		endif;
		
	?>
	
	<body <?php body_class( $AR_classes ); ?>>

	
		
		<div class="container-fluid">
					<img src="<?php header_image(); ?>" class="img-responsive img-fluid" height="100%" width="100%" alt="JUSIS TRAINING | ASMENINĖS TRENIRUOTĖS" />
		</div>

			<div class="col-xs-12 col-sm-12">
					
					<nav class="navbar navbar-default">
					  <div class="container-fluid">
					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					    </div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<?php 
								wp_nav_menu(array(
									'theme_location' => 'primary',
									'container' => false,
									'menu_class' => 'nav navbar-nav',
									//'walker' => new Walker_Nav_Primary()
									)
								);
							?>
						</div>
					  </div><!-- /.container-fluid -->
					</nav>

				
				</div>
		