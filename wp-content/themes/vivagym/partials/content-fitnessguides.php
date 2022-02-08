<div class="section workout_guides">
			<div class="row">
				<div class="grid">
					<div class="box l_corner"></div>
					<div class="workout_guides_inner">
						<div class="box box1"><img src="<?php echo (get_sub_field('image')) ? get_sub_field('image') : ''; ?>" alt=""></div>
						<div class="box box2">
							<h3><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h3>
							<div class="slim_desc"><?php echo (get_sub_field('sub_title')) ? get_sub_field('sub_title') : ''; ?></div>
							<div class="desc">
								<?php echo (get_sub_field('content')) ? get_sub_field('content') : ''; ?>
							</div>
							<div class="button_container">
								<a class="blue_button proxy" href="<?php bloginfo('url'); ?>/fitness-library/">CHECK OUT OUR LIBRARY</a>
							</div>
						</div>
					</div>
					<div class="box r_corner"></div>
				</div>
			</div>
		</div>