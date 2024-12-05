<?php
/**
 * colombiahumana functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package colombiahumana
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
function colombiahumana_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on colombiahumana, use a find and replace
		* to change 'colombiahumana' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'colombiahumana', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'colombiahumana' ),
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
			'colombiahumana_custom_background_args',
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
add_action( 'after_setup_theme', 'colombiahumana_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function colombiahumana_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'colombiahumana_content_width', 640 );
}
add_action( 'after_setup_theme', 'colombiahumana_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function colombiahumana_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'colombiahumana' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'colombiahumana' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'colombiahumana_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function colombiahumana_scripts() {
	wp_enqueue_style( 'colombiahumana-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'colombiahumana-style', 'rtl', 'replace' );

	wp_enqueue_script( 'colombiahumana-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'colombiahumana_scripts' );

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

function my_login_logo() { ?>
    <style type="text/css">
		
		/** @import url("https://www.colombiahumana.co/portal/assets/fonts/fonts.css"); **/
		.user-pass-wrap, p.forgetmenot, #login form p.submit, #login form p {
			display:none;
		}
		#login {
			display: none !important;
		}
		
		input[type=email], input[type=url] {
			width: 100%;
		}
		
		.login input[type=number] {
			font-size: 24px;
			line-height: 1.33333333;
			width: 100%;
			border-width: .0625rem;
			padding: .1875rem .3125rem;
			margin: 0 6px 16px 0;
			min-height: 40px;
			max-height: none;
		}
		
		.woo-slg-login-loader {
			text-align: center;
		}
		
		.woo-slg-social-container-login {
			display: none;
		}

		.woo-slg-horizontal-divider {
			display: none !important;
		}

		.woo-slg-email-login-container > span > legend {
			font-size: 0px !important;
			background-image: none, url(https://www.colombiahumana.co/portal/wp-content/uploads/2024/07/colombia-humana-500-x-200-px-2-1-1.png);
			background-size: 200px;
			background-position: center top;
			background-repeat: no-repeat;
			height: 44px;
		}

		.woo-slg-email-login-container {
			max-width: 400px !important;
			width: 100% !important;
			display: grid;
			align-content: center;
			padding: 0 !important;
			min-height: 100vh;
		}

		.woo-slg-email-login-wrap {
			background: #fff;
			padding: 30px !important;
			border-radius: 5px;
		}

		.woo-slg-email-login-btn,
		.woo-slg-email-login-btn-otp {
			font-weight: 300 !important;
			background-color: #2b50ed !important;
			border-radius: 6px !important;
			border: none !important;
			box-shadow: 0 8px 26px 0 rgba(34, 60, 169, .31) !important;
			padding-top: 5px !important;
			padding-bottom: 5px !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
			font-size: 14px !important;
			color: white;
			min-height: 32px;
			width: 100%;
			line-height: 2.30769231;
		}

		.woo-slg-email-login-btn-otp:hover {
			background-color: #2644c5 !important;
		}
		
		.woo-slg-email-login-btn {
			font-weight: 500 !important;
			color: #212121;
			background: #f5f5f5 !important;
			box-shadow: none !important;
			background-image: url("https://cdn-icons-png.flaticon.com/512/2541/2541620.png") !important;
			background-repeat: no-repeat !important;
			background-size: 16px !important;
			background-position-x: 44px !important;
			background-position-y: center !important;
		}

		.woo-slg-email-login-btn:hover {
			background-color: #EEE !important;
		}

		input.regular-text.woo-slg-email-login.woo-slg-email-input {
			font-size: 16px;
		}
		
		
		
		
		
		#login h1 a, .login h1 a {
			background-image: url(https://www.colombiahumana.co/portal/wp-content/uploads/2024/07/colombia-humana-500-x-200-px-2-1-1.png);
			background-image: none, url(https://www.colombiahumana.co/portal/wp-content/uploads/2024/07/colombia-humana-500-x-200-px-2-1-1.png);
			background-size: 200px;
			background-position: center top;
			background-repeat: no-repeat;
			color: #3c434a;
			height: 44px;
			font-size: 20px;
			font-weight: 400;
			line-height: 1.3;
			margin: 0 auto 25px;
			padding: 0;
			text-decoration: none;
			width: 100%;
			text-indent: -9999px;
			outline: 0;
			overflow: hidden;
			display: block;
		}
		#backtoblog, .language-switcher, .login #nav {
			display: none;
		}
		
		input[value="Login with Password"] {
			display: none !important;
		}
		.wp-core-ui .button.button-large {
			width: 100% !important;
			margin-top: 10px;
		}
		
		#loginform > p > label[for=user_login]:after {
			content: "Correo electrónico";
			font-size: 14px !important;
		}

		#loginform > p > label[for=user_login] {
			font-size: 0px;
		}

		body {
			font-family: Portal, -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif !important;
			background: #f5f5f5 !important;
		}

		.login form {
			box-shadow: none !important;
			border: none !important;
			padding: 30px !important;
			border-radius: 5px;
		}

		.wp-core-ui .button-primary {
			font-weight: 300;
			background: #2b50ed !important;
			border-radius: 6px !important;
			border: none !important;
			box-shadow: 0 8px 26px 0 rgba(34,60,169,.31) !important;
			padding-top: 5px !important;
			padding-bottom: 5px !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
			font-size: 14px !important;
		}

		#login {
			max-width: 400px;
			width: 100% !important;
			min-height: 100vh;
			display: grid;
			align-content: center;
			padding: 0 !important;
		}

		.wp-core-ui .button-primary:hover {
			background: #2644c5 !important;
		}
		.wp-core-ui .button-primary:active {
			background: #2644c5 !important;
		}

		.login #nav {
			text-align: center;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**
 * AJAX handler for votaciones filters
 */
