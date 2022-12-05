<?php
/*
 * Social links
 */
class Naxos_Social_Links_Widget extends WP_Widget {
	
	public $icons = array(
		'twitter' 		=> 'fab fa-twitter',
		'facebook' 		=> 'fab fa-facebook-f',
		'instagram' 	=> 'fab fa-instagram',
		'behance' 		=> 'fab fa-behance',
		'dribbble' 		=> 'fab fa-dribbble',
		'linked_in' 	=> 'fab fa-linkedin-in',
		'pinterest' 	=> 'fab fa-pinterest',
		'youtube' 		=> 'fab fa-youtube',
		'tumblr' 		=> 'fab fa-tumblr',
		'flickr' 		=> 'fab fa-flickr',
		'email' 		=> 'fas fa-envelope',
		'rss' 			=> 'fas fa-rss',
		'github' 		=> 'fab fa-github',
		'skype' 		=> 'fab fa-skype',
		'vkontakte' 	=> 'fab fa-vk',
		'mix' 			=> 'fab fa-mix',
		'dropbox' 		=> 'fab fa-dropbox',
		'soundcloud' 	=> 'fab fa-soundcloud'
	);

	public $titles = array(
		'twitter' 		=> 'Twitter',
		'facebook' 		=> 'Facebook',
		'instagram' 	=> 'Instagram',
		'behance' 		=> 'Behance',
		'dribbble' 		=> 'Dribbble',
		'linked_in' 	=> 'LinkedIn',
		'pinterest' 	=> 'Pinterest',
		'youtube' 		=> 'Youtube',
		'tumblr' 		=> 'Tumblr',
		'flickr' 		=> 'Flickr',
		'email' 		=> 'Email',
		'rss' 			=> 'RSS',
		'github' 		=> 'Github',
		'skype' 		=> 'Skype',
		'vkontakte'		=> 'VK',
		'mix' 			=> 'Mix',
		'dropbox' 		=> 'Dropbox',
		'soundcloud' 	=> 'SoundCloud'
	);

