<?php
// Body Background Color
if ( ! empty( $naxos_config['body-bgcolor'] ) && strtolower( $naxos_config['body-bgcolor'] ) != $naxos_default['body-bgcolor'] ) {
?>
body {
	background:<?php echo esc_attr( $naxos_config['body-bgcolor'] ); ?>;
}
<?php } ?>

<?php
// Header Background Color
if ( ! empty( $naxos_config['header-bgcolor'] ) && strtolower( $naxos_config['header-bgcolor'] ) != $naxos_default['header-bgcolor'] ) {
?>
header {
	background:<?php echo esc_attr( $naxos_config['header-bgcolor'] ); ?>;
}
<?php } ?>

<?php
// Footer Background Color
if ( ! empty( $naxos_config['footer-bgcolor'] ) && strtolower( $naxos_config['footer-bgcolor'] ) != $naxos_default['footer-bgcolor'] ) {
?>
footer {
	background:<?php echo esc_attr( $naxos_config['footer-bgcolor'] ); ?>;
}
<?php } ?>

<?php
// Page Loader Background Color
if ( ! empty( $naxos_config['loader-bgcolor'] ) && strtolower( $naxos_config['loader-bgcolor'] ) != $naxos_default['loader-bgcolor'] ) {
?>
.preloader {
	background-color:<?php echo esc_attr( $naxos_config['loader-bgcolor'] ); ?>;
}
<?php } ?>

<?php
// Primary font
if ( $naxos_config['typography-content']['font-family'] != $naxos_config['typography-content']['font-family'] ) {
?>
body,
h1, h2, h3, h4, h5, h6,
.form-control,
.btn-search {
	font-family:"<?php echo esc_attr( $naxos_config['typography-content']['font-family'] ); ?>", sans-serif;
}
<?php } ?>

<?php 
// Font size
if ( intval( $naxos_config['typography-content']['font-size'] ) != intval( $naxos_config['typography-content']['font-size'] ) ) {
?>
body,
.btn,
.checkout-button,
.wp-block-button__link,
.wp-block-search__button,
input.btn,
input.search-submit,
.nav-menu li a,
.search-wrapper span,
.testimonial-carousel .carousel-images .slick-slide .client-info h3,
.team-member .team-details .title,
.team-member .team-social-inner > a,
.share-btn > p > i,
.post-counters li > a > i,
.nav-links,
.author-social i,
footer .widget_social a > i {
	font-size:<?php echo intval( $naxos_config['typography-content']['font-size'] ); ?>px;
}
<?php } ?>

<?php
// H1
if ( $naxos_config['typography-headers-h1']['font-family'] != $naxos_default['typography-headers-h1']['font-family'] ) {
?>
h1, .h1 {
	font-family:"<?php echo esc_attr( $naxos_config['typography-headers-h1']['font-family'] ); ?>", sans-serif;
	<?php if ( intval( $naxos_config['typography-headers-h1']['font-size'] ) != intval( $naxos_default['typography-headers-h1']['font-size'] ) ) { ?>
	font-size:<?php echo intval( $naxos_config['typography-headers-h1']['font-size'] ); ?>px !important;
	<?php } ?>
}
<?php } ?>

<?php
// H2
if ( $naxos_config['typography-headers-h2']['font-family'] != $naxos_default['typography-headers-h2']['font-family'] ) {
?>
h2, .h2 {
	font-family:"<?php echo esc_attr( $naxos_config['typography-headers-h2']['font-family'] ); ?>", sans-serif;
	<?php if ( intval( $naxos_config['typography-headers-h2']['font-size'] ) != intval( $naxos_default['typography-headers-h2']['font-size'] ) ) { ?>
	font-size:<?php echo intval( $naxos_config['typography-headers-h1']['font-size'] ); ?>px !important;
	<?php } ?>
}
<?php } ?>

<?php
// H3
if ( $naxos_config['typography-headers-h3']['font-family'] != $naxos_default['typography-headers-h3']['font-family'] ) {
?>
h3, .h3 {
	font-family:"<?php echo esc_attr( $naxos_config['typography-headers-h3']['font-family'] ); ?>", sans-serif;
	<?php if ( intval( $naxos_config['typography-headers-h3']['font-size'] ) != intval( $naxos_default['typography-headers-h3']['font-size'] ) ) { ?>
	font-size:<?php echo intval( $naxos_config['typography-headers-h3']['font-size'] ); ?>px !important;
	<?php } ?>
}
<?php } ?>

