<?php global $naxos_config; ?>

<?php if ( have_posts( ) ) : ?>
	<?php global $more; $more = 0; ?>
	<?php 
		while ( have_posts( ) ) : 
			the_post( );
	?>
		<?php 
			// Single blog post
			if ( is_single( ) ) : 
		?>
			
			<!-- Blog content -->
			<article class="row blog-post">
							
				<div class="col-12">
					<?php echo apply_filters( 'the_content', wpautop( get_the_content( esc_html__( 'Read More', 'naxos' ) ) ) ); ?>
				
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'naxos' ),
							'after'  => '</div>',
							'link_before' => '',
							'link_after' => '',
							'next_or_number' => 'number',
							'pagelink' => '%',
							'echo' => 1
						) );
					?>
				</div>
				
			</article>

			<?php if ( ! post_password_required( ) ) { ?>
				<!-- Post footer -->
				<div class="post-footer single-post-footer clearfix">
					
					<!-- Post tags -->
					<?php echo get_the_tag_list( '<div class="tagcloud">', esc_html__( ' ', 'naxos' ), '</div>' ); ?>

					<!-- Share -->
					<?php 
						if ( ( $naxos_config['allow-share-posts'] ) and class_exists( 'Naxos_Shortcodes' ) ) :
							echo Naxos_Shortcodes::share( get_the_title( ), get_the_post_thumbnail_url( 'post-thumbnail' ), get_permalink( ) );
						endif;
					?>
					
					<!-- Post counters -->
					<ul class="post-counters hidden-xs">
						
						<?php if ( get_comments_number( ) ) { ?>
							<li>
								<?php comments_popup_link('<i class="far fa-comment"></i> 0', '<i class="far fa-comment"></i> 1', '<i class="far fa-comment"></i> %'); ?>
							</li>
						<?php } ?>
						
						<?php if ( function_exists( 'get_simple_likes_button' ) ) { ?>
							<li>
								<?php echo get_simple_likes_button( get_the_ID( ) ); ?>
							</li>
						<?php } ?>
						
					</ul>
					
				</div>
			<?php } ?>

			<!-- Author -->
			<?php 
				$show_author = false;

				if ( $naxos_config['show-post-author'] and get_the_author_meta( 'description', $user_ID ) ) { 
					$show_author = true;
				?>
				<?php if ( ! post_password_required() ) { ?>
					<!-- Delimiter -->
					<hr />
				<?php } ?>

				<div class="post-author text-center">

					<div class="avatar">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $user_ID ) ); ?>">
							<?php echo str_replace( ' photo', '', str_replace( ' avatar', '', get_avatar( get_the_author_meta( 'email', $user_ID ) , $size='100', '', '', $args = array( 'class' => array( 'avatar-100 rounded-circle' ) ) ) ) ); ?>
						</a>
					</div>

					<div class="description">
						<span><?php esc_html_e( 'About Author', 'naxos' ); ?></span>
						<h4>							
							<?php 
								$author = '';

								if ( ! get_the_author_meta( 'first_name', $user_ID ) && ! get_the_author_meta( 'last_name', $user_ID ) ) { 
									$author = get_the_author_meta( 'nickname', $user_ID ); 
								} else { 
									$author = get_the_author_meta( 'first_name', $user_ID ) . ' ' . get_the_author_meta( 'last_name', $user_ID ); 
								}

								$author = '<a href="' . get_author_posts_url( get_the_author_meta( 'ID', $user_ID ) ).'">' . $author . '</a>';

								echo wp_kses_post( $author );
							?>
						</h4>
						<p><?php echo get_the_author_meta( 'description', $user_ID ); ?></p>
					</div>

				</div>
			<?php } ?>

			<!-- Prev/Next posts -->
			<?php							
				// Previous post
				$img_prev = false;
				$prev_post = get_adjacent_post( false, '', true );
				
				if ( ! empty( $prev_post ) ) {
					$img_prev = get_the_post_thumbnail( $prev_post->ID, 'thumbnail' );
				}

				// Next post
				$img_next = false;
				$next_post = get_adjacent_post( false, '', false );

				if ( ! empty( $next_post ) ) {
					$img_next = get_the_post_thumbnail( $next_post->ID, 'thumbnail' );
				}

				if ( ( ! empty( $prev_post ) && $img_prev ) || ( ! empty( $next_post ) && $img_next ) ) {
			?>
				<?php if ( ! $show_author ) { ?>
					<!-- Delimiter -->
					<hr />
				<?php } ?>

				<div class="post-navigation-wrapper">

					<div class="row divider">
						<div class="col-12">

							<?php
								the_post_navigation(array(
									'prev_text' => $img_prev . '<div><span>' . esc_html__( 'Previous Article', 'naxos' ) . '</span>%title</div>',
									'next_text' => $img_next . '<div><span>' . esc_html__( 'Next Article', 'naxos' ) . '</span>%title</div>'
								));
							?>

						</div>
					</div>

				</div>
			<?php } ?>

			<!-- Comments -->
			<?php if ( $naxos_config['show-comments'] ) : ?>
				<?php if ( get_comments_number( get_the_ID( ) ) > 0 && ! post_password_required( ) ) { ?>
					<!-- Delimiter -->
					<hr />
				<?php } ?>

				<?php comments_template( '', true ); ?>
			<?php endif; ?>

		<?php 
			else :
			// Blog posts
		?>
			
			<!-- Blog post -->
			<article class="row blog-post">
				<div class="col-12">
					<div <?php post_class(); ?>>
					
						<header>
							
							<h3>
								<?php the_title( sprintf( '<a href="%s">', esc_url( get_permalink() ) ), '</a>' );?>
							</h3>
							
							<div class="info">
								
								<span>
									<?php 
										$author = '';

										if ( ! get_the_author_meta( 'first_name', $user_ID ) && ! get_the_author_meta( 'last_name', $user_ID ) ) { 
											$author = get_the_author_meta( 'nickname', $user_ID ); 
										} else { 
											$author = get_the_author_meta( 'first_name', $user_ID ) . ' ' . get_the_author_meta( 'last_name', $user_ID ); 
										}

										$author = '<a href="' . get_author_posts_url( get_the_author_meta( 'ID', $user_ID ) ).'">' . $author . '</a>';

										echo wp_kses_post( $author );
									?>
								</span>
								
								<?php 
									$category = get_the_category( );

									if ( ! empty( $category ) ) :
								?>							
									<span>
										<?php the_category(' / '); ?>
									</span>
								<?php endif; ?>
								
								<span>
									<?php echo get_the_time( get_option( 'date_format' ) ); ?>
								</span>							
							
							</div>
							
						</header>
						
						<?php if ( has_post_thumbnail( ) ) : ?>
							<figure>
								<a href="<?php the_permalink( ); ?>">
									<?php the_post_thumbnail( 'post-thumbnail', array('class' => 'img-responsive img-rounded') ); ?>
								</a>
							</figure>
						<?php endif; ?>
						
						<div class="post-content">
							<p><?php echo wp_trim_words( get_the_excerpt( ), intval( $naxos_config['excerpt-length'] ) ); ?></p>
						</div>
						
						<div class="post-footer clearfix">
							
							<ul class="post-meta">
								
								<li class="post-like d-none d-md-block">
									<!-- Post counters -->
									<ul class="post-counters">

										<?php if ( get_comments_number( ) ) { ?>
											<li>										
												<i class="far fa-comment"></i> <?php comments_popup_link('0', '1', '%'); ?>
											</li>
										<?php } ?>

										<?php if ( function_exists( 'get_simple_likes_button' ) ) { ?>
											<li>
												<?php echo get_simple_likes_button( get_the_ID( ) ); ?>
											</li>
										<?php } ?>

									</ul>
								</li>
							
								<li class="post-read-more">
									<!-- Read more -->
									<a href="<?php echo get_permalink( ); ?>" class="btn btn-default">
										<?php esc_html_e( 'Read More', 'naxos' ); ?>
									</a>
								</li>
								
								<li class="post-share d-none d-md-block">
									<?php 
										if ( ( $naxos_config['allow-share-posts'] ) and class_exists( 'Naxos_Shortcodes' ) ) :											
											echo Naxos_Shortcodes::share( true, get_the_title( ), get_the_post_thumbnail_url( get_the_ID( ), 'full' ), get_permalink( ) );
										endif;
									?>
								</li>								

							</ul>
							
						</div>
						
					</div>
				</div>
			</article>

		<?php endif; ?>

	<?php endwhile; ?>
<?php else : ?>
	<h2><?php esc_html_e( 'Nothing Found!', 'naxos' ); ?></h2>
	
	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'naxos' ); ?></p>
	
	<div class="empty-20"></div>

	<div class="search-wrapper">
		<?php get_search_form(); ?>
	</div>
<?php endif; ?>