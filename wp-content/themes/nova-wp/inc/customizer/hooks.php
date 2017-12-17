<?php
/**
 * General setup hooks and filters
 *
 * @package nova-wp
 */

/**
 * Add Nova WP specific CSS selectors based on customizer settings
 */
add_action( 'wp_enqueue_scripts', 								'nova_wp_add_customizer_css', 1000 );

/**
 * Adjust Nova WP default controls
 */
add_action( 'customize_register',								'nova_wp_customize_storefront_controls', 10);

add_action( 'storefront_before_header', 						'nova_wp_before_header_right_open', 16 );
add_action( 'storefront_before_header', 						'storefront_secondary_navigation', 17);
add_action( 'storefront_before_header', 						'nova_wp_social_icons', 18 );
add_action( 'storefront_before_header', 						'nova_wp_before_header_right_close', 19 );

add_filter( 'storefront_default_heading_color', 				'nova_wp_color_charcoal' );
add_filter( 'storefront_default_footer_heading_color', 			'nova_wp_color_charcoal' );


// The navigation bg
add_filter( 'storefront_default_header_background_color', 		'nova_wp_color_charcoal' );
add_filter( 'storefront_default_footer_background_color', 		'nova_wp_color_off_white' );
add_filter( 'storefront_default_header_link_color', 			'nova_wp_color_white' );
add_filter( 'storefront_default_header_text_color', 			'nova_wp_color_black' );

add_filter( 'storefront_default_footer_link_color', 			'nova_wp_color_charcoal' );

add_filter( 'storefront_default_button_background_color', 		'nova_wp_color_red' );
add_filter( 'storefront_default_button_alt_background_color', 	'nova_wp_color_charcoal' );
add_filter( 'storefront_default_text_color', 					'nova_wp_color_charcoal' );
add_filter( 'storefront_default_accent_color', 					'nova_wp_color_red' );

add_filter( 'storefront_default_background_color', 				'nova_wp_color_white' );
