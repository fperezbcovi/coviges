<?php
class Naxos_Init {	
	
	// Import demo content
	public static function naxos_import_demo( ) {
		return array(
			array(
				'import_file_name'			=> 	'Naxos Demo Content',
				'import_file_url' 			=> 	esc_url( get_template_directory_uri() . '/demo/naxos.wordpress.xml' ),
                'import_widget_file_url'    =>  esc_url( get_template_directory_uri() . '/demo/naxos.widgets.wie' )
            ),
		);
	}
	
	// After import demo
	public static function naxos_after_import_demo( ) {
		// Assign quick menu location
		$primary_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		
		set_theme_mod( 'nav_menu_locations' , array(
            'header-menu' => $primary_menu->term_id
        ));
		
		// Set front page
		$page = get_page_by_title( 'Home Style - Single Image' );
		
		if ( isset( $page->ID ) ) {
			update_option( 'page_on_front', $page->ID );
			update_option( 'show_on_front', 'page' );
		}
		
		// Set blog page
		$blog = get_page_by_title( 'Blog' );
		
		if ( isset( $blog->ID ) ) {
			update_option( 'page_for_posts', $blog->ID );
		}
	}
	
	// JavaScript files
	public static function naxos_scripts( ) {
		global $naxos_config;
		
		if ( ! is_admin( ) ) {
			wp_enqueue_script( 'retina', 				get_template_directory_uri( ) . '/assets/library/retina/retina.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'bootstrap', 			get_template_directory_uri( ) . '/assets/library/bootstrap/js/bootstrap.min.js', array( ), false, true );
			wp_enqueue_script( 'backstretch', 			get_template_directory_uri( ) . '/assets/library/backstretch/jquery.backstretch.min.js', array( ), false, true );
			wp_enqueue_script( 'swiper', 				get_template_directory_uri( ) . '/assets/library/swiper/swiper.min.js', array( ), false, true );
			wp_enqueue_script( 'owlcarousel', 			get_template_directory_uri( ) . '/assets/library/owlcarousel/owl.carousel.min.js', array( ), false, true );
			wp_enqueue_script( 'slick', 				get_template_directory_uri( ) . '/assets/library/slick/slick.min.js', array( ), false, true );
			wp_enqueue_script( 'waypoints', 			get_template_directory_uri( ) . '/assets/library/waypoints/jquery.waypoints.min.js', array( ), false, true );
			wp_enqueue_script( 'isotope', 				get_template_directory_uri( ) . '/assets/library/isotope/isotope.pkgd.min.js', array( ), false, true );
			wp_enqueue_script( 'waitforimages', 		get_template_directory_uri( ) . '/assets/library/waitforimages/jquery.waitforimages.min.js', array( ), false, true );
			wp_enqueue_script( 'lightcase', 			get_template_directory_uri( ) . '/assets/library/lightcase/js/lightcase.js', array( ), false, true );
			wp_enqueue_script( 'wow', 					get_template_directory_uri( ) . '/assets/library/wow/wow.min.js', array( ), false, true );
			wp_enqueue_script( 'parallax', 				get_template_directory_uri( ) . '/assets/library/parallax/jquery.parallax.min.js', array( ), false, true );
			wp_enqueue_script( 'counterup', 			get_template_directory_uri( ) . '/assets/library/counterup/jquery.counterup.min.js', array( ), false, true );
			wp_enqueue_script( 'magnificpopup', 		get_template_directory_uri( ) . '/assets/library/magnificpopup/jquery.magnific-popup.min.js', array( ), false, true );
			wp_enqueue_script( 'ytplayer', 				get_template_directory_uri( ) . '/assets/library/ytplayer/jquery.mb.ytplayer.min.js', array( ), false, true );
			
			// Google Maps
			if ( $naxos_config['google-map-api'] != '' ) {
				wp_enqueue_script( 'google-maps',		'//maps.googleapis.com/maps/api/js?key=' . esc_attr( $naxos_config['google-map-api'] ), array( ), false, true );
			}
			
			// Main
			wp_enqueue_script( 'naxos-main', 			get_template_directory_uri( ) . '/assets/js/main.js', array( ), false, true );
			
			// Add parameters for main
			wp_localize_script('naxos-main', 'js_load_parameters',
				array(
					'theme_default_path' => get_template_directory_uri(),
					'theme_site_url' => get_home_url()
				)
			);
			
			if ( is_singular( ) && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( "comment-reply" );
			}
			
			if ( isset( $naxos_config ) and $naxos_config['settings'] ) {
				wp_enqueue_script( 'cookie', 			get_template_directory_uri( ) . '/assets/library/settings/jquery.cookies.min.js', array( ), false, true );
				wp_enqueue_script( 'naxos-settings', 	get_template_directory_uri( ) . '/assets/library/settings/settings.js', array( ), false, true );
			}
		} else {
			$currentPage = ( isset( $_GET['page'] ) ) ? $_GET['page'] : '';

			if ( isset( $_GET['post'] ) ) {
				wp_enqueue_media( );
				wp_enqueue_script( 'jquery-ui-core' );
				wp_enqueue_script( 'jquery-ui-dropable' );
				wp_enqueue_script( 'jquery-ui-dragable' );
				wp_enqueue_script( 'jquery-ui-sortable', 'jquery' );
			}
			
			global $pagenow;
			
			if ( 'widgets.php' === $pagenow || 'customize.php' === $pagenow ) {
				wp_enqueue_editor();
			}
            
		    wp_enqueue_script( 'naxos-admin', 			get_template_directory_uri( ) . '/admin/js/admin.js', array( ), false, true );
		}
	}

	// CSS files
	public static function naxos_styles( ) {
		global $naxos_config;

		if ( ! is_admin( ) ) {
			wp_enqueue_style( 'bootstrap', 					get_template_directory_uri( ) . '/assets/library/bootstrap/css/bootstrap.min.css' );
			wp_enqueue_style( 'font-awesome', 				get_template_directory_uri( ) . '/assets/library/fontawesome/css/all.min.css' );
			wp_enqueue_style( 'linea-arrows', 				get_template_directory_uri( ) . '/assets/library/linea/arrows/styles.css' );
			wp_enqueue_style( 'linea-basic', 				get_template_directory_uri( ) . '/assets/library/linea/basic/styles.css' );
			wp_enqueue_style( 'linea-basic-elaboration', 	get_template_directory_uri( ) . '/assets/library/linea/basic_elaboration/styles.css' );
			wp_enqueue_style( 'linea-ecommerce', 			get_template_directory_uri( ) . '/assets/library/linea/ecommerce/styles.css' );
			wp_enqueue_style( 'linea-music', 				get_template_directory_uri( ) . '/assets/library/linea/music/styles.css' );
			wp_enqueue_style( 'linea-software', 			get_template_directory_uri( ) . '/assets/library/linea/software/styles.css' );
			wp_enqueue_style( 'linea-weather', 				get_template_directory_uri( ) . '/assets/library/linea/weather/styles.css' );
			wp_enqueue_style( 'animate', 					get_template_directory_uri( ) . '/assets/library/animate/animate.css' );
			wp_enqueue_style( 'lightcase', 					get_template_directory_uri( ) . '/assets/library/lightcase/css/lightcase.css' );
			wp_enqueue_style( 'swiper', 					get_template_directory_uri( ) . '/assets/library/swiper/swiper.min.css' );
			wp_enqueue_style( 'owlcarousel', 				get_template_directory_uri( ) . '/assets/library/owlcarousel/owl.carousel.min.css' );
			wp_enqueue_style( 'slick', 						get_template_directory_uri( ) . '/assets/library/slick/slick.css' );
			wp_enqueue_style( 'magnificpopup', 				get_template_directory_uri( ) . '/assets/library/magnificpopup/magnific-popup.css' );
			wp_enqueue_style( 'ytplayer', 					get_template_directory_uri( ) . '/assets/library/ytplayer/css/jquery.mb.ytplayer.min.css' );
			wp_enqueue_style( 'naxos-style', 				get_template_directory_uri( ) . '/assets/css/style.css' );
			wp_enqueue_style( 'naxos-wp-style', 			get_template_directory_uri( ) . '/style.css' );
			wp_enqueue_style( 'naxos-media', 				get_template_directory_uri( ) . '/assets/css/media.css' );
			
			// Color schema
			if ( $naxos_config['styling-schema'] != 'none' ) {
				wp_enqueue_style( 'naxos-color-schema', 	get_template_directory_uri( ) . '/assets/colors/' . $naxos_config['styling-schema'] . '.css' );
			}
			
			// Settings
			if ( isset( $naxos_config ) and $naxos_config['settings'] ) {
				wp_enqueue_style( 'naxos-settings', 		get_template_directory_uri( ) . '/assets/library/settings/settings.css' );
			}
			
			// Custom CSS		
			Naxos_Theme::naxos_custom_css( );
		} else {
			wp_enqueue_style( 'font-awesome', 			    get_template_directory_uri( ) . '/assets/library/fontawesome/css/all.min.css' );
            wp_enqueue_style( 'linea-arrows', 				get_template_directory_uri( ) . '/assets/library/linea/arrows/styles.css' );
			wp_enqueue_style( 'linea-basic', 				get_template_directory_uri( ) . '/assets/library/linea/basic/styles.css' );
			wp_enqueue_style( 'linea-basic-elaboration', 	get_template_directory_uri( ) . '/assets/library/linea/basic_elaboration/styles.css' );
			wp_enqueue_style( 'linea-ecommerce', 			get_template_directory_uri( ) . '/assets/library/linea/ecommerce/styles.css' );
			wp_enqueue_style( 'linea-music', 				get_template_directory_uri( ) . '/assets/library/linea/music/styles.css' );
			wp_enqueue_style( 'linea-software', 			get_template_directory_uri( ) . '/assets/library/linea/software/styles.css' );
			wp_enqueue_style( 'linea-weather', 				get_template_directory_uri( ) . '/assets/library/linea/weather/styles.css' );
			wp_enqueue_style( 'naxos-admin-style', 		    get_template_directory_uri( ) . '/admin/css/admin.css' );
			wp_enqueue_style( 'naxos-admin-icons', 		    get_template_directory_uri( ) . '/admin/themify-icons/themify-icons.css' );
		}
	}
	
	// Fix for to remove "type" attribute from JavaScript & CSS
	public static function naxos_html5_support() {
		add_theme_support( 'html5', array('script', 'style' ) );
	}

	// Google fonts
	public static function naxos_fonts( ) {
		global $naxos_config;

		$fonts = array( 'typography-content', 'typography-headers-h1', 'typography-headers-h2', 'typography-headers-h3', 'typography-headers-h4', 'typography-headers-h5', 'typography-headers-h6' );
		foreach ( $fonts as $key ) {
			if ( $naxos_config[$key]['font-family'] == 'Roboto' ) {
				wp_deregister_style( 'open-sans' );
				wp_deregister_style( 'options-google-fonts' );
				break;
			}
		}

		$fonts = array( );
		for ( $i = 1; $i <= 6; $i ++ ) {
			$key = 'typography-headers-h' . $i;
			
			if ( (boolean) json_decode( $naxos_config[$key]['google'] ) ) {
				$name = strtolower( str_replace( ' ', '-', $naxos_config[$key]['font-family'] ) );
				if ( ! in_array( $name, $fonts ) ) {
					$fonts[] = $name;
					$google = str_replace( ' ', '+', $naxos_config[$key]['font-family'] );					
					$font_url = add_query_arg( 'family', $google . urlencode( ':300,300italic,400,400italic,500,500italic,600,600italic,700,700italic' ), "//fonts.googleapis.com/css" );

					wp_enqueue_style( $name, $font_url );
				}
			}
		}
		
		if ( (boolean) json_decode( $naxos_config['typography-content']['google'] ) ) {
			$name = strtolower( str_replace( ' ', '-', $naxos_config['typography-content']['font-family'] ) );
			
			if ( ! in_array( $name, $fonts ) ) {
				$fonts[] = $name;
				$google = str_replace( ' ', '+', $naxos_config['typography-content']['font-family'] );
				$font_url = add_query_arg( 'family', $google . urlencode( ':300,300italic,400,400italic,500,500italic,600,600italic,700,700italic' ), "//fonts.googleapis.com/css" );

				wp_enqueue_style( $name, $font_url );
			}
		}
	}

	// Initialization
	public static function naxos_initialize( ) {
		// Removing demo mode (Redux Framework)
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance( ), 'admin_notices' ) );
		}

		// Register menus
		register_nav_menu( 'header-menu', esc_html__( 'Primary Menu', 'naxos' ) );
	}

	// After setup theme
	public static function naxos_setup( ) {
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );
		
		// Enable support for post thumbnails on posts and pages
		add_theme_support( 'post-thumbnails', array( 'post', 'our-team' ) );
		
		// Enable support for post formats
		add_theme_support( 'post-formats', array( 'gallery', 'aside', 'status', 'quote', 'link' ) );
		
		// Switch default core markups to output valid HTML5
		add_theme_support( 'html5', array( 'search-form' ) );
		
		// Set up the WordPress core custom header feature
		add_theme_support( 'custom-header' ); 
		
		// Set up the WordPress core custom background feature
		add_theme_support( 'custom-background' );
		
		// Add support for responsive embeds
		add_theme_support( 'responsive-embeds' );
		
		// Gutenberg wide and full images support
		add_theme_support( 'align-wide' );
		
		// Add custom colors to Gutenberg
		add_theme_support(
			'editor-color-palette', array(				
				array(
					'name'  => esc_html__( 'Blue', 'naxos' ),
					'slug' => 'blue',
					'color' => '#7c4fe0',
				),
				array(
					'name'  => esc_html__( 'Green', 'naxos' ),
					'slug' => 'green',
					'color' => '#2aa275',
				),
				array(
					'name'  => esc_html__( 'Red', 'naxos' ),
					'slug' => 'red',
					'color' => '#ff3d65',
				),
				array(
					'name'  => esc_html__( 'Turquoise', 'naxos' ),
					'slug' => 'turquoise',
					'color' => '#46cad7',
				),
				array(
					'name'  => esc_html__( 'Purple', 'naxos' ),
					'slug' => 'purple',
					'color' => '#d1397c',
				),
				array(
					'name'  => esc_html__( 'Orange', 'naxos' ),
					'slug' => 'orange',
					'color' => '#ee8f67',
				),
				array(
					'name'  => esc_html__( 'Yellow', 'naxos' ),
					'slug' => 'yellow',
					'color' => '#ffbe00',
				),
				array(
					'name'  => esc_html__( 'Grey', 'naxos' ),
					'slug' => 'grey',
					'color' => '#656d78',
				),
				array(
					'name'  => esc_html__( 'Black', 'naxos' ),
					'slug' => 'black',
					'color' => '#444444',
				),
				array(
					'name'  => esc_html__( 'White', 'naxos' ),
					'slug' => 'white',
					'color' => '#ffffff',
				),
			)
		);
	}

	// Main menu attributes
	public static function naxos_menu_atts( $atts, $item, $args = array( ) ) {
		if ( ! isset( $args->theme_location ) or $args->theme_location != 'header-menu' ) {
			return $atts;
		}

		if ( get_option( 'show_on_front', 'posts' ) == 'page' and get_option( 'page_on_front', 0 ) > 0 ) {
			$is_front_page = Naxos_Theme::naxos_is_front_page( get_the_ID( ) );
			
			// Add #home anchor
			if ( $is_front_page ) {
				$front_id = get_option( 'page_on_front' );
				
				if ( intval( $front_id ) == $item->object_id ) {
					$atts['href'] = '#home';
				}
			}

			// Add site url to custom links
			if ( $item->object == 'custom' ) {
				if ( ! $is_front_page && substr($atts['href'], 0, 1) == "#" ) {
					$atts['href'] = esc_url( home_url( '/' ) . $atts['href'] );
				}
			}
		}

		return $atts;
	}

	// Main menu classes
	public static function naxos_menu_classes( $classes, $item, $args ) {
		if ( ! isset( $args->theme_location ) or $args->theme_location != 'header-menu' ) {
			return $classes;
		}

		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$classes[] = 'dropdown';
		}

		return $classes;
	}

	// Fallback menu
	public static function naxos_menu_fallback( $menu, $args = array( ) ) {
		if ( isset( $args['naxos_fallback'] ) and isset( $args['naxos_class'] ) ) {
			$menu = preg_replace( '/ class="' . $args['menu_class'] . '"/', '', $menu );
			$menu = preg_replace( '/<ul>/', '<ul class="' . esc_attr( $args['naxos_class'] ) . '">', $menu );
		}

		return $menu;
	}

	// More link
	public static function naxos_more_link( $link, $text ) {
		return str_replace( 'more-link', 'more-link btn btn-default', $link );
	}

	// Widgets
	public static function naxos_widgets( ) {
		// Sidebars
		$args = array(
			'name'          => esc_html__( 'Sidebar', 'naxos' ),
			'id'            => 'sidebar-primary',
			'description'   => esc_html__( 'Widgets in this area will be shown in the sidebar.', 'naxos' ),
			'before_widget' => '<div id="%1$s" class="row sidebar widget %2$s"><div class="col-md-12 col-sm-12">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<header><h4>',
			'after_title'   => '</h4></header>'
		);
		register_sidebar( $args );
		
		register_sidebar(array(
			'name' => esc_html__( 'Footer', 'naxos' ),
			'id' => 'footer',
			'description' => esc_html__( 'Widgets in this area will be shown in the footer.', 'naxos' ),
			'before_widget' => '<div id="%1$s" class="col-12 col-md-6 col-lg-3 res-margin"><div class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
		));
	}

	// Embed video
	public static function naxos_embed( $source ) {
		$before = '<div class="embed-container">';
		$after = '</div>';
		
		return $before . $source . $after;
	}

	// Left link attributes (Navigation for Posts & Comments)
	public static function naxos_nav_link_left( $atts = '' ) {
		$atts .= ( ! empty( $atts ) ? ' ' : '' ) . 'class="btn btn-prev"';
		return $atts;
	}

	// Right link attributes (Navigation for Posts & Comments)
	public static function naxos_nav_link_right( $atts = '' ) {
		$atts .= ( ! empty( $atts ) ? ' ' : '' ) . 'class="btn btn-next"';
		return $atts;
	}

	// Password form (Protected Posts)
	public static function naxos_password_form( ) {
		global $post;
		
		return '<div class="nothing-found">
		<form class="search-form" action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<div style="padding-bottom:20px">' . esc_html__( 'To view this protected post, enter the password below:', 'naxos' ) . '</div>
		<input name="post_password" type="password" class="search-field" size="20" maxlength="20" /><input type="submit" name="Submit" class="search-submit" value="' . esc_attr__( 'Submit', 'naxos' ) . '" /></form></div>';
	}
	
	// Gutenberg editor styles
	public static function naxos_editor_styles() {
		wp_enqueue_style( 'naxos-editor-block-style', get_template_directory_uri( ) . '/assets/css/editor-style.css' );
		wp_enqueue_style( 'naxos-fonts', Naxos_Init::naxos_fonts_url( ), array(), null );
	}
	
	// Register custom fonts
	public static function naxos_fonts_url() {
		global $naxos_config;
		
		$fonts_url = '';
	
		if ( isset( $naxos_config['typography-content']['google'] ) ) {
			$font_families = array();
	
			$font_families[] = $naxos_config['typography-content']['font-family'] . ':300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800';
			
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
	
			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}
	
		return esc_url_raw( $fonts_url );
	}
	
	// Body class
	public static function naxos_body_class( $classes ) {
		global $naxos_config;
		$theme = wp_get_theme();
		
		// Theme version
		$classes[] = 'naxos-theme-v'.$theme->version;
		
		// Preloader
		if ( $naxos_config['preloader'] ) {
			$classes[] = 'show-preloader';
		}
		
		// Header
		if ( $naxos_config['header-sticky'] ) {
			$classes[] = 'header-sticky';
		} else {
			$classes[] = 'header-normal';
		}
		
		// Color schema
		$classes[] = 'color-' . esc_attr( $naxos_config['styling-schema'] );
		
		return $classes;
	}
	
	// Add a pingback url auto-discovery header for single posts, pages, or attachments
	public static function naxos_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
	
}

