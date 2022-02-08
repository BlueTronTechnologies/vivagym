	<?php

		// check if the flexible content field has rows of data
		if( have_rows('page_footer') ):

			echo '<hr class="yellow">';

		    // loop through the rows of data
		    while ( have_rows('page_footer') ) : the_row();

		        if( get_row_layout() == 'footer_blog_list' ):

		            include  TEMPLATEPATH . "/templates/latest_blog_general.php";

		        elseif( get_row_layout() == 'footer_guides_list' ): 

		        	get_template_part( 'partials/footer', 'guides' );

		        endif;

		    endwhile;

		else : 

				//

		 endif; 

	 ?>