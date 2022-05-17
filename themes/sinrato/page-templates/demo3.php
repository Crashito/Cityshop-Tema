<?php
$_SESSION["preset"] = 3;
/**
 * Template Name: Demo 3
 *
 * Description: Demo 3
 *
 * @package WordPress
 * @subpackage Sinrato
 * @since Sinrato  1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php global $sinrato_opt; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
$jscomposer_templates_args = array(
	'orderby'          => 'title',
	'order'            => 'ASC',
	'post_type'        => 'templatera',
	'post_status'      => 'publish',
	'posts_per_page'   => 100,
);
$jscomposer_templates = get_posts( $jscomposer_templates_args );
if(count($jscomposer_templates) > 0) {
	foreach($jscomposer_templates as $jscomposer_template){
		if($jscomposer_template->post_title == 'Header 3' || $jscomposer_template->post_title == 'Footer 1'){
			$jscomposer_template_css = get_post_meta ( $jscomposer_template->ID, '_wpb_shortcodes_custom_css', false );
			if(isset($jscomposer_template_css[0])){
				echo '<style>'.esc_html($jscomposer_template_css[0]).'</style>';
			}
		}
	}
} ?>
<?php wp_head(); ?>
</head>
<body <?php body_class('home'); ?>>
	<div id="yith-wcwl-popup-message" style="display:none;"><div id="yith-wcwl-message"></div></div>
	<div class="wrapper">
		<div class="page-wrapper">
			<div class="header-container header-3 rs-active has-mobile-layout">  
			 	<div class="header">
					<div class="header-content">
						<?php
						if ( isset($sinrato_opt['header_layout']) && $sinrato_opt['header_layout']!="") {
							$jscomposer_templates_args = array(
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'templatera',
								'post_status'      => 'publish',
								'posts_per_page'      => 100,
							);
							$jscomposer_templates = get_posts( $jscomposer_templates_args );
							if(count($jscomposer_templates) > 0) {
								foreach($jscomposer_templates as $jscomposer_template){
									if($jscomposer_template->post_title == 'Header 3'){ ?>
										<div class="header-composer"> 
												<?php 
													echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
												?> 
										</div>
									<?php }
								}
							}
							// header mobile
							if ( isset($sinrato_opt['header_mobile_layout']) && $sinrato_opt['header_mobile_layout'] != "") {
								if(count($jscomposer_templates) > 0) {
									foreach($jscomposer_templates as $jscomposer_template){
										if($jscomposer_template->post_title == 'Header 1 Mobile'){ ?>
											<div class="header-mobile">
												<div class="container">
													<?php 
														echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
													?>
												</div>
											</div>
										<?php }
									}
								}
							}
							// header mobile
							if ( isset($sinrato_opt['sticky_header']) && $sinrato_opt['sticky_header']) {
								if(count($jscomposer_templates) > 0) {
									foreach($jscomposer_templates as $jscomposer_template){
										if($jscomposer_template->post_title == 'Header 1 Sticky'){ ?>
											<div class="header-sticky <?php if ( is_admin_bar_showing() ) {echo 'with-admin-bar';} ?>">
												<div class="container">
													<?php 
														echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
													?>
												</div>
											</div>
										<?php }
									}
								}
							}
						} 
						?>
					</div>
				</div>  
				<div class="clearfix"></div>
			</div>
			<div class="main-container front-page">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content"> 
								<?php the_content(); ?> 
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="footer footer-1"> 
					<?php
					if ( isset($sinrato_opt['footer_layout']) && $sinrato_opt['footer_layout']!="" ) {
						$jscomposer_templates_args = array(
							'orderby'          => 'title',
							'order'            => 'ASC',
							'post_type'        => 'templatera',
							'post_status'      => 'publish',
						);
						$jscomposer_templates = get_posts( $jscomposer_templates_args );
						if(count($jscomposer_templates) > 0) {
							foreach($jscomposer_templates as $jscomposer_template){
								if($jscomposer_template->post_title == 'Footer 1'){
									echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
								}
							}
						}
					}
					?> 
			</div>
		</div><!-- .page -->
	</div><!-- .wrapper -->
	<div id="back-top" class="hidden-xs hidden-sm hidden-md"></div>
	<?php wp_footer(); ?>
</body>
</html>
<?php unset($_SESSION["preset"]); ?>