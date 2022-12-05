<?php global $naxos_config; ?>

		<!-- Footer -->
		<footer>
			
			<?php if( is_active_sidebar( 'footer' ) ) { ?>
				<!-- Widgets -->
				<div class="footer-widgets">
					<div class="container">

						<div class="row">

							<?php dynamic_sidebar( 'footer' ); ?>

						</div>

					</div>
				</div>
			<?php } ?>
            
            <!-- Copyright -->
			<div class="footer-copyright">				
				<div class="container">
					
					<div class="row">						
						<div class="col-12">
							
							<!-- Text -->
                            <p class="copyright text-center">
								<?php echo do_shortcode( wp_kses_post( $naxos_config['copyright-text'] ) ); ?>
                            </p>
							
						</div>
					</div>
					
				</div>				
			</div>
			
		</footer>

		<?php if ( $naxos_config['footer-button-top'] or $naxos_config === null ) : ?>
			<!-- Back to top -->
			<a href="#top-page" class="to-top">
				<div class="icon icon-arrows-up"></div>
			</a>
		<?php endif; ?>

		<?php Naxos_Theme::naxos_inline_scripts( get_the_ID( ) ); ?>

		<?php wp_footer( ); ?>

	</body>
</html>