
		<div class="section">
			<div class="row">
							<!-- Section -->
				<div class="row_header">
					<h2><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h2>
					<div class="row_tag" style="transform: rotate(-3deg);"><?php echo (get_sub_field('sub_title')) ? get_sub_field('sub_title') : ''; ?></div>
				</div>
				<div class="video">
					<div class="videowrapper">
						<span class="placeholder" style="background: url(<?php echo (get_sub_field('video_bg')) ? get_sub_field('video_bg') : ''; ?>) no-repeat 0 0 / cover;">
							<span class="overlay"></span>
							<span class="prompt"><?php include TEMPLATEPATH . "/images/svg/play.svg" ?></span>
						</span>
						<?php echo (get_sub_field('video_block_vid')) ? get_sub_field('video_block_vid') : ''; ?>
					</div>
				</div>
			</div>
		</div>