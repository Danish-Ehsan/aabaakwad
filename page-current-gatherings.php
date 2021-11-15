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
			
			$the_query = new WP_Query( array(
				'post_type'  => 'events',
				'tax_query' => array(
					array(
						'taxonomy' => 'archived',
						'field'    => 'slug',
						'terms'    => 'yes',
						'operator' => 'NOT IN'
					)
				)
			) );

			$terms_array = [];

			if ( $the_query->have_posts() ) {	
				while ($the_query->have_posts()) {
					$the_query->the_post();
					$term_object = get_the_terms(get_the_ID(), 'event_date');
					if ( !empty($term_object) ) {
						foreach($term_object as $value) {
							if ($value->parent != 0) {
								$terms_array[] = array (
									'id' => $value->term_id,
									'slug' => $value->slug,
									'name' => $value->name
								);

							}
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
			<div class="filter-btns js--filter-btns-cont">
				<!--<button data-filter="*" class="js--filter-btn"><h3>All</h3></button>-->
			<?php foreach( $terms_array as $term ) : ?>
				<button data-filter=".<?= $term['slug'] ?>" class="js--filter-btn"><h3><?= $term['name'] ?></h3></button>
				<!--<span class="fitler-btns__seperator">|</span>-->
			<?php endforeach; ?>
			</div>
		</section>
		<?php

		//Go back to Current Gatherings page Loop
		wp_reset_postdata();	
		?>
		<section class="site-content">

		<?php 
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
		?>
		</section>

		<?php 
			endwhile;
		endif;

		// Go back to the custom query
		/* Start the Loop */
		if ($the_query->have_posts()) :
			echo '<section class="list-cont--flex js--isotope-grid">';
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$term_obj = get_the_terms( $post->ID, 'event_date' );
				$terms_string = implode(' ', wp_list_pluck($term_obj, 'slug') );
		?>
		<article class="list-item__cont--flex <?= $terms_string ?> isotope-grid-item">
			<a href="<?php the_permalink() ?>" class="list-item__link">
				<div class="list-item__image"><?php echo get_the_post_thumbnail('', 'medium'); ?></div>
			
				<div href="<?php the_permalink() ?>" class="list-item__title-cont">
					<h4><?php the_field('start_time'); ?><?php echo get_field('end_time') ? ' - ' . get_field('end_time') : ''; ?></h4>
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
