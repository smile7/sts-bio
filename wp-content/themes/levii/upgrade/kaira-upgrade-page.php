<div class="wrap kaira-upgrade-page-wrap">
    <?php
    $levii_link = 'http://www.kairaweb.com';
    $levii_premium_link = 'http://app.sellwire.net/p/MB'; ?>
    
    <h2 id="theme-settings-title">
        <a href="<?php echo $levii_link; ?>" target="_blank"></a>
    </h2>
    
    <div class="kaira-page-description">
        <?php _e( '<a href="http://www.kairaweb.com/" target="_blank">Visit our website</a> to view our other Themes and Plugins.', 'levii' ); ?>
    </div>
    <div class="kaira-page-description">
        <?php _e( '<a href="http://app.sellwire.net/p/MB" target="_blank">Upgrade to Premium</a> to enable the following features.', 'levii' ); ?>
    </div>
    
    <table class="form-table">
        <tr>
            <th scope="row">
                <?php _e( 'Enable Social Icons in the header', 'levii' ); ?>
            </th>
            <td>
                <a href="<?php echo $levii_premium_link; ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/upgrade/images/header-social.jpg'; ?>" alt="" class="kaira-page-img" />
                </a>
                <p class="description"><?php _e( '<a href="http://app.sellwire.net/p/MB" target="_blank">Upgrade to premium</a> to enable adding the social icons to the header.', 'levii' ); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <?php _e( 'Blog Posts Layout', 'levii' ); ?>
            </th>
            <td>
                <a href="<?php echo $levii_premium_link; ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/upgrade/images/blog-layout.jpg'; ?>" alt="" class="kaira-page-img" />
                </a>
                <p class="description"><?php _e( 'Be able to change the blog layout to have image carousels on top of the post.', 'levii' ); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <?php _e( 'Social Icons', 'levii' ); ?>
            </th>
            <td>
                <a href="<?php echo $levii_premium_link; ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/upgrade/images/social-icons.jpg'; ?>" alt="" class="kaira-page-img" />
                </a>
                <p class="description"><?php _e( 'Be able to add social icons to the footer of your site.', 'levii' ); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <?php _e( 'Site Copy Info', 'levii' ); ?>
            </th>
            <td>
                <a href="<?php echo $levii_premium_link; ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/upgrade/images/site-copy.jpg'; ?>" alt="" class="kaira-page-img" />
                </a>
                <p class="description"><?php _e( 'Change the site \'copy info\' to link to your own website.', 'levii' ); ?></p>
            </td>
        </tr>
    </table>
    
</div>