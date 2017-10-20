<?php
/**
 * Enfant functions and definitions
 *
 * @package Enfant
 */

define( 'VERSION', '1.02' ); //used to force browser cache when new updates appear

/**
 * Zoutula helpers
 */
require get_template_directory() . '/inc/framework.php';


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1000; /* pixels */
}

if ( ! function_exists( 'enfant_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function enfant_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Enfant, use a find and replace
		 * to change 'enfant' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'enfant', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded title tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'enfant-square-thumb', 300, 300, true ); // 300 wide by 300 tall, image is cropped due to true setting
		add_image_size( 'enfant-blog-full',1100,560,true ); // 1100 wide by 560 tall, image is cropped due to true setting
		add_image_size( 'enfant-4-3', 600, 450, true ); // 600 wide by 450 tall, image is cropped due to true setting
		add_image_size( 'enfant-square-big', 600, 600, true ); // 600 wide by 600 tall, image is cropped due to true setting
		add_image_size( 'enfant-column', 600, 840, true ); // 600 wide by 840 tall, image is cropped due to true setting
		add_image_size( 'enfant-wide', 600, 300, true ); // 600 wide by 300 tall, image is cropped due to true setting

		// Addd WooCommmerce support
		add_theme_support( 'woocommerce' );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'enfant' ),
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
		add_theme_support( 'custom-background', apply_filters( 'enfant_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	}
endif; // enfant_setup
add_action( 'after_setup_theme', 'enfant_setup' );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function enfant_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'enfant' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'enfant' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s sidebar-right">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Header widget area
    register_sidebar( array(
        'name'          => esc_html__( 'Header', 'enfant' ),
        'id'            => 'sidebar-header',
        'description'   => esc_html__( 'Add widgets here to appear on Header.', 'enfant' ),
        'before_widget' => '<aside id="%1$s" class="widget header-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'enfant' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here to appear in footer.', 'enfant' ),
		'before_widget' => '<aside id="%1$s" class="widget col-sm-4 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Enable Shop sidebar only if WooCommerce is active
	 */
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop', 'enfant' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here to appear in WooCommerece sidebar.', 'enfant' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

}
add_action( 'widgets_init', 'enfant_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function enfant_scripts() {

	wp_enqueue_style( 'enfant-style', get_stylesheet_uri(), false, VERSION );
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style('enfant-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', false, VERSION);
	}
	wp_enqueue_style( 'enfant-style-responsive', get_template_directory_uri() . '/css/responsive.css', false, VERSION );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, VERSION );
    wp_enqueue_style( 'font-base-flaticon', get_template_directory_uri() . '/css/flaticon.css', false, VERSION );

	// enqueue Bootstrap JS
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), VERSION, true );

	// enfant custom JS
	wp_enqueue_script( 'enfant-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), VERSION, true );

	// waypoints & sticky & inview
	wp_enqueue_script( 'enfant-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array( 'jquery' ), VERSION, true );
	wp_enqueue_script( 'enfant-inview', get_template_directory_uri() . '/js/inview.min.js',array( 'jquery' ), VERSION, true );
	wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', array( ), VERSION, true );


	wp_enqueue_script( 'enfant-js', get_template_directory_uri() . '/js/general.js', array( 'jquery','retina' ), VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'enfant_scripts' );


/**
 * Enqueue bootstrap before theme css
 */

function enfant_bootstrap() {
	// enqueue Bootstrap CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
}
add_action( 'wp_enqueue_scripts', 'enfant_bootstrap', 9 );



function enfant_vcSetAsTheme() {
	vc_set_as_theme();
}
add_action( 'vc_before_init', 'enfant_vcSetAsTheme' );


//custom filter to parse a shortcode
add_filter( 'ztl_shortcode_filter', 'do_shortcode' );


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
 * WooCommerce settings.
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
* Load TGM Plugins activation
*/
require get_template_directory() . '/plugin-activation/activator.php';