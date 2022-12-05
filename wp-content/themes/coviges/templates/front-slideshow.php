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
<section id="home" class="banner slide-bg <?php echo esc_attr( $css ); ?>"
	data-source="<?php echo esc_url( Naxos_Theme::naxos_slideshow_images( get_the_ID( ) ) ); ?>"
	data-delay="<?php echo intval( $naxos_config['home-slideshow-timeout'] ); ?>"
>
	
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

