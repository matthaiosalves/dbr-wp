<?php

/**
 * Diário Brasileiro Habbo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Diário_Brasileiro_Habbo
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dbr_wp_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Diário Brasileiro Habbo, use a find and replace
		* to change 'dbr-wp' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('dbr-wp', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'dbr-wp'),
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
			'dbr_wp_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'dbr_wp_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dbr_wp_content_width()
{
	$GLOBALS['content_width'] = apply_filters('dbr_wp_content_width', 640);
}
add_action('after_setup_theme', 'dbr_wp_content_width', 0);


/**
 * Enqueue scripts and styles.
 */
function dbr_wp_scripts()
{
	wp_enqueue_style('dbr-wp-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('dbr-wp-style', 'rtl', 'replace');

	wp_enqueue_script('dbr-wp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'dbr_wp_scripts');



require_once get_template_directory() . '/inc/cpt/noticias.php';
require_once get_template_directory() . '/inc/noticias-rules-url.php';

add_action('pre_get_posts', function ($query) {
	if (!is_admin() && $query->is_main_query() && is_category()) {
		$query->set('post_type', array('noticia'));
	}
});

add_action('admin_init', function () {
	add_post_type_support('noticia', 'excerpt');
});


add_action('wp_ajax_dbr_ajax_search', 'dbr_ajax_search');
add_action('wp_ajax_nopriv_dbr_ajax_search', 'dbr_ajax_search');
function dbr_ajax_search()
{
	$keyword = sanitize_text_field($_GET['keyword'] ?? '');
	$query = new WP_Query([
		'post_type' => 'noticia',
		'posts_per_page' => 20,
		's' => $keyword,
		'post_status' => 'publish',
	]);
	$results = [];
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$img = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
			if (!$img) $img = 'https://i.imgur.com/EmBfP1e.png';
			$results[] = [
				'title' => get_the_title(),
				'link' => get_permalink(),
				'img' => $img,
				'author' => get_the_author(),
				'date' => get_the_date('d \d\e F \d\e Y'),
				'excerpt' => get_the_excerpt(),
			];
		}
		wp_reset_postdata();
	}
	wp_send_json($results);
}
