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

			<header class="page-header">
				<?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>
				<h1>Archives by Category</h1>
			</header><!-- .page-header -->

		<?php
			$categories = get_categories();
			$current_category_id = get_queried_object()->term_id;
			
			if ( !empty($categories) ) :
		?>
			<section>
				<div class="filter-btns">
				<?php foreach( $categories as $category ) : 
					if ($category->slug != 'uncategorized') :
				?>
					<a href="<?= get_category_link($category->term_id); ?>" class="<?= ($category->term_id == $current_category_id) ? 'active' : '' ?>"><h3><?= $category->name ?></h3></a>
				<?php 
					endif;
				endforeach;
				?>
				</div>
			</section>
		<?php
			endif;
		
		/* Go back to Archived posts list
		/* Start the Loop */
		if (have_posts()) :
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
