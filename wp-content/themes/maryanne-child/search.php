<?php
/**
 * The search results template file.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
  <div id="headline-wrapper" class="menu-box">
    <div class="content-headline"><?php //printf( __( 'Search Results for: %s', 'maryanne' ), '<span>' . get_search_query() . '</span>' ); ?></div>
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
  </div>  
<?php maryanne_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content"<?php if ($maryanne_options_db['maryanne_post_entry_format'] != 'Standard') { ?> class="content-grid"<?php } ?>>
    <h1 class="content-headline"><?php printf( __( 'Search Results for: %s', 'maryanne' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
      <div class="archive-meta"><p class="number-of-results"><?php _e( 'Number of Results: ', 'maryanne' ); ?><?php echo $wp_query->found_posts; ?></p></div>
      <div<?php if ($maryanne_options_db['maryanne_post_entry_format'] != 'Standard') { ?> class="js-masonry"<?php } ?>>
<?php while (have_posts()) : the_post(); ?>
<?php if ($maryanne_options_db['maryanne_post_entry_format'] != 'Standard') {
get_template_part( 'content', 'grid' ); } else {
get_template_part( 'content', 'archives' ); } ?>
<?php endwhile; ?>
      </div>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="navigation" role="navigation">
			<h2 class="navigation-headline section-heading"><?php _e( 'Search results navigation', 'maryanne' ); ?></h2>
      <div class="nav-wrapper">
			 <p class="navigation-links">
<?php $big = 999999999;
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
  'prev_text' => __( '&larr; Previous', 'maryanne' ),
	'next_text' => __( 'Next &rarr;', 'maryanne' ),
	'total' => $wp_query->max_num_pages
) );
?>
        </p>
      </div>
    </div>
<?php endif; ?>

<?php else : ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php _e( 'Nothing Found', 'maryanne' ); ?></h1>
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
  </div>  
<?php maryanne_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content">
      <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'maryanne' ); ?></p>
<?php endif; ?> 
    </div> <!-- end of content -->
<?php if ($maryanne_options_db['maryanne_post_entry_format'] == 'Standard') { ?>
<?php get_sidebar(); ?>
<?php } ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>