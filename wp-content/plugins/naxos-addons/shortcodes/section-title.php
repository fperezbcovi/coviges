<?php
// Section title ([section_title])
class Naxos_Shortcode_Section_Title {
    
    public static function sectionTitle( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'  	=> '',
			'color'  	=> '',
			'align'  	=> '',
			'fullwidth' => 'true'
		), $atts ) );
		
		$output = '';
		
		if ( $fullwidth == 'true' ) {
			$output .= '<div class="row justify-content-center"><div class="col-12 col-md-10 col-lg-6">';
		}
		
		$output .= '<div class="section-title text-center ' . $align . ' ' . $color . '"><h3>' . wp_kses( $title, 'strong' ) . '</h3>' . (strlen( $content ) > 0 ? '<p>' . do_shortcode( $content ) . '</p>' : '') . '</div>';
		
		if ( $fullwidth == 'true' ) {
			$output .= '</div></div>';
		}
		
		return $output;
	}
	
	public static function vc_sectionTitle() {
		vc_map( array(
		   	"name" => esc_html__( "Section Title", "naxos-addons" ),
		   	"base" => "section_title",
		   	"icon" => 'ti-uppercase',
            "description" => esc_html__( "Styled heading", "naxos-addons" ),
		   	"category" => esc_html__("Naxos", "naxos-addons"),
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
					"heading"     => esc_html__( "Slogan", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
				 	"type" => "dropdown",
				 	"holder" => "div",
					"class" => "",
				 	"heading" => esc_html__( "Color", "naxos-addons" ),
				 	"param_name" => "color",
				 	"value" => array(   
						esc_html__( "Dark", "naxos-addons" ) => '',
						esc_html__( "White", "naxos-addons" ) => 'white'
					),
					"description" => "",
					"admin_label" => true,
			  	),
				array(
				 	"type" => "dropdown",
				 	"holder" => "div",
					"class" => "",
				 	"heading" => esc_html__( "Align", "naxos-addons" ),
				 	"param_name" => "align",
				 	"value" => array(
						esc_html__( "Center", "naxos-addons" ) 	=> "",
						esc_html__( "Left", "naxos-addons" ) 	=> "text-lg-left",
						esc_html__( "Right", "naxos-addons" ) 	=> "text-lg-right"
					),
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Full Width", "naxos-addons" ),
					"param_name"  => "fullwidth",
					"value"       => "",
					"std" 		  => "true",
					"description" => "",
					"admin_label" => true,
			  	)
			)
		));
	}
    
}

add_shortcode( 'section_title', array( 'Naxos_Shortcode_Section_Title', 'sectionTitle' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Section_Title', 'vc_sectionTitle' ) );

