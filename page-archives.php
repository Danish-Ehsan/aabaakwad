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
				the_title( '<h1 class="page-title">', '</h1>' );
				?>
			</header><!-- .page-header -->

			<?php
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
			
			//Go back to Resources page Loop
			wp_reset_postdata();	
			
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				//the_title();
				echo '</br>';
				the_content();
				echo '</br>';
			?>
			<section class="categories">
				<?php $field = get_field('the_conversations'); ?>
				<div class="categories__cont">
					<a href="<?= get_category_url_by_slug('the_conversations') ?>">
						<div class="category__cont">
							<img class="category__img" src="<?= $field['image']['sizes']['thumbnail'] ?>">
							<h3 class="category__title"><?= $field['title'] ?></h3>
							<p class="category__desc"><?= $field['description'] ?></p>
						</div>
					</a>
				</div>
				<?php $field = get_field('performance_series'); ?>
				<div class="categories__cont">
					<a href="<?= get_category_url_by_slug('performance_series') ?>">
						<div class="category__cont">
							<img class="category__img" src="<?= $field['image']['sizes']['thumbnail'] ?>">
							<h3 class="category__title"><?= $field['title'] ?></h3>
							<p class="category__desc"><?= $field['description'] ?></p>
						</div>
					</a>
				</div>
				<?php $field = get_field('artist_mentorship'); ?>
				<div class="categories__cont">
					<a href="<?= get_category_url_by_slug('artist_mentorship') ?>">
						<div class="category__cont">
							<img class="category__img" src="<?= $field['image']['sizes']['thumbnail'] ?>">
							<h3 class="category__title"><?= $field['title'] ?></h3>
							<p class="category__desc"><?= $field['description'] ?></p>
						</div>
					</a>
				</div>
				
			</section>
			<?php endwhile;
			

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
</div>
<?php
get_footer();
