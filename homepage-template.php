<?php /* Template Name: Homepage */ 

get_header();
?>
<div class="main-cont">
	<main id="primary" class="site-main main main--full-width">

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
					<section class="homepage__carousel js--homepage-carousel">
						<?php
						while (have_rows('carousel_item')) : the_row(); 
							$image = get_sub_field('image');
							$hyperlink = get_sub_field('hyperlink');
						?>

						<div class="carousel__item-cont">
							<div class="carousel__item-info">
								<h2><?php the_sub_field('title') ?></h2>
								<p><?php the_sub_field('description') ?></p>
							</div>
							<?php if ($hyperlink) :
							echo '<a class="carousel__link" href="' . $hyperlink . '">';
							endif; ?>
							<img src="<?php echo $image['url'] ?>" alt="<?php echo get_sub_field('image')['alt'] ?>" class="carousel__image">
							<?php if ($hyperlink) :
							echo '</a>';
							endif; ?>
						</div>

						<?php 
						endwhile;
					echo '</section>';
				endif;
				
				if (have_rows('highlight_item')) : ?>
					<section class="homepage__highlights list-cont list-cont--homepage">
						<?php
						while (have_rows('highlight_item')) : the_row() ;?>
						<div class="highlight__item-cont list-item__cont">
							<?php if (get_sub_field('hyperlink')) :
							echo '<a class="highlight__link list-item__link" href="' . get_sub_field('hyperlink') . '">';
							endif; ?>
							<div class="list-item__image">
								<img class="highlight__image" src="<?php echo get_sub_field('image')['sizes']['medium']; ?>">
							</div>
							<h4 class="highlight__title font-monstalt list-item__title-cont"><?php the_sub_field('title'); ?></h4>
							<?php if (get_sub_field('hyperlink')) :
							echo '</a>'; 
							endif; ?>
							<?php if (get_sub_field('subtitle')) : ?>
							<p class="list-item__subtitle"><?= get_sub_field('subtitle') ?></p>
							<?php endif; ?>
							<p class="highlight__description"><?php the_sub_field('description'); ?></p>
							<?php if (get_sub_field('hyperlink')) : ?>
							<a href="<?= get_sub_field('hyperlink') ?>" class="list-item__btn">Learn More</a>
							<?php endif; ?>
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
</div>
<?php
get_footer();
