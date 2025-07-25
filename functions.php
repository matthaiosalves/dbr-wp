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



require_once get_template_directory() . '/inc/cpt/noticias.php';
require_once get_template_directory() . '/inc/noticias-rules-url.php';
require_once get_template_directory() . '/inc/ajax/buscaHome.php';
require_once get_template_directory() . '/inc/ajax/habbo-verification.php';


add_action('pre_get_posts', function ($query) {
	if (!is_admin() && $query->is_main_query() && is_category()) {
		$query->set('post_type', array('noticia'));
	}
});

add_action('admin_init', function () {
	add_post_type_support('noticia', 'excerpt');
});


add_filter('login_redirect', function ($redirect_to, $request, $user) {
	if (is_wp_error($user) || !is_a($user, 'WP_User')) {
		return $redirect_to;
	}
	return home_url('/');
}, 10, 3);

add_action('after_setup_theme', function () {
	if (is_user_logged_in() && !current_user_can('administrator')) {
		show_admin_bar(false);
	}
});

add_action('init', function () {
	$post_types = get_post_types(['public' => true], 'names');
	foreach ($post_types as $type) {
		add_post_type_support($type, 'comments');
	}
});


if (function_exists('acf_add_options_page')) {
	acf_add_options_page([
		'page_title'    => 'Opções do Tema',
		'menu_title'    => 'Opções do Tema',
		'menu_slug'     => 'opcoes-do-tema',
		'capability'    => 'edit_posts',
		'redirect'      => false
	]);
}

// Bloqueia acesso de não administradores ao painel admin, inclusive ao perfil
add_action('admin_init', function () {
	if (!current_user_can('administrator') && !wp_doing_ajax()) {
		wp_redirect(home_url());
		exit;
	}
});

add_action('template_redirect', function () {
	if (is_404()) {
		wp_redirect(home_url('/'));
		exit;
	}
});