// Import demo
add_action( 'pt-ocdi/after_import', array( 'Naxos_Init', 'naxos_after_import_demo' ) );
add_filter( 'pt-ocdi/import_files', array( 'Naxos_Init', 'naxos_import_demo' ), 10, 3 );

// Enqueue scripts
add_action( 'wp_enqueue_scripts', array( 'Naxos_Init', 'naxos_fonts' ) );
add_action( 'wp_enqueue_scripts', array( 'Naxos_Init', 'naxos_styles' ) );
add_action( 'wp_enqueue_scripts', array( 'Naxos_Init', 'naxos_scripts' ) );
add_action( 'admin_enqueue_scripts', array( 'Naxos_Init', 'naxos_styles' ) );
add_action( 'admin_enqueue_scripts', array( 'Naxos_Init', 'naxos_scripts' ) );
add_action( 'after_setup_theme', array( 'Naxos_Init', 'naxos_html5_support' ) );

// Init
add_action( 'init', array( 'Naxos_Init', 'naxos_initialize' ) );
add_action( 'after_setup_theme', array( 'Naxos_Init', 'naxos_setup' ) );
add_action( 'widgets_init', array( 'Naxos_Init', 'naxos_widgets' ) );
add_action( 'the_content_more_link', array( 'Naxos_Init', 'naxos_more_link' ), 10, 2 );
add_filter( 'the_password_form', array( 'Naxos_Init', 'naxos_password_form' ) );

