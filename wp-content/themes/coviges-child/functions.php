<?php	
/** Functions file for Naxos Child Theme **/

/* Enqueue parent styles */
function theme_enqueue_styles() {
	wp_enqueue_style( 'naxos-child-style', get_stylesheet_directory_uri() . '/style.css' );
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles', 11);
?>