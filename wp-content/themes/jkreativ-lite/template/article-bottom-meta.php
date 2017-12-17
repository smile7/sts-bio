<div class="article-masonry-meta-wrapper">
	<?php if(has_category()) :  ?>
	<div class="category-meta">
		<strong><?php _e("Filled under :", 'jkreativ-lite'); ?> </strong>
		<?php
			$catlink = array();

			foreach(get_the_category() as $category) :
				$catlink[] = '<a href="' . get_category_link($category->term_id) . '" title="' . $category->description . '">' . $category->name . '</a>';
			endforeach;

			echo implode(' , ', $catlink);
		?>
	</div>
	<?php endif; ?>

	<div class="author-meta"><strong><?php _e("Author :", 'jkreativ-lite'); ?></strong> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a> </div>

	<div class="comment-meta">
		<strong><?php _e("Comment Number :", 'jkreativ-lite'); ?> </strong>
		<a href="<?php echo get_permalink();?>#comments">
			<?php
				$zerocomment 	= __( 'No Comment Yet', 'jkreativ-lite');
				$onecomment 	= __('1 Comment', 'jkreativ-lite');
				$morecomment 	= __('% Comments', 'jkreativ-lite');
				comments_number($zerocomment, $onecomment, $morecomment);
			?>
		</a>
	</div>

	<?php if(has_tag()) : ?>
	<div class="tag-meta">
		<strong><?php _e("Tagged on :", 'jkreativ-lite'); ?></strong>
		<?php
			$taglink = array();

			foreach(get_the_tags() as $tag) :
				$taglink[] = '<a href="' . get_tag_link($tag->term_id) . '" title="' . $tag->description . '">' . $tag->name . '</a>';
			endforeach;

			echo implode(' , ', $taglink);
		?>
	</div>
	<?php endif; ?>
</div>