	public function __construct() {
		$widget_ops = array( 
			'classname' 	=> 'widget_social', 
			'description' 	=> esc_html__( 'Add your social accounts', 'naxos-addons' ) 
		);

		parent::__construct( 'Naxos_Social_Links_Widget', esc_html__( 'Naxos Social Links Widget', 'naxos-addons' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		global $naxos_config;
		
		$values['twitter'] 		= $instance['twitter'];
		$values['facebook'] 	= $instance['facebook'];
		$values['instagram'] 	= $instance['instagram'];
		$values['behance'] 		= $instance['behance'];
		$values['dribbble'] 	= $instance['dribbble'];
		$values['linked_in'] 	= $instance['linked_in'];
		$values['pinterest'] 	= $instance['pinterest'];
		$values['youtube'] 		= $instance['youtube'];
		$values['tumblr'] 		= $instance['tumblr'];
		$values['flickr'] 		= $instance['flickr'];
		$values['email'] 		= $instance['email'];
		$values['rss'] 			= $instance['rss'];
		$values['github'] 		= $instance['github'];
		$values['skype'] 		= $instance['skype'];
		$values['vkontakte'] 	= $instance['vkontakte'];
		$values['mix'] 		    = $instance['mix'];
		$values['dropbox'] 		= $instance['dropbox'];
		$values['soundcloud'] 	= $instance['soundcloud'];

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo wp_kses_post($args['before_widget']);

		if ( $title ) {
			echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']);
		}
		
		$show_logo = isset( $instance['show_logo'] ) ? $instance['show_logo'] : false;
		$content = empty( $instance['content'] ) ? '' : $instance['content'];
		?>

		<?php 
			if ( $show_logo != '' ) {
				$logo = ! empty( $naxos_config['logo-light']['url'] ) ? $naxos_config['logo-light']['url'] : get_template_directory_uri( ) . '/images/logo-white.png';
		?>
			<p>
				<img class="footer-logo text-center text-lg-left" src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2">
			</p>
		<?php } ?>

		<?php if ( $content != '' ) { ?>
			<p><?php esc_html_e($content); ?></p>
		<?php } ?>

		<div class="author-social">
			<div class="social">
			<?php 
				foreach ($this->icons as $arg => $value) {
					if (!empty($values[$arg])) {
						if ($values[$arg] != '#' && 
							! ( substr( $values[$arg], 0, 4 ) === "http" || substr( $values[$arg], 0, 7 ) === "http://" ||
								substr( $values[$arg], 0, 5 ) === "https" || substr( $values[$arg], 0, 8 ) === "https://") ) {
								$values[$arg] = "http://" . $values[$arg];
						}

						echo '<a href="' . $values[$arg] .'"><i class="'. $value .'"></i></a>';
					}
				} 
			?>
			</div>
		</div>
		<?php 
		echo wp_kses_post($args['after_widget']);
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$new_instance = wp_parse_args( (array) $new_instance, 
			array( 	
				'title' 		=> '',
				'content' 		=> '', 
				'twitter' 		=> '',
				'facebook' 		=> '',
				'instagram' 	=> '',
				'behance' 		=> '',
				'dribbble' 		=> '',
				'linked_in' 	=> '',
				'pinterest' 	=> '',
				'youtube' 		=> '',
				'tumblr' 		=> '',
				'flickr' 		=> '',
				'email' 		=> '',
				'rss' 			=> '',
				'github' 		=> '',
				'skype' 		=> '',
				'vkontakte' 	=> '',
				'mix' 			=> '',
				'dropbox' 		=> '',
				'soundcloud' 	=> ''
			) 
		);

		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['content'] 		= strip_tags( $new_instance['content'] );
		$instance['show_logo'] 		= isset( $new_instance['show_logo'] ) ? (bool) $new_instance['show_logo'] : false;

		$instance['twitter'] 		= $new_instance['twitter'];
		$instance['facebook'] 		= $new_instance['facebook'];
		$instance['instagram'] 		= $new_instance['instagram'];
		$instance['behance'] 		= $new_instance['behance'];
		$instance['dribbble'] 		= $new_instance['dribbble'];
		$instance['linked_in'] 		= $new_instance['linked_in'];
		$instance['pinterest'] 		= $new_instance['pinterest'];
		$instance['youtube'] 		= $new_instance['youtube'];
		$instance['tumblr'] 		= $new_instance['tumblr'];
		$instance['flickr'] 		= $new_instance['flickr'];
		$instance['email'] 			= $new_instance['email'];
		$instance['rss'] 			= $new_instance['rss'];
		$instance['github'] 		= $new_instance['github'];
		$instance['skype'] 			= $new_instance['skype'];
		$instance['vkontakte'] 		= $new_instance['vkontakte'];
		$instance['mix'] 			= $new_instance['mix'];
		$instance['dropbox'] 		= $new_instance['dropbox'];
		$instance['soundcloud'] 	= $new_instance['soundcloud'];

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, 
			array( 	
				'title' 		=> '', 
				'content' 		=> '', 
				'twitter' 		=> '',
				'facebook' 		=> '',
				'instagram' 	=> '',
				'behance' 		=> '',
				'dribbble' 		=> '',
				'linked_in' 	=> '',
				'pinterest' 	=> '',
				'youtube' 		=> '',
				'tumblr' 		=> '',
				'flickr' 		=> '',
				'email' 		=> '',
				'rss' 			=> '',
				'github' 		=> '',
				'skype' 		=> '',
				'vkontakte' 	=> '',
				'mix' 			=> '',
				'dropbox' 		=> '',
				'soundcloud' 	=> ''
			) 
		);

		$title 					= strip_tags( $instance['title'] );
		$content 				= strip_tags( $instance['content'] );
		$show_logo 				= isset( $instance['show_logo'] ) ? (bool) $instance['show_logo'] : true;
		
		$values['twitter'] 		= $instance['twitter'];
		$values['facebook'] 	= $instance['facebook'];
		$values['instagram'] 	= $instance['instagram'];
		$values['behance'] 		= $instance['behance'];
		$values['dribbble'] 	= $instance['dribbble'];
		$values['linked_in'] 	= $instance['linked_in'];
		$values['pinterest'] 	= $instance['pinterest'];
		$values['youtube'] 		= $instance['youtube'];
		$values['tumblr'] 		= $instance['tumblr'];
		$values['flickr'] 		= $instance['flickr'];
		$values['email'] 		= $instance['email'];
		$values['rss'] 			= $instance['rss'];
		$values['github'] 		= $instance['github'];
		$values['skype'] 		= $instance['skype'];
		$values['vkontakte'] 	= $instance['vkontakte'];
		$values['mix'] 		    = $instance['mix'];
		$values['dropbox'] 		= $instance['dropbox'];
		$values['soundcloud'] 	= $instance['soundcloud'];
		?>
		<p>
			<label class="widefat" for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<?php esc_html_e( 'Title:', 'naxos-addons' ) ?>
				<input 
					class="widefat" type="text" 
					id="<?php echo esc_attr($this->get_field_id('title')); ?>"
					name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
					value="<?php echo esc_attr($title); ?>" 
				/>
			</label>
		</p>
		<p>
			<label class="widefat" for="<?php echo esc_attr($this->get_field_id('content')); ?>">
				<?php esc_html_e( 'Content:', 'naxos-addons' ) ?>
				<textarea 
					class="widefat" rows="3" 
					id="<?php echo esc_attr($this->get_field_id('content')); ?>" 
					name="<?php echo esc_attr($this->get_field_name('content')); ?>"
				><?php echo wp_kses_post($content); ?></textarea>
			</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_logo ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_logo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_logo' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id( 'show_logo' )); ?>"><?php esc_html_e( 'Display logo?', 'naxos-addons' ); ?></label>
		</p>

		<?php foreach ($values as $arg => $value) { ?>
			<p>
				<label class="widefat" for="<?php echo esc_attr($this->get_field_id($arg)); ?>">
					<?php echo esc_attr($this->titles[$arg]); ?> <?php esc_html_e( 'Link:', 'naxos-addons' ); ?> 
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id($arg)); ?>" 
						name="<?php echo esc_attr($this->get_field_name($arg)); ?>" 
						type="text" 
						value="<?php echo esc_attr($value); ?>" 
					/>					
				</label>
			</p>
		<?php }
	}
}

