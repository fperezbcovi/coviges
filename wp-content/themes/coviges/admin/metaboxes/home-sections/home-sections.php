<?php
function naxos_home_section_meta( ) {
	global $post;

    if ( class_exists( 'Naxos_Admin' ) ) {
        Naxos_Admin::naxos_add_metabox('naxos_home');
    }
}

function naxos_home_section_callback( $post ) {
	// Styles
	wp_enqueue_style( 'naxos-meta-sections', get_template_directory_uri( ) . '/admin/metaboxes/styles.css' );
	
	// Scripts
	wp_register_script( 'naxos-home-sections', get_template_directory_uri( ) . '/admin/metaboxes/home-sections/functions.js', array( ), false, true );
	wp_localize_script( 'naxos-home-sections', 'naxos_home_lng', array(
		'insert_media' => esc_html__( 'Insert Media', 'naxos' ),
		'image'        => esc_html__( 'Image', 'naxos' ),
		'remove'       => esc_html__( 'Remove', 'naxos' )
	) );
	wp_enqueue_script( 'naxos-home-sections' );

	// Core
	wp_nonce_field( 'theme_nonce_safe', 'theme_nonce' );
	$meta = get_post_meta( $post->ID );

	$header_section = false;
	$bg_effect = false;
	$color_schema = false;
	
	if ( isset( $meta['header-section'] ) and ! empty( $meta['header-section'][0] ) and $meta['header-section'][0] != 'none' ) {
		$header_section = $meta['header-section'][0];
	}
	
	if ( isset( $meta['bg-effect'] ) and ! empty( $meta['bg-effect'][0] ) and $meta['bg-effect'][0] != 'none' ) {
		$bg_effect = $meta['bg-effect'][0];
	}
	
	if ( isset( $meta['color-schema'] ) and ! empty( $meta['color-schema'][0] ) and $meta['color-schema'][0] != 'default' ) {
		$color_schema = $meta['color-schema'][0];
	}
?>

	<!-- Home section type -->
	<p><strong><?php esc_html_e( 'Section Type', 'naxos' ); ?></strong></p>
	<select id="header-section" name="header-section" class="meta-item-m">
		<option value="none" 		<?php selected( $header_section, false ); ?>><?php esc_html_e( 'None', 'naxos' ); ?></option>
		<option value="slideshow" 	<?php selected( $header_section, 'slideshow' ); ?>><?php esc_html_e( 'Image Slideshow', 'naxos' ); ?></option>
		<option value="image" 		<?php selected( $header_section, 'image' ); ?>><?php esc_html_e( 'Single Image', 'naxos' ); ?></option>
		<option value="video" 		<?php selected( $header_section, 'video' ); ?>><?php esc_html_e( 'Video Background', 'naxos' ); ?></option>
	</select>

	<!-- Background effect -->
	<p><strong><?php esc_html_e( 'Background Effect', 'naxos' ); ?></strong></p>
	<select id="bg-effect" name="bg-effect" class="meta-item-m">
		<option value="none" 		<?php selected( $bg_effect, false ); ?>><?php esc_html_e( 'None', 'naxos' ); ?></option>
		<option value="wave" 		<?php selected( $bg_effect, 'wave' ); ?>><?php esc_html_e( 'Wave', 'naxos' ); ?></option>
		<option value="curve" 		<?php selected( $bg_effect, 'curve' ); ?>><?php esc_html_e( 'Curve', 'naxos' ); ?></option>
		<option value="oval" 		<?php selected( $bg_effect, 'oval' ); ?>><?php esc_html_e( 'Oval', 'naxos' ); ?></option>
	</select>

	<!-- Color schema -->
	<p><strong><?php esc_html_e( 'Color Schema', 'naxos' ); ?></strong></p>
	<select id="color-schema" name="color-schema" class="meta-item-m">
		<option value="default" 	<?php selected( $color_schema, false ); ?>><?php esc_html_e( 'Default', 'naxos' ); ?></option>
		<option value="blue" 		<?php selected( $color_schema, 'blue' ); ?>><?php esc_html_e( 'Blue', 'naxos' ); ?></option>
		<option value="green" 		<?php selected( $color_schema, 'green' ); ?>><?php esc_html_e( 'Green', 'naxos' ); ?></option>
		<option value="red" 		<?php selected( $color_schema, 'red' ); ?>><?php esc_html_e( 'Red', 'naxos' ); ?></option>
		<option value="turquoise" 	<?php selected( $color_schema, 'turquoise' ); ?>><?php esc_html_e( 'Turquoise', 'naxos' ); ?></option>
		<option value="purple" 		<?php selected( $color_schema, 'purple' ); ?>><?php esc_html_e( 'Purple', 'naxos' ); ?></option>
		<option value="orange" 		<?php selected( $color_schema, 'orange' ); ?>><?php esc_html_e( 'Orange', 'naxos' ); ?></option>
		<option value="yellow" 		<?php selected( $color_schema, 'yellow' ); ?>><?php esc_html_e( 'Yellow', 'naxos' ); ?></option>
		<option value="grey" 		<?php selected( $color_schema, 'grey' ); ?>><?php esc_html_e( 'Grey', 'naxos' ); ?></option>
	</select>

	<!-- Image slideshow -->
	<div data-header-section="slideshow" <?php echo esc_attr( $header_section != 'slideshow' ? 'class="meta-hidden"' : '' ); ?>>
		
		<div id="slideshow-add-button">
			<p><strong><?php esc_html_e( 'Background Images', 'naxos' ); ?></strong></p>
			<input type="button" class="button meta-item-upload" data-area="#slideshow-fields" data-multiple="true" value="<?php esc_attr_e( 'Choose or Upload Images', 'naxos' ); ?>">
		</div>
		
		<div id="slideshow-fields">
			<?php
				$limit = 20;
	
				for ( $i = 1; $i <= $limit; $i ++ ) {
			?>
					<div class="meta-item-row meta-mt-20 meta-hidden" id="slideshow-field-<?php echo esc_attr( $i ); ?>">
						<hr>
						<div>
							<p>
								<?php esc_html_e( 'Background Image', 'naxos' ); ?>
								<input type="text" class="meta-item-l alt" name="slideshow-field[<?php echo esc_attr( $i ); ?>]" value="" />
							</p>
							<p><input type="button" value="<?php esc_attr_e( 'Remove Slide', 'naxos' ); ?>" class="button" data-remove-slide="true"></p>
						</div>
					</div>
			<?php } ?>
		</div>
		
	</div>
	
	<!-- Single image -->
	<div data-header-section="image" <?php echo esc_attr( $header_section != 'image' ? 'class="meta-hidden"' : '' ); ?>>
		<p><strong><?php esc_html_e( 'Background Image', 'naxos' ); ?></strong></p>
		<input type="text" class="meta-item-l" name="single-image" id="single-image-field" value="<?php echo esc_attr( get_post_meta( $post->ID, 'single-image', true ) ); ?>">
		<input type="button" class="button meta-item-upload" data-area="#single-image-field" value="<?php esc_attr_e( 'Choose or Upload an Image', 'naxos' ); ?>">
	</div>	

	<!-- Video background -->
	<div data-header-section="video" <?php echo esc_attr( $header_section != 'video' ? 'class="meta-hidden"' : '' ); ?>>
		<p><strong><?php esc_html_e( 'Background Video ID', 'naxos' ); ?></strong></p>
		<input type="text" class="meta-item-m" name="video-id" value="<?php echo esc_attr( get_post_meta( $post->ID, 'video-id', true ) ); ?>">
		<p><?php esc_html_e( 'Example', 'naxos' ); ?>, https://www.youtube.com/watch?v=<strong>mqEeWiRwv0k</strong></p>
	</div>
	
	<?php
		$slidesContent = '';
	
		if ( ! empty( $meta['slideshow-images'][0] ) ) {
			$i = 0;
			$explode = explode( ',', $meta['slideshow-images'][0] );
	
			if ( count( $explode ) > 0 ) {
				foreach ( $explode as $name ) {
					$i ++;
	
					if ( ! empty( $name ) ) {
			
						$slidesContent .= 	'naxosSlidesContent[naxosSlidesContent.length] = {
												id:' . json_encode( $i ) .', 
												url:\'' . json_encode( $name ) . '\'
										   	 };';
					
					}
				}
			}
		}		
		
		wp_add_inline_script( 'naxos-home-sections', 
			'var naxosSlidesContent = [];' . 
			$slidesContent,
		'before');
	?>

	<?php
}

