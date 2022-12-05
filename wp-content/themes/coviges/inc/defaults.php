<?php
// Some demo content
// And variables for Redux Framework
class Naxos_Defaults {
	
	// Initialize
	public static function naxos_initialize( ) {
		global $naxos_config;

		if ( ! isset( $naxos_config ) or count( $naxos_config ) == 0 ) {
			$naxos_config = self::naxos_redux( );
		}
		
		if ( ! get_option( 'naxos_started', false ) ) {
			self::naxos_save( );
		}
	}

	// Save state
	public static function naxos_save( ) {
		update_option( 'naxos_started', 1 );
	}

	// Default options for Redux Framework
	public static function naxos_redux( ) {
		return array(
			'home-page-title'        => esc_html__( 'Home', 'naxos' ),
			'preloader'              => 1,
			'preloader-only-home'    => 1,
			'google-map-api'         => '',
			'settings'            	 => 0,
			
			'logo-dark'              => array( 'url' => '' ),
			'logo-light'             => array( 'url' => '' ),
			'logo-dark-retina'       => array( 'url' => '' ),
			'logo-light-retina'      => array( 'url' => '' ),
			
			'header-sticky'          => 1,
			'search-icon'            => 1,
			'header-bgcolor'   		 => '#212121',
			'header-bgimage'         => array( 'url' => '' ),
			
			'footer-button-top'      => 1,
			'footer-bgcolor'   		 => '#1a191d',
			'copyright-text'         => esc_html__( 'Copyright &copy; 2021 Naxos', 'naxos' ),
		
			'blog-page-title'        => '',
			'blog-page-subtitle'     => '',
			'allow-share-posts'      => 1,
			'show-post-author'       => 1,
			'show-comments'      	 => 1,
			'excerpt-length'      	 => 50,
			'layout-blog'         	 => 3,
			'layout-search'          => 3,
			
			'typography-content'     => array( 'font-family' => 'Roboto', 'google' => 1, 'font-size' => '16px' ),
			'typography-headers-h1'  => array( 'font-family' => 'Roboto', 'google' => 1, 'font-size' => '48px' ),
			'typography-headers-h2'  => array( 'font-family' => 'Roboto', 'google' => 1, 'font-size' => '38px' ),
			'typography-headers-h3'  => array( 'font-family' => 'Roboto', 'google' => 1, 'font-size' => '30px' ),
			'typography-headers-h4'  => array( 'font-family' => 'Roboto', 'google' => 1, 'font-size' => '24px' ),
			'typography-headers-h5'  => array( 'font-family' => 'Roboto', 'google' => 1, 'font-size' => '20px' ),
			'typography-headers-h6'  => array( 'font-family' => 'Roboto', 'google' => 1, 'font-size' => '18px' ),
			
			'styling-schema'         => 'blue',
			'primary-color'   		 => '#24bca4',
			'secondary-color'   	 => '#2dd7bc',
			'gradient-color'     	 => array( 'from' => '#7c4fe0', 'to' => '#4528dc' ),
			'body-bgcolor'   		 => '#ffffff',
			'loader-bgcolor' 		 => '#ffffff',
			
			'home-video-mutted'      => 1,
			'home-video-loop'        => 1,
			'home-video-start-at'    => 0,
			'home-video-stop-at'     => 0,
			'home-video-opacity'     => 100,
            'home-video-volume'      => 50,
			'home-video-placeholder' => array( 'url' => '' ),
			'home-slideshow-timeout' => 3,
			
			'mailchimp-api-key'   	 => '',
			'mailchimp-list-id'      => ''
			
		);
	}
	
}

add_action( 'after_setup_theme', array( 'Naxos_Defaults', 'naxos_initialize' ) );
