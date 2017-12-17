<div id="loading" data-type="circle">
	<div class="relative" id="loader">
		<div class="" id="imgLoading">
			<img width="270" height="270" alt="" data-at2x="<?php echo esc_url(ot_get_option('circle_loader_retina')); ?>" src="<?php echo esc_url(ot_get_option('circle_loader_image')); ?>">
		</div>
		<canvas height="276" width="400" id="canvas">
			<?php _e('Loading...', 'jkreativ-lite'); ?>
		</canvas>
	</div>
</div>
<div id="loadingbg"><canvas id="mask"></canvas></div>