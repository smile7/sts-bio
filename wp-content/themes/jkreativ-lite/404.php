<?php
get_header();
?>

<div class="headermenu">
    <?php get_template_part('template/rightheader'); ?>
</div> <!-- headermenu -->

<div class="pagewrapper pagecenter fullwidth nosidebar">
    <div class="pageholder">
        <div class="pageholdwrapper">
            <div class="mainpage blog-normal-article">
                <div class="pageinnerwrapper notfound">
                    <h1><?php _e("404",'jkreativ-lite'); ?>  </h1>
                    <div class="notfoundsec">
                        <div class="notfoundtext">
                            <?php _e("It look like the page you're looking for doesn't exist, sorry",'jkreativ-lite'); ?>
                        </div>
                        <div>
                            <form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/">
                                <input type="text" placeholder="<?php _e('Type and Enter to Search', 'jkreativ-lite'); ?>" id="s" name="s" class="field">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>