<?php
/**
 * The sidebar template file.
 * @package MaryAnne
 * @since MaryAnne 1.0.0
*/
?>
<?php global $maryanne_options_db; ?>
<?php if ($maryanne_options_db['maryanne_display_sidebar'] != 'Hide') { ?>
<aside id="sidebar">
<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
<?php endif; ?>
</aside> <!-- end of sidebar -->
<?php } ?>