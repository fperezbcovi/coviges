<?php
// Localization
function naxos_localization( ) {
	load_theme_textdomain( 'naxos', get_template_directory( ) . '/languages' );
}

add_action( 'after_setup_theme', 'naxos_localization' );
