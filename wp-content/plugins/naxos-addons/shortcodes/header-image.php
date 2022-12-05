<?php
// Intro Image ([header_image])
class Naxos_Shortcode_Header_Image {
    
    public static function headerImage( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'img' => '',
			'style' => 'right',
		), $atts ) );
        
        $image = '';
        
        if ( ! empty( $img ) ) {
             $image = wp_get_attachment_url( $img );
        }
		
		$cls = '';
		$effect = '';
		
		switch( $style ) {
			case 'right':
				$cls = 'banner-image'; 
				$effect = 'class="bounce-effect"'; 
				break;
			case 'center':
				$cls = 'banner-image-center'; 
				break;
			case 'full-width':
				$cls = 'banner-image-center w-100'; 
				break;
		}
		
		return  '<div class="' . $cls . ' wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0.3s">
					<img ' . $effect . ' src="' . $image . '" alt="" />
				 </div>';
	}
	
	public static function vc_headerImage() {
		vc_map( array(
		   	"name" => esc_html__( "Header Image", "naxos-addons" ),
		   	"base" => "header_image",
		   	"icon" => 'ti-image',
            "description" => esc_html__( "Intro image", "naxos-addons" ),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
                array(
					"type"        => "attach_image",
					"heading"     => esc_html__( "Image", "naxos-addons" ),
					"param_name"  => "img",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
				 	"type" => "dropdown",
				 	"holder" => "div",
				 	"class" => "",
				 	"heading" => esc_html__( "Style", "naxos-addons" ),
				 	"param_name" => "style",
				 	"value" => array(   
						esc_html__( "Right", "naxos-addons" ) 		=> "right",
						esc_html__( "Center", "naxos-addons" ) 		=> "center",
						esc_html__( "Full Width", "naxos-addons" ) 	=> "full-width"
					),
					"std" => "1/3",
				 	"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'header_image', 	array( 'Naxos_Shortcode_Header_Image', 'headerImage' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Header_Image', 'vc_headerImage' ) );

