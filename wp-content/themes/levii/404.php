<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package levii
 */

get_header(); ?>

	<div id="primary" class="content-area-full color-border-top">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
                
                <i class="fa fa-ban"></i>
                
				<header class="page-header">
					<h1 class="page-title"><?php echo wp_kses_post( get_theme_mod( 'kra-website-error-head', false ) ) ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php echo wp_kses_post( get_theme_mod( 'kra-website-error-msg', false ) ) ?></p>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
