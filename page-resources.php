<?php
/**
 * The template for displaying the Resources page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aabaakwad
 */

get_header();

	$the_query = new WP_Query( array(
		'post_type'  => 'events',
		'tax_query' => array(
			array(
				'taxonomy' => 'archived',
				'field'    => 'slug',
				'terms'    => 'no'
			)
		)
	) );

?>

	<main id="primary" class="site-main">

		<?php if ( $the_query->have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_title( '<h1 class="page-title">', '</h1>' );
				?>
			</header><!-- .page-header -->
			<section>
				<?php 
//					echo '<pre>';
//					get_the_terms();
//					echo '</pre>';
				?>
			</section>
			<?php
			
				
//			echo '<pre>';
//			print_r(get_terms( array( 
//				'taxonomy' => 'event_date',
//				'parent' => 0	
//			) ));
//			echo '</pre>';
			
			
			/* Start the Loop */
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				the_title();
				echo '</br>';
				the_content();
				echo '</br>';
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
