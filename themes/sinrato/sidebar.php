<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Sinrato_Theme
 * @since Sinrato 1.0
 */
$sinrato_opt = get_option( 'sinrato_opt' );
$sinrato_blogsidebar = 'right';
if(isset($sinrato_opt['sidebarblog_pos']) && $sinrato_opt['sidebarblog_pos']!=''){
	$sinrato_blogsidebar = $sinrato_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$sinrato_blogsidebar = $_GET['sidebar'];
}
$sinrato_blog_sidebar_extra_class = NULl;
if($sinrato_blogsidebar=='left') {
	$sinrato_blog_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($sinrato_blog_sidebar_extra_class);?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>