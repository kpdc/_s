<?php
/**
 * Digitate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Digitate
 */

// Clean up Header
function digitate_removeHeadLinks() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'digitate_removeHeadLinks');

function digitate_remove_version() {
        return '';
}
add_filter('the_generator', 'digitate_remove_version');

function digitate_remove_css_js_ver($src) {
        if(strpos($src, 'ver='))
                $src = remove_query_arg('ver', $src);
        return $src;
}
add_filter( 'style_loader_src', 'digitate_remove_css_js_ver', 9999 );
add_filter( 'script_loader_src', 'digitate_remove_css_js_ver', 9999 );

if ( ! function_exists( 'digitate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function digitate_setup() {
        // CPT Hook-in
        include_once(ABSPATH . 'wp-content/themes/digitate/inc/cpt.php');
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Digitate, use a find and replace
	 * to change 'digitate' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'digitate', get_template_directory() . '/languages' );

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
        add_image_size( 'blog-post-thumbnail', 600, 600, array( 'center', 'center' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'digitate' ),
                'footnav' => esc_html__( 'Footnav', 'digitate' ),
                'productfeanav' => esc_html__( 'Productfeanav', 'digitate' ),
                'newsfilter' => esc_html__( 'Newsfilter', 'digitate' ),
                'resourcenav' => esc_html__( 'Resourcenav', 'digitate' ),
                'footsitemap' => esc_html__( 'Footsitemap', 'digitate' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'digitate_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'digitate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function digitate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'digitate_content_width', 640 );
}
add_action( 'after_setup_theme', 'digitate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
//function digitate_widgets_init() {
//	register_sidebar( array(
//		'name'          => esc_html__( 'Sidebar', 'digitate' ),
//		'id'            => 'sidebar-1',
//		'description'   => esc_html__( 'Add widgets here.', 'digitate' ),
//		'before_widget' => '<section id="%1$s" class="widget %2$s">',
//		'after_widget'  => '</section>',
//		'before_title'  => '<h2 class="widget-title">',
//		'after_title'   => '</h2>',
//	) );
//}
//add_action( 'widgets_init', 'digitate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function digitate_scripts() {
        wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0', false );
        
	wp_enqueue_script( 'digitate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'digitate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'digitate-main-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '20170508', true );

	if ( is_front_page() ) {
            wp_enqueue_style( 'owl-style', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.3', false );
            wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), '1.3.3', false );
            wp_enqueue_script( 'owl-carousel-script', get_template_directory_uri() . '/js/owl.carousel.js', array(), '1.3.3', true );
            wp_enqueue_script( 'owl-calling', get_template_directory_uri() . '/js/slide.js', array(), '20170508', true );
            wp_enqueue_script( 'home-call', get_template_directory_uri() . '/js/home.js', array(), '20170508', true );
        }
        
        if ( is_page( array('learn', 'resolve', 'predict') ) ) {
            wp_enqueue_script( 'product-child', get_template_directory_uri() . '/js/product-feature-min.js', array(), '20170508', true );
        }
        
        if ( is_page( 'events' ) ) {
            wp_enqueue_script( 'event-filter', get_template_directory_uri() . '/js/event.js', array(), '20170508', true );
        }
        
        if ( is_page('contact-us') ) {
            wp_enqueue_script( 'gmap-api', '//maps.googleapis.com/maps/api/js?key=AIzaSyDRX5v6RM-T-afB7QvDOSXEdIzqqZZ9QFY', array(), '20170508', true );
            wp_enqueue_script( 'gmap-us', get_template_directory_uri() . '/js/usmap.js', array(), '20170508', true );
            wp_enqueue_script( 'gmap-in', get_template_directory_uri() . '/js/inmap.js', array(), '20170508', true );
        }
        
        wp_enqueue_style( 'digitate-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'digitate_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
