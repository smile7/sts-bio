<div class="article-masonry-container">
	<article class="article-masonry-box">
		<div id="post-<?php the_ID(); ?>" <?php post_class('article-masonry-wrapper'); ?>>
			<?php if(!post_password_required()) : ?>

				<?php if ( has_post_format( 'gallery' ) ): // Gallery ?>

					<?php $images = jkreativ_lite_get_post_images(); if ( !empty($images) ): ?>
						<div class='article-fotorama'>
							<div class='article-image-slider'>
								<?php foreach ( $images as $image ): ?>
									<?php $image_url = wp_get_attachment_image_src($image->ID,'large'); ?>
									<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image->post_title); ?>">
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

				<?php else: ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink() ?>">
							<div class="article-image">
								<?php the_post_thumbnail('thumb-masonry'); ?>
							</div>
						</a>
					<?php } ?>
				<?php endif; ?>

			<?php endif; ?>

			<h2><a href="<?php echo get_permalink() ?>"><?php echo get_the_title(); ?></a></h2>
			<?php if(ot_get_option('hide_top_meta', null, JEG_PAGE_ID) !== "on" && !post_password_required() ) { ?>
			<div class="clearfix article-meta">
				<?php if ( is_sticky() && ! is_paged() ) { ?>
					<div class="featured-post">Sticky</div>
				<?php } else { ?>
					<a href="<?php echo get_permalink() ?>"><?php echo get_the_date(); ?></a>
				<?php } ?>
			</div>
			<?php } ?>

			<?php $excerpt = get_the_excerpt(); if ( $excerpt != '' ) : ?>
			<div class="article-masonry-summary">
				<p><?php echo $excerpt ?></p>
			</div>
			<?php endif; ?>

			<?php
				if(ot_get_option('hide_bottom_meta', null, JEG_PAGE_ID) !== "on" && !post_password_required() ) {
					get_template_part('template/article-bottom-meta');
				}
			?>
		</div>
	</article>
</div>