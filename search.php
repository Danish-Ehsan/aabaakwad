<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package aabaakwad
 */

get_header();
?>

	<div class="main-cont">
		<main id="primary" class="site-main main">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'aabaakwad' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
			<section class="list-cont">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
			?>
			<article class="list-item__cont">
				<a href="<?php the_permalink() ?>" class="list-item__link">
					<div class="list-item__image"><?php echo get_the_post_thumbnail('', 'medium'); ?></div>

					<div class="list-item__title-cont">
						<h4><?php the_title() ?></h4>
					</div>
				</a>
			</article>
			
			<?php
			endwhile;
			echo '</section>';
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div>
<?php
get_footer();