<?php
// H4
if ( $naxos_config['typography-headers-h4']['font-family'] != $naxos_default['typography-headers-h4']['font-family'] ) {
?>
h4, .h4 {
	font-family:"<?php echo esc_attr( $naxos_config['typography-headers-h4']['font-family'] ); ?>", sans-serif;
	<?php if ( intval( $naxos_config['typography-headers-h4']['font-size'] ) != intval( $naxos_default['typography-headers-h4']['font-size'] ) ) { ?>
	font-size:<?php echo intval( $naxos_config['typography-headers-h4']['font-size'] ); ?>px !important;
	<?php } ?>
}
<?php } ?>

<?php
// H5
if ( $naxos_config['typography-headers-h5']['font-family'] != $naxos_default['typography-headers-h5']['font-family'] ) {
?>
h5, .h5 {
	font-family:"<?php echo esc_attr( $naxos_config['typography-headers-h5']['font-family'] ); ?>", sans-serif;
	<?php if ( intval( $naxos_config['typography-headers-h5']['font-size'] ) != intval( $naxos_default['typography-headers-h5']['font-size'] ) ) { ?>
	font-size:<?php echo intval( $naxos_config['typography-headers-h5']['font-size'] ); ?>px !important;
	<?php } ?>
}
<?php } ?>

<?php
// H6
if ( $naxos_config['typography-headers-h6']['font-family'] != $naxos_default['typography-headers-h6']['font-family'] ) {
?>
h6, .h6 {
	font-family:"<?php echo esc_attr( $naxos_config['typography-headers-h6']['font-family'] ); ?>", sans-serif;
	<?php if ( intval( $naxos_config['typography-headers-h6']['font-size'] ) != intval( $naxos_default['typography-headers-h6']['font-size'] ) ) { ?>
	font-size:<?php echo intval( $naxos_config['typography-headers-h6']['font-size'] ); ?>px !important;
	<?php } ?>
}
<?php } ?>

