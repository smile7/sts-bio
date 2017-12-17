<?php
/**
 * The tag archive template file.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php printf( __( 'Tag Archive: %s', 'maryanne' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
  </div>  
<?php maryanne_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content"<?php if ($maryanne_options_db['maryanne_post_entry_format'] != 'Standard') { ?> class="content-grid"<?php } ?>>    
<?php if ( tag_description() ) : ?>
      <div class="archive-meta"><?php echo tag_description(); ?></div>
<?php endif; ?>
      <div<?php if ($maryanne_options_db['maryanne_post_entry_format'] != 'Standard') { ?> class="js-masonry"<?php } ?>>
<?php while (have_posts()) : the_post(); ?>
<?php if ($maryanne_options_db['maryanne_post_entry_format'] != 'Standard') {
get_template_part( 'content', 'grid' ); } else {
get_template_part( 'content', 'archives' ); } ?>
<?php endwhile; endif; ?> 
      </div>
<?php maryanne_content_nav( 'nav-below' ); ?> 
    </div> <!-- end of content -->
<?php if ($maryanne_options_db['maryanne_post_entry_format'] == 'Standard') { ?>
<?php get_sidebar(); ?>
<?php } ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>