<?php get_header(); ?>

    <div id="app">

    	<welcome></welcome>

		<?php

		// check if the flexible content field has rows of data
		if( have_rows('blocks') ):

		    // loop through the rows of data
		    while ( have_rows('blocks') ) : the_row();

		        if( get_row_layout() == 'home_hero' ):

		            get_template_part( 'partials/content', 'homehero' );

		        elseif( get_row_layout() == 'text_block' ): 

		        	get_template_part( 'partials/content', 'textblock' );

		        elseif( get_row_layout() == 'highlight_blocks' ): 

		        	get_template_part( 'partials/content', 'highlightblocks' );

		        elseif( get_row_layout() == 'video_block' ): 

		        	get_template_part( 'partials/content', 'videoblock' );

		        elseif( get_row_layout() == 'latest_blogs' ): 

		        	get_template_part( 'partials/content', 'latestblogs' );

		        elseif( get_row_layout() == 'finder_and_timetable' ): 

		        	get_template_part( 'partials/content', 'finderandtimetable' );

		        elseif( get_row_layout() == 'social_block' ): 

		        	get_template_part( 'partials/content', 'socialblock' );

		        elseif( get_row_layout() == 'single_highlight_block' ): 

		        	get_template_part( 'partials/content', 'singlehighlightblock' );

		        elseif( get_row_layout() == 'text_black_background' ): 

		        	get_template_part( 'partials/content', 'textblackbackground' );

		        elseif( get_row_layout() == 'member_comments' ): 

		        	get_template_part( 'partials/content', 'membercomments' );

		        elseif( get_row_layout() == 'featured_trainers' ): 

		        	get_template_part( 'partials/content', 'featuredtrainers' );

		        elseif( get_row_layout() == 'fitness_guides' ): 

		        	get_template_part( 'partials/content', 'fitnessguides' );

		        endif;

		    endwhile;

		else : 

			if (have_posts()) { while (have_posts()) { the_post();

				get_template_part( 'partials/content', 'noblocks' );

		 	} } 

		 endif; ?>

    </div>
	
<?php get_footer(); ?>