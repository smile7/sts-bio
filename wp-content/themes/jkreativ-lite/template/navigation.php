<div id="leftsidebar">

	<div class="lefttop">
		<div class="logo" style="padding-top: <?php echo esc_attr( ot_get_option('side_nav_top_padding') ); ?>px; padding-bottom: <?php echo ot_get_option('side_nav_bottom_padding'); ?>px;">
			<?php $side_nav_logo = ot_get_option('side_nav_logo_image'); ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if( !empty($side_nav_logo) ) :  ?>
					<img data-at2x="<?php echo esc_url(ot_get_option('side_nav_logo_retina')); ?>" src="<?php echo esc_url($side_nav_logo); ?>" alt="<?php bloginfo('name'); ?>"/>
				<?php else :
					echo get_bloginfo('name');
				endif; ?>
			</a></h1>
		</div>

		<?php jkreativ_lite_main_side_navigation(); ?>
	</div>

	<div class="leftfooter">
		<div class="leftfooterwrapper">
			<?php jkreativ_lite_side_bottom_navigation(); ?>
			<div class="footsocial">
				<?php echo jkreativ_lite_social_icon(false); ?>
			</div>
			<div class="footcopy"><?php echo esc_html(ot_get_option('website_copyright')); ?></div>
		</div>
	</div>

	<div class="csbwrapper">
		<div class="cbsheader">
			<div class="csbhicon"></div>
		</div>
		<div class="csbfooter">
			<?php echo jkreativ_lite_social_icon(false); ?>
		</div>
	</div>

</div>