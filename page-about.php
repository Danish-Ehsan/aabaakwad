<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aabaakwad
 */

get_header();
?>
<div class="main-cont main-cont--align-start">
	<main id="primary" class="site-main main">
		
		<?php
		while ( have_posts() ) :
			the_post();
		?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div class="twocol">
		<div class="twocol__main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php aabaakwad_post_thumbnail(); ?>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aabaakwad' ),
							'after'  => '</div>',
						)
					);
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
		<?php
			if (have_rows('co-presented_by')) :
				echo '<h2 class="logos__title logos__title--about">Co-presented by</h2>';
				echo '<section class="logos__cont">';
				while (have_rows('co-presented_by')) : the_row();
					if (get_sub_field('hyperlink')) :
			?>
				<a href="<?php the_sub_field('hyperlink') ?>" target="_blank" class="logo__cont logo__cont--about">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</a>
				<?php else : ?>
				<div class="logo__cont logo__cont--about">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</div>
			<?php
					endif;
				endwhile;
				echo '</section>';
			endif; 

			if (have_rows('sponsors')) :
				echo '<h2 class="logos__title logos__title--about">Sponsors</h2>';
				echo '<section class="logos__cont logos__cont--about">';
				while (have_rows('sponsors')) : the_row();
					if (get_sub_field('hyperlink')) :
			?>
				<a href="<?php the_sub_field('hyperlink') ?>" target="_blank" class="logo__cont logo__cont--about">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</a>
				<?php else : ?>
				<div class="logo__cont logo__cont--about">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</div>
			<?php
					endif;
				endwhile;
				echo '</section>';
			echo '</div>'; //.col-main
			endif; 
			if (get_field('contact_info')) : ?>
			<sidebar class="twocol__sidebar">
				<div class="sidebar__content">
					<h2>Contact Info</h2>
					<?php the_field('contact_info'); ?>
				</div>
			</sidebar>
		<?php 
			endif;
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div>
<?php
get_footer();
