<?php
// Accordion ([accordions])
class Naxos_Shortcode_Accordions {
    
	static $accordionsCounters;
    static $accordionCounters;
    
    public static function accordions( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'mt' => '0px',
			'mb' => '0px',
		), $atts ) );
		
		self::$accordionsCounters = ( self::$accordionsCounters > 0 ) ? ( int ) self::$accordionsCounters : 0;
		self::$accordionsCounters ++;
		
		$mt = intval( $mt );
		$mb = intval( $mb );

		$style = ( $mt > 0 || $mb > 0 ) ? 'style="margin-top: ' . $mt . 'px; margin-bottom: ' . $mb . 'px;"' : '';		
		
		$content = do_shortcode( $content );
		
		return '<div class="accordion" id="accordion' . self::$accordionsCounters . '" role="tablist" ' . $style . '>' . $content . '</div>';
	}
	
	public static function vc_accordions() {
		vc_map( array(
		   	"name" => esc_html__( "Accordion", "naxos-addons" ),
		   	"base" => "accordions",
		   	"icon" => 'ti-layout-accordion-separated',
            'description' => esc_html__( "Accordion section", "naxos-addons" ),
			"as_parent" => array(
            	"only" => "accordion"
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

	// Accordion tab ([accordion])
	public static function accordion( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'  => '',
			'opened' => 'false'
		), $atts ) );

		self::$accordionCounters = ( self::$accordionCounters > 0 ) ? ( int ) self::$accordionCounters : 0;
		self::$accordionCounters ++;
		
		$show = ( $opened == 'true' ? 'show' : 'collapsed' );
		$cls = ( $opened == 'true' ? 'show' : '' );
		
		return '<div class="card">
					<div class="card-header" role="tab" id="heading-' . self::$accordionCounters . '">
						<h5><a class="' . $show . '" data-toggle="collapse" href="#collapse-' . self::$accordionCounters . '" role="button" aria-expanded="false" aria-controls="collapse-' . self::$accordionCounters . '">' . esc_html( $title ) . '</a></h5>
					</div>
					<div id="collapse-' . self::$accordionCounters . '" class="collapse ' . $cls . '" role="tabpanel" aria-labelledby="heading-' . self::$accordionCounters . '" data-parent="#accordion' . self::$accordionsCounters . '">
						<div class="card-body">
							<p>' . do_shortcode( $content ) . '</p>
						</div>
					</div>
				</div>';
				
	}
	
	public static function vc_accordion() {
		vc_map( array(
		   	"name" => esc_html__( "Accordion Tab", "naxos-addons" ),
		   	"base" => "accordion",
		   	"icon" => 'ti-layout-accordion-separated',
			"as_child" => array(
            	"only" => "accordions"
   			),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
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
					"heading"     => esc_html__( "Text", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "checkbox",
					"heading"     => esc_html__( "Opened", "naxos-addons" ),
					"param_name"  => "opened",
					"value"       => "",
					"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'accordions', 		array( 'Naxos_Shortcode_Accordions', 'accordions' ) );
add_shortcode( 'accordion', 		array( 'Naxos_Shortcode_Accordions', 'accordion' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Accordions', 'vc_accordions' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Accordions', 'vc_accordion' ) );

// Nested shortcodes
add_action( 'vc_before_init', function() {
    
    // Accordions extend
	if (class_exists( 'WPBakeryShortCodesContainer' )) {
		class WPBakeryShortCode_accordions extends WPBakeryShortCodesContainer {};
	}
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_accordion extends WPBakeryShortCode {};
	}
    
});