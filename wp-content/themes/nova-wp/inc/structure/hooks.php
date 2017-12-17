<?php
/**
 * Nova WP structural hooks and filters
 *
 * @package nova-wp
 */

/**
 * Layout
 */ 
add_action( 'init' , 'nova_wp_remove_stuff' , 15 );
function nova_wp_remove_stuff() {		
	remove_action( 'storefront_content_top',	'woocommerce_breadcrumb',			10 );
	remove_action( 'storefront_loop_post',		'storefront_post_header',			10 );
	remove_action( 'storefront_single_post',	'storefront_post_header',			10 );
	remove_action( 'homepage', 					'storefront_product_categories',	20 );
	remove_action( 'storefront_header', 		'storefront_site_branding', 		20 );
	remove_action( 'storefront_loop_post',		'storefront_post_meta',				20 );
	remove_action( 'storefront_single_post',	'storefront_post_meta',				20 );
	remove_action( 'storefront_loop_post',		'storefront_post_content',			30 );
	remove_action( 'storefront_header',			'storefront_secondary_navigation',	30 );
	remove_action( 'storefront_header',			'storefront_product_search', 		40 );
	remove_action( 'storefront_footer',			'storefront_credit',				20 );
}
add_action( 'wp_head' , 				'nova_wp_manage_home' , 		15 );
add_action( 'nova_wp_slider',			'nova_wp_slider',				9 );
add_action( 'storefront_before_header', 'nova_wp_before_header_open', 	10 );
add_action( 'storefront_before_header', 'storefront_site_branding', 	13 );
add_action( 'storefront_before_header', 'nova_wp_before_header_close', 	20 );
add_action( 'homepage',					'nova_wp_product_categories',	20 );

/**
 * Post / Page
 */
add_action( 'loop_start', 				'nova_wp_page_conditional_tag'	 );
add_action( 'novawp_before_excerpt',	'novawp_post_header',			10 );
add_action( 'novawp_after_excerpt',		'novawp_post_meta',				10 );
add_action( 'storefront_single_post',	'novawp_post_header',			10 );
add_action( 'storefront_loop_post',		'novawp_post_thumbnail',		20 );
add_action( 'storefront_loop_post',		'novawp_post_excerpt',			30 );

/**
 * Footer
 */
add_action( 'storefront_after_footer',		'nova_wp_credit',			20 );

/**
 * Homepage
 * @see  nova_wp_product_category()
 * @see  nova_wp_recent_products()
 * @see  nova_wp_featured_products()
 * @see  nova_wp_top_rated_products()
 * @see  nova_wp_on_sale_products()
 */
add_filter( 'nova_wp_product_categories_args', 		'nova_wp_product_category', 	99 );
add_filter( 'storefront_recent_products_args', 		'nova_wp_recent_products', 		99 );
add_filter( 'storefront_featured_products_args', 	'nova_wp_featured_products', 	99 );
add_filter( 'storefront_popular_products_args', 	'nova_wp_top_rated_products', 	99 );
add_filter( 'storefront_on_sale_products_args', 	'nova_wp_on_sale_products', 	99 );



