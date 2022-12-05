<?php
class Naxos_Subtitle {
	
	// Initialization
	public static function naxos_initialize( ) {
		global $post;

		if ( $post !== null and get_post_meta( $post->ID, '_wp_page_template', true ) != 'templates/front.php' ) {
			if ( class_exists( 'Naxos_Admin' ) ) {
				Naxos_Admin::naxos_add_metabox('naxos_subtitle');
			}
		}
	}

	// Metabox
	public static function naxos_content( $post ) {
		// Styles
		wp_enqueue_style( 'naxos-meta-sections', get_template_directory_uri( ) . '/admin/metaboxes/styles.css' );
		
		wp_nonce_field( 'athenastudio_nonce_safe', 'athenastudio_nonce' );
		$meta = get_post_meta( $post->ID );

		$subtitle = '';
		if ( isset( $meta['subtitle'] ) and isset( $meta['subtitle'][0] ) ) {
			$subtitle = $meta['subtitle'][0];
		}

		$output = '
		<div class="meta-pt-15">
			<input type="text" class="meta-item-full" name="subtitle" value="' . esc_attr( $subtitle ) . '">
			<p>' . esc_html__( 'Example', 'naxos' ) . ', <strong>' . esc_html__( 'Lorem ipsum dolor sit amet.', 'naxos' ) . '</strong></p>
		</div>';

		echo wp_specialchars_decode( $output );
	}

	// Save
	public static function naxos_save( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! isset( $_POST['athenastudio_nonce'] ) || ! wp_verify_nonce( $_POST['athenastudio_nonce'], 'athenastudio_nonce_safe' ) ) return;
		if ( ! current_user_can( 'edit_posts' ) ) return;

		if ( isset( $_POST['subtitle'] ) ) {
			update_post_meta( $post_id, 'subtitle', sanitize_text_field( $_POST['subtitle'] ) );
		}
	}
	
}

if ( class_exists( 'Naxos_Admin' ) ) {
	Naxos_Admin::naxos_add_action('naxos_subtitle');
}

add_action( 'save_post', array( 'Naxos_Subtitle', 'naxos_save' ) );
