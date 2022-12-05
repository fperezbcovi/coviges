<?php
// Service ([service])
class Naxos_Shortcode_Service {
	
	public static function service( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'	=> '',
			'icon'	=> '',
			'delay' => '0',
			'style' => ''
		), $atts ) );
		
		if ( ! is_numeric( $delay ) ) {
			$delay = 0;
		}
		
		return '<div class="service-single ' . $style . ' res-margin wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="' . $delay . 's">
					<div class="' . esc_attr( $icon ) . '"></div>
					<h5>' . esc_html( $title ) . '</h5>
					<p>' . do_shortcode( $content ) . '</p>
				</div>';		
	}
	
	public static function vc_service() {
		vc_map( array(
		   	"name" => esc_html__( "Service", "naxos-addons" ),
		   	"base" => "service",
		   	"icon" => 'ti-layout-grid3',
			"description" => esc_html__( "Service grid", "naxos-addons" ),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Title", "naxos-addons" ),
					"param_name"  => "title",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textarea_html",
					"heading"     => esc_html__( "Text", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type" 			=> "iconpicker",
					"heading" 		=> esc_html__( "Icon", "naxos-addons" ),
					"param_name" 	=> "icon",
					"value" 		=> "",
					"settings" 		=> array(
					  	"emptyIcon" 	=> true,
                        'type' 			=> 'linea',
					  	"iconsPerPage" 	=> 4000,
					),
					"dependency" 	=> array(
					  	"element" 	=> "type",
					  	"value" 	=> "linea",
					),
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Animation Delay", "naxos-addons" ),
					"param_name"  => "delay",
					"value"       => "0",
					"description" => "Type numeric values like 0.3 seconds",
					"admin_label" => true,
			  	),
				array(
				 	"type" => "dropdown",
				 	"holder" => "div",
				 	"class" => "",
				 	"heading" => esc_html__( "Style", "naxos-addons" ),
				 	"param_name" => "style",
				 	"value" => array(   
						esc_html__( "Style 1", "naxos-addons" ) => "",
						esc_html__( "Style 2", "naxos-addons" ) => "service-style-2"
					),
					"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'service', 			array( 'Naxos_Shortcode_Service', 'service' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Service', 'vc_service' ) );