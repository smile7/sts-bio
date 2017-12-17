<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package levii
 */ ?>
    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="site-footer-left">
    		
    		<?php printf( __( 'Theme: %1$s by %2$s.', 'levii' ), 'levii', '<a href="http://www.kairaweb.com/">Kaira</a>' ); ?>
    	   
        </div><!-- .site-info -->
        <div class="site-footer-right">
            
            <?php printf( __( 'Powered by %1$s', 'levii' ), '<a href="http://www.wordpress.org/">WordPress</a>' ); ?>
            
        </div>
        <div class="clearboth"></div>
    </footer><!-- #colophon -->
</div>
<?php wp_footer(); ?>
</body>
</html>