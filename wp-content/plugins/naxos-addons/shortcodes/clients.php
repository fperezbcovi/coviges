<?php
// Clients ([clients])
class Naxos_Shortcode_Clients {
	
	public static function clients( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'dots' => 'false'
		), $atts ) );
		
		$dots = $dots == 'true' ? 'data-dots="true"' : '';
		
		return '<div class="row">
					<div class="clients-slider owl-carousel owl-theme"' . ' ' . $dots . '>' . do_shortcode( $content ) . '</div>
				</div>';
	}
	
	public static function vc_clients() {
		vc_map( array(
		   	"name" => esc_html__( "Clients", "naxos-addons" ),
		   	"base" => "clients",
		   	"icon" => 'ti-id-badge',
            "description" => esc_html__( "Client logos", "naxos-addons" ),
			"as_parent" => array(
            	"only" => "client"
   			),
			"js_view" => "VcColumnView",
			"category" => esc_html__( "Naxos", "naxos-addons" ),
			"params" => array(
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Show Navigation Dots", "naxos-addons" ),
					"param_name"  => "dots",
					"value"       => "",
					"std" 		  => "false",
					"description" => "",
					"admin_label" => true,
			  	)
			)
		));
	}

	// Client ([client])
	public static function client( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'image'         => '',
			'website'		=> ''
		), $atts ) );
		
		// Image
		$img = '';
        
        if ( ! empty( $image ) ) {
             $img = wp_get_attachment_url( $image );
        }
		
		// Website
		$website = vc_build_link( $website );
		
		return '<div class="client">'. ( strlen( $website['url'] ) > 0 ? '<a href="' . esc_url( $website['url'] ) . '" ' . ( strlen( $website['target'] ) > 0 ? 'target="' . $website['target'] . '"' : '' ) . '>' : '' ) . '<img src="' . $img . '" alt="' . do_shortcode( $content ) . '">'. ( strlen( $website['url'] ) > 0 ? '</a>' : '' ) . '</div>';
	}
	
	public static function vc_client() {
		vc_map( array(
		   	"name" => esc_html__( "Client", "naxos-addons" ),
		   	"base" => "client",
		   	"icon" => 'ti-id-badge',
			"as_child" => array(
            	"only" => "clients"
   			),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
				array(
					"type"        => "attach_image",
					"heading"     => esc_html__( "Image", "naxos-addons" ),
					"param_name"  => "image",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Name", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Website URL", "naxos-addons" ),
					'param_name'  => 'website',
					'description' => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'clients', 			array( 'Naxos_Shortcode_Clients', 'clients' ) );
add_shortcode( 'client', 			array( 'Naxos_Shortcode_Clients', 'client' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Clients', 'vc_clients' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Clients', 'vc_client' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    // Features extend
	if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_clients extends WPBakeryShortCodesContainer {};
	}
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_client extends WPBakeryShortCode {};
	}
    
});

