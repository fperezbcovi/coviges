<?php
/**
 * Template Name: Front Page
 */
?>

<?php
	// Custom color schema
	if ( $color_schema = get_post_meta( get_the_ID( ), 'color-schema', true ) ) {		
		if ($color_schema != 'default') {
			$naxos_config['styling-schema'] = $color_schema;
		}
	}
?>

<?php get_header( ); ?>

<?php Naxos_Theme::naxos_front_page( get_the_ID( ) ); ?>

<?php get_footer( ); ?>