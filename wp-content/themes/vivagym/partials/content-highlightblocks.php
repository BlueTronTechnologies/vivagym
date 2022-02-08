		<div class="section">
			<div class="row">
				<div class="row_header">
					<h2><?php echo (get_sub_field('heading')) ? get_sub_field('heading') : ''; ?></h2>
					<div class="row_tag" style="transform: rotate(-3deg);"><?php echo (get_sub_field('sub_heading')) ? get_sub_field('sub_heading') : ''; ?></div>
					<div class="desc">
						<?php echo (get_sub_field('intro')) ? get_sub_field('intro') : ''; ?>
					</div>
				</div>
				<div class="grid benefits">

					<?php

					// check if the repeater field has rows of data
					if( have_rows('highlight_blocks') ):

					 	// loop through the rows of data
					    while ( have_rows('highlight_blocks') ) : the_row();

					        // display a sub field value
					      
					        ?>


							<div class="box box1" style="background: url(<?php echo (get_sub_field('image')) ? get_sub_field('image') : ''; ?>) no-repeat 0 0 / cover;">
								<div class="overlay"></div>
								<div class="box_content">
									<h4><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h4>
									<?php echo (get_sub_field('content')) ? get_sub_field('content') : ''; ?>
									<div class="button_container">
										<?php echo (get_sub_field('link') && get_sub_field('link_text')) ? '<a class="blue_button" href="'.get_sub_field('link').'">'.get_sub_field('link_text').'</a>' : ''; ?>
									</div>
								</div>
								
							</div>

					        <?php

					    endwhile;

					else :

					    // no rows found

					endif;

					?>




				</div>
			</div>
		</div>