function naxos_home_section_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['theme_nonce'] ) || ! wp_verify_nonce( $_POST['theme_nonce'], 'theme_nonce_safe' ) ) return;
	if ( ! current_user_can( 'edit_posts' ) ) return;
	
	// Home section type
	if ( isset( $_POST['header-section'] ) ) {
		update_post_meta( $post_id, 'header-section', sanitize_text_field( $_POST['header-section'] ) );
	}
	
	// Background effect
	if ( isset( $_POST['bg-effect'] ) ) {
		update_post_meta( $post_id, 'bg-effect', sanitize_text_field( $_POST['bg-effect'] ) );
	}
	
	// Custom color schema
	if ( isset( $_POST['color-schema'] ) ) {
		update_post_meta( $post_id, 'color-schema', sanitize_text_field( $_POST['color-schema'] ) );
	}

	// Image slideshow
	if ( $_POST['header-section'] == 'slideshow' ) {
		if ( isset( $_POST['slideshow-field'] ) and count( $_POST['slideshow-field'] ) > 0 ) {
			update_post_meta( $post_id, 'slideshow-images', sanitize_text_field( implode( ',', $_POST['slideshow-field'] ) ) );
		} else if ( $_POST['header-section'] == 'slideshow' ) {
			update_post_meta( $post_id, 'slideshow-images', '' );
		}
	}
	
	// Single image
	if ( $_POST['header-section'] == 'image' ) {
		if ( isset( $_POST['single-image'] ) ) {
			update_post_meta( $post_id, 'single-image', sanitize_text_field( $_POST['single-image'] ) );
		}
	}

	// Video background
	if ( $_POST['header-section'] == 'video' ) {
		if ( isset( $_POST['video-id'] ) ) {
			update_post_meta( $post_id, 'video-id', sanitize_text_field( $_POST['video-id'] ) );
		}
	}	
}

if ( class_exists( 'Naxos_Admin' ) ) {
	Naxos_Admin::naxos_add_action('naxos_home');
}

add_action( 'save_post', 'naxos_home_section_save' );
