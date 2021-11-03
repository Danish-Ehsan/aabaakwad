<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aabaakwad
 */

get_header();

//	$the_query = new WP_Query( array(
//		'post_type'  => 'events',
//		'tax_query' => array(
//			array(
//				'taxonomy' => 'archived',
//				'field'    => 'slug',
//				'terms'    => 'yes',
//				'operator' => 'NOT IN'
//			)
//		)
//	) );

$terms_array = [];

	if ( have_posts() ) {	
		while (have_posts()) {
			the_post();
//			echo '<pre>';
//			print_r(get_the_terms(get_the_ID(), 'event_date'));
//			echo '</pre>';
			//echo print_r(get_the_terms(get_the_ID(), 'event'));
			$term_object = get_the_terms(get_the_ID(), 'event_date');
			
			foreach($term_object as $value) {
				if ($value->parent != 0) {
					//$term_ids[] = $value->term_id;
					//echo $value->term_id;
					$terms_array[] = array (
						'id' => $value->term_id,
						'slug' => $value->slug,
						'name' => $value->name
					);
					
				}
			}
		}
		
		//$term_ids = array_unique($term_ids);
		//print_r($terms_array);
		usort($terms_array, function($a, $b){
			return strcmp($a['name'], $b['name']);
		});
		//echo '</br>';
		$terms_array = array_unique($terms_array, SORT_REGULAR);
		//print_r($terms_array);
		
	}
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : 
			
			
		?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			
			<section>
				<div class="filter-btns">
				<?php foreach( $terms_array as $term ) : ?>
					<a href="<?= get_term_link($term['id']); ?>"><?= $term['name'] ?></a>
				<?php endforeach;?>
				</div>
			</section>
			<?php
			
//			echo '<pre>';
//			print_r(get_terms( array( 
//				'taxonomy' => 'event_date',
//				'parent' => 0	
//			) ));
//			echo '</pre>';
			
			
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				echo '<strong>' . get_the_title() . '</strong>';
				echo '</br>';
				the_content();
//				echo '<pre>';
//				print_r(get_the_terms());
//				echo '</pre>';
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
