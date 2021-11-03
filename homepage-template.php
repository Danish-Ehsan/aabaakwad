<?php /* Template Name: Homepage */ 

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				
				if (have_rows('carousel_item')) : ?>
					<section class="homepage__carousel">
						<?php
						while (have_rows('carousel_item')) : the_row(); 
							$image = get_sub_field('image');
							$hyperlink = get_sub_field('hyperlink');
						?>

						<div class="carousel__item-cont">
							<?php if ($hyperlink) :
							echo '<a class="carousel__link" href="' . $hyperlink . '" target="_blank">';
							endif; ?>
							<img src="<?php echo $image['url'] ?>" alt="<?php echo get_sub_field('image')['alt'] ?>">
							<?php if ($hyperlink) :
							echo '</a>';
							endif; ?>
						</div>

						<?php 
						endwhile;
					echo '</section>';
				endif;
				
				if (have_rows('highlight_item')) : ?>
					<section class="homepage__highlights">
						<?php
						while (have_rows('highlight_item')) : the_row() ;?>
						<div class="highlight__item-cont">
							<?php if (get_sub_field('hyperlink')) :
							echo '<a class="highlight__link" href="' . get_sub_field('hyperlink') . '" target="_blank">';
							endif; ?>
							<img class="highlight__image" src="<?php echo get_sub_field('image')['sizes']['thumbnail']; ?>">
							<h3 class="highlight__title"><?php the_sub_field('title'); ?></h3>
							<p class="highlight__description"><?php the_sub_field('description'); ?></p>
							<?php if (get_sub_field('hyperlink')) :
							echo '</a>';
							endif; ?>
						</div>
						
				<?php
						endwhile;
					echo '</section>';
				endif;
			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
