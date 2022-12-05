<?php
// Header title (header_title])
class Naxos_Shortcode_Header_Title {
    
    public static function headerTitle( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'  => '',
			'class'  => ''
		), $atts ) );
		
		return '<div class="banner-text' . ( ! empty( $class ) ? ' ' . esc_attr( $class ) : '' ) . '">
					<h1 class="wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0s">' . wp_kses( $title, 'br, em, strong' ) . '</h1>' . 
					(strlen( $content ) > 0 ? '<p class="wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0.3s">' . do_shortcode( $content ) . '</p>' : '') .
			   '</div>';
	}
	
	public static function vc_headerTitle() {
		vc_map( array(
		   	"name" => esc_html__("Header Title", "naxos-addons"),
		   	"base" => "header_title",
		   	"icon" => 'ti-text',
            "description" => esc_html__( "Intro heading text", "naxos-addons" ),
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

add_shortcode( 'header_title', 		array( 'Naxos_Shortcode_Header_Title', 'headerTitle' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Header_Title', 'vc_headerTitle' ) );
