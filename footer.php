<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aabaakwad
 */

	$the_query = new WP_Query( array(
		'pagename'  => 'footer-info'
	) );


	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) :
		$the_query->the_post();
?>
	<footer id="colophon" class="site-footer footer">
		<div class="site-info footer__content">
			<?php the_content() ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
		endwhile;
	endif;

wp_footer(); 
?>

</body>
</html>
