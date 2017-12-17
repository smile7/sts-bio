<?php
/**
 * levii functions and definitions
 *
 * @package levii
 */
define( 'LEVII_THEME_VERSION' , '1.1.1' );

if ( ! function_exists( 'levii_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function levii_theme_setup() {
    
    /**
     * Set the content width based on the theme's design and stylesheet.
     */
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 718; /* pixels */
    }

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on levii, use a find and replace
	 * to change 'levii' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'levii', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
    
    add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
    add_theme_support('post-thumbnails');
    
    add_image_size('levii_blog_img_side', 400, 480, true );
    add_image_size('levii_blog_img_top', 720, 260, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'levii' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
    
    // The custom header is used for top header image
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width'         => 1000,
        'height'        => 360,
        'flex-width' => false,
        'flex-height' => true,
        'header-text' => false,
    ));
    
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'levii_custom_background_args', array(
		'default-color' => 'F0F0F0',
		'default-image' => '',
	) ) );
    
    add_theme_support( 'woocommerce' );
}
endif; // levii_theme_setup
add_action( 'after_setup_theme', 'levii_theme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function levii_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'levii' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'levii_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function levii_theme_scripts() {
    wp_enqueue_style( 'levii-google-body-font-default', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic', array(), LEVII_THEME_VERSION );
    wp_enqueue_style( 'levii-google-heading-font-default', '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic', array(), LEVII_THEME_VERSION );
    
    wp_enqueue_style( 'levii-fontawesome', get_template_directory_uri().'/includes/font-awesome/css/font-awesome.css', array(), '4.0.3' );
	wp_enqueue_style( 'levii-style', get_stylesheet_uri(), array(), LEVII_THEME_VERSION );

	wp_enqueue_script( 'levii-navigation', get_template_directory_uri() . '/js/navigation.js', array(), LEVII_THEME_VERSION, true );
    wp_enqueue_script( 'levii-caroufredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), LEVII_THEME_VERSION, true );
    
    wp_enqueue_script( 'levii-customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'), LEVII_THEME_VERSION, true );

	wp_enqueue_script( 'levii-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), LEVII_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'levii_theme_scripts' );

// add the favicon to the header if set
function levii_site_favicon() {
    if ( get_theme_mod( 'kra-header-favicon', false ) ) :
        echo '<link rel="icon" href="' . esc_url( get_theme_mod( 'kra-header-favicon' ) ) . '">';
    endif;
}
add_action('wp_head', 'levii_site_favicon');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

// Helper library for the theme customizer.
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';

// Define options for the theme customizer.
require get_template_directory() . '/customizer/customizer-options.php';

// Output inline styles based on theme customizer selections.
require get_template_directory() . '/customizer/styles.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/customizer/mods.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Display the premium admin menu
 *
 * @action admin_menu
 */
function levii_premium_admin_menu() {
    global $levii_upgrade_page;
    $levii_upgrade_page = add_theme_page( __( 'Levii Premium', 'levii' ), __( 'Levii Premium', 'levii' ), 'edit_theme_options', 'premium_upgrade', 'levii_upgrade_page_render' );
}

add_action( 'admin_menu', 'levii_premium_admin_menu' );

/**
 * Render the theme upgrade page
 */
function levii_upgrade_page_render() {
    locate_template( 'upgrade/kaira-upgrade-page.php', true, false );
}

/**
 * Enqueue Levii admin stylesheet only on upgrade page.
 */
function levii_load_admin_style($hook) {
    global $levii_upgrade_page;
 
    if( $hook != $levii_upgrade_page ) 
        return;
    
    wp_enqueue_style( 'levii-admin-css', get_template_directory_uri() . '/upgrade/css/kaira-admin.css' );
}    
add_action( 'admin_enqueue_scripts', 'levii_load_admin_style' );

/**
 * Enqueue Levii custom customizer styling.
 */
function levii_load_customizer_style() {
    wp_enqueue_style( 'levii-customizer-css', get_template_directory_uri() . '/customizer/customizer-library/css/customizer.css' );
}    
add_action( 'customize_controls_enqueue_scripts', 'levii_load_customizer_style' );

/* Display the recommended plugins notice that can be dismissed */
add_action('admin_notices', 'levii_recommended_plugin_notice');

function levii_recommended_plugin_notice() {
    global $pagenow;
    global $current_user;
    
    $user_id = $current_user->ID;
    
    /* If on plugins page, check that the user hasn't already clicked to ignore the message */
    if ( $pagenow == 'plugins.php' ) {
        if ( ! get_user_meta( $user_id, 'levii_recommended_plugin_ignore_notice' ) ) {
            echo '<div class="updated"><p>';
            printf( __( '<p>Install the plugins we recommend | <a href="%1$s">Hide Notice</a></p>', 'levii' ), '?levii_recommended_plugin_nag_ignore=0' ); ?>
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'WooCommerce', 'levii' ), 'levii' ); ?></a><br />
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'SiteOrigin\'s Page Builder', 'levii' ), 'levii' ); ?></a><br />
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'Meta Slider', 'levii' ), 'levii' ); ?></a>
            <?php
            echo '</p></div>';
        }
    }
}
add_action('admin_init', 'levii_recommended_plugin_nag_ignore');

function levii_recommended_plugin_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
        
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset($_GET['levii_recommended_plugin_nag_ignore']) && '0' == $_GET['levii_recommended_plugin_nag_ignore'] ) {
        add_user_meta( $user_id, 'levii_recommended_plugin_ignore_notice', 'true', true );
    }
}

/**
 * Adjust is_home query if kra-blog-cats is set
 */
function levii_set_blog_queries( $query ) {
    $blog_query_set = '';
    if ( get_theme_mod( 'kra-blog-cats', false ) ) {
        $blog_query_set = get_theme_mod( 'kra-blog-cats' );
    }
    
    if ( $blog_query_set ) {
        // do not alter the query on wp-admin pages and only alter it if it's the main query
        if ( !is_admin() && $query->is_main_query() ){
            if ( is_home() ){
                $query->set( 'cat', $blog_query_set );
            }
        }
    }
}
add_action( 'pre_get_posts', 'levii_set_blog_queries' );