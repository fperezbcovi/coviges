<?php
// Video ([video])
class Naxos_Shortcode_Video {
    
    public static function video( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'icon'    => '',
			'url'     => '',
			'target'  => ''
		), $atts ) );
		
		$url = vc_build_link( $url );
		$target = strlen( $url['target'] ) > 0 ? $url['target'] : '';
		$url = strlen( $url['url'] ) > 0 ? $url['url'] : '';
		
		return '<div class="row">
					<div class="video-btn wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0s"><p><a href="' . esc_url( $url ) . '" data-rel="lightcase" class="play-btn"><i class="' . esc_attr( $icon ) . '"></i></a></p><p class="video-text">' . do_shortcode( $content ) . '</p></div>
				</div>';
	}
	
	public static function vc_video() {
		vc_map( array(
		   	"name" => esc_html__("Video Control", "naxos-addons"),
		   	"base" => "video",
		   	"icon" => 'ti-control-play',
            "description" => esc_html__( "Parallax video button", "naxos-addons" ),
		   	"category" => esc_html__("Naxos", "naxos-addons"),
		   	"params" => array(
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Watch Text", "naxos-addons" ),
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
					'heading' 	  => esc_html__( 'Video URL', 'naxos-addons' ),
					'param_name'  => 'url',
					'description' => "Example: https://www.youtube.com/watch?v=Q6dsRpVyyWs",
					"admin_label" => true,
			  	),
				
			)
		));
	}
    
}

add_shortcode( 'video', 			array( 'Naxos_Shortcode_Video', 'video' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Video', 'vc_video' ) );

