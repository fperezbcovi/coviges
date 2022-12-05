<?php
// Milestone counter ([counter])
class Naxos_Shortcode_Counter {
	
	public static function counter( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'	=> '',
			'icon'	=> '',
			'count'	=> '',
			'delay' => '0'
		), $atts ) );
		
		if ( ! is_numeric( $delay ) ) {
			$delay = 0;
		}
		
		return '<div class="counter wow fadeInUp" data-wow-delay="' . $delay . 's">
					<div class="' . esc_attr( $icon ) . '"></div>
					<div class="counter-content res-margin">
						<h5><span class="number-count">' . intval( $count ) . '</span></h5>
						<p>' . esc_html( $title ) . '</p>
					</div>
				</div>';
	}
	
	public static function vc_counter() {
		vc_map( array(
		   	"name" => esc_html__( "Counter", "naxos-addons" ),
		   	"base" => "counter",
		   	"icon" => 'ti-dashboard',
			"description" => esc_html__( "Milestone number", "naxos-addons" ),
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
					"type" 		  => "iconpicker",
					"heading" 	  => esc_html__( "Icon", "naxos-addons" ),
					"param_name"  => "icon",
					"value" 	  => "",
					"settings" 	  => array(
					  	"emptyIcon" 	=> true,
                        'type' 			=> 'linea',
					  	"iconsPerPage" 	=> 4000,
					),
					"dependency"  => array(
					  	"element" => "type",
					  	"value"   => "linea",
					),
				),				
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Count", "naxos-addons" ),
					"param_name"  => "count",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Animation Delay", "naxos-addons" ),
					"param_name"  => "delay",
					"value"       => "0",
					"description" => "Type numeric values like 0.3 seconds",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'counter', 			array( 'Naxos_Shortcode_Counter', 'counter' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Counter', 'vc_counter' ) );