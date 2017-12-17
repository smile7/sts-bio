<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package nova-wp
 */
function nova_wp_slider() {
	$slider_cat = esc_attr(get_theme_mod( 'nova_wp_homepage_category_slider_setting'));
	$enable = esc_attr(get_theme_mod( 'nova_wp_homepage_disable_slider_setting'));	
	if(!$enable){	 
	$args =	array(
		'offset'           => 0,
		'category_name' => $slider_cat,
		'posts_per_page' => -1,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);
	$the_query = new WP_Query( $args );
?>
<?php if ($the_query->have_posts()) : ?> 
    <div class="flexslider">
      <ul class="slides">
      	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?> 
				<?php
                if ( has_post_thumbnail() ) { 
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                ?>
                <li>
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $large_image_url[0]; ?>" /></a>
                </li>
                <?php } ?>
        
		<?php endwhile; ?>
      </ul>
    </div>
<?php endif; ?> 
<?php wp_reset_query(); ?>    
<?php
	}
}

function nova_wp_product_category( $args ) {
	$columns_count = column_count(get_theme_mod( 'nova_wp_homepage_categories_column_setting' ));
	if ( get_theme_mod( 'nova_wp_homepage_categories_to_display_setting' ) ){
		$args['limit'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_categories_to_display_setting' ));
	}
	if ( get_theme_mod( 'nova_wp_homepage_slected_categories_setting' ) ){
		$args['ids'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_slected_categories_setting' ));
	}
	$args['columns'] = $columns_count;
 
	return $args;
}

function column_count($cat_display_count){
	switch ($cat_display_count) {
		case "two":
			$columns_count = 2;
			break;
		case "four":
			$columns_count = 4;
			break;
		case "five":
			$columns_count = 5;
			break;
		default:
			$columns_count = 3;
	}
	return $columns_count;
}

function nova_wp_recent_products( $args ) {	
	$columns_count = esc_attr(column_count(get_theme_mod( 'nova_wp_homepage_recent_column_setting', "four" )));		
	if ( get_theme_mod( 'nova_wp_homepage_recent_title_setting' ) ){
		$args['title'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_recent_title_setting' ));
	}
	if ( get_theme_mod( 'nova_wp_homepage_recent_to_display_setting' ) ){
		$args['limit'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_recent_to_display_setting', 4 ));
	}
	$args['columns'] = $columns_count;
 
	return $args;	
}

function nova_wp_featured_products( $args ) {	
	$columns_count = esc_attr(column_count(get_theme_mod( 'nova_wp_homepage_featured_column_setting', "four" )));		
	if ( get_theme_mod( 'nova_wp_homepage_featured_title_setting' ) ){
		$args['title'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_featured_title_setting' ));
	}
	if ( get_theme_mod( 'nova_wp_homepage_featured_to_display_setting' ) ){
		$args['limit'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_featured_to_display_setting' ));
	}
	$args['columns'] = $columns_count; 
	return $args;	
}
function nova_wp_top_rated_products( $args ) {	
	$columns_count = esc_attr(column_count(get_theme_mod( 'nova_wp_homepage_top_rated_column_setting', "four" )));	
	if ( get_theme_mod( 'nova_wp_homepage_top_rated_title_setting' ) ){
		$args['title'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_top_rated_title_setting' ));
	}
	if ( get_theme_mod( 'nova_wp_homepage_top_rated_to_display_setting' ) ){
		$args['limit'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_top_rated_to_display_setting', 4 ));
	}
	$args['columns'] = $columns_count; 
	return $args;	
}

function nova_wp_on_sale_products( $args ) {	
	$columns_count = esc_attr(column_count(get_theme_mod( 'nova_wp_homepage_on_sale_column_setting', "four" )));	
	if ( get_theme_mod( 'nova_wp_homepage_on_sale_title_setting' ) ){
		$args['title'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_on_sale_title_setting' ));
	}
	if ( get_theme_mod( 'nova_wp_homepage_on_sale_to_display_setting' ) ){
		$args['limit'] 		= esc_attr(get_theme_mod( 'nova_wp_homepage_on_sale_to_display_setting', 4 ));
	}
	$args['columns'] = $columns_count; 
	return $args;	
}

function nova_wp_page_conditional_tag() {
	if ( is_front_page() ) {	
		remove_action( 'storefront_page', 'storefront_page_header', 10 );
    }
}

function nova_wp_manage_home(){	
	if(!(get_theme_mod( 'nova_wp_homepage_categories_setting', true ))){
		remove_action( 'homepage',		'nova_wp_product_categories',			20 );
	}
	if(!(get_theme_mod( 'nova_wp_homepage_recent_setting', true ))){
		remove_action( 'homepage',		'storefront_recent_products',			30 );
	}
	if(!(get_theme_mod( 'nova_wp_homepage_featured_setting', true ))){
		remove_action( 'homepage',		'storefront_featured_products',			40 );
	}
	if(!(get_theme_mod( 'nova_wp_homepage_top_rated_setting', true ))){
		remove_action( 'homepage',		'storefront_popular_products',			50 );
	}
	if(!(get_theme_mod( 'nova_wp_homepage_on_sale_setting', true ))){
		remove_action( 'homepage',		'storefront_on_sale_products',			60 );
	}	
}

function nova_wp_product_categories( $args ) {
		if ( is_woocommerce_activated() ) {
			$args = apply_filters( 'nova_wp_product_categories_args', array(
				'limit' 			=> 3,
				'columns' 			=> 3,
				'child_categories' 	=> 0,
				'orderby' 			=> 'name',
				'title'				=> __( 'Product Categories', 'nova-wp' ),
				'ids'				=> ''
				) );
			echo '<section class="storefront-product-section storefront-product-categories">';
				echo storefront_do_shortcode( 'product_categories',
					array(
						'number' 	=> intval( $args['limit'] ),
						'columns'	=> intval( $args['columns'] ),
						'orderby'	=> esc_attr( $args['orderby'] ),
						'parent'	=> esc_attr( $args['child_categories'] ),
						'ids'		=> $args['ids'] 
						) );
			echo '</section>';

		}
	}		

?>