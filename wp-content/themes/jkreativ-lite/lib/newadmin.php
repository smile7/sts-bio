<?php

/**
 * Themes option
 */
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Activates Theme Mode
 */
add_filter( 'ot_theme_mode', '__return_true' );
	

/**
 * Loads OptionTree
 */
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );


/**
 * Loads Theme Options
 */
load_template( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );


