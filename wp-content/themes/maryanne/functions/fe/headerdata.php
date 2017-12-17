<?php
/**
 * Headerdata of Theme options.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/  

// additional js and css
if(	!is_admin()){
function maryanne_fonts_include () {
global $maryanne_options_db;
// Google Fonts
$bodyfont = $maryanne_options_db['maryanne_body_google_fonts'];
$headingfont = $maryanne_options_db['maryanne_headings_google_fonts'];
$descriptionfont = $maryanne_options_db['maryanne_description_google_fonts'];
$headlinefont = $maryanne_options_db['maryanne_headline_google_fonts'];
$postentryfont = $maryanne_options_db['maryanne_postentry_google_fonts'];
$sidebarfont = $maryanne_options_db['maryanne_sidebar_google_fonts'];
$menufont = $maryanne_options_db['maryanne_menu_google_fonts'];

$fonturl = "//fonts.googleapis.com/css?family=";

$bodyfonturl = $fonturl.$bodyfont;
$headingfonturl = $fonturl.$headingfont;
$descriptionfonturl = $fonturl.$descriptionfont;
$headlinefonturl = $fonturl.$headlinefont;
$postentryfonturl = $fonturl.$postentryfont;
$sidebarfonturl = $fonturl.$sidebarfont;
$menufonturl = $fonturl.$menufont;
	// Google Fonts
     if ($bodyfont != 'default' && $bodyfont != ''){
      wp_enqueue_style('maryanne-google-font1', $bodyfonturl); 
		 }
     if ($headingfont != 'default' && $headingfont != ''){
      wp_enqueue_style('maryanne-google-font2', $headingfonturl);
		 }
     if ($descriptionfont != 'default' && $descriptionfont != ''){
      wp_enqueue_style('maryanne-google-font3', $descriptionfonturl);
		 }
     if ($headlinefont != 'default' && $headlinefont != ''){
      wp_enqueue_style('maryanne-google-font4', $headlinefonturl); 
		 }
     if ($postentryfont != 'default' && $postentryfont != ''){
      wp_enqueue_style('maryanne-google-font5', $postentryfonturl); 
		 }
     if ($sidebarfont != 'default' && $sidebarfont != ''){
      wp_enqueue_style('maryanne-google-font6', $sidebarfonturl);
		 }
     if ($menufont != 'default' && $menufont != ''){
      wp_enqueue_style('maryanne-google-font8', $menufonturl);
		 }
}
add_action( 'wp_enqueue_scripts', 'maryanne_fonts_include' );
}

// additional js and css
function maryanne_css_include () {
global $maryanne_options_db;
	if ($maryanne_options_db['maryanne_css'] == 'Green (default)' ){
			wp_enqueue_style('maryanne-style', get_stylesheet_uri());
		}
    
    if ($maryanne_options_db['maryanne_css'] == 'Red' ){
			wp_enqueue_style('maryanne-style-red', get_template_directory_uri().'/css/red.css');
		}

		if ($maryanne_options_db['maryanne_css'] == 'Tan' ){
			wp_enqueue_style('maryanne-style-tan', get_template_directory_uri().'/css/tan.css');
		}
}
add_action( 'wp_enqueue_scripts', 'maryanne_css_include' );

// Display sidebar
function maryanne_display_sidebar() {
global $maryanne_options_db;
    $display_sidebar = $maryanne_options_db['maryanne_display_sidebar']; 
		if ($display_sidebar == 'Hide') { ?>
		<?php _e('#wrapper #container #content { width: 870px; }', 'maryanne'); ?>
<?php } 
}

// Left Sidebar Position
function maryanne_left_sidebar_position() {
global $maryanne_options_db;
    $left_sidebar_position = $maryanne_options_db['maryanne_left_sidebar_position']; 
		if ($left_sidebar_position == 'Absolute (scrolled)') { ?>
		<?php _e('body #left-sidebar { height: auto; position: absolute; } body .sidebar-background { display: block; }', 'maryanne'); ?>
<?php } 
}

// Display Meta Box on posts - post entries styling
function maryanne_display_meta_post_entry() {
global $maryanne_options_db;
    $display_meta_post_entry = $maryanne_options_db['maryanne_display_meta_post_entry']; 
		if ($display_meta_post_entry == 'Hide') { ?>
		<?php _e('#wrapper #main-content .post-entry .attachment-post-thumbnail { margin-bottom: 17px; } #wrapper #main-content .post-entry .post-entry-content { margin-bottom: -4px; }', 'maryanne'); ?>
<?php } 
}

// FONTS
// Body font
function maryanne_get_body_font() {
global $maryanne_options_db;
    $bodyfont = $maryanne_options_db['maryanne_body_google_fonts'];
    if ($bodyfont != 'default' && $bodyfont != '') { ?>
    <?php _e('html body, #wrapper blockquote, #wrapper q, #wrapper #container #comments .comment, #wrapper #container #comments .comment time, #wrapper #container #commentform .form-allowed-tags, #wrapper #container #commentform p, #wrapper input, #wrapper button, #wrapper select, #wrapper #main-content .post-meta { font-family: "', 'maryanne'); ?><?php echo $bodyfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'maryanne'); ?>
<?php } 
}

// Site title font
function maryanne_get_headings_google_fonts() {
global $maryanne_options_db;
    $headingfont = $maryanne_options_db['maryanne_headings_google_fonts']; 
		if ($headingfont != 'default' && $headingfont != '') { ?>
		<?php _e('#wrapper .site-title { font-family: "', 'maryanne'); ?><?php echo $headingfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'maryanne'); ?>
<?php } 
}

// Site description font
function maryanne_get_description_font() {
global $maryanne_options_db;
    $descriptionfont = $maryanne_options_db['maryanne_description_google_fonts'];
    if ($descriptionfont != 'default' && $descriptionfont != '') { ?>
    <?php _e('#wrapper #left-sidebar .site-description {font-family: "', 'maryanne'); ?><?php echo $descriptionfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'maryanne'); ?>
<?php } 
}

// Page/post headlines font
function maryanne_get_headlines_font() {
global $maryanne_options_db;
    $headlinefont = $maryanne_options_db['maryanne_headline_google_fonts'];
    if ($headlinefont != 'default' && $headlinefont != '') { ?>
		<?php _e('#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper #container .navigation .section-heading, #wrapper #comments .entry-headline { font-family: "', 'maryanne'); ?><?php echo $headlinefont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'maryanne'); ?>
<?php } 
}

// Post entry font
function maryanne_get_postentry_font() {
global $maryanne_options_db;
    $postentryfont = $maryanne_options_db['maryanne_postentry_google_fonts']; 
		if ($postentryfont != 'default' && $postentryfont != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline, #wrapper #main-content .grid-entry .grid-entry-headline, #wrapper #main-content .slides li a, #wrapper #main-content .home-list-posts ul li a { font-family: "', 'maryanne'); ?><?php echo $postentryfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'maryanne'); ?>
<?php } 
}

// Sidebar and Footer widget headlines font
function maryanne_get_sidebar_widget_font() {
global $maryanne_options_db;
    $sidebarfont = $maryanne_options_db['maryanne_sidebar_google_fonts'];
    if ($sidebarfont != 'default' && $sidebarfont != '') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget .sidebar-headline, #wrapper #footer .footer-widget .footer-headline { font-family: "', 'maryanne'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'maryanne'); ?>
<?php } 
}

// Menu font
function maryanne_get_menu_font() {
global $maryanne_options_db;
    $menufont = $maryanne_options_db['maryanne_menu_google_fonts']; 
		if ($menufont != 'default' && $menufont != '') { ?>
		<?php _e('#wrapper #left-sidebar .menu-box ul li a { font-family: "', 'maryanne'); ?><?php echo $menufont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'maryanne'); ?>
<?php } 
}

// User defined CSS.
function maryanne_get_own_css() {
global $maryanne_options_db;
    $own_css = $maryanne_options_db['maryanne_own_css']; 
		if ($own_css != '') { ?>
		<?php echo esc_attr($own_css); ?>
<?php } 
}

// Display custom CSS.
function maryanne_custom_styles() { ?>
<?php echo ("<style type='text/css'>"); ?>
<?php maryanne_get_own_css(); ?>
<?php maryanne_display_sidebar(); ?>
<?php maryanne_left_sidebar_position(); ?>
<?php maryanne_display_meta_post_entry(); ?>
<?php maryanne_get_body_font(); ?>
<?php maryanne_get_headings_google_fonts(); ?>
<?php maryanne_get_description_font(); ?>
<?php maryanne_get_headlines_font(); ?>
<?php maryanne_get_postentry_font(); ?>
<?php maryanne_get_sidebar_widget_font(); ?>
<?php maryanne_get_menu_font(); ?>
<?php echo ("</style>"); ?>
<?php
} 
add_action('wp_enqueue_scripts', 'maryanne_custom_styles');	?>