<?php
// Color schema
if ( $naxos_config['styling-schema'] == 'none' ) {
	$primary_color = $naxos_config['primary-color'];
	$secondary_color = $naxos_config['secondary-color'];
	$gradient_color = $naxos_config['gradient-color'];
	
	// RGB
	$primary_color_rgb = Naxos_Theme::naxos_hex2rgb( $primary_color );
?>
a,
h1 > a:hover, 
h2 > a:hover, 
h3 > a:hover, 
h4 > a:hover, 
h5 > a:hover, 
h6 > a:hover,
.custom-btn,
.play-btn:hover > i,
.button-store .custom-btn:hover i,
.button-store .custom-btn:hover p,
.button-store .custom-btn:hover p em,
.feature-box .box-icon .icon,
.feature-box:hover .box-text > h4,
.service-single:hover .icon,
.service-single.service-style-2 .icon,
.service-single.service-style-2:hover .icon,
.service-single.service-style-2:hover h5,
.overview-box:hover .icon,
.overview-list .fa-li,
.pricing-item .pricing-head .price,
.pricing-item .pricing-head .price .dollar-sign,
.op-mobile-menu .nav-menu li a:hover,
.fixed-menu .nav-menu li a.active,
.fixed-menu .nav-menu li.current_page_item > a,
.fixed-menu .nav-menu li.current_page_parent > a,
.page-header .page-header-content .breadcrumb li a:hover,
.testimonial-carousel .carousel-text .single-box i,
.accordion .card-header a:not(.collapsed),
.accordion .card-header a:hover,
.blog-home .blog-col:hover .blog-text h4 > a,
.price-table .icon,
.price-table:hover .plan-type,
.contact-info .icon,
footer a:hover,
footer .widget_social a:hover > i,
.blog-post .image-slider .arrows .arrow:hover,
.post-counters li a:hover,
.share-btn:hover > p,
.share-btn li:hover > a,
.share-btn li:hover > a > i,
.nav-links a:hover,
.widget ul li a:hover,
.sidebar .search-form button:hover,
.sidebar .search-form button:focus,
.comment-respond h3 small > a,
.author-social a:hover,
.wp-block-pullquote__citation,
.wp-block-pullquote cite,
.wp-block-pullquote footer,
.icon.colored i {
	color:<?php echo esc_attr( $primary_color ); ?>;
}

.fixed-menu .nav-menu li a:hover,
.wpcf7 form.sent .wpcf7-response-output,
.is-style-outline .wp-block-button__link {
	color:<?php echo esc_attr( $primary_color ); ?> !important;
}

.custom-btn,
.price-table.plan-popular,
.service-single.service-style-2:hover,
.testimonial-carousel .carousel-images .slick-center img,
.clients-slider .owl-dots .owl-dot span,
.screenshot-slider .owl-dots .owl-dot span,
.progress-heading .progress-value > span:before {
	border-color:<?php echo esc_attr( $primary_color ); ?>;
}

input:focus, 
textarea:focus,
input.notice, 
textarea.notice,
.is-style-outline .wp-block-button__link {
	border-color:<?php echo esc_attr( $primary_color ); ?> !important;
}

.is-style-outline .wp-block-button__link:hover {
	border-color:<?php echo esc_attr( $secondary_color ); ?> !important;
}

.page-loader .progress,
.wp-block-pullquote blockquote {
	border-left-color:<?php echo esc_attr( $primary_color ); ?>;
}

.user-comment.bypostauthor .user-comment-inner:after {
	border-top-color:<?php echo esc_attr( $primary_color ); ?>;
}

.banner:before {
	background:linear-gradient(-47deg, <?php echo esc_attr( $gradient_color['from'] ); ?> 0%, <?php echo esc_attr( $gradient_color['to'] ); ?> 100%);
}

.btn,
.to-top:hover,
.play-btn,
.service-single:hover,
.service-single .icon,
.overview-box .icon,
.overview-box:hover,
.fixed-menu .nav-menu li a.active span:after,
.fixed-menu .nav-menu li.current_page_item > a span:after,
.fixed-menu .nav-menu li.current_page_parent > a span:after,
.nav-menu li.dropdown .submenu li a:hover,
.nav-menu li.menu-item-has-children .sub-menu li.current_page_item > a,
.nav-menu li.page_item_has_children .children li.current_page_item > a,
.nav-menu li.menu-item-has-children .sub-menu li a:hover,
.nav-menu li.page_item_has_children .children li a:hover,
.search-wrapper .search-close-btn:hover:before,
.search-wrapper .search-close-btn:hover:after,
.clients-slider .owl-dots .active span,
.screenshot-slider .owl-dots .active span,
.blog-home .blog-col:hover .blog-category,
.page-title .blog-category > a:hover,
.pagination li a.active, 
.pagination li a:hover,
.pagination li:last-child a,
.pagination li:first-child a,
.page-links .post-page-numbers.current,
.widget_categories li span,
.recent-post-image:before,
.author-social a:hover,
.member-info ul:after,
.progress .progress-bar,
.progress-heading .progress-value > span,
.tagcloud > a:hover,
blockquote {
	background-color:<?php echo esc_attr( $primary_color ); ?>;
}

.checkout-button,
.wp-block-button__link,
.wp-block-search__button,
input.btn,
input.search-submit {
	background-color:<?php echo esc_attr( $primary_color ); ?> !important;
}

.btn:hover,
#zoom-in:hover, 
#zoom-out:hover,
.pagination li a:hover,
.pagination li a.active,
.page-links .post-page-numbers:hover {
	background-color:<?php echo esc_attr( $secondary_color ); ?>;
}

.checkout-button:hover,
.wp-block-button__link:hover,
.wp-block-search__button:hover,
input.btn:hover,
input.search-submit:hover {
	background-color:<?php echo esc_attr( $secondary_color ); ?> !important;
}

#zoom-in, 
#zoom-out,
.team-member .team-social {
	background-color:rgba(<?php echo esc_attr( $primary_color_rgb ); ?>, 0.85);
}
<?php } ?>




