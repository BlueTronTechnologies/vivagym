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

								        elseif( get_row_layout() == 'latest_blogs_home' ): 

								        	get_template_part( 'partials/content', 'latestbloghome' );

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

								        elseif( get_row_layout() == 'custom_the_content' ): 

								        	get_template_part( 'partials/content', 'thecontent' );

								        elseif( get_row_layout() == 'club_list' ): 

								        	get_template_part( 'partials/content', 'clublist' );

								        elseif( get_row_layout() == 'facilities_list' ): 

								        	get_template_part( 'partials/content', 'facilitieslist' );

								        elseif( get_row_layout() == 'classes_list' ): 

								        	get_template_part( 'partials/content', 'classeslist' );

								        elseif( get_row_layout() == 'guide_list' ): 

								        	get_template_part( 'partials/content', 'guidelist' );

								        elseif( get_row_layout() == 'pages_list' ): 

								        	get_template_part( 'partials/content', 'pageslist' );

								        elseif( get_row_layout() == 'blog_list' ): 

								        	get_template_part( 'partials/content', 'bloglist' );

								        elseif( get_row_layout() == 'meet_team' ): 

								        	get_template_part( 'partials/content', 'meetteam' );

								        elseif( get_row_layout() == 'contact_page' ): 

								        	get_template_part( 'partials/content', 'contact' );

								        elseif( get_row_layout() == 'accordian_block' ): 

								        	get_template_part( 'partials/content', 'accordian' );

								        elseif( get_row_layout() == 'facilities_statement' ): 

								        	get_template_part( 'partials/content', 'facstatement' );

								        elseif( get_row_layout() == 'timetable' ): 

								        	get_template_part( 'partials/content', 'timetable' );

								        elseif( get_row_layout() == 'faqs' ): 

								        	get_template_part( 'partials/content', 'allfaqs' );

								        endif;

								    endwhile;

								else : 

										get_template_part( 'partials/content', 'noblocks' );

								 endif; ?>