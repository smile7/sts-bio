<?php
/**
 * Template functions used for the site header.
 *
 * @package nova-wp
 */

if ( ! function_exists( 'nova_wp_before_header_open' ) ) {
	function nova_wp_before_header_open() {
		echo '<div class="col-full header-top">';	
	}
}

if ( ! function_exists( 'nova_wp_before_header_close' ) ) {
	function nova_wp_before_header_close() {
		echo '</div>';
	}
}




