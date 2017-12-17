<?php
/**
 * Nova WP custom selectors that adopt Storefront customizer settings
 *
 * @package nova-wp
 */

/**
 * Add custom CSS based on settings in Storefront core
 * @return void
 */
function nova_wp_add_customizer_css() {
	$accent_color				= storefront_sanitize_hex_color( get_theme_mod( 'storefront_accent_color', '#EA3A3C' ) );
	$button_background_color 	= storefront_sanitize_hex_color( get_theme_mod( 'storefront_button_background_color', '#EA3A3C' ) );
	$style = '
		.woocommerce-active .site-header .site-header-cart, .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-noreviews, p.no-comments{
			background: ' . $accent_color . ';
		}
		.flex-control-paging li a.flex-active {
			background: ' . $accent_color . ' !important;
		}
		.woocommerce-active .site-header .site-header-cart:before{
			border-color: transparent ' . $accent_color . ' transparent transparent;
		}
		.storefront-product-section .section-title, .related h2, .price .amount, .site-footer a:not(.button):hover, .site-branding h1 a:hover, .mini_cart_item .amount, a.remove:before, .cart .amount, .cart-collaterals .amount, h1.entry-title a:hover{
			color: ' . $accent_color . ' ;
		}
		.woocommerce-pagination .page-numbers li .page-numbers.current{
			background-color: ' . $accent_color . ';
		}
		button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart, .pagination .page-numbers li .page-numbers.current{
			background-color: ' . $button_background_color . ';
		}		
		';

	wp_add_inline_style( 'nova-wp-style', $style );
}


