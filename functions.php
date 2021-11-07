<?php
/**
 * aabaakwad functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aabaakwad
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'aabaakwad_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function aabaakwad_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on aabaakwad, use a find and replace
		 * to change 'aabaakwad' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'aabaakwad', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'aabaakwad' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'aabaakwad_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'aabaakwad_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aabaakwad_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aabaakwad_content_width', 640 );
}
add_action( 'after_setup_theme', 'aabaakwad_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aabaakwad_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'aabaakwad' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'aabaakwad' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'aabaakwad_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aabaakwad_scripts() {
	wp_enqueue_style( 'aabaakwad-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'aabaakwad-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'underscores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'aabaakwad-navigation', get_template_directory_uri() . '/js/aabaakwad-navigation.js', array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aabaakwad_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/*----------------------
 * Custom functions
 ---------------------*/

/*
add_filter( 'manage_events_posts_columns', 'add_event_dates_column' );
function add_event_dates_column( $columns ) {
	//$dateColumn = array_pop($columns);
	$columns['event_dates'] = 'Event Dates';
	//$columns[] = $dateColumn;
	
	return $columns;
}


add_action( 'manage_events_posts_custom_column', 'event_dates_column', 10, 2);
function event_dates_column( $column, $post_id ) {
  // Image column
  if ( 'event_dates' === $column ) {
    echo get_the_post_thumbnail( $post_id, array(80, 80) );
  }
}



add_filter( 'manage_edit-events_sortable_columns', 'set_custom_events_sortable_columns' );

function set_custom_events_sortable_columns( $columns ) {
	$columns['event_date'] = 'event_date';
	
	return $columns;
}
*/

//Filter Schedule page posts to remove posts marked as Archived
function aabaakwad_filter_schedule($query) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( $query->is_post_type_archive('events')) {
            $query->set( 'tax_query', array(
				array(
					'taxonomy' => 'archived',
					'field'    => 'slug',
					'terms'    => 'yes',
					'operator' => 'NOT IN'
				)
			) );
        }
    }
}
add_action( 'pre_get_posts', 'aabaakwad_filter_schedule' );

//Filter all Resources posts to only include posts marked as Archived
function aabaakwad_filter_resources($query) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( $query->is_tax('event_date')) {
            $query->set( 'tax_query', array(
				array(
					'taxonomy' => 'archived',
					'field'    => 'slug',
					'terms'    => 'yes'
				)
			) );
        }
    }
}
add_action( 'pre_get_posts', 'aabaakwad_filter_resources' );

//Add custom post Events to the Category Archive query
function aabaakwad_add_custom_types( $query ) {
  if( (is_category() || is_tag()) && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', 'events');
  }
}

add_action( 'pre_get_posts', 'aabaakwad_add_custom_types' );