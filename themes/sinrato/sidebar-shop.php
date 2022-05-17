<?php
/**
 * The sidebar for shop page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Sinrato_Theme
 * @since Sinrato 1.0
 */
$sinrato_opt = get_option( 'sinrato_opt' );
$shopsidebar = 'left';
if(isset($sinrato_opt['sidebarshop_pos']) && $sinrato_opt['sidebarshop_pos']!=''){
	$shopsidebar = $sinrato_opt['sidebarshop_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
}
$sinrato_shop_sidebar_extra_class = NULl;
if($shopsidebar=='left') {
	$sinrato_shop_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 sidebar-shop <?php echo esc_attr($sinrato_shop_sidebar_extra_class);?>">
		<?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</div>
<?php endif; ?>