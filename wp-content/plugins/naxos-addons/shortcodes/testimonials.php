<?php
// Testimonial ([testimonials])
class Naxos_Shortcode_Testimonials {
	
	public static function testimonials( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'mt' => '0px',
			'mb' => '0px',
		), $atts ) );
		
		$mt = intval( $mt );
		$mb = intval( $mb );

		$style = ( $mt > 0 || $mb > 0 ) ? 'style="margin-top: ' . $mt . 'px; margin-bottom: ' . $mb . 'px;"' : '';	
		
		$block_text = '<div class="block-text row">
							<div class="carousel-text testimonial-slider col-12 col-lg-8 offset-lg-2"></div>
					   </div>';

		$block_media = '<div class="block-media row">
							<div class="carousel-images testimonial-nav col-12 col-lg-8 offset-lg-2"></div>
						</div>';
		
		return '<div class="row" ' . $style . '>
					<div class="col-12 testimonial-carousel">' . $block_text . $block_media . do_shortcode( $content ) . '</div>
				</div>';
	}
	
	public static function vc_testimonials() {
		vc_map( array(
		   	"name" => esc_html__( "Testimonials", "naxos-addons" ),
		   	"base" => "testimonials",
		   	"icon" => 'ti-heart',
            "description" => esc_html__( "Client reviews", "naxos-addons" ),
			"as_parent" => array(
            	"only" => "review"
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

	// Review ([review])
	public static function review( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'image'         => '',
			'reviewer'		=> '',
			'company'		=> ''
		), $atts ) );
		
		$img = '';
        
        if ( ! empty( $image ) ) {
             $img = wp_get_attachment_url( $image );
        }
		
		$text = '<div class="single-block-text">
					<div class="single-box"><p><i class="fas fa-quote-left"></i> ' . do_shortcode( $content ) . ' <i class="fas fa-quote-right"></i></p></div>
				 </div>';
				
		$media = '<div class="single-block-media">
					<p><img src="' . $img . '" alt="' . esc_html( $reviewer ) . '" class="img-fluid rounded-circle"></p>
					<div class="client-info">
						<h3>' . esc_html( $reviewer ) . '</h3><span>' . esc_html( $company ) . '</span>
					</div>
				  </div>';
		
		return $text . $media;
	}
	
	public static function vc_review() {
		vc_map( array(
		   	"name" => esc_html__( "Review", "naxos-addons" ),
		   	"base" => "review",
		   	"icon" => 'ti-heart',
			"as_child" => array(
            	"only" => "testimonials"
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
					"heading"     => esc_html__( "Client", "naxos-addons" ),
					"param_name"  => "reviewer",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Company", "naxos-addons" ),
					"param_name"  => "company",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textarea_html",
					"heading"     => esc_html__( "Content", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),				
			)
		));
	}
    
}

add_shortcode( 'testimonials', 		array( 'Naxos_Shortcode_Testimonials', 'testimonials' ) );
add_shortcode( 'review', 			array( 'Naxos_Shortcode_Testimonials', 'review' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Testimonials', 'vc_testimonials' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Testimonials', 'vc_review' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    // Features extend
	if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_testimonials extends WPBakeryShortCodesContainer {};
	}
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_review extends WPBakeryShortCode {};
	}
    
});

