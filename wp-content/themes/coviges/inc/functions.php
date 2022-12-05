<?php
class Naxos_Theme {
	
	// Shortcodes fix
	// https://gist.github.com/bitfade/4555047
	public static function naxos_filter( $content ) {
		$block = join( '|', array(
			'intro', 			'header_title', 	'header_image',		'buttons', 				'download', 	
			'section_title',	'clients',			'client',			'features',				'feature',		
			'video',			'services',			'service',			'overviews',			'overview',
			'testimonials',		'review',			'counter',			'team',					'worker',			
			'screenshots',		'accordions',		'accordion',		'subscription_form',	'pricing_table',	
			'plan',				'contact_info',		'contact_text',		'contact_form',			'blog',				
			'google_map'
		) );

		$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
		$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

		return $rep;
	}
	
	// Slideshow images
	public static function naxos_slideshow_images( $postId ) {
		$meta = get_post_meta( $postId );
		$result = '';

		if ( count( $meta ) > 0 ) {
			foreach ( $meta as $param => $value ) {
				if ( substr_count( $param, 'slideshow-images' ) > 0 ) {
					if ( ! empty( $value[0] ) ) {
						$explode = explode( ',', $value[0] );

						if ( count( $explode ) > 0 ) {
							foreach ( $explode as $name ) {
								if ( ! empty( $name ) ) $result .= $name . ',';
							}
						}						
					}
				}
				
				if ( substr( $result, -1 ) == ',' ) {
					$result = substr( $result, 0, strlen($result) - 1 );
				}
			}
		}

		return $result;
	}

	// Slideshow slides
	public static function naxos_slideshow_slides( $postId ) {
		$meta = get_post_meta( $postId );

		if ( count( $meta ) > 0 ) {
			$array = array( );

			foreach ( $meta as $param => $value ) {
				if ( substr_count( $param, 'slideshow-slide-' ) > 0 ) {
					if ( ! empty( $value[0] ) ) {
						$array[] = $value[0];
					}
				}
			}

			if ( count( $array ) > 0 ) {
				return $array;
			}
		}

		return false;
	}

	// Get front page type
	public static function naxos_front_page_type( $postId ) {
		$type = get_post_meta( $postId, 'header-section', true );
		
		if ( $type == 'none' or empty( $type ) ) {
			return false;
		}

		return $type;
	}

	// Is front page
	public static function naxos_is_front_page( $postId ) {
		if ( self::naxos_front_page_type( $postId ) !== false ) {
			return true;
		}

		return false;
	}
	
