<?php
// Skills ([skills])
class Naxos_Shortcode_Skills {
    
    public static function skills( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'mt' => '0px',
			'mb' => '0px',
		), $atts ) );
		
		$mt = intval( $mt );
		$mb = intval( $mb );

		$style = ( $mt > 0 || $mb > 0 ) ? 'style="margin-top: ' . $mt . 'px; margin-bottom: ' . $mb . 'px;"' : '';	
		
		return '<div class="skills" ' . $style . '>' . do_shortcode( $content ) . '</div>';
	}
	
	public static function vc_skills() {
		vc_map( array(
		   	"name" => esc_html__( "Skills", "naxos-addons" ),
		   	"base" => "skills",
		   	"icon" => 'ti-align-left',
            "description" => esc_html__( "Progress bars", "naxos-addons" ),
			"as_parent" => array(
            	"only" => "bar"
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
	
	// Progress bar ([bar])
	public static function bar( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'  => '',
			'value'  => 80
		), $atts ) );

		return '<div class="bar"><div class="progress-heading"><p class="progress-title">' . esc_html( $title ) . '</p><div class="progress-value"></div></div><div class="progress"><div class="progress-bar" data-value="' . intval( $value ) . '"></div></div></div>';
	}
	
	public static function vc_bar() {
		vc_map( array(
		   	"name" => esc_html__( "Progress Bar", "naxos-addons" ),
		   	"base" => "bar",
		   	"icon" => 'ti-align-left',
            "description" => esc_html__( "Animated progress bar", "naxos-addons" ),
			"as_child" => array(
            	"only" => "skills"
   			),
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
					"type"        => "textfield",
					"heading"     => esc_html__( "Value", "naxos-addons" ),
					"param_name"  => "value",
					"value"       => "80",
					"description" => "Number between 0 and 100",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'skills', 		array( 'Naxos_Shortcode_Skills', 'skills' ) );
add_shortcode( 'bar', 			array( 'Naxos_Shortcode_Skills', 'bar' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Skills', 'vc_skills' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Skills', 'vc_bar' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    // Skills extend
	if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_skills extends WPBakeryShortCodesContainer {};
	}
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_bar extends WPBakeryShortCode {};
	}
    
});
