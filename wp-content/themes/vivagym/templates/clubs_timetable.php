<div class="club_timetable">
	<div class="grid">

		<?php

		// check if the repeater field has rows of data
		if( have_rows('opening_times_list') ):
		?>
			<div class="club_timtable_label">
				<span>Opening</span>
				<span>Hours:</span>
			</div>
		<?php

		 	// loop through the rows of data
		    while ( have_rows('opening_times_list') ) : the_row();
		?>

			<div>
				<span><?php echo get_sub_field('day'); ?></span>
				<span><?php echo get_sub_field('times'); ?></span>
			</div>

		<?php

		    endwhile;

		else :

		    // no rows found

		endif;

		?>

	</div>
</div>