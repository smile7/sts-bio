<?php 
/**
 * Library of Theme options functions.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/

// Display Breadcrumb navigation
function maryanne_get_breadcrumb() { 
global $maryanne_options_db;
		if ($maryanne_options_db['maryanne_display_breadcrumb'] != 'Hide') { ?>
<?php if(function_exists( 'bcn_display' ) && !is_front_page()){ _e('<div id="breadcrumb-navigation"><p>', 'maryanne'); ?><?php bcn_display(); ?><?php _e('</p></div>', 'maryanne');} ?>
<?php } 
} 

// Display featured images on single posts
function maryanne_get_display_image_post() { 
global $maryanne_options_db;
		if ($maryanne_options_db['maryanne_display_image_post'] == '' || $maryanne_options_db['maryanne_display_image_post'] == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
}

// Display featured images on pages
function maryanne_get_display_image_page() { 
global $maryanne_options_db;
		if ($maryanne_options_db['maryanne_display_image_page'] == '' || $maryanne_options_db['maryanne_display_image_page'] == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
} ?>