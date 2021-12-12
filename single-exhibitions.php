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
		?>
		<header class="single-header">
			<div class="single-header__title"><h2><?php the_title() ?></h2></div>
		<?php if ( get_field('start_date')) : ?>
			<div class="single-header__date">
			<?php
				if (get_field('start_date') && !get_field('end_date')) { echo '<h2 class="single-header__time">' . get_field('start_date') . '</h2>'; }
				if (get_field('start_date') && get_field('end_date')) { echo '<h2 class="single-header__time">' . get_field('start_date') . ' - ' . get_field('end_date') . '</h2>'; }
			?>
			</div>
		<?php endif; ?>
		</header>
		
		<section class="single-main">
		<div class="single-main__content"><?php the_content() ?></div>
		</section>
		

		
	<?php
		endwhile; // End of the loop.
		
			$the_query = new WP_Query( array(
				'post_type'			=> 'exhibitions',
				'posts_per_page'	=> 6,
				'orderby'			=> 'date'
			) );
			
			if ($the_query->have_posts()) :
				echo '<h2 class="single-sidebar__title">Other Exhibitions</h2>';
				echo '<sidebar class="single-sidebar">';
				while ($the_query->have_posts()) : $the_query->the_post(); 
					if ( get_the_ID() != $current_post_ID ) :
		?>
			<article class="list-item__cont">
				<a href="<?= get_field('external_page') === 'Yes' ? get_field('hyperlink') : get_the_permalink(); ?>" class="list-item__link" <?php if ( get_field('external_page') === 'Yes' ) { echo 'target="_blank"'; } ?>>
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
