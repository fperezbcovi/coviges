<?php global $naxos_config; ?>
<?php the_post(); ?>

<?php
	$bg_effect = get_post_meta( get_the_ID( ), 'bg-effect', true );
	$css = '';

	if ( $bg_effect == 'curve' ) {
		$css = 'bottom-curve';
	} else if ( $bg_effect == 'oval' ) {
		$css = 'bottom-oval';
	}
?>

<!-- Banner -->
<section id="home" class="banner parallax video-bg <?php echo esc_attr( $css ); ?>">

	<!-- Youtube player -->
	<div id="BackgroundVideo" class="player" 
		data-property="{
			videoURL:'https://www.youtube.com/watch?v=<?php echo esc_attr( get_post_meta( get_the_ID( ), 'video-id', true ) ); ?>', 
			mobileFallbackImage:'<?php echo esc_url( $naxos_config['home-video-placeholder']['url'] ); ?>',
			containment:'#home', 
			autoPlay:true, 
			showControls:false, 
			showYTLogo:false, 
			mute:<?php echo ( ( $naxos_config['home-video-mutted'] or $naxos_config['home-video-mutted'] === null ) ? 'true' : 'false' ) ?>, 
			loop:<?php echo ( Naxos_Theme::naxos_option( 'home-video-loop', true ) ? 'true' : 'false' ); ?>,
			startAt:<?php echo intval( $naxos_config['home-video-start-at'] ); ?>, 
			stopAt:<?php echo intval( $naxos_config['home-video-stop-at'] ); ?>, 
			opacity:<?php echo ( ( $naxos_config['home-video-opacity'] === null ? 100 : intval( $naxos_config['home-video-opacity'] ) ) / 100 ); ?>, 
			vol:<?php echo ( ( $naxos_config['home-video-volume'] === null ? 50 : intval( $naxos_config['home-video-volume'] ) ) ); ?>
		}">
	</div>
	
	<?php if ( $bg_effect == 'wave' ) { ?>
		<!-- Wave effect -->
		<div class="wave-effect wave-anim">

			<div class="waves-shape shape-one">
				<div class="wave wave-one"></div>
			</div>

			<div class="waves-shape shape-two">
				<div class="wave wave-two"></div>
			</div>

			<div class="waves-shape shape-three">
				<div class="wave wave-three"></div>
			</div>

		</div>
	<?php } ?>
	
</section>

<?php the_content(); ?>

