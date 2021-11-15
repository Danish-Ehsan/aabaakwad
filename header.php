<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aabaakwad
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!--<Montserrat & Montserrat Alternatives Google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site site-container">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'aabaakwad' ); ?></a>

	<header id="masthead" class="site-header header">
		<div class="header__sun js--header-sun"></div>
		
		<div class="site-branding header__logo">
			<a href="<?= get_home_url() ?>" class="custom-logo-link" rel="home">
				<img src="<?php $src = is_front_page() || is_single() || is_archive() ? '/images/aabaakwad-logo-blue.png' : '/images/aabaakwad-logo.png'; echo get_template_directory_uri() . $src ?>" class="custom-logo" alt="aabaakwad">
			</a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation nav">
			<button class="menu-toggle nav-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'aabaakwad' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container'		 => 'false',
					'menu_class'	 => 'nav__list'
				)
			);
			
			//get_search_form() ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
