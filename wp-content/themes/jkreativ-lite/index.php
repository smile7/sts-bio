<?php get_header(); ?>

<div class="headermenu">
    <!-- right header -->
    <div class="searchcontent">
        <?php get_search_form(); ?>
        <div class="closesearch">
            <i class="default-remove"></i>
        </div>
    </div>
    <div class="searchheader">
        <i class="default-search"></i>
    </div>
</div> <!-- headermenu -->

<div class="blog-masonry-wrapper">

    <div class="isotopewrapper">
        <?php
            if ( have_posts() ) :
                while ( have_posts() ): the_post();
                        get_template_part('template/content', get_post_format());
                endwhile;
            else:
        ?>

            <div class='article-masonry-container postnotfound'>
                <article class='article-masonry-box'>
                    <div class='article-masonry-wrapper'>
                        <div class='pagetext'>
                            <span class='pagetotal'>
                            <?php _e('Post Not Found','jkreativ-lite') ?>
                            </span>
                        </div>
                    </div>
                </article>
            </div>

        <?php endif; ?>

    </div>

    <?php
        $total_pages = $GLOBALS['wp_query']->max_num_pages;
        $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $current_page = max(1, $paged);

        if($total_pages > 1) : ?>

            <div class='blogpagingholder'>
                <div class='blogpagingwrapper hideme'>
                    <div class="pagedot">
                    <?php
                        echo paginate_links(array(
                          'base' =>  @add_query_arg('paged','%#%'),
                          'format' => '?paged=%#%',
                          'current' => max(1, $paged),
                          'total' => $total_pages,
                          'prev_next' => false
                        ));
                    ?>
                    </div>

                    <div class="pagetext">
                        <span class="pagenow">Page  <strong class="curpage"><?php echo $current_page; ?></strong></span>
                        <span class="pagetotal">From  <strong class="totalpage"><?php echo $total_pages ?></strong></span>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>
<div class="blogloader bigloader"></div>

<?php get_footer(); ?>