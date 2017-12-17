<div class="blog-masonry-wrapper">
	<div class="isotopewrapper">
		<?php
			function jkreativ_lite_excerpt_masonry_length () {
				return 30;
			}
			add_filter( 'excerpt_length', 'jkreativ_lite_excerpt_masonry_length' );

			$paged = $_REQUEST['paged'];
			$statement = array(
				'post_type'      => 'post',
				'orderby'        => "date",
				'order'          => "DESC",
				'post_status'    => 'publish',
				'paged'          => $paged,
				's'              => esc_attr($_REQUEST['s']),
				'posts_per_page' => get_option('posts_per_page')
			);

			if(!empty($_REQUEST['sort'])) {
				if($_REQUEST['sort'] === 'date') {
					$statement['orderby'] = "date";
					$statement['order'] = "DESC";
				} else {
					$statement['meta_key'] = "post_views_count";
					$statement['orderby'] = "meta_value_num";
					$statement['order'] = "DESC";
				}
			}

			$query = new WP_Query($statement);
			if ( $query->have_posts() ) {
				while ( $query->have_posts() )
				{
					$query->the_post();
					get_template_part('template/content', get_post_format());
				}
			} else {
                echo "
                <div class='article-masonry-container postnotfound'>
                    <article class='article-masonry-box'>
                        <div id='post-". the_ID() ."' ". post_class((is_sticky() ? 'sticky':'') .' article-masonry-wrapper') .">
                            <div class='pagetext'>
                                <span class='pagetotal'>
                                " . __('Post Not Found','jkreativ-lite') . "
                                </span>
                            </div>
                        </div>
                    </article>
                </div>
                ";
            }

			wp_reset_postdata();
		?>
	</div>
	<?php
		if($query->max_num_pages > 1) {
			echo
			"<div class='blogpagingholder'>
				<div class='blogpagingwrapper hideme'>
				" . jkreativ_lite_new_pagination(JEG_PAGE_ID, $paged, $query->max_num_pages) . "
				</div>
			</div>";
		}
	?>
</div>