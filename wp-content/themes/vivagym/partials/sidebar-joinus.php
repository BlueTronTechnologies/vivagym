<div class="block <?php echo (get_sub_field('colors') && get_sub_field('colors') != 'default') ? get_sub_field('colors') : 'yellow'; ?>">
	<h3><?php echo (get_sub_field('heading')) ? get_sub_field('heading') : 'Join Us';  ?></h3>
	<?php echo (get_sub_field('content')) ? get_sub_field('content') : '<p>Come maximise your sexiness <br>with Viva Gym!</p>';  ?>
	<div class="button_container">
		<a href="<?php echo (get_sub_field('link')) ? get_sub_field('link') : get_bloginfo('url').'/blog/';  ?>" class="button white_border"><?php echo (get_sub_field('link_text')) ? get_sub_field('link_text') : 'VIEW OUR BLOG';  ?></a>
	</div>
</div>