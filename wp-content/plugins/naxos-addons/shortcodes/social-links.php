<?php
// Social Links ([social])
class Naxos_Shortcode_Social_Links {
	
	public static function socialLinks( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'twitter'		=> '',
			'facebook'		=> '',
			'linkedin'		=> '',
			'instagram'		=> '',
			'dribbble'		=> ''
		), $atts ) );
		
		$output = '<div class="author-social mt-4"><div class="social">';
		
		// Twitter
		$twitter = vc_build_link( $twitter );
		
		if ( strlen( $twitter['url'] ) > 0 ) {
			$target = strlen( $twitter['target'] ) > 0 ? 'target="' . $twitter['target'] . '"' : '';
			$output .= '<a href="' . esc_url( $twitter['url'] ) . '" title="' . esc_html__( "Twitter", "naxos_addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-twitter"></i></a>';
		}
		
		// Facebook
		$facebook = vc_build_link( $facebook );
		
		if ( strlen( $facebook['url'] ) > 0 ) {
			$target = strlen( $facebook['target'] ) > 0 ? 'target="' . $facebook['target'] . '"' : '';
			$output .= '<a href="' . esc_url( $facebook['url'] ) . '" title="' . esc_html__( "Facebook", "naxos_addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-facebook-f"></i></a>';
		}
		
		// LinkedIn
		$linkedin = vc_build_link( $linkedin );
		
		if ( strlen( $linkedin['url'] ) > 0 ) {
			$target = strlen( $linkedin['target'] ) > 0 ? 'target="' . $linkedin['target'] . '"' : '';
			$output .= '<a href="' . esc_url( $linkedin['url'] ) . '" title="' . esc_html__( "LinkedIn", "naxos_addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-linkedin-in"></i></a>';
		}
		
		// Instagram
		$instagram = vc_build_link( $instagram );
		
		if ( strlen( $instagram['url'] ) > 0 ) {
			$target = strlen( $instagram['target'] ) > 0 ? 'target="' . $instagram['target'] . '"' : '';
			$output .= '<a href="' . esc_url( $instagram['url'] ) . '" title="' . esc_html__( "Instagram", "naxos_addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-instagram"></i></a>';
		}
		
		// Dribbble
		$dribbble = vc_build_link( $dribbble );
		
		if ( strlen( $dribbble['url'] ) > 0 ) {
			$target = strlen( $dribbble['target'] ) > 0 ? 'target="' . $dribbble['target'] . '"' : '';
			$output .= '<a href="' . esc_url( $dribbble['url'] ) . '" title="' . esc_html__( "Dribbble", "naxos_addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-dribbble"></i></a>';
		}
		
		$output .= '</div></div>';
		
		return $output;
	}
	
	public static function vc_socialLinks() {
		vc_map( array(
		   	"name" => esc_html__( "Social Links", "naxos-addons" ),
		   	"base" => "social_links",
		   	"icon" => 'ti-arrow-circle-right',
			"description" => esc_html__( "Team member social info", "naxos-addons" ),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
				array(
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Twitter URL", "naxos-addons" ),
					'param_name'  => 'twitter',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Facebook URL", "naxos-addons" ),
					'param_name'  => 'facebook',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "LinkedIn URL", "naxos-addons" ),
					'param_name'  => 'linkedin',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Instagram URL", "naxos-addons" ),
					'param_name'  => 'instagram',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Dribbble URL", "naxos-addons" ),
					'param_name'  => 'dribbble',
					'description' => "",
					"admin_label" => true,
			  	),				
			)
		));
	}
    
}

add_shortcode( 'social_links', 		array( 'Naxos_Shortcode_Social_Links', 'socialLinks' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Social_Links', 'vc_socialLinks' ) );

