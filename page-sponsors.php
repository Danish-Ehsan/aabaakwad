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
<!--			<header class="page-header">
				<?php
				//the_title( '<h1 class="page-title">', '</h1>' );
				//the_content();
				?>
			</header> .page-header -->
		<?php
			if (have_rows('co-presented_by')) :
				echo '<h1 class="logos__title">Co-presented by</h1>';
				echo '<section class="logos__cont">';
				while (have_rows('co-presented_by')) : the_row();
					if (get_sub_field('hyperlink')) :
			?>
				<a href="<?php the_sub_field('hyperlink') ?>" target="_blank" class="logo__cont">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</a>
				<?php else : ?>
				<div class="logo__cont">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</div>
			<?php
					endif;
				endwhile;
				echo '</section>';
			endif; 

			if (have_rows('sponsors')) :
				echo '<h1 class="logos__title">Sponsors</h1>';
				echo '<section class="logos__cont">';
				while (have_rows('sponsors')) : the_row();
					if (get_sub_field('hyperlink')) :
			?>
				<a href="<?php the_sub_field('hyperlink') ?>" target="_blank" class="logo__cont">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</a>
				<?php else : ?>
				<div class="logo__cont">
					<img src="<?= get_sub_field('logo_image')['url'] ?>" alt="<?= get_sub_field('logo_image')['alt'] ?>">
				</div>
			<?php
					endif;
				endwhile;
				echo '</section>';
			endif;
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div>
<?php
get_footer();
