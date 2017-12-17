<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library Demo
 */

if ( ! function_exists( 'customizer_library_kaira_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_kaira_build_styles() {

    // Main Color
    $color = 'kra-main-color';
    $colormod = get_theme_mod( $color, customizer_library_get_default( $color ) );
    
    $bgcolormod = get_theme_mod( $color, customizer_library_get_default( $color ) );
    
    $border_top_colormod = get_theme_mod( $color, customizer_library_get_default( $color ) );
    
    $border_right_colormod = get_theme_mod( $color, customizer_library_get_default( $color ) );

    if ( $colormod !== customizer_library_get_default( $color ) ) {

        $sancolor = sanitize_hex_color( $colormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'a,
                .pc-text a,
                .search-block i,
                .search-no-results .page-title,
                .archive .page-title span,
                .search-results .page-title span,
                .entry-title,
                .entry-title a,
                .entry-content a,
                .entry-footer a,
                .search-button .fa-search,
                .error404 .page-title,
                .error404 .page-content .widgettitle,
                .widget ul li a,
                .main-navigation a'
            ),
            'declarations' => array(
                'color' => $sancolor
            )
        ) );
    }
    
    if ( $bgcolormod !== customizer_library_get_default( $color ) ) {

        $bgsancolor = sanitize_hex_color( $bgcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '.site-header-search .search-submit,
                .no-site-header-img .site-header-cover-image,
                .tags-links a,
                .form-submit #submit,
                .wpcf7-submit,
                .woocommerce ul.products li.product a,
                .woocommerce-page ul.products li.product a,
                .woocommerce input.button.alt:hover,
                .woocommerce-page #content input.button.alt:hover'
            ),
            'declarations' => array(
                'background-color' => $bgsancolor . ' !important'
            )
        ) );
    }
    
    if ( $border_top_colormod !== customizer_library_get_default( $color ) ) {

        $border_top_sancolor = sanitize_hex_color( $border_top_colormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '.color-border-top,
                .nav-links a,
                aside.widget,
                .archive .page-header,
                article.page.blog-post-side-layout,
                article.post.blog-post-side-layout,
                .woocommerce #container,
                .woocommerce-page #container,
                .woocommerce-page .content-area,
                .page #content .content-area'
            ),
            'declarations' => array(
                'border-top' => '6px solid ' . $border_top_sancolor
            )
        ) );
    }
    
    if ( $border_right_colormod !== customizer_library_get_default( $color ) ) {

        $border_right_sancolor = sanitize_hex_color( $border_right_colormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '.tags-links a:after'
            ),
            'declarations' => array(
                'border-right' => '12px solid ' . $border_right_sancolor
            )
        ) );
    }

    // Main Color Hover
    $colorh = 'kra-main-color-hover';
    $colorhmod = get_theme_mod( $colorh, customizer_library_get_default( $colorh ) );
    
    $bgcolorhmod = get_theme_mod( $colorh, customizer_library_get_default( $colorh ) );

    if ( $colorhmod !== customizer_library_get_default( $colorh ) ) {

        $sancolorh = sanitize_hex_color( $colorhmod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'a:hover,
                .pc-text a:hover,
                .search-block i:hover,
                .entry-content a:hover,
                .entry-footer a:hover,
                .search-button .fa-search:hover,
                .widget ul li a:hover,
                .main-navigation a:hover'
            ),
            'declarations' => array(
                'color' => $sancolorh
            )
        ) );
    }
    
    if ( $bgcolorhmod !== customizer_library_get_default( $colorh ) ) {

        $bgsancolorh = sanitize_hex_color( $bgcolorhmod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '.form-submit #submit:hover,
                .wpcf7-submit:hover,
                .woocommerce ul.products li.product .add_to_cart_button:hover,
                .woocommerce-page ul.products li.product .add_to_cart_button:hover,
                .site-header-search .search-submit:hover,
                .woocommerce input.button.alt,
                .woocommerce-page #content input.button.alt'
            ),
            'declarations' => array(
                'background-color' => $bgsancolorh . ' !important'
            )
        ) );
    }


    // Body Font
    $font = 'kra-body-font';
    $fontmod = get_theme_mod( $font, customizer_library_get_default( $font ) );
    $fontstack = customizer_library_get_font_stack( $fontmod );
    
    $fontcolor = 'kra-body-font-color';
    $fontcolormod = get_theme_mod( $fontcolor, customizer_library_get_default( $fontcolor ) );

    if ( $fontmod != customizer_library_get_default( $font ) ) {

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'body,
                .page-header h1,
                .alba-banner-heading h5,
                .alba-carousel-block,
                .alba-heading-text'
            ),
            'declarations' => array(
                'font-family' => $fontstack
            )
        ) );

    }
    
    if ( $fontcolormod !== customizer_library_get_default( $fontcolor ) ) {

        $sanfontcolor = sanitize_hex_color( $fontcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'body,
                .page-header h1,
                .alba-banner-heading h5,
                .alba-carousel-block,
                .alba-heading-text'
            ),
            'declarations' => array(
                'color' => $sanfontcolor
            )
        ) );
    }
    
    
    // Heading Font
    $hfont = 'kra-heading-font';
    $hfontmod = get_theme_mod( $hfont, customizer_library_get_default( $hfont ) );
    $hfontstack = customizer_library_get_font_stack( $hfontmod );
    
    $hfontcolor = 'kra-heading-font-color';
    $hfontcolormod = get_theme_mod( $hfontcolor, customizer_library_get_default( $hfontcolor ) );

    if ( $hfontmod != customizer_library_get_default( $hfont ) ) {

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a'
            ),
            'declarations' => array(
                'font-family' => $hfontstack
            )
        ) );

    }
    
    if ( $hfontcolormod !== customizer_library_get_default( $hfontcolor ) ) {

        $sanhfontcolor = sanitize_hex_color( $hfontcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a'
            ),
            'declarations' => array(
                'color' => $sanhfontcolor
            )
        ) );
    }


}
endif;

add_action( 'customizer_library_styles', 'customizer_library_kaira_build_styles' );

if ( ! function_exists( 'customizer_library_kaira_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_kaira_styles() {

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"kaira-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'customizer_library_kaira_styles', 11 );