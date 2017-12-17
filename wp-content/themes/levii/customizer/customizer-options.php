<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_kaira_options() {

	// Theme defaults
	$primary_color = '#6f9d9f';
	$secondary_color = '#c54513';
    
    $body_font_color = '#7b7d80';
    $heading_font_color = '#5a5a5a';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Logo
	$section = 'kra-favicon';
    
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Favicon', 'levii' ),
		'priority' => '10',
		'description' => __( 'Add a favicon to your website', 'levii' )
	);
    
	$options['kra-header-favicon'] = array(
		'id' => 'kra-header-favicon',
		'label'   => __( 'Favicon', 'levii' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);
    
    
    // Header Settings
    $section = 'kra-header';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Header Options', 'levii' ),
        'priority' => '30'
    );
    
    $options['kra-header-profile-img'] = array(
        'id' => 'kra-header-profile-img',
        'label'   => __( 'Profile Image', 'levii' ),
        'section' => $section,
        'type'    => 'image',
        'description' => __( 'Upload a small square image, this image size is set to 104px by 104px', 'levii' ),
        'default' => '',
    );
    $options['kra-header-search'] = array(
        'id' => 'kra-header-search',
        'label'   => __( 'Show Search', 'levii' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'Enable to a slogan for your site. This uses the site Tagline', 'levii' ),
        'default' => 1,
    );
    // Upsell Button One
    $options['kra-upsell-one'] = array(
        'id' => 'kra-upsell-one',
        'label'   => __( 'Enable header social icons', 'levii' ),
        'section' => $section,
        'type'    => 'upsell',
    );


	// Colors
	$section = 'kra-styling';
    $font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Styling Options', 'levii' ),
		'priority' => '40'
	);

	$options['kra-main-color'] = array(
		'id' => 'kra-main-color',
		'label'   => __( 'Main Color', 'levii' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);
	$options['kra-main-color-hover'] = array(
		'id' => 'kra-main-color-hover',
		'label'   => __( 'Secondary Color', 'levii' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
    
    
    $options['kra-body-font'] = array(
        'id' => 'kra-body-font',
        'label'   => __( 'Body Font', 'levii' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Open Sans'
    );
    $options['kra-body-font-color'] = array(
        'id' => 'kra-body-font-color',
        'label'   => __( 'Body Font Color', 'levii' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $body_font_color,
    );
    $options['kra-heading-font'] = array(
        'id' => 'kra-heading-font',
        'label'   => __( 'Headings Font', 'levii' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Roboto'
    );
    $options['kra-heading-font-color'] = array(
        'id' => 'kra-heading-font-color',
        'label'   => __( 'Heading Font Color', 'levii' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $heading_font_color,
    );
    
    
    // Blog Settings
    $section = 'kra-blog';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog Options', 'levii' ),
        'priority' => '160'
    );
    
    // Upsell Button Two
    $options['kra-upsell-two'] = array(
        'id' => 'kra-upsell-two',
        'label'   => __( 'Blog Post Layout', 'levii' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $options['kra-blog-cats'] = array(
        'id' => 'kra-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'levii' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.', 'levii' )
    );
    
    
    // Social Settings
    $section = 'kra-social';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Social Links', 'levii' ),
        'priority' => '160'
    );
    
    // Upsell Button Three
    $options['kra-upsell-three'] = array(
        'id' => 'kra-upsell-three',
        'label'   => __( 'Enable Social Icons', 'levii' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Site Text Settings
    $section = 'kra-website';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Website Text', 'levii' ),
        'priority' => '160'
    );
    
    // Upsell Button Four
    $options['kra-upsell-four'] = array(
        'id' => 'kra-upsell-four',
        'label'   => __( 'Site Copy Text', 'levii' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $options['kra-website-error-head'] = array(
        'id' => 'kra-website-error-head',
        'label'   => __( '404 Error Page Heading', 'levii' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! That page can\'t be found.', 'levii'),
        'description' => __( 'Enter the heading for the 404 Error page', 'levii' )
    );
    $options['kra-website-error-msg'] = array(
        'id' => 'kra-website-error-msg',
        'label'   => __( 'Error 404 Message', 'levii' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'The page you are looking for can\'t be found. Please select one of the options below.', 'levii'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'levii' )
    );
    $options['kra-website-nosearch-msg'] = array(
        'id' => 'kra-website-nosearch-msg',
        'label'   => __( 'No Search Results', 'levii' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords or return to home.', 'levii'),
        'description' => __( 'Enter the default text for when no search results are found', 'levii' )
    );

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_kaira_options' );
