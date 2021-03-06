<?php
/**
 * legit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package legit
 */

/**
 * Implement custom color palette
 */
require get_template_directory() . '/inc/color-palette.php';

if ( ! function_exists( 'legit_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function legit_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on legit, use a find and replace
		 * to change 'legit' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'legit', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'legit' ),
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
		add_theme_support( 'custom-background', apply_filters( 'legit_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for Gutenberg wide and full image alignments
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Add support for core block styles
		 */
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles
		add_theme_support( 'editor-styles' );

		/**
		 * Add support for responsive embeds in Gutenberg
		 */
		add_theme_support( 'responsive-embeds' );

		/**
		 * Custom colors for use in the editor.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
		 */
		global $legit_color_palette;

		add_theme_support( 'editor-color-palette', $legit_color_palette );
	}
endif;
add_action( 'after_setup_theme', 'legit_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function legit_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'legit_content_width', 700 );
}
add_action( 'after_setup_theme', 'legit_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function legit_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'legit' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'legit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'legit' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'legit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'legit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function legit_scripts() {
	wp_enqueue_style( 'legit-fonts', 'https://fonts.googleapis.com/css?family=Merriweather:400,700', array(), '1.0.0', false );

	wp_enqueue_style( 'legit-style', get_stylesheet_uri(), array( 'legit-fonts' ) );

	wp_enqueue_script( 'legit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'legit-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//wp_enqueue_script( 'fitVids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.2.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'legit-scripts', get_template_directory_uri() . '/js/legit.js', array( 'jquery' ), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'legit_scripts' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-legit-svg-icons.php';

/**
 * Comment walkker class.
 */
require get_template_directory() . '/classes/class-legit-walker-comment.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Enqueue block editor style
 */
function legit_block_editor_styles() {
	wp_enqueue_style( 'legit-fonts', 'https://fonts.googleapis.com/css?family=Merriweather:400,700', array(), '1.0.0', false );
    wp_enqueue_style( 'legit-editor-styles', get_theme_file_uri( '/css/style-editor.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'legit_block_editor_styles' );

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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Add classes to the body depending on thumbnail shown
 *
 * @link https://developer.wordpress.org/reference/functions/body_class/
 */
add_filter( 'body_class', 'legit_add_body_class_thumb' );

if ( ! function_exists( 'legit_add_body_class_thumb' ) ) {
	function legit_add_body_class_thumb( $classes ) {
		$legit_thumbnail = get_theme_mod( 'legit_thumbnail_layout', 'none' );

		if ( is_singular() || $legit_thumbnail === 'none' ) {
			return $classes;
		}

		return array_merge( $classes, array( 'legit-size-' . $legit_thumbnail ) );
	}
}

/**
 * Add classes to the body pages displaying posts
 *
 * @link https://developer.wordpress.org/reference/functions/body_class/
 */
add_filter( 'body_class', 'legit_add_body_class' );

if ( ! function_exists( 'legit_add_body_class' ) ) {
	function legit_add_body_class( $classes ) {
		if ( is_singular() ) {
			return $classes;
		}

		return array_merge( $classes, array( 'legit-post-feed' ) );
	}
}

/**
 * Filters for applying the_content type filters outside the loop
 * 
 * @link https://themehybrid.com/weblog/how-to-apply-content-filters
 */
add_filter( 'legit_content', 'wptexturize' );
add_filter( 'legit_content', 'convert_smilies' );
add_filter( 'legit_content', 'convert_chars' );
add_filter( 'legit_content', 'wpautop' );
add_filter( 'legit_content', 'shortcode_unautop' );
add_filter( 'legit_content', 'wp_make_content_images_responsive' );
add_filter( 'legit_content', 'do_shortcode' );

/**
 * Add a button to menu items with children for expanding the mobile nav.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function legit_menu_toggle( $item_output, $item, $depth, $args ) {
	// Add the button element after the line items link
	if ( 'menu-1' === $args->theme_location && in_array( 'menu-item-has-children', $item->classes ) ) {
		$button = '<button class="menu-item-toggle legit-button-alt"><span class="screen-reader-text">Toggle Sub Menu</span><span class="toggle-icon">+</span></button>';
		$item_output = str_replace( '</a>', '</a>' . $button, $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'legit_menu_toggle', 10, 4 );
