<?php
/**
 * Template functions used for pages.
 *
 * @package nova-wp
 */

if ( ! function_exists( 'storefront_page_header' ) ) {
	function storefront_page_header() {
		?>
		<header class="entry-header">
			<?php			
			the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' );			
			?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'storefront_page_content' ) ) {
	function storefront_page_content() {
		?>
		<div class="entry-content" itemprop="mainContentOfPage">
        	<?php storefront_post_thumbnail( 'full' ); ?>
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'nova-wp' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php
	}
}