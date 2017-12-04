<?php
/**
 * uh18 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uh18
 */

if ( ! function_exists( 'uh18_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function uh18_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on uh18, use a find and replace
		 * to change 'uh18' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'uh18', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'uh18' ),
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
		add_theme_support( 'custom-background', apply_filters( 'uh18_custom_background_args', array(
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


				// IMAGE SIZES
		if ( function_exists( 'add_image_size' ) ) { 
		    add_image_size( '450', 450, 9999 ); //300 pixels wide (and unlimited height)
		    add_image_size( 'hd', 1980, 9999 ); //300 pixels wide (and unlimited height)
		}
	}
endif;
add_action( 'after_setup_theme', 'uh18_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uh18_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uh18_content_width', 640 );
}
add_action( 'after_setup_theme', 'uh18_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uh18_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uh18' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'uh18' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uh18_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function uh18_scripts() {
	wp_enqueue_style( 'uh18-style', get_stylesheet_uri() );
	wp_enqueue_style( 'uh18-style-custom', get_template_directory_uri() . '/css/min/uh18.css' );
    // wp_enqueue_style( 'uh18-style-custom', get_template_directory_uri() . '/css/theme-uh18.css' );

	wp_enqueue_script( 'font', get_template_directory_uri() . '/js/font.js', array('jquery'), '20151215', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'uh18_scripts' );



// NAVIGATION
class Le_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $post;
        $id = ( isset( $post->ID ) ? get_the_ID() : NULL );


        $classes = array();
        if( !empty( $item->classes ) ) {
            $classes = (array) $item->classes;
        }

        $active_class = '';
        // rewrite active class for custom post type
        if (isset( $id )){
            // Getting the post type of the current post
            $current_post_type = get_post_type_object(get_post_type($post->ID));
            $current_post_type_slug = $current_post_type->rewrite['slug'];

            // Getting the URL of the menu item
            $menu_slug = strtolower(trim($item->url));

            // If the menu item URL contains the current post types slug add the current-menu-item class
            if (strpos($menu_slug,$current_post_type_slug) !== false) {
               $active_class = 'active';
            // usual active menu item if conditions
            } else if( in_array('current-menu-item', $classes) ) {
                $active_class = 'active';
            } else if( in_array('current-menu-parent', $classes) ) {
                $active_class = 'active-parent';
            } else if( in_array('current-menu-ancestor', $classes) ) {
                $active_class = 'active-ancestor';
            }
        }

        $url = '';
        if( !empty( $item->url ) ) {
            $url = $item->url;
        }

        $output .= '
        <li class="nav__item  '. $active_class . '">
            <a class="nav__link" href="' . $url . '">
                ' . $item->title . '
            </a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}


/**
 * ACF Options
 */
if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Partner',
		'menu_title' 	=> 'Partner',
		'menu_slug' 	=> 'partner',
		'capability' 	=> 'edit_posts'
	));
}

/**
 * Disable ACF on Frontend
 *
 */
function ea_disable_acf_on_frontend( $plugins ) {

    if( is_admin() )
        return $plugins;

    foreach( $plugins as $i => $plugin )
        if( 'advanced-custom-fields-pro/acf.php' == $plugin )
            unset( $plugins[$i] );
    return $plugins;
}
add_filter( 'option_active_plugins', 'ea_disable_acf_on_frontend' );


/**
 * Returns the ACF JSON filename by group name.
 *
 * @param string $field_group_name Name of the ACF field group
 * @return string|bool
 */
function get_acf_json_by_name( string $field_group_name ) {
    $field_group_lookup = [
        'home' => 'group_5a1294f25b550.json',
        'partner'  => 'group_5a129bdd97333.json',
        'hero' => 'group_5a12aeb4d5c8c.json',
        // Add more field_group_name => file_name pairs here.
    ];
    if ( ! isset( $field_group_lookup[ $field_group_name ] ) ) {
        return false;
    }
    return $field_group_lookup[ $field_group_name ];
}


// PERFORMANCE
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
// add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

// REMOVE EMOJI
function remove_emoji()
    {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'remove_tinymce_emoji');
    }
add_action('init', 'remove_emoji');
function remove_tinymce_emoji($plugins)
    {
    if (!is_array($plugins))
        {
        return array();
        }
    return array_diff($plugins, array(
        'wpemoji'
    ));
}




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

