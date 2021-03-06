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
				'post_type'  => 'events',
				'tax_query' => array(
					array(
						'taxonomy' => 'archived',
						'field'    => 'slug',
						'terms'    => 'yes'
					)
				)
			) );

			if ( $the_query->have_posts() ) {	
				while ($the_query->have_posts()) {
					$the_query->the_post();
					$term_object = get_the_terms(get_the_ID(), 'event_date');

					foreach($term_object as $value) {
						if ($value->parent == 0) {
							$terms_array[] = array (
								'id' => $value->term_id,
								'slug' => $value->slug,
								'name' => $value->name
							);

						}
					}
				}

				usort($terms_array, function($a, $b){
					return strcmp($a['name'], $b['name']);
				});
				$terms_array = array_unique($terms_array, SORT_REGULAR);

			}
			
		?>
			<section>
				<div class="filter-btns">
				<?php foreach( $terms_array as $term ) : ?>
					<a href="<?= get_term_link($term['id']); ?>"><h3><?= $term['name'] ?></h3></a>
				<?php endforeach;?>
				</div>
			</section>
		<?php
			
		//Go back to Archives page Loop
		wp_reset_postdata();	
		if (have_posts()) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				if (have_rows('category_blocks')) :
					echo '<section class="list-cont list-cont--categories">';
					while(have_rows('category_blocks')) :
						the_row();
			?>
					<article class="list-item__cont">
						<a href="<?= get_term_link( get_sub_field('category') ) ?>" class="list-item__link">
							<div class="list-item__image"><img src="<?= get_sub_field('image')['sizes']['medium']; ?>" alt="<?= get_sub_field('image')['alt'] ?>"></div>

							<div class="list-item__title-cont">
								<h4><?= get_sub_field('title'); ?></h4>
							</div>
						</a>
						<p><?= get_sub_field('description') ?></p>
						<a href="<?php the_permalink() ?>" class="list-item__btn">Explore Category</a>
					</article>
			<?php 
					endwhile;
					echo '</section>';
				endif;
			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
</div>
<?php
get_footer();
