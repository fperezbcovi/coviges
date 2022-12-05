<?php
// Pricing table plan ([plan])
class Naxos_Shortcode_Pricing_Plan {
    
    // Pricing table plan ([plan])
	public static function plan( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'featured'		=> 'no',
			'title'         => '',
			'icon'          => '',
			'price'    		=> '',
			'label'        	=> 'Purchase',
			'ribbon'        => '',
			'url'           => ''
		), $atts ) );
		
		$url = vc_build_link( $url );
		$target = strlen( $url['target'] ) > 0 ? $url['target'] : '';
		$url = strlen( $url['url'] ) > 0 ? $url['url'] : '';
		
		$featured = ( $featured == "true" ? "plan-popular mb-4 mb-sm-5 mb-lg-0" : "" );
		
		if ( $ribbon!="" ) {
			$ribbon = '<div class="card-ribbon"><span>' . $ribbon . '</span></div>';
		}
		
		return '<div class="price-table ' . $featured . ' res-margin">
					<div class="' . esc_attr( $icon ) . '"></div>
					<h3 class="plan-type">' . esc_html( $title ) . '</h3>
					<h2 class="plan-price">' . esc_html( $price ) . '</h2>
					<p>' . do_shortcode( $content ) . '</p>
					<p class="mb-0"><a class="btn" href="' . esc_url( $url ) . '" '. ( ( $target != '' && $target != '_self' ) ? ' target="' . esc_attr( $target ) . '"' : '' ) . '>' . esc_html( $label ) . '</a></p>
					' . $ribbon . '
				</div>';
	}
	
	public static function vc_plan() {
		vc_map( array(
		   	"name" => esc_html__( "Pricing Plan", "naxos-addons" ),
		   	"base" => "plan",
		   	"icon" => 'ti-money',
			"description" => esc_html__( "Pricing table plan", "appme-addons" ),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Featured", "naxos-addons" ),
					"param_name"  => "featured",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),	
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Title", "naxos-addons" ),
					"param_name"  => "title",
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
                        'type' => 'linea',
					  	"iconsPerPage" => 4000,
					),
					"dependency" => array(
					  	"element" => "type",
					  	"value" => "linea",
					),
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Price", "naxos-addons" ),
					"param_name"  => "price",
					"value"       => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textarea_html",
					"heading"     => esc_html__( "List", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),				
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Ribbon", "naxos-addons" ),
					"param_name"  => "ribbon",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Button Text", "naxos-addons" ),
					"param_name"  => "label",
					"value"       => "Purchase",
					"description" => "",
					"admin_label" => true,
			  	), 
				array(
					'type' => 'vc_link',
					'heading' => __( "Button URL", "naxos-addons" ),
					'param_name' => 'url',
					'description' => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'plan', 			array( 'Naxos_Shortcode_Pricing_Plan', 'plan' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Pricing_Plan', 'vc_plan' ) );


