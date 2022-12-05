<?php global $naxos_config; ?>
<?php get_header( ); ?>

<!-- Primary header -->
<section class="page-title valign parallax" 
		 data-image="<?php echo ( ! empty( $naxos_config['header-bgimage']['url'] ) ? esc_url( $naxos_config['header-bgimage']['url'] ) : '' ); ?>"
>

	<?php if ( ! empty( $naxos_config['header-bgimage']['url'] ) ) { ?>
		<!-- Overlay -->
		<div class="overlay"></div>	
	<?php } ?>
	
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">

				<!-- Title -->
				<h1 id="blog-title"><?php esc_html_e( 'Search Results', 'naxos' ); ?></h1>
				<p class="blog-info info"><?php echo get_search_query(); ?></p>

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