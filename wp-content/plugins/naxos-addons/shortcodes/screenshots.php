<?php
// Screenshots ([screenshots])
class Naxos_Shortcode_Screenshots {
    
    public static function screenshots( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'images'  	=> '',
			'zoom' 		=> 'true'
		), $atts ) );
		
		$cls = ( $zoom == 'true' ? 'zoom-screenshot' : '' );
		
		$output = '<div class="row">
						<div class="col-12">
							<div class="owl-carousel owl-theme screenshot-slider ' . $cls . '">';
		
		$image_ids = explode( ',', $images );
		
		foreach ( $image_ids as $image_id ) {
			if ( $img = wp_get_attachment_image_src( $image_id, 'full' ) ) {
				$output .= '<div class="item">
								<a href="' . esc_attr( $img[0] ) . '"><img src="' . esc_attr( $img[0] ) . '" alt="screenshot" /></a>
							</div>';
			}
		}
		
		$output .= '		</div>
						</div>
					</div>';
		
		return $output;
	}
	
	public static function vc_screenshots() {
		vc_map( array(
		   	"name" => esc_html__("Screenshots", "naxos-addons"),
		   	"base" => "screenshots",
		   "icon" => 'ti-image',
            "description" => esc_html__( "App screenshots", "naxos-addons" ),
		   	"category" => esc_html__("Naxos", "naxos-addons"),
		   	"params" => array(
				array(
					"type"        => "attach_images",
					"heading"     => esc_html__( "Images", "naxos-addons" ),
					"param_name"  => "images",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Popup Window", "naxos-addons" ),
					"param_name"  => "zoom",
					"value"       => "",
					"std" 		  => "true",
					"description" => "Zoom on image click",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'screenshots', 		array( 'Naxos_Shortcode_Screenshots', 'screenshots' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Screenshots', 'vc_screenshots' ) );