function filter_votaciones_handler() {
    $categories = isset($_GET['categories']) ? explode(',', sanitize_text_field($_GET['categories'])) : array();
    $tags = isset($_GET['tags']) ? explode(',', sanitize_text_field($_GET['tags'])) : array();
    $authors = isset($_GET['authors']) ? explode(',', sanitize_text_field($_GET['authors'])) : array();
    $order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'desc';

    $args = array(
        'post_type' => 'votacion',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => strtoupper($order),
    );

    // Add category filter
    if (!empty($categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $categories,
        );
    }

    // Add tag filter
    if (!empty($tags)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => $tags,
        );
    }

    // Add author filter
    if (!empty($authors)) {
        $args['author__in'] = $authors;
    }

    // Add multiple taxonomy relation if both categories and tags are present
    if (!empty($categories) && !empty($tags)) {
        $args['tax_query']['relation'] = 'AND';
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $author_id = get_the_author_meta('ID');
            ?>
            <a href="<?php the_permalink(); ?>" class="block">
                <article class="group relative overflow-hidden rounded-lg border bg-background p-6 hover:border-accent transition-all">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-4 aspect-video overflow-hidden rounded-md">
                            <?php the_post_thumbnail('medium', array('class' => 'h-full w-full object-cover transition-all group-hover:scale-105')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="flex flex-col space-y-1.5">
                        <h3 class="text-2xl font-semibold leading-none tracking-tight"><?php the_title(); ?></h3>
                        
                        <div class="flex items-center text-sm text-slate-500 space-x-2">
                            <div class="flex items-center space-x-2">
                                <?php echo get_avatar($author_id, 24, '', '', array('class' => 'rounded-full')); ?>
                                <span><?php the_author(); ?></span>
                            </div>
                            <span>•</span>
                            <time datetime="<?php echo get_the_date('c'); ?>" class="text-xs"><?php echo get_the_date(); ?></time>
                        </div>

                        <div class="text-sm text-slate-600 mb-4"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
                        
                        <button class="w-full px-4 py-2 text-sm font-medium text-white bg-slate-900 rounded-md hover:bg-slate-800 transition-colors">Ver más</button>
                    </div>
                </article>
            </a>
            <?php
        endwhile;
    else :
        ?>
        <div class="col-span-full text-center py-8 text-slate-600">
            No se encontraron votaciones.
        </div>
        <?php
    endif;

    wp_reset_postdata();
    die();
}
add_action('wp_ajax_filter_votaciones', 'filter_votaciones_handler');
add_action('wp_ajax_nopriv_filter_votaciones', 'filter_votaciones_handler');

/**
 * Register Votacion post type
 */
function register_votacion_post_type() {
    $labels = array(
        'name'               => 'Votaciones',
        'singular_name'      => 'Votación',
        'menu_name'          => 'Votaciones',
        'add_new'            => 'Añadir Nueva',
        'add_new_item'       => 'Añadir Nueva Votación',
        'edit_item'          => 'Editar Votación',
        'new_item'           => 'Nueva Votación',
        'view_item'          => 'Ver Votación',
        'search_items'       => 'Buscar Votaciones',
        'not_found'          => 'No se encontraron votaciones',
        'not_found_in_trash' => 'No se encontraron votaciones en la papelera',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'votaciones'),
        'capability_type'    => 'post',
        'menu_icon'          => 'dashicons-chart-bar',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'         => array('category', 'post_tag'),
    );

    register_post_type('votacion', $args);
}
add_action('init', 'register_votacion_post_type');

/**
 * Redirect non-logged-in users to the login page
 */
function redirect_non_logged_in_users() {
    if (!is_user_logged_in() && !is_login()) {
        wp_redirect(wp_login_url());
        exit();
    }
}
add_action('template_redirect', 'redirect_non_logged_in_users');

/**
 * Hide admin bar for subscribers on frontend
 */
function hide_admin_bar_for_subscribers() {
    if (current_user_can('subscriber') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'hide_admin_bar_for_subscribers');