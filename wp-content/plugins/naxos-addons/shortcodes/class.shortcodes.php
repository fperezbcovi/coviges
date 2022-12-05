<?php
class Naxos_Shortcodes {
	
    // Convert columns
	public static function getColumnsNumber( $fraction ) {
		list( $x, $y ) = explode( '/', $fraction );

		$x = intval( $x ) > 0 ? intval( $x ) : 1;
		$y = intval( $y ) > 0 ? intval( $y ) : 1;

		return round( $x * ( 12 / $y ) );
	}

	// Share
	public static function share( $title = null, $image = null, $url = null ) {
		global $naxos_config;
		
		$txt = $title ? '<span>' . esc_html__( 'Share This Article', 'naxos-addons' ) .'</span>' : '';
		
		$output =  '<div class="share-panel share-btn">
						<p><i class="fas fa-share-alt"></i>' . esc_html__( 'Share', 'naxos-addons' ) .'</p>
						<ul>
							<li><a title="' . esc_html__( "Twitter", 	"naxos-addons" ) . '" onclick="shareTo( \'twitter\', \'' . 		esc_js( $title ) . '\', \'' . esc_js( $image ) . '\', \'' . esc_js( $url ) . '\' )"><i class="fab fa-twitter"></i></a></li>
							<li><a title="' . esc_html__( "Facebook", 	"naxos-addons" ) . '" onclick="shareTo( \'facebook\', \'' . 	esc_js( $title ) . '\', \'' . esc_js( $image ) . '\', \'' . esc_js( $url ) . '\' )"><i class="fab fa-facebook-f"></i></a></li>
							<li><a title="' . esc_html__( "Pinterest", 	"naxos-addons" ) . '" onclick="shareTo( \'pinterest\', \'' . 	esc_js( $title ) . '\', \'' . esc_js( $image ) . '\', \'' . esc_js( $url ) . '\' )"><i class="fab fa-pinterest"></i></a></li>
							<li><a title="' . esc_html__( "LinkedIn", 	"naxos-addons" ) . '" onclick="shareTo( \'linkedin\', \'' . 	esc_js( $title ) . '\', \'' . esc_js( $image ) . '\', \'' . esc_js( $url ) . '\' )"><i class="fab fa-linkedin-in"></i></a></li>
						</ul>
					</div>';

		return $output;
	}
	
}

// Include shortcodes
require_once NAXOS_PLUGIN_DIR . 'shortcodes/intro.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/header-title.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/header-image.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/buttons.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/download.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/section-title.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/clients.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/features.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/video.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/service.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/overviews.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/testimonials.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/counter.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/worker.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/screenshots.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/accordions.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/subscription-form.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/pricing-plan.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/contact-info.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/blog.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/social-links.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/skills.php';
require_once NAXOS_PLUGIN_DIR . 'shortcodes/google-maps.php';





