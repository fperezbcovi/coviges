<?php global $naxos_config; ?>
<?php get_header( ); ?>

<?php
    $bg_image = '';

	if ( ! empty( $naxos_config['header-bgimage']['url'] ) ) {
		$bg_image = $naxos_config['header-bgimage']['url'];
	}
?>

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
				<?php if ( ! empty( $naxos_config['blog-page-title'] ) ) { ?>
					<h1 class="blog-title"><?php echo esc_html( $naxos_config['blog-page-title'] ); ?></h1>
				<?php } else { ?>
					<h1 class="blog-title"><?php bloginfo( 'name' ); ?></h1>
				<?php } ?>
				
				<?php if ( ! empty( $naxos_config['blog-page-subtitle'] ) ) { ?>
					<p class="blog-info info"><?php echo esc_html( $naxos_config['blog-page-subtitle'] ); ?></p>
				<?php } else { ?>
					<p class="blog-info info"><?php bloginfo( 'description' ); ?></p>
				<?php } ?>
				
			</div>
		</div>
	</div>

</section>

<?php
	if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
		$naxos_config['layout-blog'] = 1;
	}
?>
	
<!-- Blog -->
<section class="blog">

	<!-- Container -->
	<div class="container">				
		<div class="row">
			
			<?php if ( $naxos_config['layout-blog'] == 3 ) : ?>
				<!-- Blog posts -->
				<div class="col-12 col-lg-8 res-margin">
					<?php get_template_part( 'templates/post' ); ?>
					<?php Naxos_Theme::naxos_nav_content( ); ?>
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
				
				<!-- Blog posts -->
				<div class="col-12 col-lg-8">
					<?php get_template_part( 'templates/post' ); ?>
					<?php Naxos_Theme::naxos_nav_content( ); ?>
				</div>
			<?php else : ?>
				<!-- Blog posts -->
				<div class="col-12 col-lg-12">
					<?php get_template_part( 'templates/post' ); ?>
					<?php Naxos_Theme::naxos_nav_content( ); ?>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
	
</section>

<?php get_footer( ); ?>