<?php

function jkreativ_lite_get_js_option()
{
	$ismobile = wp_is_mobile();

	// populate option array
	$option = array();
	$option['adminurl'] = '';
	$option['ismobile'] = $ismobile;

	return $option;
}

function jkreativ_lite_init_script ()
{

	if(!is_admin()) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('jkreativ_modernizr', get_template_directory_uri() . '/public/js/vendor/modernizr-2.6.2.min.js', false, null, false);
		wp_enqueue_script('jkreativ_common', get_template_directory_uri() . '/public/js/internal/jquery.jcommon.js', false, JEG_VERSION, true);
		wp_enqueue_script('jkreativ_main', get_template_directory_uri() . '/public/js/internal/main.js', false, JEG_VERSION, true);
		wp_enqueue_script('jkreativ_retina', get_template_directory_uri() . '/public/js/external/retina.js', false, JEG_VERSION, true);

		wp_enqueue_script('jkreativ_plugin', get_template_directory_uri() . '/public/js/external/essencialplugin.js', false, JEG_VERSION, true);
		wp_localize_script('jkreativ_plugin', 'joption', jkreativ_lite_get_js_option());

		if ( jkreativ_lite_is_using_loading() ) wp_enqueue_script('jkreativ_pageload', get_template_directory_uri() . '/public/js/internal/jquery.jpageload.js', false, JEG_VERSION, true);
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		wp_enqueue_script('jkreativ_fotorama', get_template_directory_uri() . '/public/js/external/fotorama.js', false, JEG_VERSION, true);
		wp_enqueue_script('jkreativ_bootstrap', get_template_directory_uri() . '/public/js/external/bootstrap.js', false, JEG_VERSION, true);
		wp_enqueue_script('jkreativ_klass', get_template_directory_uri() . '/public/js/external/klass.min.js', false, JEG_VERSION, true);
		wp_enqueue_script('jkreativ_photoswipe', get_template_directory_uri() . '/public/js/external/code.photoswipe.jquery-3.0.5.min.js', false, JEG_VERSION, true);
		wp_enqueue_script('jkreativ_maps');
		wp_enqueue_script('jkreativ_normalblog', get_template_directory_uri() . '/public/js/internal/jquery.jnormalblog.js', false, JEG_VERSION, true);

		// Blog Masonry
		wp_enqueue_script('jkreativ_masonryblog', get_template_directory_uri() . '/public/js/internal/jquery.jmasonryblog.js', false, JEG_VERSION, true);
		wp_localize_script('jkreativ_masonryblog', 'joption', jkreativ_lite_jmasonryblog());
		wp_enqueue_script('jquery-masonry');
	}
}

function jkreativ_lite_jmasonryblog() {
	$options = array();
	$options['adminurl'] = admin_url("admin-ajax.php");

	return $options;
}

function jkreativ_lite_init_style()
{

	if(!is_admin()) {
		wp_enqueue_style ('jeg-fonticon'	, 	get_template_directory_uri() . '/public/css/fonts.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-normalize'	, 	get_template_directory_uri() . '/public/css/normalize.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-plugin'		, 	get_template_directory_uri() . '/public/css/plugin.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-style'		, 	get_stylesheet_uri());
		wp_enqueue_style ('jeg-maincss'		, 	get_template_directory_uri() . '/public/css/main.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-responsive'	, 	get_template_directory_uri() . '/public/css/responsive.css', null, JEG_VERSION);

		wp_enqueue_style ('jeg_google_fonts'	,   '//fonts.googleapis.com/css?family=Open+Sans|Roboto+Slab' , null, null);
	}
}

add_action('wp_enqueue_scripts', 'jkreativ_lite_init_style');
add_action('wp_enqueue_scripts', 'jkreativ_lite_init_script');