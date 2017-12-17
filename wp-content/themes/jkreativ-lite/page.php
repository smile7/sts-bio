<?php

get_header();
if ( ! post_password_required() ) {

?>

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
    <div class="toplink"></div>

</div> <!-- headermenu -->

<div class="pagewrapper fullwidth pagecenter withsidebar">
    <div class="pageholder">

        <div class="pageholdwrapper">
            <div class="mainpage blog-normal-article">
                <!-- article -->
                <?php
                    if( have_posts() ) {
                        while(have_posts()){
                            the_post();
                ?>
                <div class="pageinnerwrapper">

                    <?php if ( has_post_format( 'gallery' ) ): // Gallery ?>

                        <?php $images = jkreativ_lite_get_post_images(); if ( !empty($images) ): ?>
                        <div class='article-slider-wrapper loading'>
                            <div class='article-fotorama'>
                                <div class='article-image-slider'>
                                    <?php foreach ( $images as $image ): ?>
                                        <?php $image_url = wp_get_attachment_image_src($image->ID,'large'); ?>
                                        <img src="<?php echo $image_url[0]; ?>" alt="<?php echo $image->post_title; ?>">
                                    <?php endforeach; ?>
                                </div>
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

                    <div class="article-header">
                        <h2><?php echo get_the_title(); ?></h2>
                        <?php if(ot_get_option('hide_top_meta', null, JEG_PAGE_ID) !== "on" && !post_password_required() ) { ?>
                        <span class="meta-top">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a>, <?php the_date(); ?></span>
                        <?php } ?>
                    </div> <!-- article header -->

                    <div class="article-content">
                        <?php the_content() ?>
                    </div> <!-- article content -->

                    <div class="clearfix"></div>
                    <?php comments_template(); ?>
                </div> <!-- page inner wrapper -->
                <?php
                        }
                    }
                ?>
            </div>
            <?php get_template_part('template/sidebar'); ?>
        </div>
    </div>
</div>

<?php
} else {
    get_template_part('template/password-form');
}

get_footer();
?>