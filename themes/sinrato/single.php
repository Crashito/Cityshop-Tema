<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Sinrato_Theme
 * @since Sinrato 1.0
 */
$sinrato_opt = get_option( 'sinrato_opt' );
get_header();
$sinrato_bloglayout = 'sidebar';
if(isset($sinrato_opt['blog_layout']) && $sinrato_opt['blog_layout']!=''){
	$sinrato_bloglayout = $sinrato_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$sinrato_bloglayout = $_GET['layout'];
}
$sinrato_blogsidebar = 'right';
if(isset($sinrato_opt['sidebarblog_pos']) && $sinrato_opt['sidebarblog_pos']!=''){
	$sinrato_blogsidebar = $sinrato_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$sinrato_blogsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-1' ) )  {
	$sinrato_bloglayout = 'nosidebar';
}
switch($sinrato_bloglayout) {
	case 'nosidebar':
		$sinrato_blogclass = 'blog-nosidebar';
		$sinrato_blogcolclass = 12;
		$sinrato_blogsidebar = 'none';
		break;
	default:
		$sinrato_blogclass = 'blog-sidebar'; 
		$sinrato_blogcolclass = 9;
}
?>
<div class="main-container">
	<div class="breadcrumb-container">
		<div class="container">
			<?php Sinrato_Class::sinrato_breadcrumb(); ?> 
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 <?php echo 'col-lg-'.$sinrato_blogcolclass; ?>">
				<div class="page-content blog-page single <?php echo esc_attr($sinrato_blogclass); if($sinrato_blogsidebar=='left') {echo ' left-sidebar'; } if($sinrato_blogsidebar=='right') {echo ' right-sidebar'; } ?> ">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php
			$customsidebar = get_post_meta( $post->ID, '_sinrato_custom_sidebar', true );
			$customsidebar_pos = get_post_meta( $post->ID, '_sinrato_custom_sidebar_pos', true );
			if($customsidebar != ''){
				if($customsidebar_pos == 'left' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3 order-lg-last">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if($sinrato_blogsidebar=='left') {
					get_sidebar();
				}
			} ?>
			<?php
			if($customsidebar != ''){
				if($customsidebar_pos == 'right' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if($sinrato_blogsidebar=='right') {
					get_sidebar();
				}
			} ?>
		</div>
	</div> 
	<!-- brand logo -->
	<?php 
		if(isset($sinrato_opt['inner_brand']) && function_exists('sinrato_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
			if($sinrato_opt['inner_brand'] && isset($sinrato_opt['brand_logos'][0]) && $sinrato_opt['brand_logos'][0]['thumb']!=null) { ?>
				<div class="inner-brands">
					<div class="container">
						<?php if(isset($sinrato_opt['inner_brand_title']) && $sinrato_opt['inner_brand_title']!=''){ ?>
							<div class="title">
								<h3><?php echo esc_html( $sinrato_opt['inner_brand_title'] ); ?></h3>
							</div>
						<?php } ?>
						<?php echo do_shortcode('[ourbrands]'); ?>
					</div>
				</div>
			<?php }
		}
	?>
	<!-- end brand logo --> 
</div>
<?php get_footer(); ?>