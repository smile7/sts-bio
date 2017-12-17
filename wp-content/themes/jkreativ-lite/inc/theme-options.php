<?php

/*  Initialize the options before anything else.
/* ------------------------------------ */
add_action( 'admin_init', 'custom_theme_options', 1 );


/*  Build the custom settings & update OptionTree.
/* ------------------------------------ */
function custom_theme_options() {

	// Get a copy of the saved settings array.
	$saved_settings = get_option( 'option_tree_settings', array() );

	// Custom settings array that will eventually be passed to the OptionTree Settings API Class.
	$custom_settings = array(

/*  Help pages
/* ------------------------------------ */
	'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'general_help',
          'title'     => 'Documentation',
          'content'   => '
			<h1>Jkreativ Free</h1>
			<p>Thanks for using this theme! Enjoy.</p>
			<hr />
			<p>This themes also available on premium version if you need more power for your website</p>
		'
        )
      )
    ),

/*  Admin panel sections
/* ------------------------------------ */
	'sections'        => array(
		array(
			'id'		=> 'general',
			'title'		=> 'General Option'
		),
		array(
			'id'		=> 'social',
			'title'		=> 'Social Icon (Insert Profile Social)'
		),
		array(
			'id'		=> 'sidelogo',
			'title'		=> 'Side Navigation Logo'
		),
		array(
			'id'		=> 'mobilelogo',
			'title'		=> 'Mobile Navigation Logo'
		),
		array(
			'id'		=> 'loaderlogo',
			'title'		=> 'Loader Logo'
		),
	),


/*  Theme options
/* ------------------------------------ */
	'settings'        => array(

		/** general **/
		array(
			'id'		=> 'enable_loader',
			'label'		=> 'Enable Page Loader',
			'desc'		=> 'Show circle page loader when load every page.',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'hide_top_meta',
			'label'		=> 'Hide Page Top Meta',
			'desc'		=> 'this meta can contain date, author, and other',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'hide_bottom_meta',
			'label'		=> 'Hide Page Bottom Meta',
			'desc'		=> 'this meta can contain category, comment number, tag, and other',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'website_copyright',
			'label'		=> 'Website copyright',
			'std'		=> 'All right reserved &copy; '. date('Y') .' '. get_bloginfo('name'),
			'type'		=> 'text',
			'section'	=> 'general'
		),



		/** social **/
		array(
			'id'		=> 'social_facebook',
			'label'		=> 'Facebook',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_twitter',
			'label'		=> 'Twitter',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_linkedin',
			'label'		=> 'Linkedin',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_googleplus',
			'label'		=> 'Google Plus',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_pinterest',
			'label'		=> 'Pinterest',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_github',
			'label'		=> 'Github',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_flickr',
			'label'		=> 'Flickr',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_tumblr',
			'label'		=> 'Tumblr',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_dribbble',
			'label'		=> 'Dribbble',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_soundcloud',
			'label'		=> 'Soundcloud',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_lastfm',
			'label'		=> 'Fastfm',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_behance',
			'label'		=> 'Behance',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_instagram',
			'label'		=> 'Instagram',
			'type'		=> 'text',
			'section'	=> 'social'
		),
		array(
			'id'		=> 'social_vimeo',
			'label'		=> 'Vimeo',
			'type'		=> 'text',
			'section'	=> 'social'
		),

		/** sidelogo **/
		array(
			'id'		=> 'side_nav_logo_image',
			'label'		=> 'Side Navigation logo',
			'desc'		=> 'upload your logo',
			'std'		=> get_template_directory_uri() . '/public/img/logo.png',
			'type'		=> 'upload',
			'section'	=> 'sidelogo'
		),
		array(
			'id'		=> 'side_nav_logo_retina',
			'label'		=> 'Retina Side navigation logo',
			'desc'		=> 'upload your logo',
			'std'		=> get_template_directory_uri() . '/public/img/logo@2x.png',
			'type'		=> 'upload',
			'section'	=> 'sidelogo'
		),
		array(
			'id'			=> 'side_nav_top_padding',
			'label'			=> 'Top padding for logo',
			'desc'			=> 'logo top padding, giving some space on top of side navigation logo',
			'std'			=> '45',
			'type'			=> 'numeric-slider',
			'section'		=> 'sidelogo',
			'min_max_step'	=> '0,100,1'
		),
		array(
			'id'			=> 'side_nav_bottom_padding',
			'label'			=> 'Bottom padding for logo',
			'desc'			=> 'logo bottom padding, giving some space on bottom of side navigation logo',
			'std'			=> '30',
			'type'			=> 'numeric-slider',
			'section'		=> 'sidelogo',
			'min_max_step'	=> '0,100,1'
		),

		/** mobile logo **/
		array(
			'id'		=> 'mobile_nav_logo_image',
			'label'		=> 'Mobile responsive logo',
			'desc'		=> 'upload your logo for mobile responsive menu',
			'type'		=> 'upload',
			'section'	=> 'mobilelogo'
		),
		array(
			'id'		=> 'mobile_nav_logo_retina',
			'label'		=> 'Retina Mobile responsive logo',
			'desc'		=> 'Upload your logo for retina display. It has have the same name and doubled the sized then the regular.',
			'type'		=> 'upload',
			'section'	=> 'mobilelogo'
		),
		/** loader logo **/
		array(
			'id'		=> 'circle_loader_image',
			'label'		=> 'Loader Logo ( 270x270 px )',
			'desc'		=> 'upload your logo for mobile responsive menu',
			'std'		=> get_template_directory_uri() . '/public/img/logo_loading.png',
			'type'		=> 'upload',
			'section'	=> 'loaderlogo'
		),
		array(
			'id'		=> 'circle_loader_retina',
			'label'		=> 'Retina Loader Logo ( 540x540 px )',
			'desc'		=> 'Upload your logo for retina display. It has have the same name and doubled the sized then the regular.',
			'std'		=> get_template_directory_uri() . '/public/img/logo_loading@2x.png',
			'type'		=> 'upload',
			'section'	=> 'loaderlogo'
		),

	)
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings );
	}
}
