<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package levii
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
<div class="site-container">
    
    <header id="masthead" class="site-header<?php echo ( get_header_image() ) ? '' : ' no-site-header-img'; ?>" role="banner">
        <?php if ( get_header_image() ) : ?>
        <div class="site-header-cover-image" style="background-image: url(<?php esc_url( header_image() ); ?>);"></div>
        <?php else : ?>
        <div class="site-header-cover-image"></div>
        <?php endif; ?>
        
        <div class="site-header-info color-border-top">
            <?php if ( get_theme_mod( 'kra-header-profile-img', false ) ) : ?>
            <div class="site-header-profile-image">
                <?php echo '<img src="' . esc_url( get_theme_mod( 'kra-header-profile-img' ) ) . '" width="104" height="104" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />'; ?>
            </div>
            <?php endif; ?>
            
            <div class="site-branding<?php echo ( get_theme_mod( 'kra-header-profile-img', false ) ) ? '' : ' no-profile-pic'; ?>">
        		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        	</div>

            <?php if ( get_theme_mod( 'kra-header-search', false ) ) : ?>
                <div class="search-block">
                    <i class="fa fa-search search-btn"></i>
                </div>
                <div class="site-header-search">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
            
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <button class="menu-toggle"><?php _e( 'Menu', 'levii' ); ?></button>
                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </nav><!-- #site-navigation -->
            
            <div class="clearboth"></div>
        </div>
        
    </header><!-- #masthead -->

    <div id="content" class="site-content">