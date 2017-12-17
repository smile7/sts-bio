<?php
/**
 * General setup hooks and filters
 *
 * @package nova-wp
 */

/**
 * Styles / scripts
 */
add_action( 'wp_enqueue_scripts', 	'nova_wp_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 	'nova_wp_enqueue_child_styles', 	990 );
add_action( 'wp_enqueue_scripts', 	'nova_wp_enqueue_scripts', 			999 );

add_action( 'widgets_init',	'nova_wp_widgets_init', 20 );


/**
 * Layout tweaks
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 12 );

