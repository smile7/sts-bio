<?php

function jkreativ_lite_init_variable()
{
	/* jkreativ */
	defined( 'JEG_THEMENAME' ) or define("JEG_THEMENAME", 'Jkreativ');
	defined( 'JEG_SHORTNAME' ) or define("JEG_SHORTNAME", 'jkreativ');
	defined( 'JEG_THEME' ) or define("JEG_THEME", 'jegtheme');

	/* themes version */
	$themeData    = wp_get_theme();
	$themeVersion = trim($themeData['Version']);
	if (!$themeVersion) $themeVersion = "1.0.0";
	define("JEG_VERSION", $themeVersion);


	// support feed link
	add_theme_support( 'automatic-feed-links' );

	// Support custom background
	add_theme_support( 'custom-background', array('default-color' => 'eeeeee') );

	// unnecesary add
	if ( ! isset( $content_width ) ) $content_width = 900;
}

jkreativ_lite_init_variable();

/**
 * setup page id
 */

function jkreativ_lite_init_page_variable() {
	defined( 'JEG_PAGE_ID' ) or define('JEG_PAGE_ID', get_the_ID());
	jkreativ_lite_set_post_views(get_the_ID());
}

add_action('get_header', 'jkreativ_lite_init_page_variable');