	// Inline scripts
	public static function naxos_inline_scripts( $page_id ) {
		global $naxos_config;
		
		$loader = false;
		$isFrontPage = self::naxos_is_front_page( $page_id );

		if ( $naxos_config === null ) {
			$loader = true;
		} else if ( $naxos_config['preloader'] ) {
			if ( ( $naxos_config['preloader-only-home'] and $isFrontPage ) or ! $naxos_config['preloader-only-home'] ) {
				$loader = true;
			}
		}
		
		$script_loader = $loader ? 'true' : 'false';
		$script_navigation = $naxos_config['header-sticky'] ? 'sticky' : 'normal';		
		$ajax_nonce = wp_create_nonce( "naxos-nonce" );

		wp_add_inline_script( 'naxos-main',
			'var Naxos = {
				"loader":'. $script_loader .',
				"navigation":"' . $script_navigation . '",
				"security":"' . $ajax_nonce . '"
			};', 
		'before');
	}

	// Load front page templates
	public static function naxos_front_page( $postId ) {
		$type = self::naxos_front_page_type( $postId );
		
		switch ( $type ) {
			case 'slideshow':
				get_template_part( 'templates/front', 'slideshow' );
				break;
			case 'image':
				get_template_part( 'templates/front', 'image' );
				break;
			case 'video':
				get_template_part( 'templates/front', 'video' );
				break;
			case false:
				return false;
		}	

		return true;
	}

	// Main menu
	public static function naxos_main_menu( $post_id, $menu_class = '' ) {
		return wp_nav_menu( array(
			'theme_location' => 'header-menu',
			'container'      => false,
			'menu_class'     => $menu_class,			
			'depth'          => 3,
			'walker'         => new Naxos_Menu,
			'fallback_cb'    => array( 'Naxos_Menu', 'fallback_cb' )
		) );
	}

	// Post content
	public static function naxos_post_content( ) {
		$formats = array( 'gallery', 'aside', 'status', 'quote', 'link' );

		foreach ( $formats as $format ) {
			if ( has_post_format( $format ) ) {
				get_template_part( 'templates/post', $format );
				
				return true;
			}
		}
		
		get_template_part( 'templates/post', 'standard' );

		return true;
	}

	// Post categories
	public static function naxos_post_categories( $post_id, $before = '<span>', $after = '</span>', $echo = true ) {
		$categories = get_the_category( $post_id );

		if ( is_array( $categories ) and count( $categories ) > 0 ) {
			$output = array( );

			foreach ( $categories as $row ) {
				$output[] = '<a href="' . get_category_link( $row->term_id ) . '">' . $row->cat_name . '</a>';
			}

			if ( $echo ) {
				echo wp_specialchars_decode( $before . implode( ', ', $output ) . $after );
			} else {
				return wp_specialchars_decode( $before . implode( ', ', $output ) . $after );
			}
		}
	}

	// Comment
	public static function naxos_comment( $comment, $args, $depth ) {
		global $post;
		
		$comment_approved = '';
		
		if ( $comment->comment_approved == '0' ) {
			$comment_approved = '<p class="comment-approved">
									<em>' . esc_html( 'Your comment is awaiting moderation.', 'naxos' ) . '</em>
								 </p>';
		}

		if ( $comment->comment_type == 'pingback' or $comment->comment_type == 'trackback' ) {?>
			<div <?php comment_class( 'user-comment pingback' ); ?> id="comment-<?php comment_ID() ?>">
				<div class="user-comment-inner">
					<div class="details">
						<div class="info">
							<span class="author">
								<span><?php esc_html_e( 'Pingback', 'naxos' ); ?> &ndash;</span>
								<?php comment_author_link( ); ?>
							</span>
							<span class="reply">
								<?php edit_comment_link( esc_html__( 'Edit ', 'naxos' ), '', ( ( comments_open( ) and $depth < $args['max_depth'] ) ? ' &ndash; ' : '' ) ); ?>
							</span>
						</div>					
					</div>
				</div>
		
		<?php 
			} else {
				$avatar = str_replace( 'class=\'', 'class=\'img-responsive rounded-circle ', get_avatar( $comment, 80, '', 'avatar' ) );
		?>
			<div <?php comment_class( 'user-comment' ); ?> id="comment-<?php comment_ID() ?>">	
				<div class="user-comment-inner">
					<div class="image">
						<?php echo wp_kses_post( $avatar ); ?>
					</div>
					
					<div class="details">
						<div class="info">
							<span class="author"><?php comment_author_link( ); ?></span>
							<span class="date"><span><?php esc_html_e( 'Posted on ', 'naxos' ); ?></span> <?php comment_date( ); ?></span>
						</div>
						<div class="text">
							<?php comment_text(); ?><?php echo wp_kses_post( $comment_approved ); ?>
						</div>
						<div class="reply">
							<?php 
								edit_comment_link( esc_html__( 'Edit ', 'naxos' ), '', ( ( comments_open( ) and $depth < $args['max_depth'] ) ? ' &ndash; ' : '' ) );
								comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses_post( '<i class="fas fa-reply"></i> Reply', 'naxos' ), 'depth' => $depth ) ) );
							?>
						</div>
					</div>
				</div>				
		<?php }
	}

	// Page title
	public static function naxos_page_title( ) {
		if ( is_home( ) ) {
			if ( get_option( 'page_for_posts', true ) ) {
				echo get_the_title( get_option( 'page_for_posts', true ) );
			} else {
				esc_html_e( 'Latest Posts', 'naxos' );
			}
		} elseif ( is_archive( ) ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			
			if ( $term ) {
				echo esc_html( $term->name );
			} elseif ( is_post_type_archive( ) ) {
				echo get_queried_object( )->labels->name;
			} elseif ( is_day( ) ) {
				printf( esc_html__( 'Daily Archives: %s', 'naxos' ), get_the_date( ) );
			} elseif ( is_month( ) ) {
				printf( esc_html__( 'Monthly Archives: %s', 'naxos' ), get_the_date( 'F Y' ) );
			} elseif ( is_year( ) ) {
				printf( esc_html__( 'Yearly Archives: %s', 'naxos' ), get_the_date( 'Y' ) );
			} elseif ( is_author( ) ) {
				global $post;

				printf( esc_html__( 'Author Archives: %s', 'naxos' ), get_the_author_meta( 'display_name', $post->post_author ) );
			} else {
				single_cat_title( );
			}
		} elseif ( is_search( ) ) {
			printf( esc_html__( 'Search Results for %s', 'naxos' ), get_search_query( ) );
		} elseif ( is_404( ) ) {
			esc_html_e( 'File Not Found', 'naxos' );
		} else {
			the_title( );
		}
	}

	// Content navigation
	public static function naxos_nav_content( $class = '' ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
			echo '<ul class="post-nav pagination justify-content-center justify-content-lg-start">
					<li>' . get_next_posts_link( esc_html__( '&lsaquo;&nbsp; Older posts', 'naxos' ) ) . '</li>
					<li>' . get_previous_posts_link( esc_html__( 'Newer posts &nbsp;&rsaquo;', 'naxos' ) ) . '</li>
				  </ul>';
		}
	}

	// Post gallery
	public static function naxos_post_gallery( $more_link, $echo = true ) {		
		$content = preg_replace_callback( '/\\[gallery(.*?)ids=(?:"|\')([0-9,]+)([^\\]]+)\\]/is', array( 'self', 'gallerySlider' ), get_the_content( $more_link ) );
		
		if ( $echo ) {
			echo apply_filters( 'the_content', wpautop( $content ) );
		} else {
			return apply_filters( 'the_content', wpautop( $content ) );
		}
	}
	
	// Gallery slider
	public static function naxos_gallery_slider( $matches ) {
		$output = '';
		
		if ( ! empty( $matches[2] ) ) {
			$output .= '<div class="image-slider">';
			$ids = explode( ',', $matches[2] );

			foreach ( $ids as $id ) {
				$output .= '<div><img src="' . wp_get_attachment_url( $id ) . '" class="img-responsive img-rounded" alt="image"></div>';
			}

			$output .= '<div class="arrows"><a class="arrow left"><i class="fas fa-chevron-left"></i></a><a class="arrow right"><i class="fas fa-chevron-right"></i></a></div></div>';
		}

		return $output;
	}

	// Get next attachment URL
	public static function naxos_next_attachment_url( $post ) {
		$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );

		foreach ( $attachments as $k => $attachment ) {
			if ( $attachment->ID == $post->ID ) {
				break;
			}
		}
		
		if ( count( $attachments ) > 1 ) {
			$k ++;
			if ( isset( $attachments[$k] ) ) {
				$url = get_attachment_link( $attachments[$k]->ID );
			} else {
				$url = get_attachment_link( $attachments[0]->ID );
			}
		} else {
			$url = wp_get_attachment_url( );
		}
		
		return $url;
	}

	// Get option
	public static function naxos_option( $key, $default = false ) {
		global $naxos_config;

		if ( isset( $naxos_config[$key] ) ) {
			return $naxos_config[$key];
		}

		return $default;
	}
	
	// Hex to RGB convert
	public static function naxos_hex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );
		
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		
		$rgb = "$r, $g, $b";
		
		return $rgb;
	}
	
	// Minify CSS
	public static function naxos_minify_css( $css ) {
		// Trim
		$css = trim( $css );
		
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		
		// Remove tabs, spaces, newlines, etc.
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), ' ', $css );
		
		return $css;
	}
	
	// Custom CSS
	public static function naxos_custom_css() {
		global $naxos_config;
		
		$naxos_default = Naxos_Defaults::naxos_redux( );
		
		$custom_css = '';
		
		// Get custom CSS
		ob_start();
		include ( get_template_directory() . '/inc/styling.php' );
		$custom_css  = ob_get_clean();
		
		// Minify CSS
		$custom_css  = self::naxos_minify_css( $custom_css );
		
		wp_add_inline_style( 'naxos-style', $custom_css );
	}
	
}
