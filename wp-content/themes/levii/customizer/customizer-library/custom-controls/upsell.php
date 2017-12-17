<?php
/**
 * Customize for upsell button, extend the WP customizer
 *
 * @package 	Customizer_Library
 * @author		Devin Price, The Theme Foundry
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return NULL;
}

class Customizer_Library_Upsell extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	public function render_content() {
		?>
		<div class="kaira-upsell">
			<div class="kaira-upsell-title"><?php echo esc_html( $this->label ); ?></div>
            <?php printf( __( '%1$s', 'levii' ), '<a href="http://app.sellwire.net/p/MB" target="_blank" class="kaira-upsell-btn">Buy Levii Premium</a>' ); ?>
            <div class="kaira-upsell-desc"><?php printf( __( 'See the %1$s features', 'levii' ), '<a href="' . admin_url( 'themes.php?page=premium_upgrade' ) . '" target="_blank">Premium</a>' ); ?></div>
		</div>
		<?php
	}

}