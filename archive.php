<?php
/**
 * The template for displaying the Resources page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aabaakwad
 */

get_header();

	function get_category_url_by_slug( $category_slug ) {
		return get_category_link( get_category_by_slug( $category_slug ) );
	}
?>
<div class="main-cont">
	<main id="primary" class="site-main main">
		<?php 
			if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>
				<!--<h1>Archives by Year</h1>-->
				<h1 style="margin-bottom: 5rem">Archive</h1>
			</header><!-- .page-header -->

		<?php
		/* Start the Loop */
			echo '<section class="list-cont">';
			while ( have_posts() ) :
				the_post();
		?>
		<article class="list-item__cont">
			<a href="<?php the_permalink() ?>" class="list-item__link">
				<div class="list-item__image"><?php echo get_the_post_thumbnail('', 'medium'); ?></div>
			
				<div class="list-item__title-cont">
					<h4><?php the_field('time'); ?></h4>
					<h4><?php the_title() ?></h4>
				</div>
			</a>
			<?php the_excerpt() ?>
			<a href="<?php the_permalink() ?>" class="list-item__btn">Learn More</a>
		</article>

		<?php
			endwhile;
			echo '</section>';
			

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
</div>
<?php
get_footer();
