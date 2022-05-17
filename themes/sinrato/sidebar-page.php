<?php
/**
 * The sidebar for content page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Sinrato_Theme
 * @since Sinrato 1.0
 */
$sinrato_opt = get_option( 'sinrato_opt' );
$sinrato_page_sidebar_extra_class = NULl;
if($sinrato_opt['sidebarse_pos']=='left') {
	$sinrato_page_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($sinrato_page_sidebar_extra_class);?>">
	<?php dynamic_sidebar( 'sidebar-page' ); ?>
</div>
<?php endif; ?>