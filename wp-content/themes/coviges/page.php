<?php global $naxos_config; ?>

<?php 
    $page_id = get_the_ID( );
    $subtitle = get_post_meta( $page_id, 'subtitle', true ); 
    $bg_image = ( has_post_thumbnail( $page_id ) ? esc_url( get_the_post_thumbnail_url( $page_id ) ) : '' );
	$custom_page = ! empty( $subtitle ) ? true : false;
?>

<?php get_header( ); ?>

<!-- Primary header -->
<section class="page-title valign parallax" 
		 data-image="<?php echo esc_url( $bg_image ); ?>"
>

	<?php if ( ! empty( $bg_image ) ) { ?>
		<!-- Overlay -->
		<div class="overlay"></div>	
	<?php } ?>
	
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">

				<!-- Title -->
				<h1 class="blog-title"><?php Naxos_Theme::naxos_page_title( ); ?></h1>
				
				<?php if ( ! empty( $subtitle ) ) : ?>
					<p class="blog-info info"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>	

			</div>
		</div>
	</div>

</section>

<!-- Page -->
<?php 
	if ( have_posts( ) ) : 
		while ( have_posts( ) ) : 
			the_post( );
?>

	<?php if ( ! $custom_page ) : ?>
		<section class="page">
			<div class="container">
				<div class="row">

					<!-- Content -->
					<div class="col-12">	
	<?php endif; ?>
					
	<?php the_content( ); ?>
						
	<?php
		$link_pages = wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'naxos' ),
			'after'  => '</div>',
			'link_before' => '',
			'link_after' => '',
			'next_or_number' => 'number',
			'pagelink' => '%',
			'echo' => 0
		) );

		if ( $link_pages or ( comments_open( ) and is_singular( ) ) ) : 
	?>
		
		<?php if ( $custom_page ) : ?>			
			<section>
				<div class="container">
					<div class="row">

						<!-- Content -->
						<div class="col-12">
		<?php endif; ?>

			<?php echo wp_kses_post( $link_pages ); ?>

			<?php if ( comments_open( ) and is_singular( ) ) : ?>
				<?php comments_template( ); ?>
			<?php endif; ?>

		<?php if ( $custom_page ) : ?>			
						</div>

					</div>
				</div>
			</section>
		<?php endif; ?>
						
	<?php endif; ?>
						
	<?php if ( ! $custom_page ) : ?>
					</div>

				</div>
			</div>
		</section>		
	<?php endif; ?>	

<?php 
		endwhile; 
	endif; 
?>		

<?php get_footer( ); ?>