// Menu
add_filter( 'nav_menu_link_attributes', array( 'Naxos_Init', 'naxos_menu_atts' ), 10, 3 );
add_filter( 'nav_menu_css_class', array( 'Naxos_Init', 'naxos_menu_classes' ), 10, 3 );
add_filter( 'wp_page_menu', array( 'Naxos_Init', 'naxos_menu_fallback' ), 10, 2 );

// Previus / Next buttons
add_filter( 'next_posts_link_attributes', array( 'Naxos_Init', 'naxos_nav_link_left' ) );
add_filter( 'previous_posts_link_attributes', array( 'Naxos_Init', 'naxos_nav_link_right' ) );
add_filter( 'previous_comments_link_attributes', array( 'Naxos_Init', 'naxos_nav_link_left' ) );
add_filter( 'next_comments_link_attributes', array( 'Naxos_Init', 'naxos_nav_link_right' ) );

// Embed video
add_filter( 'embed_oembed_html', array( 'Naxos_Init', 'naxos_embed' ), 10, 3 );
add_filter( 'video_embed_html', array( 'Naxos_Init', 'naxos_embed' ) );

// Enqueue editor styles
add_editor_style( array( 'assets/css/editor-style.css', Naxos_Init::naxos_fonts_url( ) ) );
add_action( 'enqueue_block_editor_assets', array( 'Naxos_Init', 'naxos_editor_styles' ) );

// Body class
add_filter( 'body_class', array( 'Naxos_Init', 'naxos_body_class' ) );

// Pingback
add_action( 'wp_head', array( 'Naxos_Init', 'naxos_pingback' ) );






