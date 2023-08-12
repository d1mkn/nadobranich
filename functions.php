<?php
/**
 * nadobranich functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nadobranich
 */

if (!defined('_S_VERSION')) {
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
function nadobranich_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on nadobranich, use a find and replace
	 * to change 'nadobranich' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('nadobranich', get_template_directory() . '/languages');

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
			'menu-1' => esc_html__('Primary', 'nadobranich'),
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
			'nadobranich_custom_background_args',
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
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'nadobranich_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nadobranich_content_width()
{
	$GLOBALS['content_width'] = apply_filters('nadobranich_content_width', 640);
}
add_action('after_setup_theme', 'nadobranich_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nadobranich_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'nadobranich'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'nadobranich'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name' => esc_html__('Віджети головної сторінки', 'nadobranich'),
			'id' => 'mainpagesidebar',
			'description' => esc_html__('Add widgets here.', 'nadobranich'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

}
add_action('widgets_init', 'nadobranich_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function nadobranich_scripts()
{
	wp_enqueue_style('nadobranich-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('nadobranich-style', 'rtl', 'replace');

	wp_enqueue_style('nadobranich-general', get_template_directory_uri() . '/assets/css/general.css', array(), _S_VERSION);
	wp_enqueue_style('nadobranich-plugins', get_template_directory_uri() . '/dist/index.css', array(), _S_VERSION, );

	if (is_front_page()) {
		wp_enqueue_script('nadobranich-script', get_template_directory_uri() . '/dist/index.js', null, _S_VERSION, true);
	}

	if (is_archive()) {
		wp_enqueue_script('nadobranich-script-category', get_template_directory_uri() . '/dist/categoryPage.js', null, _S_VERSION, true);
	}

	if (is_product()) {
		wp_enqueue_script('nadobranich-script-single', get_template_directory_uri() . '/dist/singlePage.js', null, _S_VERSION, true);
	}

	if (is_cart()) {
		wp_enqueue_script('nadobranich-script-cart', get_template_directory_uri() . '/dist/cartPage.js', null, _S_VERSION, true);
	}

	if (is_404()) {
		wp_enqueue_script('nadobranich-script', get_template_directory_uri() . '/dist/index.js', null, _S_VERSION, true);
	}

	if (is_account_page()) {
		wp_enqueue_script('nadobranich-script', get_template_directory_uri() . '/dist/accountPage.js', null, _S_VERSION, true);
	}

	wp_enqueue_script('nadobranich-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'nadobranich_scripts');

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/woocommerce.php';

require get_template_directory() . '/inc/shortcodes.php';