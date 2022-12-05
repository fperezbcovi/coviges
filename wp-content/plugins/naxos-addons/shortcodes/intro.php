<?php
// Intro ([intro])
class Naxos_Shortcode_Intro {
	
	public static function intro( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'mt' => '0px',
			'mb' => '0px',
		), $atts ) );
		
		$mt = intval( $mt );
		$mb = intval( $mb );

		$style = ( $mt > 0 || $mb > 0 ) ? 'style="margin-top: ' . $mt . 'px; margin-bottom: ' . $mb . 'px;"' : '';	
		
		return '<div ' . $style . '>' . do_shortcode( $content ) . '</div>';
	}
	
	public static function vc_intro() {
		vc_map( array(
		   	"name" => esc_html__( "Intro", "naxos-addons" ),
		   	"base" => "intro",
		   	"icon" => 'ti-layers',
            "description" => esc_html__( "Intro banner", "naxos-addons" ),
			"as_parent" => array(
            	"except" => "intro"
   			),
			"show_settings_on_create" => false,
			"js_view" => "VcColumnView",
			"category" => esc_html__( "Naxos", "naxos-addons" ),
			"params" => array(
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Margin Top", "naxos-addons" ),
					"param_name"  => "mt",
					"value"       => "0px",
					"description" => "",
					"admin_label" => true,
			  	),
			  	array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Margin Bottom", "naxos-addons" ),
					"param_name"  => "mb",
					"value"       => "0px",
					"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'intro', 			array( 'Naxos_Shortcode_Intro', 'intro' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Intro', 'vc_intro' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_intro extends WPBakeryShortCodesContainer {};
	}
    
});

