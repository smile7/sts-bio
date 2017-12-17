<?php
/**
 * @package levii
 */
$images = get_posts( array("numberposts"=>-1,"post_type"=>"attachment","post_mime_type"=>"image","orderby" => "menu_order", "order" => "ASC","post_parent"=>$post->ID) );
$has_img = 'post-no-img';
if ( has_post_thumbnail() ) {
    $has_img = '';
} ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $has_img . ' blog-post-side-layout' ); ?>>
    
    <?php
    if ( $images ) : ?>
    <div class="post-loop-images">
        
        <div class="post-loop-images-carousel-wrapper post-loop-images-carousel-wrapper-remove">
            <div class="post-loop-images-prev"><i class="fa fa-angle-left"></i></div>
            <div class="post-loop-images-next"><i class="fa fa-angle-right"></i></div>
            
            <div class="post-loop-images-carousel post-loop-images-carousel-remove">
                
                <?php
                foreach ( $images as $image ) {
                    $title = $image->post_title;
                    $thumbimage = wp_get_attachment_image_src( $image->ID, 'blog_img_side' ); ?>
                    <img src="<?php echo $thumbimage[0]; ?>" alt="<?php echo esc_attr( $title ) ?>" />
                <?php
                } ?>
            
            </div>
            
        </div>
        
    </div>
    <?php endif; ?>
    
    <div class="post-loop-content">
        
    	<header class="entry-header">
    		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
            
            <div class="entry-meta">
        		<?php if ( 'post' == get_post_type() ) : ?>
        		<span class="entry-posted">
        			<?php levii_posted_on(); ?>
        		</span><!-- .entry-meta -->
        		<?php endif; ?>
                
                <?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                    echo '<span class="comments-link">';
                    comments_popup_link( __( 'Leave a comment', 'levii' ), __( '1 Comment', 'levii' ), __( '% Comments', 'levii' ) );
                    echo '</span>';
                } ?>
            </div>
            
    	</header><!-- .entry-header -->

    	<div class="entry-content">
    		<?php
            if ( get_the_excerpt() ) {
                echo get_the_excerpt() . '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'levii') . '</a>';
            } else {
                echo '<a class="view-post" href="'. get_permalink( get_the_ID() ) . '">' . __('View Post', 'levii') . '</a>';
            } ?>

    		<?php
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . __( 'Pages:', 'levii' ),
    				'after'  => '</div>',
    			) );
    		?>
    	</div><!-- .entry-content -->

    	<footer class="entry-footer">
    		<?php levii_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
        
    </div>
    
    <div class="clearboth"></div>
</article><!-- #post-## -->