<?php
// Download button ([download])
class Naxos_Shortcode_Download {
    
    public static function download( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'img' 		=> '',
			'icon'    	=> '',
			'url'     	=> '',
			'target'  	=> '',
			'margin' 	=> 'true',
			'autowidth' => 'false'
		), $atts ) );
		
		//  Image
		$image = '';
        
        if ( ! empty( $img ) ) {
             $image = wp_get_attachment_url( $img );
        }
		
		// Url
		$url = vc_build_link( $url );
		$target = strlen( $url['target'] ) > 0 ? 'target="' . $url['target'] . '"' : '';
		$url = strlen( $url['url'] ) > 0 ? $url['url'] : '';
		
		// Margin
		$margin = $margin == 'true' ? 'mr-sm-3' : '';
		$auto_width = $autowidth == 'true' ? 'auto-width' : '';
		
		// Text
		$txt = '<i class="' . esc_attr( $icon ) . '"></i><p>' . wp_kses( $content, 'em' ) . '</p>';
		$custom_btn = 'custom-btn';
		
		if ( $image != '' ) {
			$txt = '<img src="' . $image . '" alt="" />';
			$custom_btn = '';
		}
		
		return '<a class="' . $custom_btn . ' ' . $auto_width . ' d-inline-flex align-items-center m-2 m-sm-0 ' . $margin . '" href="' . esc_url( $url ) . '" ' . $target . '>' . $txt . '</a>';
	}
	
	public static function vc_download() {
		vc_map( array(
		   	"name" => esc_html__("Download Button", "naxos-addons"),
		   	"base" => "download",
		   	"icon" => 'ti-download',
            "description" => esc_html__( "App download button", "naxos-addons" ),
		   	"category" => esc_html__("Naxos", "naxos-addons"),
		   	"params" => array(
				 array(
					"type"        => "attach_image",
					"heading"     => esc_html__( "Image", "naxos-addons" ),
					"param_name"  => "img",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Button Text", "naxos-addons" ),
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
                        'type' => 'fontawesome',
					  	"iconsPerPage" => 4000,
					),
					"dependency" => array(
					  	"element" => "type",
					  	"value" => "fontawesome",
					),
				),
				array(
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( 'Download URL', 'naxos' ),
					'param_name'  => 'url',
					'description' => '',
					"admin_label" => true,
			  	),
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Margin", "naxos-addons" ),
					"param_name"  => "margin",
					"value"       => "",
					"std" 		  => "true",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Auto Width", "naxos-addons" ),
					"param_name"  => "autowidth",
					"value"       => "",
					"std" 		  => "false",
					"description" => "",
					"admin_label" => true,
			  	)
			)
		));
	}
    
}

add_shortcode( 'download', 			array( 'Naxos_Shortcode_Download', 'download' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Download', 'vc_download' ) );

