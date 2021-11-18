<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aabaakwad
 */

get_header();

$current_post_ID = get_the_ID();
?>
<div class="main-cont">
	<main id="primary" class="site-main main--single main">
		
<?php
	if(have_posts()) :
		while ( have_posts() ) :
			the_post();
			$terms_obj = get_the_terms(get_the_ID(), 'event_date');

			$terms = [];
			
			//Get only Day categories by not including parentless terms
			foreach ($terms_obj as $term_obj) {
				if ($term_obj->parent != 0) {
					$terms[] = $term_obj->name;
				}
			}
		?>
		<header class="single-header">
		<?php if ( !empty($terms) || get_field('time')) : ?>
			<div class="single-header__info">
			<?php
				if (!empty($terms)) { echo '<h2 class="single-header__tax">' . implode(' ', $terms) . '</h2>'; }
				if (get_field('start_time') && !get_field('end_time')) { echo '<h2 class="single-header__time">' . get_field('start_time') . '</h2>'; }
				if (get_field('start_time') && get_field('end_time')) { echo '<h2 class="single-header__time">' . get_field('start_time') . ' - ' . get_field('end_time') . '</h2>'; }
			?>
			</div>
		<?php endif; ?>
			<div class="single-header__title"><h2><?php the_title() ?></h2></div>
		<?php if (get_field('event_type') && get_field('event_type') != 'N/A') : ?>
			<div class="single-header__type-cont">
				<h2>Event Type:</h2>
				<div class="single-header__type"><h2><?= get_field('event_type') ?></h2></div>
			</div>
		<?php endif; 
			if (get_field('show_register_button') == 'Yes') : ?>
			<a href="<?= get_home_url() . '/register-form' ?>" class="register-button">Register</a>
		<?php endif; ?>
		</header>
		
		<section class="single-main">
			<div class="single-main__image"><?php  the_post_thumbnail('full') ?></div>
			<div class="single-main__content"><?php the_content() ?></div>
		</section>
		

		
	<?php
		endwhile; // End of the loop.
		
			$the_query = new WP_Query( array(
				'post_type'			=> 'events',
				'posts_per_page'	=> 6,
				'orderby'			=> 'date'
			) );
			
			if ($the_query->have_posts()) :
				echo '<h2 class="single-sidebar__title">Other Events</h2>';
				echo '<sidebar class="single-sidebar">';
				while ($the_query->have_posts()) : $the_query->the_post(); 
					if ( get_the_ID() != $current_post_ID ) :
		?>
			<article class="list-item__cont">
				<a href="<?php the_permalink() ?>" class="list-item__link">
					<div class="list-item__image"><?php echo get_the_post_thumbnail('', 'medium'); ?></div>
					<div class="list-item__title-cont">
						<h4><?php the_title() ?></h4>
					</div>
				</a>
				<?php the_excerpt() ?>
			</article>
		<?php
					endif;
				endwhile;
				echo '</sidebar>';
			endif;
		
			wp_reset_postdata();
			
			
		


		
		
		
//			the_post_navigation(
//				array(
//					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'aabaakwad' ) . '</span> <span class="nav-title">%title</span>',
//					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'aabaakwad' ) . '</span> <span class="nav-title">%title</span>',
//				)
//			);

		
	endif;
?>

	</main><!-- #main -->
</div>
<?php
get_footer();
