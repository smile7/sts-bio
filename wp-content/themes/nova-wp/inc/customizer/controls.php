<?php
/**
 * Nova WP Customizer controls
 *
 * @package nova-wp
 */

/**
 * Customize some of the default Storefront controls.
 * @return void
 */
function nova_wp_customize_storefront_controls( $wp_customize ) {
		$wp_customize->add_panel( 'nova_wp_homepage_panel', array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => 'Homepage',
			'description'    => '',
		) );
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
		$wp_customize->add_section( 'nova_wp_homepage_slider_section' , array(
			'title'       => __( 'Slider Option', 'nova-wp' ),
			'priority'    => 20,
			'panel'  => 'nova_wp_homepage_panel',
		) );

		$wp_customize->add_setting('nova_wp_homepage_disable_slider_setting', array(
			'default'        => false,
			'sanitize_callback' => 'storefront_sanitize_checkbox',
		));
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_disable_slider', array(
			'label'    => __( 'Disable Slider', 'nova-wp' ),
			'section'  => 'nova_wp_homepage_slider_section',
			'settings' => 'nova_wp_homepage_disable_slider_setting',
			'type'     => 'checkbox',
			'priority'    => 21,
		) ) );
		 
		
		$wp_customize->add_setting('nova_wp_homepage_category_slider_setting', array(
			'sanitize_callback' => 'nova_wp_sanitize_category',
		));
		 
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_category_slider', array(
			'type' => 'select',
			'label' => 'Select Category:',
			'section'  => 'nova_wp_homepage_slider_section',
			'settings' => 'nova_wp_homepage_category_slider_setting',
			'choices' => $cats,
			'priority'    => 22,
		)));
		$wp_customize->add_setting( 'nova_wp_homepage_slider_speed_setting', array (
			'default' => '6000',
			'sanitize_callback' => 'nova_wp_sanitize_integer',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_slider_speed', array(
			'label'    => __( 'Slider Speed (milliseconds)', 'nova-wp' ),
			'section'  => 'nova_wp_homepage_slider_section',
			'settings' => 'nova_wp_homepage_slider_speed_setting',
			'priority'    => 23,
		) ) );
		
		// Category
		$wp_customize->add_section( 'nova_wp_homepage_categories_section' , array(
			'title'       => __( 'Product Category', 'nova-wp' ),
			'priority'    => 20,
			'panel'  => 'nova_wp_homepage_panel',
		) );
		
		$wp_customize->add_setting('nova_wp_homepage_categories_setting', array(
			'default'        => true,
			'sanitize_callback' => 'storefront_sanitize_checkbox',
		));
	 
		$wp_customize->add_control('nova_wp_homepage_categories', array(
			'settings' => 'nova_wp_homepage_categories_setting',
			'label'    => __('Display product categories', 'nova-wp'),
			'section'  => 'nova_wp_homepage_categories_section',
			'type'     => 'checkbox',
		));
		
		$wp_customize->add_setting('nova_wp_homepage_slected_categories_setting', array(
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_slected_categories', array(
			'label'      => __( 'Enter the category Id\'s to include', 'nova-wp' ),
			'description' => __( 'separated by commas. Example: (1, 2, 3)', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_categories_section',
			'settings'   => 'nova_wp_homepage_slected_categories_setting',
			'type'   	=> 	'text',
	    ) ) );	
		
		$wp_customize->add_setting('nova_wp_homepage_categories_column_setting', array(
			'default'        => 'three',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_categories_column', array(
			'label'      => __( 'Product categories columns', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_categories_section',
			'settings'   => 'nova_wp_homepage_categories_column_setting',
			'type'   	=> 	'select',
			'choices' => array(
				'two' => 2,
				'three' => 3,
				'four' => 4,
				'five' => 5,
			),
	    ) ) );	
		
		$wp_customize->add_setting('nova_wp_homepage_categories_to_display_setting', array(
			'default'        => 3,
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_categories_to_display', array(
			'label'      => __( 'Product categories to display', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_categories_section',
			'settings'   => 'nova_wp_homepage_categories_to_display_setting',
			'type'   	=> 	'text',
	    ) ) );
		
		//Recent
		$wp_customize->add_section( 'nova_wp_homepage_recent_section' , array(
			'title'       => __( 'Recent Products', 'nova-wp' ),
			'priority'    => 20,
			'panel'  => 'nova_wp_homepage_panel',
		) );
		
		$wp_customize->add_setting('nova_wp_homepage_recent_setting', array(
			'default'        => true,
			'sanitize_callback' => 'storefront_sanitize_checkbox',
		));
	 
		$wp_customize->add_control('nova_wp_homepage_recent', array(
			'settings' => 'nova_wp_homepage_recent_setting',
			'label'    => __('Display recent products', 'nova-wp'),
			'section'  => 'nova_wp_homepage_recent_section',
			'type'     => 'checkbox',
		));
		
		$wp_customize->add_setting('nova_wp_homepage_recent_title_setting', array(
			'default'        => 'Recent Products',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_recent_title', array(
			'label'      => __( 'Recent product title', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_recent_section',
			'settings'   => 'nova_wp_homepage_recent_title_setting',
			'type'   	=> 	'text',
	    ) ) );		
		
		$wp_customize->add_setting('nova_wp_homepage_recent_column_setting', array(
			'default'        => 'four',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_recent_column', array(
			'label'      => __( 'Recent products columns', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_recent_section',
			'settings'   => 'nova_wp_homepage_recent_column_setting',
			'type'   	=> 	'select',
			'choices' => array(
				'two' => 2,
				'three' => 3,
				'four' => 4,
				'five' => 5,
			),
	    ) ) );	
		
		$wp_customize->add_setting('nova_wp_homepage_recent_to_display_setting', array(
			'default'        => 4,
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_recent_to_display', array(
			'label'      => __( 'Recent products to display', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_recent_section',
			'settings'   => 'nova_wp_homepage_recent_to_display_setting',
			'type'   	=> 	'text',
	    ) ) );
		
		// Featured
		$wp_customize->add_section( 'nova_wp_homepage_featured_section' , array(
			'title'       => __( 'Featured Products', 'nova-wp' ),
			'priority'    => 20,
			'panel'  => 'nova_wp_homepage_panel',
		) );
		
		$wp_customize->add_setting('nova_wp_homepage_featured_setting', array(
			'default'        => true,
			'sanitize_callback' => 'storefront_sanitize_checkbox',
		));
	 
		$wp_customize->add_control('nova_wp_homepage_featured', array(
			'settings' => 'nova_wp_homepage_featured_setting',
			'label'    => __('Display featured products', 'nova-wp'),
			'section'  => 'nova_wp_homepage_featured_section',
			'type'     => 'checkbox',
		));
		
		$wp_customize->add_setting('nova_wp_homepage_featured_title_setting', array(
			'default'        => 'Featured Products',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_featured_title', array(
			'label'      => __( 'Featured products title', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_featured_section',
			'settings'   => 'nova_wp_homepage_featured_title_setting',
			'type'   	=> 	'text',
	    ) ) );		
		
		$wp_customize->add_setting('nova_wp_homepage_featured_column_setting', array(
			'default'        => 'four',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_featured_column', array(
			'label'      => __( 'Featured products columns', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_featured_section',
			'settings'   => 'nova_wp_homepage_featured_column_setting',
			'type'   	=> 	'select',
			'choices' => array(
				'two' => 2,
				'three' => 3,
				'four' => 4,
				'five' => 5,
			),
	    ) ) );	
		
		$wp_customize->add_setting('nova_wp_homepage_featured_to_display_setting', array(
			'default'        => 4,
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_featured_to_display', array(
			'label'      => __( 'Featured products to display', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_featured_section',
			'settings'   => 'nova_wp_homepage_featured_to_display_setting',
			'type'   	=> 	'text',
	    ) ) );
		
		// Top Rated
		$wp_customize->add_section( 'nova_wp_homepage_top_rated_section' , array(
			'title'       => __( 'Top Rated Products', 'nova-wp' ),
			'priority'    => 20,
			'panel'  => 'nova_wp_homepage_panel',
		) );
		
		$wp_customize->add_setting('nova_wp_homepage_top_rated_setting', array(
			'default'        => true,
			'sanitize_callback' => 'storefront_sanitize_checkbox',
		));
	 
		$wp_customize->add_control('nova_wp_homepage_top_rated', array(
			'settings' => 'nova_wp_homepage_top_rated_setting',
			'label'    => __('Display top rated products', 'nova-wp'),
			'section'  => 'nova_wp_homepage_top_rated_section',
			'type'     => 'checkbox',
		));
		
		$wp_customize->add_setting('nova_wp_homepage_top_rated_title_setting', array(
			'default'        => 'Top rated Products',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_top_rated_title', array(
			'label'      => __( 'Top rated products title', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_top_rated_section',
			'settings'   => 'nova_wp_homepage_top_rated_title_setting',
			'type'   	=> 	'text',
	    ) ) );		
		
		$wp_customize->add_setting('nova_wp_homepage_top_rated_column_setting', array(
			'default'        => 'four',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_top_rated_column', array(
			'label'      => __( 'Top rated products columns', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_top_rated_section',
			'settings'   => 'nova_wp_homepage_top_rated_column_setting',
			'type'   	=> 	'select',
			'choices' => array(
				'two' => 2,
				'three' => 3,
				'four' => 4,
				'five' => 5,
			),
	    ) ) );	
		
		$wp_customize->add_setting('nova_wp_homepage_top_rated_to_display_setting', array(
			'default'        => 4,
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_top_rated_to_display', array(
			'label'      => __( 'Top rated products to display', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_top_rated_section',
			'settings'   => 'nova_wp_homepage_top_rated_to_display_setting',
			'type'   	=> 	'text',
	    ) ) );
		
		// On Sale
		$wp_customize->add_section( 'nova_wp_homepage_on_sale_section' , array(
			'title'       => __( 'On sale Products', 'nova-wp' ),
			'priority'    => 20,
			'panel'  => 'nova_wp_homepage_panel',
		) );
		
		$wp_customize->add_setting('nova_wp_homepage_on_sale_setting', array(
			'default'        => true,
			'sanitize_callback' => 'storefront_sanitize_checkbox',
		));
	 
		$wp_customize->add_control('nova_wp_homepage_on_sale', array(
			'settings' => 'nova_wp_homepage_on_sale_setting',
			'label'    => __('Display on sale products', 'nova-wp'),
			'section'  => 'nova_wp_homepage_on_sale_section',
			'type'     => 'checkbox',
		));
		
		$wp_customize->add_setting('nova_wp_homepage_on_sale_title_setting', array(
			'default'        => 'On sale Products',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_on_sale_title', array(
			'label'      => __( 'On sale products title', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_on_sale_section',
			'settings'   => 'nova_wp_homepage_on_sale_title_setting',
			'type'   	=> 	'text',
	    ) ) );		
		
		$wp_customize->add_setting('nova_wp_homepage_on_sale_column_setting', array(
			'default'        => 'four',
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_on_sale_column', array(
			'label'      => __( 'On sale products columns', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_on_sale_section',
			'settings'   => 'nova_wp_homepage_on_sale_column_setting',
			'type'   	=> 	'select',
			'choices' => array(
				'two' => 2,
				'three' => 3,
				'four' => 4,
				'five' => 5,
			),
	    ) ) );	
		
		$wp_customize->add_setting('nova_wp_homepage_on_sale_to_display_setting', array(
			'default'        => 4,
			'sanitize_callback' => 'sanitize_text_field',
		));
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_homepage_on_sale_to_display', array(
			'label'      => __( 'On sale products to display', 'nova-wp' ),
			'section'    => 'nova_wp_homepage_on_sale_section',
			'settings'   => 'nova_wp_homepage_on_sale_to_display_setting',
			'type'   	=> 	'text',
	    ) ) );						

		/**
		 * Social Media Icons
		 */
	    $wp_customize->add_section( 'nova_wp_social_section' , array(
	      'title'       => __( 'Social Media Icons', 'nova-wp' ),
	      'priority'    => 42,
	      'description' => __( 'Optional media icons in the header', 'nova-wp' ),
	    ) );
	    
	    $wp_customize->add_setting( 'nova_wp_facebook', array (
      		'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_facebook', array(
	      'label'    => __( 'Enter your Facebook url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_facebook',
	      'priority'    => 101,
	    ) ) );
	  
	    $wp_customize->add_setting( 'nova_wp_twitter', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_twitter', array(
	      'label'    => __( 'Enter your Twitter url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_twitter',
	      'priority'    => 102,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_google', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_google', array(
	      'label'    => __( 'Enter your Google+ url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_google',
	      'priority'    => 103,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_pinterest', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_pinterest', array(
	      'label'    => __( 'Enter your Pinterest url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_pinterest',
	      'priority'    => 104,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_linkedin', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_linkedin', array(
	      'label'    => __( 'Enter your Linkedin url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_linkedin',
	      'priority'    => 105,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_youtube', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_youtube', array(
	      'label'    => __( 'Enter your Youtube url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_youtube',
	      'priority'    => 106,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_tumblr', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_tumblr', array(
	      'label'    => __( 'Enter your Tumblr url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_tumblr',
	      'priority'    => 107,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_instagram', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_instagram', array(
	      'label'    => __( 'Enter your Instagram url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_instagram',
	      'priority'    => 108,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_flickr', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_flickr', array(
	      'label'    => __( 'Enter your Flickr url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_flickr',
	      'priority'    => 109,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_vimeo', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_vimeo', array(
	      'label'    => __( 'Enter your Vimeo url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_vimeo',
	      'priority'    => 110,
	    ) ) );
	    
	    $wp_customize->add_setting( 'nova_wp_rss', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nova_wp_rss', array(
	      'label'    => __( 'Enter your RSS url', 'nova-wp' ),
	      'section'  => 'nova_wp_social_section',
	      'settings' => 'nova_wp_rss',
	      'priority'    => 112,
	    ) ) );
	    
}

