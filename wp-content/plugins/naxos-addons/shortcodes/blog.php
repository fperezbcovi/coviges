<?php
// Blog posts ([blog])
class Naxos_Shortcode_Blog {
    
    public static function blog( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'column' => '1/3',
			'limit'  => '3'
		), $atts ) );

		$i = 0;
		$output = '';
		$cols = Naxos_Shortcodes::getColumnsNumber( $column );

		$query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => intval( $limit )
		) );

		if ( $query->have_posts( ) ) {
			while ( $query->have_posts( ) ) {
				$query->the_post( );

				// Post
				$post_title = get_the_title( );
				$post_content = apply_filters( 'the_content', get_the_content( esc_html__( 'Read More', 'naxos-addons' ) ) );
				
				// Categories
				$category = '';
				$categories = get_the_category( get_the_ID( ) );
				
				if ( is_array( $categories ) and count( $categories ) > 0 ) {
					foreach ( $categories as $row ) {
						$category .= $row->cat_name . ', ';
					}
					
					if ( strlen( $category ) > 0 ) {
						$category = substr( $category, 0, -2 );
					}
				}
				
				// Image
				$get_attachment_preview_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID( ) ), '', false);
				$img = $get_attachment_preview_src[0];
				$image_output = $img ? '<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( $post_title ) . '" class="blog-img-link"><img src="' . esc_url( $img ) . '" class="blog-img" alt="' . esc_attr( get_the_title() ) . '"></a>' : '';
				
				// Author
				$author = '';
				$user_ID = get_the_author_meta( 'ID' );

				if ( ! get_the_author_meta( 'first_name', $user_ID ) && ! get_the_author_meta('last_name', $user_ID ) ) { 
					$author = get_the_author_meta( 'nickname', $user_ID ); 
				} else {
					$author = get_the_author_meta( 'first_name', $user_ID ) . ' ' . get_the_author_meta('last_name', $user_ID ); 
				}

				$author = '<a href="' . get_author_posts_url( get_the_author_meta('ID', $user_ID) ).'">' . $author . '</a>';

				// Output
				$output .= '<div class="col-12 col-lg-' . $cols . ' res-margin">
								<div class="blog-col">
									<p>' . $image_output . '<span class="blog-category">' . $category . '</span></p>
									<div class="blog-wrapper">
										<div class="blog-text">
											<div class="blog-about"><span>' . wp_kses_post( $author ) . '</span><span>' . esc_html( get_the_time( get_option( 'date_format' ) ) ) . '</span></div>
											<h4><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>
											' . $post_content . '
										</div>
									</div>
								</div>
							</div>';
			}
		} else {
			wp_reset_postdata( );

			return '';
		}

		wp_reset_postdata( );

		return '<div class="row blog-home">' . $output . '</div>';
	}
	
	public static function vc_blog() {
		vc_map( array(
		   	"name" => esc_html__("Blog Posts", "naxos-addons"),
		   	"base" => "blog",
		   	"icon" => 'ti-announcement',
            "description" => esc_html__( "Recent posts", "naxos-addons" ),
		   	"category" => esc_html__( "Naxos", "naxos-addons" ),
		   	"params" => array(
				array(
				 	"type" => "dropdown",
				 	"holder" => "div",
				 	"class" => "",
				 	"heading" => esc_html__( "Column", "naxos-addons" ),
				 	"param_name" => "column",
				 	"value" => array(   
						"1/2" => '1/2',
						"1/3" => '1/3',
						"1/4" => '1/4',
						"1/6" => '1/6'
					),
					"std" => "1/3",
				 	"description" => "",
					"admin_label" => true,
			  	),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Limit", "naxos-addons" ),
					"param_name"  => "limit",
					"value"       => "3",
					"description" => "",
					"admin_label" => true,
			  	),			  	
			)
		));
	}
    
}

add_shortcode( 'blog', 			array( 'Naxos_Shortcode_Blog', 'blog' ) );
add_action( 'vc_before_init', 	array( 'Naxos_Shortcode_Blog', 'vc_blog' ) );

