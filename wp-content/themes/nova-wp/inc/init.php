<?php
/**
 * Nova WP engine room
 *
 * @package nova-wp
 */

/*
 * Structure.
 * Template functions used throughout the theme.
 */

require get_stylesheet_directory() . '/inc/structure/hooks.php';
require get_stylesheet_directory() . '/inc/structure/header.php';
require get_stylesheet_directory() . '/inc/structure/post.php';
require get_stylesheet_directory() . '/inc/structure/page.php';
require get_stylesheet_directory() . '/inc/structure/footer.php';
require get_stylesheet_directory() . '/inc/structure/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_stylesheet_directory() . '/inc/functions/hooks.php'; 

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer/hooks.php';
require get_stylesheet_directory() . '/inc/customizer/controls.php';
require get_stylesheet_directory() . '/inc/customizer/functions.php';
require get_stylesheet_directory() . '/inc/customizer/display.php'; 
require get_stylesheet_directory() . '/inc/customizer/colors.php';

 
/**
 * Setup.
 * Enqueue styles, specify color functions, etc.
 */
require get_stylesheet_directory() . '/inc/functions/setup.php';




