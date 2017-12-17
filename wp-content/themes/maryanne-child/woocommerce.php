<?php
/**
 * The WooCommerce pages template file.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/
get_header(); ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php if ( !is_product() ) { woocommerce_page_title(); } else { the_title(); } ?></h1>
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
  </div>  
<?php maryanne_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content">    
      <div class="entry-content">
<?php woocommerce_content(); ?>
      </div>  
    </div> <!-- end of content -->
<?php get_sidebar(); ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>