<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package nova-wp
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
    <?php 
		 
		if ( is_archive() || is_home() ) {
			if ( is_active_sidebar( 'archives-sidebar' ) ) {
				dynamic_sidebar( 'archives-sidebar' );
			} else {
				dynamic_sidebar( 'sidebar-1' );
			}
		} elseif ( is_front_page() ) {
			if ( is_active_sidebar( 'front-sidebar' ) ) {
				dynamic_sidebar( 'front-sidebar' );
			} else {
				dynamic_sidebar( 'sidebar-1' );
			}	
		} elseif ( is_page() ) {
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				if(is_product()  ){
					if ( is_active_sidebar( 'product-sidebar' ) ) {
						dynamic_sidebar( 'product-sidebar' );
					} else {
						dynamic_sidebar( 'sidebar-1' );
					}
				} elseif ( is_product_category() ) {
					if ( is_active_sidebar( 'product-category-sidebar' ) ) {
						dynamic_sidebar( 'product-category-sidebar' );
					} else {
						dynamic_sidebar( 'sidebar-1' );
					}
				} elseif ( is_shop() || is_checkout() || is_cart() || is_account_page() ) {
					if ( is_active_sidebar( 'shop-sidebar' ) ) { 
						dynamic_sidebar( 'shop-sidebar' );
					} else {
						dynamic_sidebar( 'sidebar-1' );
					}
				} else {
					if ( is_active_sidebar( 'page-sidebar' ) ) {
				 		dynamic_sidebar( 'page-sidebar' ); 
					} else {
						dynamic_sidebar( 'sidebar-1' );
					}
				}
			} else {
				if ( is_active_sidebar( 'page-sidebar' ) ) {
				 	dynamic_sidebar( 'page-sidebar' ); 
				} else {
					dynamic_sidebar( 'sidebar-1' );
				}
			}	 
		} elseif ( is_single() ) {
			if ( is_active_sidebar( 'post-sidebar' ) ) {
				dynamic_sidebar( 'post-sidebar' );
			} else {
				dynamic_sidebar( 'sidebar-1' );
			}
		}  else {
				dynamic_sidebar( 'sidebar-1' );
			}
		
	?>
</div><!-- #secondary -->