/*
 * Categories
 */
class Naxos_Recent_Posts_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array (
			'classname' 	=> 'widget_recent_entries2', 
			'description' 	=> esc_html__( "Your site's most recent posts.", 'naxos' ) 
		);
		
		parent::__construct( 'recent-posts', esc_html__( 'Naxos Recent Posts Widget', 'naxos' ), $widget_ops );
	}

	public function widget($args, $instance) {
		extract($args);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		if ( $title == '' ) $title = esc_html__( "Recent Posts", "naxos" );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) $number = 3;
		
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : true;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ( $r->have_posts() ) :
	?>
		<?php echo wp_kses_post($before_widget); ?>
		<?php if ( $title ) echo wp_kses_post($before_title)  . esc_attr($title)  . wp_kses_post($after_title); ?>
		
		<?php
			$count = 0;
			$show_image = true;
			$cls = "";
		
			while ( $r->have_posts() ) : 
				$r->the_post();
				$count ++;
		
				if ( ! ( $show_image && ( has_post_thumbnail() || get_post_format( get_the_ID() ) == "image" ) ) ) {
					$show_image = false;
					$cls = "recent-post-border";
				}
		?>
			<div class="recent-post <?php echo esc_attr( $cls ); ?>">
				
				<?php if ( $show_image && ( has_post_thumbnail() || get_post_format( get_the_ID() ) == "image" ) ) { ?>
					<div class="recent-post-image" data-count="<?php echo $count; ?>">
						<a href="<?php the_permalink(); ?>">			
							<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( array(80, 80) );
								} else {
									$format = get_post_format( get_the_ID() );

									if ($format == "image") {
										$img = get_post_meta( get_the_ID(), 'upload_image', true ); 
										$img = str_replace( 'http://', '', $img );
										echo wp_get_attachment_image( $img , array(80, 80) );
									}
								}
							?>					
						</a>
					</div>
				<?php } ?>
									
				<div class="recent-post-info">					
					<h6>
						<a class='post-title' href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h6>
					
					<?php if ( $show_date ) : ?>
						<p><?php the_time(get_option( 'date_format' )); ?></p>
					<?php endif; ?>					
				</div>
				
			</div>
		<?php endwhile; ?>
		
		<?php echo wp_kses_post($after_widget); ?>
	<?php
		//Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['number'] 	= (int) $new_instance['number'];
		$instance['show_date'] 	= isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'naxos' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'naxos' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?', 'naxos' ); ?></label></p>
	<?php
	}
}

//Register custom widgets
if (!function_exists('naxos_register_widgets')) {
	function naxos_register_widgets() {
		register_widget( "Naxos_Social_Links_Widget" );
		register_widget( "Naxos_Recent_Posts_Widget" );
	}

	add_action( 'widgets_init', 'naxos_register_widgets', 1 );
}
?>