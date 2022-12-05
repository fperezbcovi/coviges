<?php
// Buttons ([buttons])
class Naxos_Shortcode_Buttons {
	
	public static function buttons( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'class'  => ''
		), $atts ) );
		
		return '<div class="button-store' . ( ! empty( $class ) ? ' ' . esc_attr( $class ) : '' ) . ' wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0.6s">' . do_shortcode( $content ) . '</div>';
	}
	
	public static function vc_buttons() {
		vc_map( array(
		   	"name" => esc_html__( "Buttons", "naxos-addons" ),
		   	"base" => "buttons",
		   	"icon" => 'ti-widget-alt',
            "description" => esc_html__( "Buttons holder", "naxos-addons" ),
			"as_parent" => array(
            	"except" => "buttons"
   			),
			"show_settings_on_create" => false,
			"js_view" => "VcColumnView",
			"category" => esc_html__( "Naxos", "naxos-addons" ),
			"params" => array(
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "CSS Class", "naxos-addons" ),
					"param_name"  => "class",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'buttons', 			array( 'Naxos_Shortcode_Buttons', 'buttons' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Buttons', 'vc_buttons' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_buttons extends WPBakeryShortCodesContainer {};
	}
    
});

