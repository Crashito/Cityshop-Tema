<?php
/**
 * Template Name: Front Page Template
 *
 * Description: Front Page Template
 *
 * @package WordPress
 * @subpackage Sinrato
 * @since Sinrato 1.0
 */

$sinrato_opt = get_option( 'sinrato_opt' );
get_header();
?>
<div class="main-container front-page"> 
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?> 
</div>
<?php get_footer(); ?>