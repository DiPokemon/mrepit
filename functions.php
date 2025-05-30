<?php
/**
 * mrepit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mrepit
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mrepit_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on mrepit, use a find and replace
		* to change 'mrepit' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'mrepit', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'mrepit' ),
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
			'mrepit_custom_background_args',
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
add_action( 'after_setup_theme', 'mrepit_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mrepit_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mrepit_content_width', 640 );
}
add_action( 'after_setup_theme', 'mrepit_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mrepit_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mrepit' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mrepit' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mrepit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mrepit_scripts() {
	wp_enqueue_style( 'mrepit-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mrepit-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mrepit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mrepit_scripts' );

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
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

/* INIT CARBON */
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

/* ПОДКЛЮЧЕНИЕ ДОПОЛНИТЕЛЬНЫХ ФАЙЛОВ */

require_once (get_template_directory() . '/inc/custom-posts.php'); //Кастомные типы записей
require_once (get_template_directory() . '/inc/custom-fields/post-options.php'); //Кастомные поля для записей
require_once (get_template_directory() . '/inc/user-roles.php'); //Кастомные пользовательские роли
require_once (get_template_directory() . '/inc/custom-fields/user-options.php'); //Кастомные поля для пользователей

require_once (get_template_directory() . '/inc/dashboards-routing.php'); //Кастомные поля для пользователей

require_once( get_template_directory().'/inc/styles-load.php' );
require_once( get_template_directory().'/inc/scripts-load.php' );



// add_action('admin_init', 'restrict_admin_access_for_custom_roles');
// function restrict_admin_access_for_custom_roles() {
//     if (!current_user_can('edit_posts') && !defined('DOING_AJAX')) {
//         wp_redirect(home_url());
//         exit;
//     }
// }










/* КАСТОМНЫЕ ПОДРУЧНЫЕ ФУНКЦИИ */
function calculate_total_experience($experience) {
    $total_months = 0;

    foreach ($experience as $job) {
        if (empty($job['from_date'])) continue;

        $from = DateTime::createFromFormat('Y-m-d', $job['from_date']);
        $to = !empty($job['to_date']) 
            ? DateTime::createFromFormat('Y-m-d', $job['to_date']) 
            : new DateTime();

        if (!$from || !$to || $from > $to) continue;

        $diff = $from->diff($to);
        $total_months += ($diff->y * 12) + $diff->m;
    }

    $years = floor($total_months / 12);
    $months = $total_months % 12;

    return [
        'years' => $years,
        'months' => $months,
        'text' => format_experience_text($years, $months),
    ];
}

function format_experience_text($years, $months) {
    $parts = [];

    if ($years > 0) {
        $year_word = get_russian_plural($years, ['год', 'года', 'лет']);
        $parts[] = "$years $year_word";
    }

    if ($months > 0) {
        $month_word = get_russian_plural($months, ['месяц', 'месяца', 'месяцев']);
        $parts[] = "$months $month_word";
    }

    return implode(' ', $parts);
}

function get_russian_plural($number, $forms) {
    $number = abs($number) % 100;
    $n1 = $number % 10;

    if ($number > 10 && $number < 20) return $forms[2];
    if ($n1 > 1 && $n1 < 5) return $forms[1];
    if ($n1 == 1) return $forms[0];

    return $forms[2];
}


if ( ! function_exists( 'get_full_name' ) ) {
    /**
     * Get full name from last, first, and middle parts.
     *
     * @param string $last   Last name.
     * @param string $first  First name.
     * @param string $middle Middle name.
     *
     * @return string Full name in format: "Last First Middle"
     */
    function get_full_name( $last = '', $first = '', $middle = '' ) {
        $parts = [];

        if ( ! empty( $last ) ) {
            $parts[] = $last;
        }

        if ( ! empty( $first ) ) {
            $parts[] = $first;
        }

        if ( ! empty( $middle ) ) {
            $parts[] = $middle;
        }

        return implode( ' ', $parts );
    }
}

function calculate_age_in_years_and_months($birthdate) {
    if (empty($birthdate)) return false;

    $birth = DateTime::createFromFormat('Y-m-d', $birthdate);
    $today = new DateTime();

    if (!$birth) return false;

    $interval = $birth->diff($today);

    return [
        'years' => $interval->y,
        'months' => $interval->m,
    ];
}




