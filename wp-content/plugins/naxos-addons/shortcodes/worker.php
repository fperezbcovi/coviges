<?php
// Worker ([worker])
class Naxos_Shortcode_Worker {
	
	public static function worker( $atts, $content = null ) {
		extract( shortcode_atts( array(
			// General
			'image'         => '',
			'activity'		=> '',
			'url'     		=> '',
			
			// Social Links
			'twitter'		=> '',
			'facebook'		=> '',
			'linkedin'		=> '',
			'instagram'		=> '',
			'dribbble'		=> ''
		), $atts ) );
		
		// Image
		$img = '';
        
        if ( ! empty( $image ) ) {
             $img = wp_get_attachment_url( $image );
        }
		
		// Url
		$website = '';
		$website_end = '';
		$url = vc_build_link( $url );
		
		if ( strlen( $url['url'] ) > 0 ) {
			$target = strlen( $url['target'] ) > 0 ? 'target="' . $url['target'] . '"' : '';
			$website = '<a href="' . $url['url'] . '" ' . $target . '>';
			$website_end = '</a>';
		}
		
		/***************** 
		    - Social -
		*****************/
		$social = '';
		
		// Twitter
		$twitter = vc_build_link( $twitter );
		
		if ( strlen( $twitter['url'] ) > 0 ) {
			$target = strlen( $twitter['target'] ) > 0 ? 'target="' . $twitter['target'] . '"' : '';
			$social .= '<a href="' . esc_url( $twitter['url'] ) . '" title="' . esc_html__( "Twitter", "naxos-addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-twitter"></i></a>';
		}
		
		// Facebook
		$facebook = vc_build_link( $facebook );
		
		if ( strlen( $facebook['url'] ) > 0 ) {
			$target = strlen( $facebook['target'] ) > 0 ? 'target="' . $facebook['target'] . '"' : '';
			$social .= '<a href="' . esc_url( $facebook['url'] ) . '" title="' . esc_html__( "Facebook", "naxos-addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-facebook-f"></i></a>';
		}
		
		// LinkedIn
		$linkedin = vc_build_link( $linkedin );
		
		if ( strlen( $linkedin['url'] ) > 0 ) {
			$target = strlen( $linkedin['target'] ) > 0 ? 'target="' . $linkedin['target'] . '"' : '';
			$social .= '<a href="' . esc_url( $linkedin['url'] ) . '" title="' . esc_html__( "LinkedIn", "naxos-addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-linkedin-in"></i></a>';
		}
		
		// Instagram
		$instagram = vc_build_link( $instagram );
		
		if ( strlen( $instagram['url'] ) > 0 ) {
			$target = strlen( $instagram['target'] ) > 0 ? 'target="' . $instagram['target'] . '"' : '';
			$social .= '<a href="' . esc_url( $instagram['url'] ) . '" title="' . esc_html__( "Instagram", "naxos-addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-instagram"></i></a>';
		}
		
		// Dribbble
		$dribbble = vc_build_link( $dribbble );
		
		if ( strlen( $dribbble['url'] ) > 0 ) {
			$target = strlen( $dribbble['target'] ) > 0 ? 'target="' . $dribbble['target'] . '"' : '';
			$social .= '<a href="' . esc_url( $dribbble['url'] ) . '" title="' . esc_html__( "Dribbble", "naxos-addons" ) . '" ' . esc_attr( $target ) . '><i class="fab fa-dribbble"></i></a>';
		}
		
		// Result
		$output = '<div class="team-member res-margin">
						<div class="team-image">
							<p class="mb-0"><img src="' . esc_url( $img ) . '" alt="' . do_shortcode( $content ) . '" /></p>
							' . ( ! empty( $social ) ? '<div class="team-social"><div class="team-social-inner">' . $social . '</div></div>' : '' ) . '
						</div>
						<div class="team-details">
							<h5 class="title">' . $website . do_shortcode( $content ) . $website_end . '</a></h5><p><span class="position">' . $activity . '</span></p>
						</div>
					</div>';
		
		return $output;
	}
	
	public static function vc_worker() {
		vc_map( array(
		   	"name" => esc_html__( "Worker", "naxos-addons" ),
		   	"base" => "worker",
		   	"icon" => 'ti-user',
			"description" => esc_html__( "Team member", "naxos-addons" ),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
				
				// General
				array(
					"group" 	  => "General",
					"type"        => "attach_image",
					"heading"     => esc_html__( "Image", "naxos-addons" ),
					"param_name"  => "image",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"group" 	  => "General",
					"type"        => "textfield",
					"heading"     => esc_html__( "Name", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"group" 	  => "General",
					"type"        => "textfield",
					"heading"     => esc_html__( "Activity", "naxos-addons" ),
					"param_name"  => "activity",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"group" 	  => "General",
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Details Page URL", "naxos-addons" ),
					'param_name'  => 'url',
					'description' => "",
					"admin_label" => true,
			  	),
				
				// Social Links
				array(
					"group" 	  => "Social Links",
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Twitter URL", "naxos-addons" ),
					'param_name'  => 'twitter',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					"group" 	  => "Social Links",
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Facebook URL", "naxos-addons" ),
					'param_name'  => 'facebook',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					"group" 	  => "Social Links",
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "LinkedIn URL", "naxos-addons" ),
					'param_name'  => 'linkedin',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					"group" 	  => "Social Links",
					'type' 		  => 'vc_link',
					'heading' 	  => esc_html__( "Instagram URL", "naxos-addons" ),
					'param_name'  => 'instagram',
					'description' => "",
					"admin_label" => true,
			  	),
				array(
					"group" 	  => "Social Links",
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

add_shortcode( 'worker', 			array( 'Naxos_Shortcode_Worker', 'worker' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Worker', 'vc_worker' ) );

