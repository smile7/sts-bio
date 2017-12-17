<?php
/**
 * Nova WP Theme Customizer functions
 *
 * @package nova-wp
 */

function nova_wp_before_header_right_open(){
	echo '<div class="top-header-right">';	
}
function nova_wp_before_header_right_close(){
	echo '</div>';	
}
function nova_wp_social_icons()  { 

	$social_networks = array( 
	array( 'name' => __('RSS','nova-wp'), 'theme_mode' => 'nova_wp_rss','icon' => 'fa-rss' ),
	array( 'name' => __('Vimeo','nova-wp'), 'theme_mode' => 'nova_wp_vimeo','icon' => 'fa-vimeo-square' ),
	array( 'name' => __('Flickr','nova-wp'), 'theme_mode' => 'nova_wp_flickr','icon' => 'fa-flickr' ),
	array( 'name' => __('Instagram','nova-wp'), 'theme_mode' => 'nova_wp_instagram','icon' => 'fa-instagram' ),
	array( 'name' => __('Tumblr','nova-wp'), 'theme_mode' => 'nova_wp_tumblr','icon' => 'fa-tumblr' ),
	array( 'name' => __('Youtube','nova-wp'), 'theme_mode' => 'nova_wp_youtube','icon' => 'fa-youtube' ),
	array( 'name' => __('Linkedin','nova-wp'), 'theme_mode' => 'nova_wp_linkedin','icon' => 'fa-linkedin' ),
	array( 'name' => __('Pinterest','nova-wp'), 'theme_mode' => 'nova_wp_pinterest','icon' => 'fa-pinterest' ),
	array( 'name' => __('Google+','nova-wp'), 'theme_mode' => 'nova_wp_google','icon' => 'fa-google-plus' ),
	array( 'name' => __('Twitter','nova-wp'), 'theme_mode' => 'nova_wp_twitter','icon' => 'fa-twitter' ),
	array( 'name' => __('Facebook','nova-wp'), 'theme_mode' => 'nova_wp_facebook','icon' => 'fa-facebook' ),
	);


	for ($row = 0; $row < 11; $row++){
		if (get_theme_mod( $social_networks[$row]["theme_mode"])): ?>
			<a href="<?php echo esc_url( get_theme_mod($social_networks[$row]['theme_mode']) ); ?>" class="social-tw" title="<?php echo esc_url( get_theme_mod( $social_networks[$row]['theme_mode'] ) ); ?>" target="_blank">
			<span class="fa <?php echo $social_networks[$row]['icon']; ?>"></span> 
			</a>
		<?php endif;
	}
                      
}
if ( ! function_exists( 'nova_wp_sanitize_category' ) ){
	function nova_wp_sanitize_category( $input ) {
		$categories = get_categories();
		$cats = array();
		$i = 0;
		foreach($categories as $category){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats[$category->slug] = $category->name;
		}
		$valid = $cats;
	 
		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}
}
if ( ! function_exists( 'nova_wp_sanitize_integer' ) ) :
	function nova_wp_sanitize_integer( $input ) {		
		return absint($input);
	}
endif;