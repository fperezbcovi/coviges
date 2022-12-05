<?php global $naxos_config; ?>

<?php 
    $bg_image = '';

	if ( ! empty( $naxos_config['header-bgimage']['url'] ) ) {
		$bg_image = $naxos_config['header-bgimage']['url'];
	}
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
				<?php if ( is_category( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Category Archive', 'naxos' ); ?></h1>
					<p class="blog-info info"><?php single_cat_title(); ?></p>
				<?php } elseif ( is_tag( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Posts Tagged', 'naxos' ); ?></h1>
					<p class="blog-info info"><?php single_tag_title(); ?></p>
				<?php } elseif ( is_day( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Archive', 'naxos' ); ?></h1>
					<p class="blog-info info"><?php printf( get_the_date( 'F jS, Y' ) ); ?></p>
				<?php } elseif ( is_month( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Archive for month', 'naxos' ); ?></h1>
					<p class="blog-info info"><?php printf( get_the_date( 'F, Y' ) ); ?></p>
				<?php } elseif ( is_year( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Archive for', 'naxos' ); ?></h1>
					<p class="blog-info info"><?php printf( get_the_date( 'Y' ) ); ?></p>
				<?php } elseif ( is_author( ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Author Archive', 'naxos' ); ?></h1>
				<?php } elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) { ?>
					<h1 class="blog-title"><?php esc_html_e( 'Blog Archives', 'naxos' ); ?></h1>
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