<?php
// Features ([features])
class Naxos_Shortcode_Features {
    
    public static function features( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'mt' => '0px',
			'mb' => '0px',
		), $atts ) );
		
		$mt = intval( $mt );
		$mb = intval( $mb );

		$style = ( $mt > 0 || $mb > 0 ) ? 'style="margin-top: ' . $mt . 'px; margin-bottom: ' . $mb . 'px;"' : '';	
		
		return '<ul class="features-item" ' . $style . '>' . do_shortcode( $content ) . '</ul>';
	}
	
	public static function vc_features() {
		vc_map( array(
		   	"name" => esc_html__( "Features", "naxos-addons" ),
		   	"base" => "features",
		   	"icon" => 'ti-reload',
            "description" => esc_html__( "Awesome features", "naxos-addons" ),
			"as_parent" => array(
            	"only" => "feature"
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

	// Feature ([feature])
	public static function feature( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'         => '',
			'icon'          => '',
			'align'			=> ''
		), $atts ) );
		
		return '<li> 
					<div class="feature-box ' . $align . ' media"> 
						<div class="box-icon"><div class="' . esc_html( $icon ) . '"></div></div>
						<div class="box-text media-body align-self-center align-self-md-start"><h4>' . esc_html( $title ) . '</h4><p>' . do_shortcode( $content ) . '</p></div>
					</div>
				</li>';
	}
	
	public static function vc_feature() {
		vc_map( array(
		   	"name" => esc_html__( "Feature", "naxos-addons" ),
		   	"base" => "feature",
		   	"icon" => 'ti-reload',
			"as_child" => array(
            	"only" => "features"
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
					"type"        => "textarea_html",
					"heading"     => esc_html__( "Text", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type" => "iconpicker",
					"heading" => esc_html__( "Icon", "naxos-addons" ),
					"param_name" => "icon",
					"value" => "",
					"settings" => array(
					  	"emptyIcon" => true,
                        'type' => 'linea',
					  	"iconsPerPage" => 4000,
					),
					"dependency" => array(
					  	"element" => "type",
					  	"value" => "linea",
					),
				),
				array(
				 	"type" => "dropdown",
				 	"holder" => "div",
					"class" => "",
				 	"heading" => esc_html__( "Align", "naxos-addons" ),
				 	"param_name" => "align",
				 	"value" => array(
						esc_html__( "Left", "naxos-addons" ) 	=> "",
						esc_html__( "Right", "naxos-addons" ) 	=> "box-left"
					),
					"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'features', 			array( 'Naxos_Shortcode_Features', 'features' ) );
add_shortcode( 'feature', 			array( 'Naxos_Shortcode_Features', 'feature' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Features', 'vc_features' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Features', 'vc_feature' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    // Features extend
	if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_features extends WPBakeryShortCodesContainer {};
	}
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_feature extends WPBakeryShortCode {};
	}
    
});