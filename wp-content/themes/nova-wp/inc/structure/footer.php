<?php
/**
 * Template functions used for the site footer.
 *
 * @package nova-wp
 */

if ( ! function_exists( 'nova_wp_credit' ) ) {
	function nova_wp_credit() {
		?>
        <div class="footer-info">
            <div class="site-info col-full">
                <?php echo __('&copy; ', 'nova-wp') . esc_attr( get_bloginfo( 'name', 'nova-wp' ) );  ?>
                        <?php if(is_home() || is_front_page() ){?>            
                            <?php _e('- Powered by ', 'nova-wp'); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'nova-wp' ) ); ?>" title="<?php esc_attr_e( 'WordPress' ,'nova-wp' ); ?>"><?php _e('WordPress' ,'nova-wp'); ?></a>
                            <?php _e(' and ', 'nova-wp'); ?><a href="<?php echo esc_url( __( 'http://hostmarks.com/', 'nova-wp' ) ); ?>"><?php _e('Hostmarks', 'nova-wp'); ?></a>
                        <?php } ?>
            </div><!-- .site-info -->
        </div>
		<?php
	}
}
