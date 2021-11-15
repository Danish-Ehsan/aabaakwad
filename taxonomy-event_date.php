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
				<h1>Archives by Year</h1>
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
				
				$current_term_id = get_queried_object()->term_id;

			}
			
		?>
			<section>
				<div class="filter-btns">
				<?php foreach( $terms_array as $term ) : ?>
					<a href="<?= get_term_link($term['id']); ?>" class="<?= ($term['id'] == $current_term_id) ? 'active' : ''  ?>"><h3><?= $term['name'] ?></h3></a>
				<?php endforeach;?>
				</div>
			</section>
			<?php
			
			//Go back to Resources page Loop
			wp_reset_postdata();	
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
