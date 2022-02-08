		<div id="accordion" class="accordion-container">

			<?php

			// check if the repeater field has rows of data
			if( have_rows('accordian') ):

			 	// loop through the rows of data
			    while ( have_rows('accordian') ) : the_row();

			?>

			<div class="accordion_row">
				<h5 class="accord_title"><?php echo (get_sub_field('title')) ? get_sub_field('title') : ''; ?></h5>
				<div class="accord_content">
					<?php echo (get_sub_field('content')) ? get_sub_field('content') : ''; ?>
				</div>
			</div>

			<?php

			    endwhile;

			else :

			    // no rows found

			endif;

			?>



		</div>