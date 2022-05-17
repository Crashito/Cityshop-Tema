<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
$sinrato_blog_main_extra_class = NULl;
if($sinrato_blogsidebar=='left') {
	$sinrato_blog_main_extra_class = 'order-lg-last';
}
$main_column_class = NULL;
switch($sinrato_bloglayout) {
	case 'nosidebar':
		$sinrato_blogclass = 'blog-nosidebar';
		$sinrato_blogcolclass = 12;
		$sinrato_blogsidebar = 'none';
		Sinrato_Class::sinrato_post_thumbnail_size('sinrato-post-thumb');
		break;
	case 'largeimage':
		$sinrato_blogclass = 'blog-large';
		$sinrato_blogcolclass = 9;
		$main_column_class = 'main-column';
		Sinrato_Class::sinrato_post_thumbnail_size('sinrato-post-thumbwide');
		break;
	case 'grid':
		$sinrato_blogclass = 'grid';
		$sinrato_blogcolclass = 9;
		$main_column_class = 'main-column';
		Sinrato_Class::sinrato_post_thumbnail_size('sinrato-post-thumbwide');
		break;
	default:
		$sinrato_blogclass = 'blog-sidebar';
		$sinrato_blogcolclass = 9;
		$main_column_class = 'main-column';
		Sinrato_Class::sinrato_post_thumbnail_size('sinrato-post-thumb');
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
			<div class="col-12 <?php echo 'col-lg-'.$sinrato_blogcolclass; ?> <?php echo ''.$main_column_class; ?> <?php echo esc_attr($sinrato_blog_main_extra_class);?>">
				<div class="page-content blog-page blogs <?php echo esc_attr($sinrato_blogclass); if($sinrato_blogsidebar=='left') {echo ' left-sidebar'; } if($sinrato_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<header class="entry-header">
						<header class="entry-header">
							<h2 class="entry-title"><?php the_archive_title(); ?></h2>
						</header>
					</header>
					<?php if ( have_posts() ) : ?>
						<?php
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							 *
							 * We reset this later so we can run the loop
							 * properly with a call to rewind_posts().
							 */
							the_post();
						?>
						<?php
						// If a user has filled out their description, show a bio on their entries.
						if ( get_the_author_meta( 'description' ) ) : ?>
							<div class="archive-header">
								<h3 class="archive-title"><?php printf( esc_html__( 'Author Archives: %s', 'sinrato' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '">' . get_the_author() . '</a></span>' ); ?></h3>
								<div class="author-info archives">
									<div class="author-avatar">
										<?php
										/**
										 * Filter the author bio avatar size.
										 *
										 * @since Sinrato 1.0
										 *
										 * @param int $size The height and width of the avatar in pixels.
										 */
										$author_bio_avatar_size = apply_filters( 'sinrato_author_bio_avatar_size', 68 );
										echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
										?>
									</div><!-- .author-avatar -->
									<div class="author-description">
										<h2><?php printf( esc_html__( 'About %s', 'sinrato' ), get_the_author() ); ?></h2>
										<p><?php the_author_meta( 'description' ); ?></p>
									</div><!-- .author-description	-->
								</div><!-- .author-info -->
							</div><!-- .archive-header -->
						<?php endif; ?>
						<?php
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
						?>
						<div class="post-container">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
						</div>
						<?php Sinrato_Class::sinrato_pagination(); ?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
 	<!-- brand logo -->
 	<?php 
 		if(isset($sinrato_opt['inner_brand']) && function_exists('sinrato_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
 			if($sinrato_opt['inner_brand'] && isset($sinrato_opt['brand_logos'][0]) && $sinrato_opt['brand_logos'][0]['thumb']!=null) { ?>
 				<div class="inner-brands">
 					<div class="container">
 						<?php if(isset($sinrato_opt['inner_brand_title']) && $sinrato_opt['inner_brand_title']!=''){ ?>
 							<div class="heading-title style1 ">
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