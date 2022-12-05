<?php
if ( ! class_exists( 'NaxosRedux' ) ) {
	class NaxosRedux {
		public $args        = array( );
		public $sections    = array( );
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings( );
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
		}

		public function initSettings( ) {
			if ( is_admin( ) ) {
				load_textdomain( 'naxos', get_template_directory( ) . '/languages/' . get_locale( ) . '.mo' );
			}
			
			$this->setArguments( );
			$this->setSections( );

			if ( ! isset( $this->args['opt_name'] ) ) {
				return;
			}

			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		public function setSections( ) {
			
			// General
			$this->sections[] = array(
				'title'     => esc_html__( 'General', 'naxos' ),
				'icon'      => 'el-icon-website',
				'fields'    => array(
					array(
						'id'        => 'home-page-title',
						'type'      => 'text',
						'title'     => esc_html__( 'Home Page Title', 'naxos' ),
						'desc'      => esc_html__( 'This title used only for navigation menu', 'naxos' ),
						'default'   => esc_html__( 'Home', 'naxos' )
					),
					array(
						'id'        => 'preloader',
						'type'      => 'switch',
						'title'     => esc_html__( 'Page Loader', 'naxos' ),
						'on'        => esc_html__( 'Enabled', 'naxos' ),
						'off'       => esc_html__( 'Disabled', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'preloader-only-home',
						'type'      => 'switch',
						'title'     => esc_html__( 'Page Loader Location', 'naxos' ),
						'on'        => esc_html__( 'Only Home Page', 'naxos' ),
						'off'       => esc_html__( 'All Pages', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'google-map-api',
						'type'      => 'text',
						'title'     => esc_html__( 'Google Maps API Key', 'naxos' ),
						'default'   => ''
					),
					array(
						'id'        => 'settings',
						'type'      => 'switch',
						'title'     => esc_html__( 'Settings Panel', 'naxos' ),
						'on'        => esc_html__( 'Enabled', 'naxos' ),
						'off'       => esc_html__( 'Disabled', 'naxos' ),
						'default'   => false
					),
				),
			);

			// Logo
			$this->sections[] = array(
				'title'     => esc_html__( 'Logo', 'naxos' ),
				'icon'      => 'el-icon-picasa',
				'fields'    => array(
					array(
						'id'        => 'logo-dark',
						'type'      => 'media',
						'title'     => esc_html__( 'Dark Logo', 'naxos' ),
						'subtitle'  => esc_html__( 'Normal size', 'naxos' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Upload a logotype image that will represent your website', 'naxos' )
					),
					array(
						'id'        => 'logo-light',
						'type'      => 'media',
						'title'     => esc_html__( 'Light Logo', 'naxos' ),
						'subtitle'  => esc_html__( 'Normal size', 'naxos' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Upload a logotype image that will represent your website', 'naxos' )
					),
					array(
						'id'        => 'logo-dark-retina',
						'type'      => 'media',
						'title'     => esc_html__( 'Dark Logo (2X)', 'naxos' ),
						'subtitle'  => esc_html__( 'Double size (for Retina displays)', 'naxos' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Name it same with the dark logo ending by @2x (image_name@2x.jpg)', 'naxos' )
					),
					array(
						'id'        => 'logo-light-retina',
						'type'      => 'media',
						'title'     => esc_html__( 'Light Logo (2X)', 'naxos' ),
						'subtitle'  => esc_html__( 'Double size (for Retina displays)', 'naxos' ),
						'mode'      => false,
						'desc'      => esc_html__( 'Name it same with the light logo ending by @2x (image_name@2x.jpg)', 'naxos' )
					),
				),
			);
			
			// Home
			$this->sections[] = array(
				'title'     => esc_html__( 'Home', 'naxos' ),
				'icon'      => 'el-icon-home',
				'fields'    => array(
					array(
						'id'        => 'home-video-mutted',
						'type'      => 'switch',
						'title'     => esc_html__( 'Video Mutted', 'naxos' ),
						'subtitle'  => esc_html__( 'Fullscreen Video Mode', 'naxos' ),
						'on'        => esc_html__( 'Yes', 'naxos' ),
						'off'       => esc_html__( 'No', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'home-video-loop',
						'type'      => 'switch',
						'title'     => esc_html__( 'Video Loop', 'naxos' ),
						'subtitle'  => esc_html__( 'Fullscreen Video Mode', 'naxos' ),
						'on'        => esc_html__( 'Yes', 'naxos' ),
						'off'       => esc_html__( 'No', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'home-video-start-at',
						'type'      => 'text',
						'title'     => esc_html__( 'Start Video At', 'naxos' ),
						'desc'      => esc_html__( 'Enter value in seconds', 'naxos' ),
						'subtitle'  => esc_html__( 'Fullscreen Video Mode', 'naxos' ),
						'default'   => '0'
					),
					array(
						'id'        => 'home-video-stop-at',
						'type'      => 'text',
						'title'     => esc_html__( 'Stop Video At', 'naxos' ),
						'desc'      => esc_html__( 'Enter value in seconds', 'naxos' ),
						'subtitle'  => esc_html__( 'Fullscreen Video Mode', 'naxos' ),
						'default'   => '0'
					),
                    array(
						'id'        => 'home-video-volume',
						'type'      => 'slider',
						'title'     => esc_html__( 'Video Volume', 'naxos' ),
						'subtitle'  => esc_html__( 'Fullscreen Video Mode', 'naxos' ),
						'desc'      => esc_html__( 'In percents', 'naxos' ),
						'default'   => '50',
						'min'           => 0,
						'step'          => 1,
						'max'           => 100,
						'display_value' => 'text'
					),
					array(
						'id'        => 'home-video-opacity',
						'type'      => 'slider',
						'title'     => esc_html__( 'Video Overlay Opacity', 'naxos' ),
						'subtitle'  => esc_html__( 'Fullscreen Video Mode', 'naxos' ),
						'desc'      => esc_html__( 'In percents (0% &ndash; fully transparent)', 'naxos' ),
						'default'   => '100',
						'min'           => 0,
						'step'          => 1,
						'max'           => 100,
						'display_value' => 'text'
					),
					array(
						'id'        => 'home-video-placeholder',
						'type'      => 'media',
						'title'     => esc_html__( 'Video Callback Image', 'naxos' ),
						'desc'      => esc_html__( 'This image will be shown if browser does not support fullscreen video background', 'naxos' ),
						'subtitle'  => esc_html__( 'Fullscreen Video Mode', 'naxos' ),
						'mode'      => false,
					),
					array(
						'id'    => 'opt-divide',
						'type'  => 'divide'
					),
					array(
						'id'        => 'home-slideshow-timeout',
						'type'      => 'text',
						'title'     => esc_html__( 'Slideshow Timeout', 'naxos' ),
						'desc'      => esc_html__( 'Enter value in seconds', 'naxos' ),
						'subtitle'  => esc_html__( 'Slideshow Mode', 'naxos' ),
						'default'   => '3'
					),
				),
			);
			
			// Header
			$this->sections[] = array(
				'title'     => esc_html__( 'Header', 'naxos' ),
				'icon'      => 'el-icon-star-empty',
				'fields'    => array(
					array(
						'id'        => 'header-sticky',
						'type'      => 'switch',
						'title'     => esc_html__( 'Header Mode', 'naxos' ),
						'on'        => esc_html__( 'Sticky', 'naxos' ),
						'off'       => esc_html__( 'Normal', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'search-icon',
						'type'      => 'switch',
						'title'     => esc_html__( 'Search Icon', 'naxos' ),
						'on'        => esc_html__( 'Enabled', 'naxos' ),
						'off'       => esc_html__( 'Disabled', 'naxos' ),
						'default'   => true
					),
					array(
                        'id'        => 'header-bgcolor',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Header Background Color', 'naxos' ),
                        'desc'  	=> esc_html__( 'Leave blank or pick a color for the header. (default: #212121).', 'naxos' ),
                        'default'   => '#212121',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
						'id'        => 'header-bgimage',
						'type'      => 'media',
						'title'     => esc_html__( 'Header Background', 'naxos' ),
						'subtitle'  => esc_html__( 'Background image', 'naxos' ),
						'mode'      => false,
						'desc'      => esc_html__( '1920 x 800 pixels', 'naxos' )
					),
				),
			);
			
			// Footer
			$this->sections[] = array(
				'title'     => esc_html__( 'Footer', 'naxos' ),
				'icon'      => 'el-icon-minus',
				'fields'    => array(
					array(
						'id'        => 'footer-button-top',
						'type'      => 'switch',
						'title'     => esc_html__( 'Back to Top Button', 'naxos' ),
						'on'        => esc_html__( 'Enabled', 'naxos' ),
						'off'       => esc_html__( 'Disabled', 'naxos' ),
						'default'   => true
					),
					array(
                        'id'        => 'footer-bgcolor',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Footer Background Color', 'naxos' ),
                        'desc'  	=> esc_html__( 'Leave blank or pick a color for the footer. (default: #1a191d).', 'naxos' ),
                        'default'   => '#1a191d',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
						'id'        => 'copyright-text',
						'type'      => 'editor',
						'title'     => esc_html__( 'Copyright Text', 'naxos' ),
						'desc'      => esc_html__( 'You can use the shortcodes in your footer text', 'naxos' ),
						'default'   => esc_html__( 'Copyright &copy; 2021 Naxos', 'naxos' )
					),
				),
			);
			
			// Blog
			$this->sections[] = array(
				'title'     => esc_html__( 'Blog', 'naxos' ),
				'icon'      => 'el-icon-pencil',
				'fields'    => array(
					array(
						'id'        => 'blog-page-title',
						'type'      => 'text',
						'title'     => esc_html__( 'Blog Page Title', 'naxos' ),
						'desc'      => esc_html__( 'This title used only for blog posts page', 'naxos' ),
						'default'   => ''
					),
					array(
						'id'        => 'blog-page-subtitle',
						'type'      => 'text',
						'title'     => esc_html__( 'Blog Page Subtitle', 'naxos' ),
						'desc'      => esc_html__( 'Subtitle for blog posts page', 'naxos' ),
						'default'   => ''
					),
					array(
						'id'        => 'allow-share-posts',
						'type'      => 'switch',
						'title'     => esc_html__( 'Allow Sharing Posts', 'naxos' ),
						'subtitle'  => esc_html__( 'Via Social Networks', 'naxos' ),
						'on'        => esc_html__( 'Yes', 'naxos' ),
						'off'       => esc_html__( 'No', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'show-post-author',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Post Author', 'naxos' ),
						'subtitle'  => esc_html__( 'Author section in posts', 'naxos' ),
						'on'        => esc_html__( 'Yes', 'naxos' ),
						'off'       => esc_html__( 'No', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'show-comments',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Comments', 'naxos' ),
						'subtitle'  => esc_html__( 'Enable comments in posts', 'naxos' ),
						'on'        => esc_html__( 'Yes', 'naxos' ),
						'off'       => esc_html__( 'No', 'naxos' ),
						'default'   => true
					),
					array(
						'id'        => 'excerpt-length',
						'type'      => 'text',
						'title'     => esc_html__( 'Excerpt Length', 'naxos' ),
						'subtitle'  => esc_html__( 'Blog Archive Text Length', 'naxos' ),
						'default'   => '50'
					),
					array(
						'id'    => 'opt-divide',
						'type'  => 'divide'
					),
					array(
						'id'        => 'layout-blog',
						'type'      => 'image_select',
						'compiler'  => false,
						'title'     => esc_html__( 'Blog Pages Layout', 'naxos' ),
						'subtitle'  => esc_html__( 'Select one of layouts for blog pages', 'naxos' ),
						'options'   => array(
							'1' => array( 'alt' => esc_html__( '1 Column', 'naxos' ),       'img' => ReduxFramework::$_url . 'assets/img/1col.png' ),
							'2' => array( 'alt' => esc_html__( '2 Column Left', 'naxos' ),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png' ),
							'3' => array( 'alt' => esc_html__( '2 Column Right', 'naxos' ), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png' ),
						),
						'default'   => '3'
					),
					array(
						'id'        => 'layout-search',
						'type'      => 'image_select',
						'compiler'  => false,
						'title'     => esc_html__( 'Search Page Layout', 'naxos' ),
						'subtitle'  => esc_html__( 'Select one of layouts for search page', 'naxos' ),
						'options'   => array(
							'1' => array( 'alt' => esc_html__( '1 Column', 'naxos' ),       'img' => ReduxFramework::$_url . 'assets/img/1col.png' ),
							'2' => array( 'alt' => esc_html__( '2 Column Left', 'naxos' ),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png' ),
							'3' => array( 'alt' => esc_html__( '2 Column Right', 'naxos' ), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png' ),
						),
						'default'   => '3'
					),
				),
			);

			// Typography
			$this->sections[] = array(
				'title'     => esc_html__( 'Typography', 'naxos' ),
				'icon'      => 'el-icon-text-height',
				'fields'    => array(
					array(
						'id'            => 'typography-content',
						'type'          => 'typography',
						'title'         => esc_html__( 'Content &mdash; Font', 'naxos' ),
						'google'        => true,
						'update_weekly' => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
						),
						'default'       => array(
							'font-family'   => 'Roboto',
							'font-size'     => '16',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h1',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H1', 'naxos' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => 'Lorem ipsum dolor sit amet.'
						),
						'default'       => array(
							'font-family'   => 'Roboto',
							'font-size'     => '48',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h2',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H2', 'naxos' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => 'Lorem ipsum dolor sit amet.'
						),
						'default'       => array(
							'font-family'   => 'Roboto',
							'font-size'     => '38',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h3',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H3', 'naxos' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => 'Lorem ipsum dolor sit amet.'
						),
						'default'       => array(
							'font-family'   => 'Roboto',
							'font-size'     => '30',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h4',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H4', 'naxos' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => 'Lorem ipsum dolor sit amet.'
						),
						'default'       => array(
							'font-family'   => 'Roboto',
							'font-size'     => '24',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h5',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H5', 'naxos' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => 'Lorem ipsum dolor sit amet.'
						),
						'default'       => array(
							'font-family'   => 'Roboto',
							'font-size'     => '20',
							'google'        => true,
						),
					),
					array(
						'id'            => 'typography-headers-h6',
						'type'          => 'typography',
						'title'         => esc_html__( 'Headers &mdash; H6', 'naxos' ),
						'google'        => true,
						'update_weekly' => true,
						'font-family'   => true,
						'font-backup'   => false,
						'font-style'    => false,
						'font-weight'   => false,
						'subsets'       => false,
						'font-size'     => true,
						'line-height'   => false,
						'text-align'    => false,
						'color'         => false,
						'preview'       => array(
							'text'          => 'Lorem ipsum dolor sit amet.'
						),
						'default'       => array(
							'font-family'   => 'Roboto',
							'font-size'     => '18',
							'google'        => true,
						),
					),
				),
			);
			
			// Styling
			$this->sections[] = array(
				'title'     => esc_html__( 'Styling', 'naxos' ),
				'icon'      => 'el-icon-asterisk',
				'fields'    => array(
					array(
						'id'        => 'styling-schema',
						'type'      => 'select',
						'title'     => esc_html__( 'Color Schema', 'naxos' ),
						'desc'      => esc_html__( 'Select a predefined color schema', 'naxos' ),
						'options'   => array(
							'blue'       	=> esc_html__( 'Blue', 'naxos' ),
							'green'         => esc_html__( 'Green', 'naxos' ),
							'red'      	 	=> esc_html__( 'Red', 'naxos' ),
							'turquoise'     => esc_html__( 'Turquoise', 'naxos' ),							
							'purple'        => esc_html__( 'Purple', 'naxos' ),
							'orange'        => esc_html__( 'Orange', 'naxos' ),
							'yellow'        => esc_html__( 'Yellow', 'naxos' ),
							'grey'     	 	=> esc_html__( 'Grey', 'naxos' ),
							'none'         	=> esc_html__( 'None', 'naxos' )
						),
						'default'   => 'blue'
					),
					array(
                        'id'        => 'primary-color',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Primary Color', 'naxos' ),
                        'desc'  	=> esc_html__( 'Unset Color Schema to "None" in order to use custom color. (default: #7c4fe0).', 'naxos' ),
                        'default'   => '#7c4fe0',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'secondary-color',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Secondary Color', 'naxos' ),
                        'desc'  	=> esc_html__( 'Unset Color Schema to "None" in order to use mouse hover color. (default: #5f36bb).', 'naxos' ),
                        'default'   => '#5f36bb',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'gradient-color',
                        'type'      => 'color_gradient',
                        'title'     => esc_html__( 'Intro Gradient Color', 'naxos' ),
                        'desc'  	=> esc_html__( 'Gradient color combination which is used in intro/banner section. Unset Color Schema to "None". (default: #7c4fe0, #4528dc) ', 'naxos' ),
                        'validate'  => 'color',
						'default'   => array(
							'from'  => '#7c4fe0',
							'to'    => '#4528dc', 
						),
                    ),
					array(
                        'id'        => 'body-bgcolor',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Body Background Color', 'naxos' ),
                        'desc'  => esc_html__( 'Leave blank or pick a color for the body. (default: #ffffff).', 'naxos' ),
                        'default'   => '#ffffff',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'loader-bgcolor',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html body'),
                        'title'     => esc_html__( 'Page Loader Background Color', 'naxos' ),
                        'desc'  => esc_html__( 'Leave blank or pick a color for the page loader. (default: #ffffff).', 'naxos' ),
                        'default'   => '#ffffff',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
				),
			);

			// Subscribe
			$this->sections[] = array(
				'title'     => __( 'Subscribe', 'naxos' ),
				'icon'      => 'el-icon-envelope',
				'fields'    => array(
					array(
						'id'        => 'mailchimp-api-key',
						'type'      => 'text',
						'title'     => esc_html__( 'MailChimp API Key', 'naxos' ),
						'default'   => ''
					),
					array(
						'id'        => 'mailchimp-list-id',
						'type'      => 'text',
						'title'     => esc_html__( 'MailChimp List ID', 'naxos' ),
						'default'   => ''
					),
				),
			);

		}

		public function setArguments( ) {
			$theme = wp_get_theme( );

			$this->args = array(
				'opt_name'           => 'naxos_config',
				'display_name'       => $theme->get( 'Name' ),
				'display_version'    => $theme->get( 'Version' ),
				'menu_type'          => 'menu',
				'allow_sub_menu'     => true,
				'menu_title'         => esc_html__( 'Naxos', 'naxos' ),
				'page_title'         => esc_html__( 'Theme Options', 'naxos' ),
				'google_api_key'     => '',
				'async_typography'   => false,
				'admin_bar'          => false,
				'global_variable'    => '',
				'dev_mode'           => false,
				'output'             => false,
				'compiler'           => false,
				'customizer'         => true,
				'page_priority'      => 102,
				'page_parent'        => 'themes.php',
				'page_permissions'   => 'manage_options',
				'menu_icon'          => 'dashicons-art',
				'last_tab'           => '',
				'page_icon'          => 'icon-themes',
				'page_slug'          => 'theme-options',
				'save_defaults'      => true,
				'default_show'       => false,
				'default_mark'       => '',
				'update_notice'      => false,
			);
			
			//Custom links in the footer of Redux panel
			$this->args['share_icons'][] = array(
				'url'   => 'https://themeforest.net/user/athenastudio',
				'title' => esc_html__( 'AthenaStudio', 'naxos' ),
				'icon'  => 'el el-globe-alt'
			);
			
			$this->args['share_icons'][] = array(
				'url'   => 'https://twitter.com/AthenaStudio87',
				'title' => esc_html__( 'Twitter', 'naxos' ),
				'icon'  => 'el el-twitter'
			);
			
			$this->args['share_icons'][] = array(
				'url'   => 'https://dribbble.com/AthenaStudio',
				'title' => esc_html__( 'Dribbble', 'naxos' ),
				'icon'  => 'el el-dribbble'
			);
			
		}

	}
	
	global $naxosInstance;
	$naxosInstance = new NaxosRedux( );
}
