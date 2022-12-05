<?php global $naxos_config; ?>
<?php $isFrontPage = Naxos_Theme::naxos_is_front_page( get_the_ID( ) ); ?>

<!DOCTYPE html>
<html class="no-js <?php echo ( is_admin_bar_showing( ) ? 'wp-bar' : '' ); ?>" <?php language_attributes( ); ?>>

	<head>
	
		<!-- Meta -->
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<?php wp_head( ); ?>
		
	</head>
	
	<body <?php body_class( ); ?>>
		<?php wp_body_open( ); ?>
		
		<?php if ( $naxos_config['preloader'] or $naxos_config === null ) { ?>
			<?php if ( ( $naxos_config['preloader-only-home'] and $isFrontPage ) or ! $naxos_config['preloader-only-home'] or $naxos_config == null ) { ?>
				<!-- Loader -->
				<div class="page-loader">
					<div class="progress"></div>
				</div>	
			<?php  } ?>
		<?php  } ?>