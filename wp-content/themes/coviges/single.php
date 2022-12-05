<?php global $naxos_config; ?>
<?php get_header( ); ?>

<?php 
	if ( have_posts( ) ) : 
		while ( have_posts( ) ) : 
		the_post( );

		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID( ) ), 'full' );
		$bg = $thumb ? $thumb[0] : "";
?>
	<!-- Primary header -->
	<section id="post-<?php the_ID(); ?>" 
			 class="page-title valign parallax" 
			 data-image="<?php echo esc_url( $bg ); ?>">

		<!-- Overlay -->
		<div class="overlay"></div>	

		<!-- Container -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">

					<!-- Category -->
					<div class="blog-category">
						<?php the_category(' <span>•</span> '); ?>
					</div>

					<!-- Title -->
					<h1 class="blog-title">
						<?php the_title( ); ?>
					</h1>

					<!-- Date -->
					<div class="blog-date">
						 <?php echo get_the_time( get_option( 'date_format' ) ); ?>
					</div>

				</div>
			</div>
		</div>

	</section>
<?php endwhile; endif; ?>

<?php
	if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
		$naxos_config['layout-blog'] = 1;
	}
?>
	
<!-- Content -->
<section class="blog">

	<!-- Container -->
	<div class="container">				
		<div class="row">
			
			<?php if ( $naxos_config['layout-blog'] == 3 ) : ?>
				<!-- Single Post -->
				<div class="col-12 col-lg-8 res-margin">
					<?php get_template_part( 'templates/post' ); ?>
				</div>

				<!-- Sidebar -->
				<div class="col-12 col-lg-4">
					<?php get_sidebar( ); ?>
				</div>
			<?php elseif ( $naxos_config['layout-blog'] == 2 ) : ?>
				<!-- Sidebar -->
				<div class="col-12 col-lg-4 res-margin">
					<?php get_sidebar( ); ?>
				</div>
				
				<!-- Single Post -->
				<div class="col-12 col-lg-8">
					<?php get_template_part( 'templates/post' ); ?>
				</div>
			<?php else : ?>
				<!-- Single Post -->
				<div class="col-12 col-lg-12">
					<?php get_template_part( 'templates/post' ); ?>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
	
</section>

<?php get_footer( ); ?>