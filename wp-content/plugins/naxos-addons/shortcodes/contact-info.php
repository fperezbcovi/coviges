<?php
// Contact Info ([contact_info])
class Naxos_Shortcode_Contact_Info {
    
    public static function contactInfo( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'mt' => '0px',
			'mb' => '0px',
		), $atts ) );
		
		$mt = intval( $mt );
		$mb = intval( $mb );

		$style = ( $mt > 0 || $mb > 0 ) ? 'style="margin-top: ' . $mt . 'px; margin-bottom: ' . $mb . 'px;"' : '';	
		
		return '<div class="contact-info res-margin" ' . $style . '>' . do_shortcode( $content ) . '</div>';
	}
	
	public static function vc_contactInfo() {
		vc_map( array(
		   	"name" => esc_html__( "Contact Info", "naxos-addons" ),
		   	"base" => "contact_info",
		   	"icon" => 'ti-pencil-alt',
            "description" => esc_html__( "Contact texts", "naxos-addons" ),
			"as_parent" => array(
            	"only" => "contact_text"
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

	// Contact Text ([contact_text])
	public static function contactText( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'	=> '',
			'icon' 	=> ''			
		), $atts ) );
		
		return '<h5><span class="' . esc_attr( $icon ) . '"></span> ' . esc_html( $title ) . '</h5>
                <p>' . do_shortcode( $content ) . '</p>';	
	}
	
	public static function vc_contactText() {
		vc_map( array(
		   	"name" => esc_html__( "Contact Text", "naxos-addons" ),
		   	"base" => "contact_text",
		   	"icon" => 'ti-pencil-alt',
			"as_child" => array(
            	"only" => "contact_info"
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
					"type"        => "textarea_html",
					"heading"     => esc_html__( "Content", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	)
			)
		));
	}
    
}

add_shortcode( 'contact_info', 	array( 'Naxos_Shortcode_Contact_Info', 'contactInfo' ) );
add_shortcode( 'contact_text', 	array( 'Naxos_Shortcode_Contact_Info', 'contactText' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Contact_Info', 'vc_contactInfo' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Contact_Info', 'vc_contactText' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    // Contact info extend
	if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_contact_info extends WPBakeryShortCodesContainer {};
	}
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_contact_text extends WPBakeryShortCode {};
	}
    
});
