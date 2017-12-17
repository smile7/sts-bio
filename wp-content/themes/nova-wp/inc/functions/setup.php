<?php
/**
 * Nova WP setup functions
 *
 * @package nova-wp
 */

/**
 * Assign the Nova WP version to a var
 */
$theme 				= wp_get_theme( 'nova-wp' );
$nova_wp_version 		= $theme['Version'];
add_editor_style();
/**
 * Enqueue Storefront Styles
 * @return void
 */
function nova_wp_enqueue_styles() {
	global $storefront_version;
    wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css', $storefront_version );
}

/**
 * Enqueue Nova WP Styles
 * @return void
 */
function nova_wp_enqueue_child_styles() {
	global $nova_wp_version;

    wp_enqueue_style( 'nova-wp-style', get_stylesheet_uri(), array( 'storefront-style' ), $nova_wp_version );
	wp_enqueue_style( 'novawp-flexslider', get_stylesheet_directory_uri() . '/css/flexslider.css', array( 'nova-wp-style' )  );
}

function nova_wp_enqueue_scripts() {
	$slider_speed = 6000;
	if ( get_theme_mod( 'nova_wp_homepage_slider_speed_setting' ) ) {
			$slider_speed = esc_attr(get_theme_mod( 'nova_wp_homepage_slider_speed_setting' )) ;
		}
	wp_enqueue_script( 'novawp-flexslider-js', get_stylesheet_directory_uri() . '/js/jquery.flexslider.js', array(), '', true );
	wp_enqueue_script( 'novawp-main-js', get_stylesheet_directory_uri() . '/js/main.js', array(), '', true );
	wp_localize_script( "novawp-main-js", "slider_speed", array('vars' => $slider_speed) );
}

function nova_wp_widgets_init() {
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'header-1' );
	unregister_sidebar( 'footer-1' );
	unregister_sidebar( 'footer-2' );
	unregister_sidebar( 'footer-3' );
	unregister_sidebar( 'footer-4' );
	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'nova-wp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Banner After Header', 'nova-wp' ),
		'id'            => 'header-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) ); 
	register_sidebar( array(
		'name'          => __( 'Home Page Sidebar', 'nova-wp' ),
		'id'            => 'front-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Archives/Blog Sidebar', 'nova-wp' ),
		'id'            => 'archives-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Post Sidebar', 'nova-wp' ),
		'id'            => 'post-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'nova-wp' ),
		'id'            => 'page-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Product Sidebar', 'nova-wp' ),
		'id'            => 'product-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Product Category Sidebar', 'nova-wp' ),
		'id'            => 'product-category-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'nova-wp' ),
		'id'            => 'shop-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	$footer_widget_regions = apply_filters( 'nova_wp_footer_widget_regions', 4 );

	for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
		register_sidebar( array(
			'name' 				=> sprintf( __( 'Footer %d', 'nova-wp' ), $i ),
			'id' 				=> sprintf( 'footer-%d', $i ),
			'description' 		=> sprintf( __( 'Widgetized Footer Region %d.', 'nova-wp' ), $i ),
			'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</aside>',
			'before_title' 		=> '<h3>',
			'after_title' 		=> '</h3>',
			)
		);
	}

	

}

