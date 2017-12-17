<?php
/**
 * The author archive template file.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php the_post(); ?>
  <div id="headline-wrapper">
    <h1 class="content-headline"><?php printf( __( 'Author Archive: %s', 'maryanne' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
  </div>  
<?php maryanne_get_breadcrumb(); ?>  
  <div id="main-content">    
    <div id="content"<?php if ($maryanne_options_db['maryanne_post_entry_format'] != 'Standard') { ?> class="content-grid"<?php } ?>>
<?php rewind_posts(); ?>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
    <div class="archive-meta">
      <div class="author-info">
		    <div class="author-description">
          <div class="author-avatar">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'maryanne_author_bio_avatar_size', 60 ) ); ?>
		      </div>
			    <p><?php the_author_meta( 'description' ); ?></p>
		    </div>
		  </div>
    </div>
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