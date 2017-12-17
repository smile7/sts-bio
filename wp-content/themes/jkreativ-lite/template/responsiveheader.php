<div class="responsiveheader">
	<div class="navleft mobile-menu-trigger" data-role="main-mobile-menu">
		<div class="navleftinner">
			<div class="navleftwrapper"><span class="iconlist"></span></div>
		</div>
	</div>
	<div class="logo">
		<?php $mobile_nav_logo = ot_get_option('mobile_nav_logo_image'); ?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if( !empty($mobile_nav_logo) ) :  ?>
				<img data-at2x="<?php echo esc_url(ot_get_option('mobile_nav_logo_retina')); ?>" src="<?php echo esc_url($mobile_nav_logo); ?>" alt="<?php bloginfo('name'); ?>"/>
			<?php else :
				echo get_bloginfo('name');
			endif; ?>
		</a></h1>
	</div>
	<div class="navright mobile-search-trigger">
		<div class="navrightinner">
			<div class="navrightwrapper"><span class="iconlist"></span></div>
		</div>
	</div>

	<div class="mobilesearch">
		<?php get_search_form(); ?>
		<div class="closemobilesearch">
			<span class="default-remove"></span>
		</div>
	</div>
</div>