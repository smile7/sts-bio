<?php
/**
 * Template functions used for blog page.
 *
 * @package nova-wp
 */

if ( ! function_exists( 'novawp_post_header' ) ) {
	function novawp_post_header() { ?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
			storefront_posted_on();
		} else {
			the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
			if ( 'post' == get_post_type() ) {
				storefront_posted_on();
			}
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}
if ( ! function_exists( 'novawp_post_thumbnail' ) ) {
	function novawp_post_thumbnail() {
		?>
		<div class="post-thumbnail">
		<?php
			if ( has_post_thumbnail() ) {
				?><a href="<?php the_permalink(); ?> "><?php storefront_post_thumbnail( 'large' );?></a><?php 
			}
			else {
				?><a href="<?php the_permalink(); ?> "><?php echo '<img src="' . get_stylesheet_directory_uri() . '/img/thumbnail-default.jpg" />'?></a><?php ;
			}
		?>
		</div><!-- .entry-content -->
		<?php
	}
}
if ( ! function_exists( 'novawp_post_excerpt' ) ) {
	function novawp_post_excerpt() {
		?>
		<div class="entry-content blog-archive" itemprop="articleBody">
		<?php
		do_action('novawp_before_excerpt');
		the_excerpt(
			sprintf(
				__( 'Continue reading %s', 'nova-wp' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'nova-wp' ),
			'after'  => '</div>',
		) );
		do_action('novawp_after_excerpt');
		?>
		</div><!-- .entry-content -->
		<?php
	}
}
if ( ! function_exists( 'novawp_post_meta' ) ) {
	function novawp_post_meta() {
		?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<div class="post-meta"><span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'nova-wp' ), __( '1 Comment', 'nova-wp' ), __( '% Comments', 'nova-wp' ) ); ?></span> | <span class="postedby">Posted by <?php the_author(); ?></span></div>
			<?php endif; ?>
		<?php
	}
}