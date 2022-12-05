<?php
// Overviews ([overviews])
class Naxos_Shortcode_Overviews {
    
    public static function overviews( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'mt' => '0px',
			'mb' => '0px',
		), $atts ) );
		
		$mt = intval( $mt );
		$mb = intval( $mb );

		$style = ( $mt > 0 || $mb > 0 ) ? 'style="margin-top: ' . $mt . 'px; margin-bottom: ' . $mb . 'px;"' : '';	
		
		return '<div class="overview-item" ' . $style . '>' . do_shortcode( $content ) . '</div>';
	}
	
	public static function vc_overviews() {
		vc_map( array(
		   	"name" => esc_html__( "Overviews", "naxos-addons" ),
		   	"base" => "overviews",
		   	"icon" => 'ti-view-list',
            "description" => esc_html__( "Overview items", "naxos-addons" ),
			"as_parent" => array(
            	"only" => "overview"
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

	// Overview ([overview])
	public static function overview( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'         => '',
			'icon'          => ''
		), $atts ) );
		
		return '<div class="overview-box d-flex flex-wrap">
					<div class="' . esc_attr( $icon ) . '"></div>
					<div class="content">
						<h6 class="font-weight-bold mb-2 mt-0">' . esc_html( $title ) . '</h6>
						<p>' . do_shortcode( $content ) . '</p>
					</div>
				</div>';		
	}
	
	public static function vc_overview() {
		vc_map( array(
		   	"name" => esc_html__( "Overview", "naxos-addons" ),
		   	"base" => "overview",
		   	"icon" => 'ti-view-list',
			"as_child" => array(
            	"only" => "overviews"
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
			)
		));
	}
    
}

add_shortcode( 'overviews', 		array( 'Naxos_Shortcode_Overviews', 'overviews' ) );
add_shortcode( 'overview', 			array( 'Naxos_Shortcode_Overviews', 'overview' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Overviews', 'vc_overviews' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Overviews', 'vc_overview' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    // Overviews extend
	if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_overviews extends WPBakeryShortCodesContainer {};
	}
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_overview extends WPBakeryShortCode {};
	}
    
});