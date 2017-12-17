<?php
/**
 * The template for displaying content of search/archive entries in the standard way.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/
?>
<?php global $maryanne_options_db; ?>
      <article <?php post_class('post-entry'); ?>>
        <h2 class="post-entry-headline"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php if ( $maryanne_options_db['maryanne_display_meta_post_entry'] != 'Hide' ) { ?>
        <p class="post-meta">
          <span class="post-info-author"><?php _e( 'Author: ', 'maryanne' ); ?><?php the_author_posts_link(); ?></span>
          <span class="post-info-date"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_date(); ?></a></span>
<?php if ( comments_open() ) : ?>
          <span class="post-info-comments"><a href="<?php comments_link(); ?>"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'maryanne' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?></a></span>
<?php endif; ?>
        </p>
<?php } ?>
        <div class="post-entry-content-wrapper">
<?php if ( has_post_thumbnail() ) { ?>
          <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
<?php } ?>
          <div class="post-entry-content">
<?php if ( $maryanne_options_db['maryanne_content_archives'] != 'Content' ) { ?>
<?php the_excerpt(); ?>
<?php } else { ?>
<?php global $more; $more = 0; ?><?php the_content(); ?>
<?php } ?>
          </div>
        </div>
<?php if ( $maryanne_options_db['maryanne_display_meta_post_entry'] != 'Hide' && has_category() ) { ?>
        <div class="post-info">
          <p class="post-category"><span class="post-info-category"><?php the_category(', '); ?></span></p>
          <p class="post-tags"><?php the_tags( '<span class="post-info-tags">', ', ', '</span>' ); ?></p>
        </div>
<?php } ?>
      </article>