<?php
// Google maps (Shortcode) ([google_map])
class Naxos_Shortcode_Google_Maps {
    
    public static function googleMap( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'latitude'       => '',
			'longitude'      => '',
			'zoom'           => '10',
            'color'          => '#7c4fe0',
            'marker_state'   => 'true',
            'marker_image'   => '',
			'title'		     => '',
			'txt'            => ''
		), $atts ) );
		
		$marker = get_template_directory_uri( ) . '/assets/images/map-marker-blue.png';

		if ( $marker_state == 'false' ) {
			$marker = false;
		} else if ( ! empty( $marker_image ) ) {
             $marker = wp_get_attachment_url( $marker_image );
        }

		return '
		<div class="map"><div id="google-map" data-zoom="' . intval( $zoom ) . '" data-latitude="' . esc_attr( $latitude ) . '" data-longitude="' . esc_attr( $longitude ) . '"' . ' data-color="' . esc_attr( $color ) . '"' . ( $marker !== false ? ' data-marker="' . esc_url( $marker ) . '"' : '' ) . '></div><div id="zoom-in"></div><div id="zoom-out"></div>
		' . ( $marker !== false ? '<div id="map-info">
			<div id="content">
				<div id="siteNotice"></div>
				<h4 id="firstHeading" class="firstHeading">' . esc_html( $title ) . '</h4>
				<div id="bodyContent">' . apply_filters( 'the_content', do_shortcode( $content ) ) . '</div></div>
		</div>' : '' ) . '</div>';
	}
	
	public static function vc_googleMap() {
		vc_map( array(
		   	"name" => esc_html__( "Google Maps", "naxos-addons" ),
		   	"base" => "google_map",
		   	"icon" => 'ti-location-pin',
            "description" => esc_html__( "Map shortcode", "naxos-addons" ),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Latitude", "naxos-addons" ),
					"param_name"  => "latitude",
					"value"       => "",
					"description" => "Please enter <a href='https://www.latlong.net/'>Latitude</a>",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Longitude", "naxos-addons" ),
					"param_name"  => "longitude",
					"value"       => "",
					"description" => "Please enter <a href='https://www.latlong.net/'>Longitude</a>",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Zoom Level", "naxos-addons" ),
					"param_name"  => "zoom",
					"value"       => "10",
					"description" => "Zoom level between 0 to 21",
					"admin_label" => true,
			  	),
                array(
					"type"        => "colorpicker",
					"heading"     => esc_html__( "Map Color", "naxos-addons" ),
					"param_name"  => "color",
					"value"       => "#7c4fe0",
					"description" => "Pick a color",
					"admin_label" => true,
			  	),
                array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Show Map Marker", "naxos-addons" ),
					"param_name"  => "marker_state",
					"value"       => "",
					"std" 		  => "true",
					"description" => "",
					"admin_label" => true,
			  	),
                array(
					"type"        => "attach_image",
					"heading"     => esc_html__( "Marker Image", "naxos-addons" ),
					"param_name"  => "marker_image",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Marker Popup Title", "naxos-addons" ),
					"param_name"  => "title",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textarea_html",
					"heading"     => esc_html__( "Marker Popup Text", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'google_map', 	array( 'Naxos_Shortcode_Google_Maps', 'googleMap' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Google_Maps', 'vc_googleMap' ) );

