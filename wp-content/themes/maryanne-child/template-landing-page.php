<?php
/**
 * Template Name: Landing Page
 * The template file for displaying a landing page without the menu, right sidebar and footer widget areas.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div id="headline-wrapper" class="menu-box">
    <h1 class="content-headline"><?php //the_title(); ?></h1>
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
  </div>    
  <div id="main-content">    
    <div id="content">
    <h1><?php the_title(); ?></h1>
<?php maryanne_get_display_image_page(); ?>
      <div class="entry-content">
<?php the_content(); ?>
<?php edit_post_link( __( 'Edit', 'maryanne' ), '<p>', '</p>' ); ?>
<?php endwhile; endif; ?>
      </div>  
    </div> <!-- end of content -->
  </div> <!-- end of main-content -->
<?php get_footer(); ?>