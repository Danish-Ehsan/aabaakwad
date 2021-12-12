<?php
/**
 * The template for displaying the Resources page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aabaakwad
 */

get_header();

?>
<div class="main-cont">
	<main id="primary" class="site-main main">

		<?php 
			if ( have_posts() ) : 
				while (have_posts()) : the_post(); ?>

				<header class="page-header">
					<?php
					the_title( '<h1 class="page-title">', '</h1>' );
					the_content();
					?>
				</header><!-- .page-header -->

			<?php
				endwhile;
			endif;
			$the_query = new WP_Query( array(
				'post_type'  => 'exhibitions',
				'posts_per_page' => -1
			) );

			if ( $the_query->have_posts() ) :
				echo '<section class="list-cont">';
				while ($the_query->have_posts()) :
					$the_query->the_post();
			?>
				<article class="list-item__cont">
					<a href="<?= get_field('external_page') === 'Yes' ? get_field('hyperlink') : get_the_permalink(); ?>" class="list-item__link" <?php if ( get_field('external_page') === 'Yes' ) { echo 'target="_blank"'; } ?>>
						<div class="list-item__image"><?php echo get_the_post_thumbnail('', 'medium'); ?></div>

						<div class="list-item__title-cont">
							<h4><?php the_title() ?></h4>
						<?php
							//if (get_field('start_date') && !get_field('end_date')) { echo '<h4 class="single-header__time">' . get_field('start_date') . '</h4>'; }
							//if (get_field('start_date') && get_field('end_date')) { echo '<h4 class="single-header__time">' . get_field('start_date') . ' - ' . get_field('end_date') . '</h4>'; }
						?>
						</div>
					</a>
					<?php the_excerpt() ?>
					<a href="<?= get_field('external_page') === 'Yes' ? get_field('hyperlink') : get_the_permalink() ?>" class="list-item__btn" <?php if ( get_field('external_page') === 'Yes' ) { echo 'target="_blank"'; } ?>>Explore</a>
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
