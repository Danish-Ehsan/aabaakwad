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
	<main id="primary" class="site-main main main--narrow">

		<?php
		while ( have_posts() ) :
			the_post();
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<?php aabaakwad_post_thumbnail() ?>

				<div class="entry-content">
					<?php
					the_content();
					?>
				</div><!-- .entry-content -->
				<div class="register-form__cont">
					<?php the_field('register_form_embed_code'); ?>
				</div>
			</article><!-- #post-<?php the_ID(); ?> -->
		
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div>
<?php
get_footer();
