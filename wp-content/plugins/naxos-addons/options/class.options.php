<?php
class Naxos_Admin {
	
	// Styles
	public static function naxos_styles( ) {
		wp_register_style( 'naxos-options', plugins_url( '/styles.css', __FILE__ ) );
	}

	// Scripts
	public static function naxos_scripts( ) {
		wp_register_script( 'naxos-options', plugins_url( '/functions.js', __FILE__ ), array( ), false, true );
		wp_localize_script( 'naxos-options', 'naxos_options_lng', array(
			'insert_media' => esc_html__( 'Insert Media', 'naxos-addons' )
		) );
	}
	
	// Metabox
	public static function naxos_add_metabox( $box ) {
		switch ( $box ) {
			case 'naxos_home':
				add_meta_box( 'naxos_home_section', esc_html__( 'Home Section', 'naxos-addons' ), 'naxos_home_section_callback', 'page', 'normal', 'high' );
				break;
			case 'naxos_subtitle':
				add_meta_box( 'athenastudio_subtitle', esc_html__( 'Visual Subtitle', 'naxos-addons' ), array( 'Naxos_Subtitle', 'naxos_content' ), 'page', 'side' );
				break;
		}
	}
	
	// Action
	public static function naxos_add_action( $box ) {
		switch ( $box ) {
			case 'naxos_home':
				add_action( 'add_meta_boxes', 'naxos_home_section_meta' );
				break;
			case 'naxos_subtitle':
				add_action( 'add_meta_boxes', array( 'Naxos_Subtitle', 'naxos_initialize' ) );
				break;
		}
	}

	// Box
	public static function naxos_box( $content ) {
		return '
		<div class="postbox">
			<div class="inside">
				' . $content . '
			</div>
		</div>';
	}

	// Wrapper
	public static function naxos_wrap( $title, $content ) {
		return '
		<div class="wrap metabox-holder">
			<h2>' . esc_html( $title ) . '</h2>
			<div style="margin-top: 15px">' . $content . '</div>
		</div>';
	}

	// Message
	public static function naxos_message( $content, $type = 'updated' ) {
		return '
		<div class="' . esc_attr( $type ) . ' settings-error" style="margin-top: 15px">
			<p><strong>' . $content . '</strong></p>
		</div>';
	}
	
}

// Styles and scripts
add_action( 'admin_enqueue_scripts', array( 'Naxos_Admin', 'naxos_styles' ) );
add_action( 'admin_enqueue_scripts', array( 'Naxos_Admin', 'naxos_scripts' ) );
